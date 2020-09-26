<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
    public function isNameExisted($name, $id = null)
    {
        if ($id) return $result = Role::where('name', $name)->where('id', '<>', $id)->exists();
        return $result = Role::where('name', $name)->exists();
    }
}
