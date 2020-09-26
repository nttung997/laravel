<?php

namespace App\Services;

use App\Repositories\Repository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class Service implements ServiceInterface
{
    // repository property on class instances
    protected $repository;

    // Constructor to bind repository to service
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    // Get all instances of repository
    public function all()
    {
        return $this->repository->all();
    }

    // show the record with the given id
    public function find($id)
    {
        $object =  $this->repository->find($id);
        if (!$object) {
            $name = (new \ReflectionClass($this->repository->getModel()))->getShortName();
            $this->add_error($name . ' does not exist');
            return false;
        }
        return $object;
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $object = $this->find($id);
        if (!$object) return false;
        $respond = $this->repository->update($data,$object);
        return $respond;
    }

    // remove record from the database
    public function delete($id)
    {
        try {
            $result = $this->repository->delete($id);
            return $result;
        } catch (\Throwable $th) {
            $name = (new \ReflectionClass($this->repository->getModel()))->getShortName();
            $this->add_error('This ' . strtolower($name) . ' cannot be deleted');
            return false;
        }
    }

    // check existence of the record with the given id
    public function exist($id)
    {
        return $this->repository->exists($id);
    }

    // Get the associated repository
    public function getRepository()
    {
        return $this->repository;
    }

    // Set the associated repository
    public function setRepository($repository)
    {
        $this->repository = $repository;
        return $this;
    }

    /*
 * Add an error to Laravel session $errors
 * @author Pavel Lint
 * @param string $key
 * @param string $error_msg
 */
    public function add_error($error_msg, $key = 'default')
    {
        $errors = Session::get('errors', new ViewErrorBag);

        if (!$errors instanceof ViewErrorBag) {
            $errors = new ViewErrorBag;
        }

        $bag = $errors->getBags()['default'] ?? new MessageBag;
        $bag->add($key, $error_msg);

        Session::flash(
            'errors',
            $errors->put('default', $bag)
        );
    }

    public function paginate($amount)
    {
        return $this->repository->paginate($amount);
    }
}
