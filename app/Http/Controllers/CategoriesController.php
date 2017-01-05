<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\IndiaReads\Repository\Eloquent\BookRepository;
use App\IndiaReads\Repository\Eloquent\BookLibraryRepository;
use App\IndiaReads\Repository\Eloquent\MerchantLibraryRepository;
use App\IndiaReads\Repository\Eloquent\SuperCatsRepository;
use App\IndiaReads\Repository\Eloquent\ParentCategoriesRepository;
use App\IndiaReads\Repository\Eloquent\CatsLevel1Repository;
use App\IndiaReads\Repository\Eloquent\CatsLevel2Repository;
use App\IndiaReads\Repository\Eloquent\BookCategoryMappingRepository;
use App\IndiaReads\Repository\Transformers\BookTransformer;
use App\IndiaReads\Repository\Transformers\ParentCategoryTransformer;
use App\IndiaReads\Repository\Transformers\CatLevel1Transformer;
use App\IndiaReads\Repository\Transformers\CatLevel2Transformer;
use App\IndiaReads\Repository\Transformers\AllCatTransformer;
use App\IndiaReads\Repository\Transformers\SubCatTransformer;

use App\Http\Requests;
use Illuminate\Contracts\Pagination\Paginator;
use App\Http\Controllers\Controller;

class CategoriesController extends ApiController {

    /**
     * @var paginatiion_limit
     */
    protected $pagination_limit = 20;

    /**
     * @var BookRepository
     */
    protected $bookRepository;

    /**
     * @var BookLibraryRepository
     */
    protected $bookLibraryRepository;

    /**
     * @var MerchantLibraryRepository
     */
    protected $merchantLibraryRepository;

    /**
     * @var SuperCatsRepository
     */
    protected $superCatsRepository;

    /**
     * @var ParentCategoriesRepository
     */
    protected $parentCategoriesRepository;

    /**
     * @var CatsLevel1Repository
     */
    protected $catsLevel1Repository;

    /**
     * @var CatsLevel2Repository
     */
    protected $catsLevel2Repository;

    /**
     * @var BookCategoryMappingRepository
     */
    protected $bookCategoryMappingRepository;

    /**
     * @var BookTransformer
     */
    protected $bookTransformer;

    /**
     * @var CategoryTransformer
     */
    protected $parentCategoryTransformer;

    /**
     * @var CatLevel1Transformer
     */
    protected $catLevel1Transformer;

    /**
     * @var CatLevel2Transformer
     */
    protected $catLevel2Transformer;

    /**
     * @var AllCatTransformer
     */
    protected $allCatTransformer;

    /**
     * @var SubCatTransformer
     */
    protected $subCatTransformer;

    /**
     * @param BookRepository $bookRepository
     * @param SuperCatsRepository $superCatsRepository
     * @param ParentCategoriesRepository $parentCategoriesRepository
     * @param CatsLevel1Repository $catsLevel2Repository
     * @param CatsLevel2Repository $catsLevel2Repository
     * @param BookCategoryMappingRepository
     * @param ParentCategoryTransformer
     * @param CatLevel1Transformer
     * @param CatLevel2Transformer
     * @param allCatTransformer
     * @param subCatTransformer
     */
    function __construct(BookRepository $bookRepository, BookLibraryRepository $bookLibraryRepository, MerchantLibraryRepository $merchantLibraryRepository, SuperCatsRepository $superCatsRepository, ParentCategoriesRepository $parentCategoriesRepository,CatsLevel1Repository $catsLevel1Repository, CatsLevel2Repository $catsLevel2Repository, BookCategoryMappingRepository $bookCategoryMappingRepository, BookTransformer $bookTransformer, ParentCategoryTransformer $parentCategoryTransformer, CatLevel1Transformer $catLevel1Transformer, CatLevel2Transformer $catLevel2Transformer, AllCatTransformer $allCatTransformer, SubCatTransformer $subCatTransformer) {
        $this->bookRepository = $bookRepository;
        $this->bookLibraryRepository = $bookLibraryRepository;
        $this->merchantLibraryRepository = $merchantLibraryRepository;
        $this->superCatsRepository = $superCatsRepository;
        $this->parentCategoriesRepository = $parentCategoriesRepository;
        $this->catsLevel1Repository = $catsLevel1Repository;
        $this->catsLevel2Repository = $catsLevel2Repository;
        $this->bookCategoryMappingRepository = $bookCategoryMappingRepository;
        $this->bookTransformer = $bookTransformer;
        $this->parentCategoryTransformer = $parentCategoryTransformer;
        $this->catLevel1Transformer = $catLevel1Transformer;
        $this->catLevel2Transformer = $catLevel2Transformer;
        $this->allCatTransformer = $allCatTransformer;
        $this->subCatTransformer = $subCatTransformer;
    }

    // ======================Helper Functions============================

    /**
     * Check wether ISBN13 in book_library or in merchant_library
     * @param array(ISBN13's)
     * @return array(ISBN13's)
     */
    public function filterBooks(array $isbn13) {
        // return count($isbn13);
        $in_lib = array();
        $in_no_lib = array();
        $isbns = array();

        foreach ($isbn13 as $isbn) {
            $this->bookLibraryRepository->resetModel();
            // check availability in book library
            $data_book_lib = $this->bookLibraryRepository->findWhere(array(array('ISBN13','=',$isbn['ISBN13']), array('status','=',1)))->limited(1)->order('circulation', 'desc')->getData(array('ISBN13', 'title'));
            // return $data_book_lib[0]->toArray();
            if (count($data_book_lib) > 0) {
                array_push($in_lib, $data_book_lib[0]->toArray());
            }
            // check availability in merchant library
            else {
              $this->merchantLibraryRepository->resetModel();
              $data_merchant_lib = $this->merchantLibraryRepository->findWhere(array('ISBN13' => $isbn['ISBN13']))->limited(1)->getData(array('*'));
              // return $data_merchant_lib;
              if (count($data_merchant_lib) > 0) {
                array_push($in_lib, $data_merchant_lib[0]->toArray());
              }
              else
                array_push($in_no_lib, $isbn);
            }
        }
        $isbns['in_stock'] = $in_lib;
        $isbns['out_of_stock'] = $in_no_lib;

        return $isbns;
    }

    //  ========================API==================================

    /**
     * Get Super Cat Books
     * @param super_cat_id
     * @return [{isbn13, title}, ...]
     */
    public function getSuperCatBooks($super_cat_id = 'null') {
        $filtered_books_transformed = array();
        if ($super_cat_id != 'null') {
            $books = $this->bookCategoryMappingRepository->findMultipleWhere(array('super_cat_id' => $super_cat_id))->paginate(50);
            $paginated_array = json_decode($books->toJson(), true);

            //->getData(array('ISBN13'));
            $filtered_books = $this->filterBooks(json_decode($books->toJson(), true)["data"]);
            $in_stock_transformed = $this->bookTransformer->transformCollection($filtered_books['in_stock']);
            $out_of_stock_transformed = $this->bookTransformer->transformCollection($filtered_books['out_of_stock']);
            $filtered_books_transformed['in_stock'] = $in_stock_transformed;
            $filtered_books_transformed['out_of_stock'] = $out_of_stock_transformed;

            if (count($paginated_array) > 0) {
                return $this->respondWithPagination($paginated_array, $filtered_books_transformed);
            }
            /*if (count($filtered_books) > 0) {
                return $this->respond(array('data' => $filtered_books));
            }*/
            return $this->respondWithError('No books found!!!');
        }
        return $this->respondWithError('Specify correct parent_id');
    }

    /**
     * Get Parent Cats
     * @param super_cat_id
     * @return [{parent_id, category}, ...]
     */
    public function getParentCats($super_cat_id = 'null') {
        if ($super_cat_id != 'null') {
            $this->parentCategoriesRepository->findMultipleWhere(array('super_cat_id' => $super_cat_id), array('parent_id', 'category'));
            $paginated_array = json_decode($this->parentCategoriesRepository->paginate($this->pagination_limit)->toJson(), true);
            $paginated_data = $this->parentCategoryTransformer->transformCollection($paginated_array['data']);
            if (count($paginated_data) > 0) {
                return $this->respond(array(
                                                              'categoryType' => 'parent_cats',
                                                              'data' => $paginated_data
                                                    ));
            }
        }
        return $this->respondWithError('No Categories Found!');
    }

    /**
     * Get Parent Category Books
     * @param parent_id
     * @return [{isbn13, title}, ...]
     */
    public function getParentCatBooks($parent_id = 'null') {
        $filtered_books_transformed = array();
        if ($parent_id != 'null') {
            $books = $this->bookCategoryMappingRepository->findMultipleWhere(array('parent_id' => $parent_id))
			->paginate(50);
	       $paginated_array = json_decode($books->toJson(), true);

			//->getData(array('ISBN13'));
            $filtered_books = $this->filterBooks(json_decode($books->toJson(), true)["data"]);
            $in_stock_transformed = $this->bookTransformer->transformCollection($filtered_books['in_stock']);
            $out_of_stock_transformed = $this->bookTransformer->transformCollection($filtered_books['out_of_stock']);
            $filtered_books_transformed['in_stock'] = $in_stock_transformed;
            $filtered_books_transformed['out_of_stock'] = $out_of_stock_transformed;

    	    if (count($paginated_array) > 0) {
                return $this->respondWithPagination($paginated_array, $filtered_books_transformed);
            }
            /*if (count($filtered_books) > 0) {
                return $this->respond(array('data' => $filtered_books));
            }*/
            return $this->respondWithError('No books found!!!');
        }
        return $this->respondWithError('Specify correct parent_id');
    }

    /**
     * Get all cats
     * @param parent_id
     * @return all categories below parent categories
     */
    public function getAllCats($parent_id = 'null') {
        $data_cats_level1 = array();
        $data_cats_level2 = array();
        $data_cats = array();
        $data = array();

        if ($parent_id != 'null') {
            $data_cats_level1 = $this->catsLevel1Repository->findMultipleWhere(array('parent_id' => $parent_id))->getData(array('cat1_id', 'category'));
            $data_cats_1 = $this->allCatTransformer->transformCollection($data_cats_level1->toArray());
            foreach ($data_cats_1 as $key => $value) {
                $data_cats_level2 = $this->catsLevel2Repository->findMultipleWhere(array('cat1_id' => $value['catID1']))->getData(array('cat2_id', 'category'));
                $data_cats_2 = $this->subCatTransformer->transformCollection($data_cats_level2->toArray());
                $data_cats_1[$key]['subCategory'] = $data_cats_2;
            }
        }
        if (count($data_cats_1) > 0) {
            return $this->respond(array('data' => $data_cats_1));
        }
        return $this->respond(array('data' => []));
    }

    /**
     * Get Level 1 Categories
     * @param parent_id
     * @return [{parent_id, category}, ...]
     */
    public function getLevel1Cats($parent_id = 'null') {
        if ($parent_id != 'null') {
            $this->catsLevel1Repository->findMultipleWhere(array('parent_id' => $parent_id))->getData(array('cat1_id', 'category'));
            $paginated_array = json_decode($this->catsLevel1Repository->paginate($this->pagination_limit)->toJson(), true);
            $paginated_data = $this->catLevel1Transformer->transformCollection($paginated_array['data']);
            if (count($paginated_data) > 0) {
                return $this->respond(array(
                                                                'categoryType' => 'cats_level_1',
                                                                'data' => $paginated_data
                                                    ));
            }
        }
        return $this->respondWithError('No Categories Found!');
    }

    /**
     * Get Level 1 Cats Books
     * @param parent_id
     * @return [{isbn13, title}, ...]
     */
    public function getLevel1CatBooks($cat1_id = 'null') {
        $filtered_books_transformed = array();
        if ($cat1_id != 'null') {
            $books = $this->bookCategoryMappingRepository->findMultipleWhere(array('cat1_id' => $cat1_id))->paginate(50);
            $paginated_array = json_decode($books->toJson(), true);
            $filtered_books = $this->filterBooks(json_decode($books->toJson(), true)["data"]);
            $in_stock_transformed = $this->bookTransformer->transformCollection($filtered_books['in_stock']);
            $out_of_stock_transformed = $this->bookTransformer->transformCollection($filtered_books['out_of_stock']);
            $filtered_books_transformed['in_stock'] = $in_stock_transformed;
            $filtered_books_transformed['out_of_stock'] = $out_of_stock_transformed;

            if (count($paginated_array) > 0) {
                return $this->respondWithPagination($paginated_array, $filtered_books_transformed);
            }
            /*if (count($filtered_books) > 0) {
                return $this->respond(array('data' => $filtered_books));
            }*/
            return $this->respondWithError('No books found!!!');
        }
        return $this->respondWithError('Specify correct cat1ID');
    }

    /**
     * Get Level 2 Categories
     * @param cat1_id
     * @return [{parent_id, category}, ...]
     */
    public function getLevel2Cats($cat1_id = 'null') {
        if ($cat1_id != 'null') {
            $this->catsLevel2Repository->findMultipleWhere(array('cat1_id' => $cat1_id))->getData(array('cat2_id', 'category'));
            $paginated_array = json_decode($this->catsLevel2Repository->paginate($this->pagination_limit)->toJson(), true);
            $paginated_data = $this->catLevel2Transformer->transformCollection($paginated_array['data']);
            if (count($paginated_data) > 0) {
                return $this->respond(array(
                                                                  'categoryType' => 'cats_level_2',
                                                                  'data' => $paginated_data
                                                    ));
            }
        }
        return $this->respondWithError('No Categories Found!');
    }

    /**
     * Get Level 2 Cats Books
     * @param cat2_id
     * @return [{isbn13, title}, ...]
     */
    public function getCatlevel2Books($cat2_id = 'null') {
        if ($cat2_id != 'null') {
            $books = $this->bookCategoryMappingRepository->findMultipleWhere(array('cat2_id' => $cat2_id))->paginate(50);
            $paginated_array = json_decode($books->toJson(), true);
            $filtered_books = $this->filterBooks(json_decode($books->toJson(), true)["data"]);
            $in_stock_transformed = $this->bookTransformer->transformCollection($filtered_books['in_stock']);
            $out_of_stock_transformed = $this->bookTransformer->transformCollection($filtered_books['out_of_stock']);
            $filtered_books_transformed['in_stock'] = $in_stock_transformed;
            $filtered_books_transformed['out_of_stock'] = $out_of_stock_transformed;

            if (count($paginated_array) > 0) {
                return $this->respondWithPagination($paginated_array, $filtered_books_transformed);
            }
            /*if (count($filtered_books) > 0) {
                return $this->respond(array('data' => $filtered_books));
            }*/
            return $this->respondWithError('No books found!!!');
        }
        return $this->respondWithError('Specify correct cat1ID');
    }

}
