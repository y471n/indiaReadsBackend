<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\CompanyDetail;
use Illuminate\Database\Eloquent\Model;

/**
* Class CompanyDetailRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class CompanyDetailsRepository extends EloquentRepository
{
    /**
     * @var model
     */
    protected $model;

    function __construct()
    {
        $this->model = new CompanyDetail();
    }
}
