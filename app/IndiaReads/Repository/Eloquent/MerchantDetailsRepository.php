<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\MerchantDetails;
use Illuminate\Database\Eloquent\Model;


/**
 * Class BookRepository
 * @package App\IndiaReads\Repository\Eloquent
 */
class MerchantDetailsRepository extends EloquentRepository {

    /**
     * @var Model
     */
    protected $model;

    function __construct() {
        $this->model = new MerchantDetails();
    }

    public function resetModel() {
      $this->model = new Book();
    }
}
