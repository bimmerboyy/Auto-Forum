<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use OpenAdmin\Admin\Auth\Database\Administrator;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Administrator::create([
            'username' => 'admin',
            'password' => Hash::make('admin'), // Bcrypt hash the password
            'name' => 'Administrator'
        ]);
    }
}
