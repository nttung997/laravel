<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = "invoice";
    public $timestamps = false;
    public function InvoiceProduct()
    {
        return $this->hasMany('App\InvoiceProduct', 'InvoiceID', 'ID');
    }
    public function Customer()
    {
        return $this->belongsTo('App/Customer','CustomerID','ID');
    }
}
