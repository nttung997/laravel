<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    protected $table = "invoice_product";
    public $timestamps = false;
    protected $primaryKey = ['InvoiceID', 'ProductID'];
    public $incrementing = false;
    public function Invoice()
    {
        return $this->belongsTo('App/Invoice','InvoiceID','ID');
    }
    public function Product()
    {
        return $this->belongsTo('App/Product','ProductID','ID');
    }
}
