<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->setModel($user);
    }

    public function isEmailExisted($email, $id = null)
    {
        return $this->user->isEmailExisted($email, $id);
    }

    public function all()
    {
        return $this->user->all();
    }

    public function find($id)
    {
        return $this->user->find($id);
    }
}
