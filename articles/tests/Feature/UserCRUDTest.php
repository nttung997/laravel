<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCRUDTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function create_user()
    {
        dd(1);
        $response = $this->post(route('admin.users.store'), $this->userData([

        ]))->assertRedirect(route('admin.users.index'));
    }

    private function userData($attibutes = [])
    {
        return array_merge([
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => bcrypt($this->faker->password),
            'role_id' => Role::all()->random(1)[0]->id,
            'status' => User::ACTIVE,
        ], $attibutes);
    }
}
