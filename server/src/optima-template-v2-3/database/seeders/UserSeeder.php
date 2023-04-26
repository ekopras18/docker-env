<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = [
            [
                'name' => 'Administrator Dashboard',
                'username' => 'dashboard',
                'email' => 'dashboard@smartkada.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$uBatLnuZ37l7Vbu3DOH4Ku8i1kqwvcr0VfkUV96bFJpgpvbX80hp6', // 1234
                'remember_token' => '',
                'compId' => 1,
                'role' => 1,
                'dashboard' => 1,
            ],
            [
                'name' => 'Administrator Smartkada',
                'username' => 'administator',
                'email' => 'root@smartkada.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$uBatLnuZ37l7Vbu3DOH4Ku8i1kqwvcr0VfkUV96bFJpgpvbX80hp6', // 1234
                'remember_token' => '',
                'compId' => 2,
                'role' => 2,
                'dashboard' => 0,
            ],
            [
                'name' => 'Admin Smartkada',
                'username' => 'admin',
                'email' => 'admin@smartkada.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$uBatLnuZ37l7Vbu3DOH4Ku8i1kqwvcr0VfkUV96bFJpgpvbX80hp6', // 1234
                'remember_token' => '',
                'compId' => 3,
                'role' => 3,
                'dashboard' => 0,
            ]
        ];

        User::insert($user);


    }
}
