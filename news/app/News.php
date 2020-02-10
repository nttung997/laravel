<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function newstype()
    {
        return $this->belongsTo('App\NewsType', 'news_type_id');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
