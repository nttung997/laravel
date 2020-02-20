<?php

namespace App\Services;

interface ServiceInterface
{
    public function all();

    public function find($id);

    public function create(array $data);

    public function update(array $data, $instance);

    public function delete($id);

    public function exist($id);

    public function getRepository();

    public function setRepository($repository);

    public function add_error($error_msg, $key);
}
