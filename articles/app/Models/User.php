<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const MODEL = 'user';
    const INACTIVE = 0;
    const ACTIVE = 1;
    const DISABLED = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    public function isEmailExisted($email, $id = null)
    {
        if ($id)  return User::where('email', $email)->where('id', '<>', $id)->exists();
        return User::where('email', $email)->exists();
    }
}
