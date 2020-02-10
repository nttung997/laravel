<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsType extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function news()
    {
        return $this->hasMany('App\News');
    }
}
