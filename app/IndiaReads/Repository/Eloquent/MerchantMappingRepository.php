<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\MerchantMapping;
use Illuminate\Database\Eloquent\Model;


/**
 * Class BookRepository
 * @package App\IndiaReads\Repository\Eloquent
 */
class MerchantMappingRepository extends EloquentRepository {

    /**
     * @var Model
     */
    protected $model;

    function __construct() {
        $this->model = new MerchantMapping();
    }

    public function resetModel()
    {
      $this->model = new MerchantMapping();
    }
}
