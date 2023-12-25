<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->hasMovies(5)->create([
            'name' => 'Hayk',
            'email' => 'haykbalasanyan1@gmail.com',
        ]);

        User::factory(5)->hasMovies(5)->create();
    }
}
