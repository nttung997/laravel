<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Repository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        if (env('CACHE_ENABLE', false)) {
            $objects = null;
            $key = $this->model::MODEL . '_all';
            if ($this->checkCache($key)) {
                $objects = $this->getCache($key);
            } else {
                $objects = $this->model->all();
                if ($objects) $this->setCache($key, $objects);
            }
            return $objects;
        }
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        if (env('CACHE_ENABLE', false)) {
            $result = $this->model->update($data, $id);
            if ($result) {
                $key = $this->model::MODEL . '_find_' . $id;
                $this->deleteCache($key);
            }
            return $result;
        }
        return $this->model->update($data, $id);
    }

    public function delete($id)
    {
        if (env('CACHE_ENABLE', false)) {
            $result = $this->model->delete($id);
            if ($result) {
                $key = $this->model::MODEL . '_find_' . $id;
                $this->deleteCache($key);
            }
            return $result;
        }
        return $this->model->delete($id);
    }

    public function find($id)
    {
        if (env('CACHE_ENABLE', false)) {
            $key = $this->model::MODEL . '_find_' . $id;
            if ($this->checkCache($key)) {
                $object = $this->getCache($key);
            } else {
                $object = $this->model::find($id);
                if ($object) $this->setCache($key, $object);
            }
            return $object;
        }
        return $this->model::find($id);
    }

    public function exists($id)
    {
        return $this->model->exists($id);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function paginate($amount)
    {
        return $this->model->paginate($amount);;
    }

    public function getCache($key)
    {
        return json_decode(Redis::get($key));
    }

    public function setCache($key, $objects)
    {
        Redis::setex($key, env('CACHE_TIME', 60), json_encode($objects));
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
