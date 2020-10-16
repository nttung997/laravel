<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Repository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, $object)
    {
        return $object->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function find($id)
    {
        return $this->model->find($id);
    }

    // check existence of the record with the given id
    public function exists($id)
    {
        return $this->model->exists($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    // public function with($relations)
    // {
    //     return $this->model->with($relations);
    // }

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
