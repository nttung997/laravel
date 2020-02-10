<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    public $timestamps = false;
    public function Invoice()
    {
        return $this->belongsTo('App\Distributor', 'DistributorID', 'ID');
    }
}
