<?php

namespace Database\Seeders;

use App\Modules\Role\Models\Role;
use App\Modules\User\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'superadmin',
            ],
            [
                'name' => 'user',
            ],
        ];

        Role::insert($roles);
        //insert admin
        User::create([
            'first_name' => 'test',
            'last_name' => 'test',
            'email' => 'test@test.com',
            'password' => bcrypt('123456'),
            'role_id' => 1,
        ]);
        UserFactory::new()->count(20)->create();

    }
}
