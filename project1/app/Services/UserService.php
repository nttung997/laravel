<?php

namespace App\Services;


use App\Repositories\UserRepository;
use App\Services\RoleService;

class UserService extends Service
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, RoleService $roleService)
    {
        $this->userRepository = $userRepository;
        $this->roleService = $roleService;
        $this->setRepository($userRepository);
    }

    public function create($data)
    {
        if (!$this->checkEmail($data)) return false;
        if (!$this->checkRole($data)) return false;
        $user = parent::create($data);
        return $user;
    }
    public function update($data, $id)
    {
        if (!$this->checkEmail($data)) return false;
        if (!$this->checkRole($data)) return false;
        $respond = parent::update($data, $id);
        return $respond;
    }

    public function checkEmail($data, $id = null)
    {
        if (array_key_exists('email', $data)) {
            if ($this->userRepository->isEmailExisted($data['email'], $id)) {
                $this->add_error('Email existed');
                return false;
            }
        }
        return true;
    }

    public function checkRole($data)
    {
        if (array_key_exists('role_id', $data)) {
            if (!$this->roleService->exist($data['role_id'])) {
                $this->add_error('Role does not exist');
                return false;
            }
        }
        return true;
    }
}
