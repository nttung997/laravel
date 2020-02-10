<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MiniFieldInvoice extends Model
{
    protected $table = "minifield_invoice";
    public $timestamps = false;
    protected $primaryKey = ['MiniFieldID', 'InvoiceID'];
    public $incrementing = false;
    public function MiniField()
    {
        return $this->belongsTo('App\MiniField', 'MiniFieldID', 'ID');
    }
    public function Invoice()
    {
        return $this->belongsTo('App\Invoice', 'InvoiceID', 'ID');
    }
}
