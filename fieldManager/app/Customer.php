<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customer";
    public $timestamps = false;
    public function invoice()
    {
        return $this->hasMany('App\Invoice', 'CustomerID', 'ID');
    }
}
