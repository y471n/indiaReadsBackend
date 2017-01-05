<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\CorporateUserMapping;
use Illuminate\Database\Eloquent\Model;

/**
* Class CorporateUserMappingRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class CorporateUserMappingRepository extends EloquentRepository
{
    /**
     * @var model
     */
    protected $model;

    function __construct()
    {
        $this->model = new CorporateUserMapping();
    }
}
