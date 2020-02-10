<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function newsTypes()
    {
        return $this->hasMany('App\NewsType');
    }
    public function news()
    {
        return $this->hasManyThrough('App\News', 'App\NewsType');
    }
}
