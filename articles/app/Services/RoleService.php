<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService extends Service
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        RoleRepository $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->setRepository($roleRepository);
    }

    public function create($data)
    {
        if (!$this->checkName($data)) return false;
        $role = parent::create($data);
        return $role;
    }
    public function update($data, $id)
    {
        if (!$this->checkName($data, $id)) return false;
        $respond = parent::update($data, $id);
        return $respond;
    }

    public function checkName($data, $id = null)
    {
        if (array_key_exists('name', $data)) {
            if ($this->roleRepository->isNameExisted($data['name'], $id)) {
                $this->add_error('Name existed');
                return false;
            }
        }
        return true;
    }
}
