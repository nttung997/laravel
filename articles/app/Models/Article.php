<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    const MODEL = 'article';
    const INACTIVE = 0;
    const ACTIVE = 1;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function isTitleExisted($title, $id = null)
    {
        if ($id) return Article::where('title', $title)->where('id', '<>', $id)->exists();
        return Article::where('title', $title)->exists();
    }

    // find all article made by user
    public function allByUserIdPaginate($userId, $amount)
    {
        return Article::where('user_id', $userId)->paginate($amount);
    }

    // find all article made by user
    public function allByUserId($userId)
    {
        return Article::where('user_id', $userId)->get();
    }
}
