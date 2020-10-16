<?php namespace App\Repositories;

interface RepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function exists($id);

    public function getCache($key);

    public function setCache($key, $objects);

    public function deleteCache($key);

    public function checkCache($key);
}