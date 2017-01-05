<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\PinCode;
use Illuminate\Database\Eloquent\Model;


/**
 * Class PinCodeRepository
 * @package App\IndiaReads\Repository\Eloquent
 */
class PinCodeRepository extends EloquentRepository {

    /**
     * @var Model
     */
    protected $model;

    function __construct() {
        $this->model = new PinCode();
    }

    public function resetModel()
    {
      $this->model = new PinCode();
    }
}
