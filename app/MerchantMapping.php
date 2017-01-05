<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantMapping extends Model {
    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'inventory_merchant_mapping';
    public $timestamps = false;
}
