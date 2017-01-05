<?php
/**
 * Created by PhpStorm.
 * User: yatin
 * Date: 01/08/15
 * Time: 1:35 PM
 */

namespace App\IndiaReads\Repository\Eloquent;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

/**
 * Class UserRepository
 * @package App\IndiaReads\Repository\Eloquent
 */
class UserRepository extends EloquentRepository {

    /*
     * User Status;
     *  0: Deleted
     *  1: Active
     *  2: Inactive
     *  3: Blocked
     */

    /**
     * @var Model
     */
    protected $model;

    /**
     * Constructor to initialize Model
     */
    function __construct()
    {
        $this->model = new User();
    }

    public function resetModel()
    {
      $this->model = new User();
    }


}
