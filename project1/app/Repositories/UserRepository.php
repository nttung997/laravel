<?php namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    // model property on class instances
    protected $user;

    // Constructor to bind model to repo
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->setModel($user);
    }

    public function isEmailExisted($email,$id = null)
    {
        return $this->user->isEmailExisted($email, $id);
    }
}