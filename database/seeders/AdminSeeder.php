<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => 'admin@seminario.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
    }
}
