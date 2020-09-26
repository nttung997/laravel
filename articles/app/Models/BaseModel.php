<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class BaseModel extends Model
{
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
