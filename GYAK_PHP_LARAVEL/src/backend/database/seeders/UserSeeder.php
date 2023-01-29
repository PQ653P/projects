<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory([
                          'name' => 'Site Admin',
                          'email' => 'admin@test.com',
                      ])->create();
        User::factory(10)->create();
    }
}
