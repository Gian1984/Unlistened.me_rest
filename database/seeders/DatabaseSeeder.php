<?php

namespace Database\Seeders;

use App\Http\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test user',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
    }
}
