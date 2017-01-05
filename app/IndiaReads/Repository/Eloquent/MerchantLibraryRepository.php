<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\MerchantLibrary;
use Illuminate\Database\Eloquent\Model;

/**
 * class MerchantLibraryRepository
 * @package App\IndiaReads\Repository\Eloquent
*/
class MerchantLibraryRepository extends EloquentRepository {

    /**
     * @var model
     */
    protected $model;

    function __construct() {
        $this->model = new MerchantLibrary();
    }
    public function resetModel()
    {
      $this->model = new MerchantLibrary();
    }
}
