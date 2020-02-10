<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MiniField extends Model
{
    protected $table = "minifield";
    public $timestamps = false;
    public function Field()
    {
        return $this->belongsTo('App\Field', 'FieldID', 'ID');
    }
    public function MiniFieldInvoice()
    {
        return $this->hasMany('App/MiniFieldInvoice','MiniFieldID','ID');
    }
}
