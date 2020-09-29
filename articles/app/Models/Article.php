<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Article extends BaseModel
{
    const MODEL = 'article';
    const INACTIVE = 0;
    const ACTIVE = 1;
    // const CACHE_ENABLE = env('CACHE_ENABLE',false);

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
        if ($id) return $result = Article::where('title', $title)->where('id', '<>', $id)->exists();
        return $result = Article::where('title', $title)->exists();
    }

    // find all article made by user
    public function allByUserIdPaginate($userId, $amount)
    {
        return $articles =  Article::where('user_id', $userId)->paginate($amount);
    }

    // find all article made by user
    public function allByUserId($userId)
    {
        return $articles =  Article::where('user_id', $userId)->get();
    }

    public function findWithCache($id)
    {
        if (env('CACHE_ENABLE',false)) {
            $object = null;
            $key = Article::MODEL . '_find_' . $id;
            if ($this->checkCache($key)) //get object from cache
            {
                $object = $this->getCache($key);
            } else { //get object and cache
                $object = parent::find($id);
                if ($object) $this->setCache($key, $object);
            }
            return $object;
        }
        return parent::find($id);
    }

    public function updateWithCache($data, $id)
    {
        if (env('CACHE_ENABLE',false)) {
            $result = parent::where('id', $id)->update($data);
            if ($result) {
                $key = Article::MODEL . '_find_' . $id;
                $this->deleteCache($key);
            }
            return $result;
        }
        return parent::where('id', $id)->update($data);
    }

    public function allWithCache()
    {
        if (env('CACHE_ENABLE',false)) {
            $objects = null;
            $key = Article::MODEL . '_all';
            if ($this->checkCache($key)) //get object from cache
            {
                $objects = $this->getCache($key);
            } else { //get object and cache 
                $objects = parent::all();
                if ($objects) $this->setCache($key, $objects);
            }
            return $objects;
        }
        return parent::all();
    }
    public function deleteWithCache($id)
    {
        if (env('CACHE_ENABLE',false)) {
            $result = parent::destroy($id);
            if ($result) {
                $key = Article::MODEL . '_find_' . $id;
                $this->deleteCache($key);
            }
            return $result;
        }
        return parent::destroy($id);
    }

    public function getCache($key)
    {
        return json_decode(Redis::get($key));
    }

    public function setCache($key, $objects)
    {
        $seconds = 60;
        Redis::setex($key, $seconds, json_encode($objects));
        return true;
    }

    public function deleteCache($key)
    {
        Redis::del($key);
        return true;
    }

    public function checkCache($key)
    {
        return Redis::exists($key);
    }
}
