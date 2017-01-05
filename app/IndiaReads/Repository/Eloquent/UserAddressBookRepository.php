<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\UserAddressBook;

/**
* class UserAddressBookRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class UserAddressBookRepository extends EloquentRepository
{
    /**
     * @var Model
     */
    protected $model;

    function __construct()
    {
        $this->model = new UserAddressBook();
    }
}
