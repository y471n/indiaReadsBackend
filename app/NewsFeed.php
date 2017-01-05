<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsFeed extends Model {
    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'news_feed';
    public $timestamps = false;
}
