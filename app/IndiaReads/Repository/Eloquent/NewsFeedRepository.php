<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\NewsFeed;
use Illuminate\Database\Eloquent\Model;


/**
 * Class BookRepository
 * @package App\IndiaReads\Repository\Eloquent
 */
class NewsFeedRepository extends EloquentRepository {

    /**
     * @var Model
     */
    protected $model;

    function __construct() {
        $this->model = new NewsFeed();
    }

    public function resetModel()
    {
      $this->model = new NewsFeed();
    }
}
