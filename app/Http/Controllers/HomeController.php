<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\IndiaReads\Repository\Eloquent\BookRepository;
use App\IndiaReads\Repository\Eloquent\NewBooksRepository;
use App\IndiaReads\Repository\Eloquent\PopularHeaderRepository;
use App\IndiaReads\Repository\Eloquent\NewHeaderRepository;
use App\IndiaReads\Repository\Eloquent\RecommendedHeaderRepository;
use App\IndiaReads\Repository\Eloquent\BookLibraryRepository;
use App\IndiaReads\Repository\Eloquent\NewsFeedRepository;
use App\IndiaReads\Repository\Eloquent\TrendingBooksRepository;
use App\IndiaReads\Repository\Transformers\BookTransformer;
use App\IndiaReads\Repository\Transformers\NewsFeedTransformer;

/**
 * class HomeController
 * API for Homepage
 */
class HomeController extends ApiController {

    /**
     * @var BookRepository
     */
    protected $bookRepository;

    /**
     * @var BookTransformer
     */
    protected $bookTransformer;

    /**
     * @var BookLibraryRepository
     */
    protected $bookLibraryRepository;

    /**
     * @var NewsFeedRepository
     */
    protected $newsFeedRepository;

    /**
     * @var PopularRepository
     */
    protected $popularHeaderRepository;

    /**
     * @var NewHeaderRepository
     */
    protected $newHeaderRepository;

    /**
     * @var RecommendedHeaderRepository
     */
    protected $recommendedHeaderRepository;

    /**
     * @var NewsFeedTransformer
     */
    protected $newsFeedTransformer;

    /**
     * @var NewBooksRepository
     */
    protected $newBooksRepository;

    /**
     * @var TrendingBooksRepository
     */
    protected $trendingBooksRepository;

    function __construct(
        BookRepository $bookRepository,
        NewBooksRepository $newBooksRepository,
        TrendingBooksRepository $trendingBooksRepository,
        NewHeaderRepository $newHeaderRepository,
        PopularHeaderRepository $popularHeaderRepository,
        RecommendedHeaderRepository $recommendedHeaderRepository,
        BookLibraryRepository $bookLibraryRepository,
        BookLibraryRepository $bookLibraryRepository,
        BookTransformer $bookTransformer,
        NewsFeedRepository $newsFeedRepository,
        NewsFeedTransformer $newsFeedTransformer
    ) {
        $this->bookRepository = $bookRepository;
        $this->bookLibraryRepository = $bookLibraryRepository;
        $this->newBooksRepository = $newBooksRepository;
        $this->trendingBooksRepository = $trendingBooksRepository;
        $this->newHeaderRepository = $newHeaderRepository;
        $this->popularHeaderRepository = $popularHeaderRepository;
        $this->recommendedHeaderRepository = $recommendedHeaderRepository;
        $this->bookTransformer = $bookTransformer;
        $this->newsFeedRepository = $newsFeedRepository;
        $this->newsFeedTransformer = $newsFeedTransformer;
    }

    /**
     * Fetch New Books
     * @param none
     * @return new books
     */
    public function getNewBooks() {
        // // fetch data from new_books table
        // $data = $this->newHeaderRepository->findMultipleWhere(array(array
        //     ('ISBN13','>',0)))->limited(10)->getData(array('ISBN13', 'title'));
        // // data count check
        // if (count($data) > 0) {
        //     // transform the data
        //     $new_books = $this->bookTransformer->transformCollection($data->toArray());
        //     // return the transformed data
        //     return $this->respond(array('data' => $new_books));
        // }
        // // return the error response
        // return $this->respondWithError('New Books Not Found!');
    }

    /**
     * Get Header New Books
     */
    public function getHeaderNewBooks() {
        // fetch data from new_books table
        $data = $this->newHeaderRepository->findMultipleWhere(array(array('ISBN13','>',0)))->getData(array('ISBN13', 'title'));
        // data count check
        if (count($data) > 0) {
            // transform the data
            $new_books = $this->bookTransformer->transformCollection($data->toArray());
            // return the transformed data
            return $this->respond(array('data' => $new_books));
        }
        // return the error response
        return $this->respondWithError('New Books Not Found!');
    }

    /**
     * Get Popular Books
     */
    public function getHeaderPopularBooks() {
        $data = $this->popularHeaderRepository->findMultipleWhere(array(array('ISBN13','>',0)))->getData(array('ISBN13', 'title'));
        // data count check
        if (count($data) > 0) {
            // transform the data
            $new_books = $this->bookTransformer->transformCollection($data->toArray());
            // return the transformed data
            return $this->respond(array('data' => $new_books));
        }
        // return the error response
        return $this->respondWithError('New Books Not Found!');
    }

    /**
     * Fetch Trending Books
     * @param none
     * @return trending books
     */
    public function getTrendingBooks() {
        // fetch data from trending books table
        $data = $this->trendingBooksRepository->findMultipleWhere(array(array('ISBN13','>',0)))->limited(10)->getData(array('ISBN13', 'title'));
        // data count check
        if (count($data) > 0) {
            // transform the data
            $trending_books = $this->bookTransformer->transformCollection($data->toArray());
            // return the transformed data
            return $this->respond(array('data' => $trending_books));
        }
        // return the error response
        return $this->respondWithError('Trending Books Not Found!');
    }
    
    /**
     * Fetch Non-Recommended Books
     * @param none
     * @return np-recommended books
     */
    public function getNonPersonalRecommendedBooks() {
        // fetch data for max circulation books from book library
        $data = $this->recommendedHeaderRepository->findMultipleWhere(array(array('ISBN13','>',0)))->limited(10)->getData(array('ISBN13', 'title'));
        // data count check
        if (count($data) > 0) {
            // transform the data
            $recommended_books = $this->bookTransformer->transformCollection($data->toArray());
            // return the transformed data
            return $this->respond(array('data' => $recommended_books));
        }
        // return the error response
        return $this->respondWithError('New Books Not Found!');
    }

    /**
     * Fetch Non-Recommended Books
     * @param none
     * @return np-recommended books
     */
    public function getAllNonPersonalRecommendedBooks() {
        // fetch data for max circulation books from book library
        $data = $this->recommendedHeaderRepository->findMultipleWhere(array(array('ISBN13','>',0)))->getData(array('ISBN13', 'title'));
        // data count check
        if (count($data) > 0) {
            // transform the data
            $new_books = $this->bookTransformer->transformCollection($data->toArray());
            // return the transformed data
            return $this->respond(array('data' => $new_books));
        }
        // return the error response
        return $this->respondWithError('New Books Not Found!');
    }

    /**
     * Get Popular Books
     */
    public function getPopularBooks() {
        $books = $this->popularRepository->getData(array('*'));
        if (count($books) > 0) {
            return $this->respond(array('data' => $books));
        }
        return $this->respondWithError('No Popular Books Found');
    }

    /**
     * Fetch news feeds
     * @param none
     * @return news feed
     */
    public function getNewsFeed() {
        // fetch news feed
        $data_news_feed = $this->newsFeedRepository->getData();
        $news_feed = $this->newsFeedTransformer->transformCollection($data_news_feed->toArray());
        return $news_feed;
    }

}
