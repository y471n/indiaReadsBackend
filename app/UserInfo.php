<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'user_info';
    protected $fillable = array('user_id', 'first_name', 'last_name', 'alternate_email', 'birthdate', 'landline', 'gender', 'mobile');
    public $timestamps = false;
}
