<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\IndiaReads\Repository\Eloquent\ParentCategoriesRepository;
use App\IndiaReads\Repository\EloquentRepository\BookCategoryMappingRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BookCategoriesController extends ApiController
{
    /**
     * @var paginatiion_limit
     */
    protected $pagination_limit = 10;

    /**
     * @var ParentCategoriesRepository
     */
    protected $parentCategoriesRepository;

    /**
     * @var BookCategoryMappingRepository
     */
    protected $bookCategoryMappingRepository;

    /**
     * @param ParentCategoriesRepository $parentCategoriesRepository
     */
    function __construct(ParentCategoriesRepository $parentCategoriesRepository, BookCategoryMappingRepository $bookCategoryMappingRepository) {
        $this->parentCategoriesRepository = $parentCategoriesRepository;
        $this->bookCategoryMappingRepository = $bookCategoryMappingRepository;
    }

    /**
     * Get Category ID
     * @param Session::get(catID);
     */
    public function getCategoryID() {
        $catID = Session::get('cat_id');
        if ($catID != null) {
            $this->getParentCatBooks($catID);
        }
    }

    /**
     * Get BestSeller Books
     * @param Session::get(catID)
     */
    public function getBestSellerBooks() {
        $catID = Session::get('cat_id');
        if ($catID != null) {
            /**
             * ToDo:
             * Get max page views
             * Get max circulations
             * Pagination Limit 10
             */
        }
    }

    /**
     * Get all Books as per parent category
     * @param parentCategoryID
     */
    public function getParentCatBooks($catID=null) {
        if ($catID != null) {
            // ToDo: Sort by Descending Page Views Not in BestSellers
            $catBooks = $this->bookCategoryRepository->findWhere(array('parent_id'=>$catID), array('ISBN13'));
        }
    }
}
