<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    const MODEL = 'role';

    protected $fillable = [
        'name'
    ];
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
    public function isNameExisted($name, $id = null)
    {
        if ($id) return Role::where('name', $name)->where('id', '<>', $id)->exists();
        return Role::where('name', $name)->exists();
    }
}
