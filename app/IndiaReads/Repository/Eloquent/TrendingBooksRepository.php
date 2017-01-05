<?php
/**
 * Created by PhpStorm.
 * User: yatin
 * Date: 30/07/15
 * Time: 6:29 PM
 */

namespace App\IndiaReads\Repository\Eloquent;

use App\TrendingBooks;

class TrendingBooksRepository extends EloquentRepository {

    /**
     * @var Model
     */
    protected $model;

    function __construct() {
        $this->model = new TrendingBooks();
    }
}
