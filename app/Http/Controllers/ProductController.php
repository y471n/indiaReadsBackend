<?php

/**
 * Created By:-> Saurabh Sharma
 */

/**
 *Define Namespace
 */
namespace App\Http\Controllers;

/**
 * Importing Laravel Specific Modules
 */
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Contracts\Pagination\Paginator;
use App\Http\Controllers\Controller;

/**
 * Importing User Defined Modules
 */
use App\IndiaReads\Repository\Eloquent\BookRepository;
use App\IndiaReads\Repository\Eloquent\BookLibraryRepository;
use App\IndiaReads\Repository\Eloquent\BookCategoryMappingRepository;
use App\IndiaReads\Repository\Eloquent\MerchantLibraryRepository;
use App\IndiaReads\Repository\Eloquent\MerchantDetailsRepository;
use App\IndiaReads\Repository\Eloquent\InitialDiscountRepository;
use App\IndiaReads\Repository\Eloquent\CirculationDiscountRepository;
use App\IndiaReads\Repository\Eloquent\RentStructureRepository;
use App\IndiaReads\Repository\Transformers\ProductTransformer;
use App\IndiaReads\Repository\Transformers\BookTransformer;
use App\IndiaReads\Repository\Transformers\RentTransformer;

/**
 * class ProductController
 * serving product page of the website
 */
class ProductController extends ApiController {

    /**
     * @var pagination_limit
     */
    protected $pagination_limit = 10;

    /**
     * @var BookRepository
     */
    protected $bookRepository;

    /**
     * @var BookLibraryRepository
     */
    protected $bookLibraryRepository;

    /**
     * @var BookCategoryMappingRepository
     */
    protected $bookCategoryMappingRepository;

    /**
     * @var MerchantLibraryRepository
     */
    protected $merchantLibraryRepository;

    /**
     * @var MerchantDetailsRepository
     */
    protected $merchantDetailsRepository;

    /**
     * @var RentStructureRepository
     */
    protected $rentStructureRepository;

    /**
     * @var InitialDiscountRepository
     */
    protected $initialDiscountRepository;

    /**
     * @var CirculationDiscountRepository
     */
    protected $circulationDiscountRepository;

    /**
     * @var ProductTransformer
     */
    protected $productTransformer;

    /**
     * @var BookTransformer
     */
    protected $bookTransformer;

    /**
     * @var RentTransformer
     */
    protected $rentTransformer;

    /**
     * @param BookRepository $bookRepository
     */
    function __construct(BookRepository $bookRepository, BookLibraryRepository $bookLibraryRepository, BookCategoryMappingRepository $bookCategoryMappingRepository, MerchantLibraryRepository $merchantLibraryRepository, MerchantDetailsRepository $merchantDetailsRepository, RentStructureRepository $rentStructureRepository, InitialDiscountRepository $initialDiscountRepository, CirculationDiscountRepository $circulationDiscountRepository, ProductTransformer $productTransformer, BookTransformer $bookTransformer, RentTransformer $rentTransformer) {
        $this->bookRepository = $bookRepository;
        $this->bookLibraryRepository = $bookLibraryRepository;
        $this->bookCategoryMappingRepository = $bookCategoryMappingRepository;
        $this->merchantLibraryRepository = $merchantLibraryRepository;
        $this->merchantDetailsRepository = $merchantDetailsRepository;
        $this->initialDiscountRepository = $initialDiscountRepository;
        $this->circulationDiscountRepository = $circulationDiscountRepository;
        $this->rentStructureRepository = $rentStructureRepository;
        $this->productTransformer = $productTransformer;
        $this->bookTransformer = $bookTransformer;
        $this->rentTransformer = $rentTransformer;
    }

    // ===================================Helper Functions============================

    /**
     * Check wether ISBN13 in book_library or in merchant_library
     * @param array(ISBN13's)
     * @return array(ISBN13's)
     */
    public function inBookLibrary(array $isbn13) {
        $isbns_exist = array();
        foreach ($isbn13 as $isbn) {
            $this->bookLibraryRepository->resetModel();
            // check availability in book library
            $data_book_lib = $this->bookLibraryRepository->findWhere(array('ISBN13' => $isbn['ISBN13']))->order('circulation', 'desc')->getData(array('ISBN13'));
            $this->bookLibraryRepository->resetModel();
            if (count($data_book_lib) > 0) {
                array_push($isbns_exist, $isbn);
            }
            // check availability in merchant library
            else {
              $this->merchantLibraryRepository->resetModel();
              $data_merchant_lib = $this->merchantLibraryRepository->findWhere(array('ISBN13' => $isbn['ISBN13']))->getData(array('ISBN13'));
              $this->merchantLibraryRepository->resetModel();
              if (count($data_merchant_lib) > 0) {
                array_push($isbns_exist, $data_merchant_lib);
              }
            }
        }
        if (count($isbns_exist) >= 3) {
            return $isbns_exist;
        }
        return [];
    }

    /**
     * Get Book under a category
     * @param ISBN13
     * @return array(ISBN13's)
     */
    public function getBooksUnderCategoryID($isbn13) {
        $this->bookCategoryMappingRepository->resetModel();
        $book = $this->bookCategoryMappingRepository->findWhere(array('ISBN13' => $isbn13))->getData(array('ISBN13'));
        if (count($book) > 0) {
            $category2_id = $this->bookCategoryMappingRepository->findWhere(array('ISBN13' => $isbn13))->getData(array('cat2_id'));
            if ($category2_id[0]->cat2_id == 0) {
                $this->bookCategoryMappingRepository->resetModel();
                $category1_id = $this->bookCategoryMappingRepository->findWhere(array('ISBN13' => $isbn13))->getData(array('cat1_id'));
                if ($category1_id[0]->cat1_id == 0) {
                    $this->bookCategoryMappingRepository->resetModel();
                    $parent_id = $this->bookCategoryMappingRepository->findWhere(array('ISBN13' => $isbn13))->getData(array('parent_id'));
                    if ($parent_id[0]->parent_id == 0) {
                        return "null";
                    }
                    else {
                        $this->bookCategoryMappingRepository->resetModel();
                        $isbns = $this->bookCategoryMappingRepository->findMultipleWhere(array('parent_id' => $parent_id[0]->parent_id))->limited(10)->getData(array('ISBN13', 'title'));
                        return $isbns;
                    }
                }
                else {
                    $this->bookCategoryMappingRepository->resetModel();
                    $isbns = $this->bookCategoryMappingRepository->findMultipleWhere(array('cat1_id' => $category1_id[0]->cat1_id))->limited(10)->getData(array('ISBN13', 'title'));
                    return $isbns;
                }
            }
            else {
                $this->bookCategoryMappingRepository->resetModel();
                $isbns = $this->bookCategoryMappingRepository->findMultipleWhere(array('cat2_id' => $category2_id[0]->cat2_id))->limited(10)->getData(array('ISBN13', 'title'));
                return $isbns;
            }
        }
        else {
            return [];
        }
    }

    /**
     * Auxillary Book Details for Bundle Books
     * @param ISBN13
     * @return auxillary book details
     */
    public function auxillaryBookDetailsForBundle($isbn13) {
        $data = array();
        // reset the model
        $this->bookRepository->resetModel();
        // fetch the ISBN13 and title from sub_mastersheet on the basis of ISBN13
        $auxillary_book_details = $this->bookRepository->findWhere(array('ISBN13' => $isbn13))->getData(array('ISBN13', 'title', 'vol', 'series', 'contributor_name1'));
        // reset the model
        $this->bookRepository->resetModel();
        // check data count
        if (count($auxillary_book_details) > 0) {
            //  fetch data on basis of author
            if ($auxillary_book_details[0]->contributor_name1 != '') {
                // reset the model
                $this->bookRepository->resetModel();
                $data_author = $this->bookRepository->findMultipleWhere(array('contributor_name1' => $auxillary_book_details[0]->contributor_name1))->limited(5)->getData(array('ISBN13', 'title', 'contributor_name1'));
                array_push($data, $data_author);
            }
            // fetch data on the basis of series
            if ($auxillary_book_details[0]->series != '') {
                // reset the model
                $this->bookRepository->resetModel();
                $data_series = $this->bookRepository->findMultipleWhere(array('series' => $auxillary_book_details[0]->series))->limited(5)->getData(array('ISBN13', 'title', 'series'));
                array_push($data, $data_series);
            }
            // fetch data on the basis of vol
            if ($auxillary_book_details[0]->vol != '') {
                // reset the model
                $this->bookRepository->resetModel();
                $data_vol = $this->bookRepository->findMultipleWhere(array('series' => $auxillary_book_details[0]->vol))->limited(5)->getData(array('ISBN13', 'title', 'vol'));
                array_push($data, $data_vol);
            }
            // data count check
            if (count($data) > 0) {
                $data_bundle = array_slice($data[0]->toArray(), 0, 3);
                return $data_bundle;
            }
        }
        return [];
    }

    /**
     * Auxillary Book Details for Similar Books
     * @param ISBN13
     * @return auxillary book details
     */
    public function auxillaryBookDetailsForSimilar($isbn13) {
        $count = 0;
        $similar_books_temp = array();
        $data = array();

        $this->bookRepository->resetModel();
        $book = $this->bookRepository->findWhere(array('ISBN13' => $isbn13))->getData(array('ISBN13', 'title', 'contributor_name1', 'series', 'vol'));
        if (count($book) > 0) {
            if ($book[0]->contributor_name1 != null && $book[0]->series != null && $book[0]->vol != null) {
                $this->bookRepository->resetModel();
                $isbns = $this->bookRepository->findMultipleOrWhere( array(array('title', 'LIKE', ''.$book[0]->title.'%'), array('contributor_name1', 'LIKE', ''.$book[0]->contributor_name1.'%'), array('series', 'LIKE', ''.$book[0]->series.'%')))->limited(10)->getData(array('ISBN13', 'title'));
                $data = array_merge($similar_books_temp, $isbns->toArray());
                if (count($data) ==10) {
                    return $data;
                }
            }
            elseif ($book[0]->title != null) {
                $this->bookRepository->resetModel();
                $isbns = $this->bookRepository->findMultipleWhere( array(array('title', 'LIKE', ''.$book[0]->title.'%')))->limited(10 - count($data))->getData(array('ISBN13', 'title'));
                $data = array_merge($similar_books_temp, $isbns->toArray());
                if (count($data) ==10) {
                    return $data;
                }
            }
            elseif ($book[0]->contributor_name1 != null) {
                $this->bookRepository->resetModel();
                $isbns = $this->bookRepository->findMultipleWhere( array(array('contributor_name1', 'LIKE', ''.$book[0]->contributor_name1.'%')))->limited(10 - count($data))->getData(array('ISBN13', 'title'));
                $data = array_merge($similar_books_temp, $isbns->toArray());
                if (count($data) ==10) {
                    return $data;
                }
            }
            elseif ($book[0]->series != null) {
                $this->bookRepository->resetModel();
                $isbns = $this->bookRepository->findMultipleWhere( array(array('series', 'LIKE', ''.$book[0]->series.'%')))->limited(10)->getData(array('ISBN13', 'title'));
                $data = array_merge($similar_books_temp, $isbns->toArray());
                if (count($data) ==10) {
                    return $data;
                }
            }
            return $data;
        }
        else {
            return [];
        }
    }

    /**
     * Calculate Total Discount
     * @param ISBN13
     * @return total discount
     */
    public function calculateTotalDiscount($isbn13, $circulation, $mrp, $status){
        // get initial discount
        if ($status == 1) {
          $initial_discount = 12;
        }
        else {
          $this->initialDiscountRepository->resetModel();
          $initial_discount_data = $this->initialDiscountRepository->findWhere(array('ISBN13' => $isbn13))->getData(array('discount'));
          if (count($initial_discount_data) > 0) {
            $initial_discount = abs($initial_discount_data[0]['discount']);
          }
          else {
            $initial_discount = 12;
          }
        }

        // get circulation discount
        if ($circulation <= 0) {
          $this->circulationDiscountRepository->resetModel();
            $circulation_discount_data = $this->circulationDiscountRepository->findWhere(array(array('circulation', '<=', 0)))->getData(array('discounts'));
        }
        elseif ($circulation >= 1 && $circulation < 5) {
          $this->circulationDiscountRepository->resetModel();
            $circulation_discount_data = $this->circulationDiscountRepository->findWhere(array('circulation' => $circulation))->getData(array('discounts'));
        }
        else {
          $this->circulationDiscountRepository->resetModel();
            $circulation_discount_data = $this->circulationDiscountRepository->findWhere(array(array('circulation', '>=', 5)))->getData(array('discounts'));
        }
        $circulation_discount = $circulation_discount_data[0]['discounts'];

        $total_discount = abs($initial_discount + $circulation_discount);
        if ($total_discount > 0) {
            return $total_discount;
        }
        return 0;
    }

    /**
     * Calculate Initial Payable
     * @param ISBN13
     * @return initial payable
     */
    public function calculateInitialPayable($isbn13, $circulation, $mrp, $status) {
        // get total discount
        $total_discount_details = $this->calculateTotalDiscount($isbn13, $circulation, $mrp, $status);
        $total_discount = abs($total_discount_details);
        if ($total_discount_details < 100) {
            $initial_payable = abs($mrp * ((100 - $total_discount)/100));
            if ($initial_payable > 0) {
                return $initial_payable;
            }
        }
    }

    /**
     * Calculate Rental Details
     * @param initial_payable, mrp
     * @return rent for each defined duration
     */
    public function calculateRentalDetails($mrp, $initial_payable) {
        $rent_for_30 = round(abs(( 25 * $mrp * ( 0.7 + ( $initial_payable * $initial_payable )/( $mrp * $mrp )))/100));
        $rent_for_90 = round(abs(( 30 * $mrp * ( 0.7 + ( $initial_payable * $initial_payable )/( $mrp * $mrp )))/100));
        $rent_for_180 = round(abs(( 35 * $mrp * ( 0.7 + ( $initial_payable * $initial_payable )/( $mrp * $mrp )))/100));
        $rent_for_360 = round(abs(( 40 * $mrp * ( 0.7 + ( $initial_payable * $initial_payable )/( $mrp * $mrp )))/100));

        $rent_details = array('rent' => array($rent_for_30, $rent_for_90, $rent_for_180, $rent_for_360) );
        return $rent_details;
    }

    // ======================================API=================================

    /**
     * Get Book Details
     * @param ISBN13
     * @return book_details
     */
    public function getBookDetails($isbn13 = 'null') {
      $rent_details = array();
      $rental_details = array();

      if ($isbn13 != 'null') {
        // fetch the data from sub_mastersheet
        $data = $this->bookRepository->findWhere(array('ISBN13' => $isbn13))->getData(array('ISBN13', 'title', 'contributor_name1', 'contributor_name2', 'contributor_name3', 'short_desc', 'long_desc', 'author_bio', 'publisher_name', 'imprint_name', 'page_no', 'publication_date', 'text_language', 'product_form'));
            // data count check
            if (count($data) > 0) {
                // transform the data
                $book_details = $this->productTransformer->transform($data[0]);

                // get rental details
                $rent_data = $this->getRentalDetails($isbn13);

                if (count($rent_data) > 0) {
                  array_push($rental_details, $rent_data);
                    // transform the data
                    $rent = $this->rentTransformer->transformCollection($rental_details);
                }
                else {
                    $rent = [];
                }
            }
            else {
                $book_details = [];
            }
            // array for rent details
            array_push($rent_details, $rent);
            // assign the rent details to the book details array
            $book_details['rent'] = $rent[0];
            if (count($book_details) > 0) {
                return $this->respond(array('data' => $book_details));
            }
            return $this->respondWithError('Book Details Not Found!');
        }
        return $this->respondWithError('ISBN13 not specified!!!');
    }

    /**
     * Get Bundle for specified ISBN13
     * @param ISBN13
     * @return [bundle_books]
     */
    public function getBundleBooks($isbn13 = 'null') {
        if ($isbn13 != 'null') {
            $data = $this->auxillaryBookDetailsForBundle($isbn13);
            $data_filter = $this->inBookLibrary($data);
            $bundle_books = $this->bookTransformer->transformCollection($data_filter);
            if (count($bundle_books) >= 0) {
                return $this->respond(array('data' => $bundle_books));
            }
            return $this->respondWithError("Bundle Not Available");
        }
        return $this->respondWithError("ISBN13 Not Specified");
    }

    /**
     * Get Similar Books
     * @param ISBN13
     * @return [similar_books]
     */
    public function getSimilarBooks($isbn13 = 'null') {
        $data_similar_books = array();
        $similar_books = array();
        $data_aux_details = array();
        $data_cats_details = array();
        $data = array();

        if ($isbn13 != 'null') {
            $similar_books_temp1 = $this->auxillaryBookDetailsForSimilar($isbn13);
            $data_aux = array_merge($data_aux_details, $similar_books_temp1);
            if (count($data_aux) >= 10) {
                $data_similar_books = array_merge($data, $data_aux);
            }
            else {
                $similar_books_temp2 = $this->getBooksUnderCategoryID($isbn13);
                $data_cats = array_merge($data_aux, $similar_books_temp2->toArray());
                if (count($data_cats) >= 10) {
                    $data_similar_books = array_merge($data, $data_cats);
                }
            }
            $similar_books = $this->bookTransformer->transformCollection($data_similar_books);

            if (count($similar_books) >= 0) {
                return $this->respond(array('data' => $similar_books));
            }
            return $this->respondWithError("Similar Books Not Available");
        }
        return $this->respondWithError("ISBN13 Not Specified");
    }

    /**
     * Get Rental Details
     * @param ISBN13
     * @return rental_details
     */
    public function getRentalDetails($isbn13 = 'null') {
        if ($isbn13 != 'null') {
            // check for existence of book in book library
            $book_lib = $this->bookLibraryRepository->
                            findMultipleWhere(array('ISBN13' => $isbn13))->
                            order('circulation', 'desc')->
                            getData(array('book_id', 'circulation'));
            // reset the model
            $this->bookLibraryRepository->resetModel();

            // check for existence of book in merchant library
            $merchant_lib = $this->merchantLibraryRepository->
                                findMultipleWhere(array('ISBN13' => $isbn13))->
                                getData(array('ISBN13'));
            // reset the model
            $this->merchantLibraryRepository->resetModel();

            // check for book in book library
            // if (count($book_lib) > 0) {
            //     // check for price in merchant library
            //     $price = $this->merchantLibraryRepository->
            //                 findWhere(array('ISBN13' => $isbn13))->
            //                 getData('merchant_id', 'supply_price');
            //     // if price found
            //     if ($price[0]['supply_price'] > 0) {
            //         $procurement_time = $this->merchantDetailsRepository->
            //                                 findWhere(array('merchant_id' => $price[0]['merchant_id']))->
            //                                 getData(array('procurement_time'));
            //         // initialise the rental details
            //         $mrp = $price[0]['supply_price'];
            //         $available_status = 1;
            //         $initial_payable = round($this->calculateInitialPayable($isbn13, 0, $mrp, 0));
            //         $rent = $this->calculateRentalDetails($mrp, $initial_payable);
            //         $rent['book_id'] = 0;
            //         $rent['mrp'] = $mrp;
            //         $rent['initial_payable'] = $initial_payable;
            //         $rent['availability_status'] = $available_status;
            //         $rent['book_library'] = 0;
            //         $rent['merchant_library'] = 1;
            //         $rent['procurement_time'] = $procurement_time[0]['procurement_time'];

            //         return $rent;
            //     }
            //     // check for price in sub mastersheet
            //     elseif (count()) {
            //         # code...
            //     }
            // }

            // ==============================OLD=============when book found in book_library
            if (count($book_lib) > 0) {
                $this->bookRepository->resetModel();
                $price = $this->bookRepository->findWhere(array('ISBN13' => $isbn13))->getData(array('price'));
                if ($price[0]['price'] > 0) {
                    $mrp = $price[0]['price'];
                    $available_status = 1;
                    $initial_payable = round($this->calculateInitialPayable($isbn13, $book_lib[0]['circulation'], $mrp, 0));
                    $rent = $this->calculateRentalDetails($mrp, $initial_payable);
                    $rent['book_id'] = $book_lib[0]['book_id'];
                    $rent['mrp'] = $mrp;
                    $rent['initial_payable'] = $initial_payable;
                    $rent['availability_status'] = $available_status;
                    $rent['book_library'] = 1;
                    $rent['merchant_library'] = 0;
                    $rent['procurement_time'] = 0;

                    return $rent;
                }
                // if price not in sub_mastrsheet so check in merchant library
                elseif(count($merchant_lib) > 0) {
                    $price = $this->merchantLibraryRepository->findWhere(array('ISBN13' => $isbn13))->getData('merchant_id', 'supply_price');
                    $procurement_time = $this->merchantDetailsRepository->findWhere(array('merchant_id' => $price[0]['merchant_id']))->getData(array('procurement_time'));
                    if ($price[0]['supply_price'] > 0) {
                        $mrp = $price[0]['supply_price'];
                        $available_status = 1;
                        $initial_payable = round($this->calculateInitialPayable($isbn13, 0, $mrp, 0));
                        $rent = $this->calculateRentalDetails($mrp, $initial_payable);
                        $rent['book_id'] = 0;
                        $rent['mrp'] = $mrp;
                        $rent['initial_payable'] = $initial_payable;
                        $rent['availability_status'] = $available_status;
                        $rent['book_library'] = 0;
                        $rent['merchant_library'] = 1;
                        $rent['procurement_time'] = $procurement_time[0]['procurement_time'];

                        return $rent;
                    }
                    else {
                        $mrp = 'null';
                        $available_status = 0;
                        $initial_payable = 'null';
                        $rent = [];

                        $rent['book_id'] = 0;
                        $rent['mrp'] = $mrp;
                        $rent['initial_payable'] = $initial_payable;
                        $rent['availability_status'] = $available_status;
                        $rent['book_library'] = 0;
                        $rent['merchant_library'] = 0;
                        $rent['procurement_time'] = 0;


                        return $rent;
                    }
                }
                else {
                    // when price not in sub_mastersheet nor in merchant_library
                    $mrp = 'null';
                    $available_status = 0;
                    $initial_payable = 'null';
                    $rent = [];

                    $rent['book_id'] = 0;
                    $rent['mrp'] = $mrp;
                    $rent['initial_payable'] = $initial_payable;
                    $rent['availability_status'] = $available_status;
                    $rent['book_library'] = 0;
                    $rent['merchant_library'] = 0;
                    $rent['procurement_time'] = 0;

                    return $rent;
                }
            }
            // when book found in merchant library
            elseif (count($merchant_lib) > 0) {
                $price = $this->merchantLibraryRepository->findWhere(array('ISBN13' => $isbn13))->getData(array('merchant_id', 'supply_price'));
                $procurement_time = $this->merchantDetailsRepository->findWhere(array('merchant_id' => $price[0]['merchant_id']))->getData(array('procurement_time'));
                if ($price[0]['supply_price'] > 0) {
                    $mrp = $price[0]['supply_price'];
                    $available_status = 1;
                    $initial_payable = round($this->calculateInitialPayable($isbn13, 0, $mrp, 0));
                    $rent = $this->calculateRentalDetails($mrp, $initial_payable);
                    $rent['book_id'] = 0;
                    $rent['mrp'] = $mrp;
                    $rent['initial_payable'] = $initial_payable;
                    $rent['availability_status'] = $available_status;
                    $rent['book_library'] = 0;
                    $rent['merchant_library'] = 1;
                    $rent['procurement_time'] = $procurement_time[0]['procurement_time'];

                    return $rent;
                }
                else {
                    $mrp = 'null';
                    $available_status = 0;
                    $initial_payable = 'null';
                    $rent = [];

                    $rent['book_id'] = 0;
                    $rent['mrp'] = $mrp;
                    $rent['initial_payable'] = $initial_payable;
                    $rent['availability_status'] = $available_status;
                    $rent['book_library'] = 0;
                    $rent['merchant_library'] = 0;
                    $rent['procurement_time'] = 0;

                    return $rent;
                }
            }
            // when book not found in book library and merchant library
            else {
                $this->bookRepository->resetModel();
                $price = $this->bookRepository->findWhere(array('ISBN13' => $isbn13))->getData(array('price'));
                if ($price[0]['price'] > 0) {
                    // take random initial discount from 1 to 10
                    $mrp = $price[0]['price'];
                    $available_status = 1;
                    $initial_payable = round($this->calculateInitialPayable($isbn13, $book_lib[0]['circulation'], $mrp, 1));
                    $rent = $this->calculateRentalDetails($mrp, $initial_payable);
                    $rent['book_id'] = 0;
                    $rent['mrp'] = $mrp;
                    $rent['initial_payable'] = $initial_payable;
                    $rent['availability_status'] = $available_status;
                    $rent['book_library'] = 0;
                    $rent['merchant_library'] = 0;
                    $rent['procurement_time'] = 0;

                    return $rent;
                }
                else {
                    $mrp = 'null';
                    $available_status = 0;
                    $initial_payable = 'null';
                    $rent = [];

                    $rent['book_id'] = 0;
                    $rent['mrp'] = $mrp;
                    $rent['initial_payable'] = $initial_payable;
                    $rent['availability_status'] = $available_status;
                    $rent['book_library'] = 0;
                    $rent['merchant_library'] = 0;
                    $rent['procurement_time'] = 0;

                    return $rent;
                }
            }
        }
    }

}
