<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'phone' => '+1 234 5678',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@test.com',
            'phone' => '+1 234 5679',
        ]);
    }
}
