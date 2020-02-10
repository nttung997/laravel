<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = "distributor";
    public $timestamps = false;
    public function product()
    {
        return $this->hasMany('App\Product', 'DistributorID', 'ID');
    }
}
