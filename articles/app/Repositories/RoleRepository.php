<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends Repository
{
    // model property on class instances
    protected $role;

    // Constructor to bind model to repo
    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->setModel($role);
    }
    public function isNameExisted($name, $id=null)
    {
        return $this->role->isNameExisted($name, $id);
    }
    
}
