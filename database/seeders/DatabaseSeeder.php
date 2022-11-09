<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Question::factory(5)->state([
            'page' => 1,
        ])->create();
        \App\Models\Question::factory(5)->state([
            'page' => 2,
        ])->create();
    }
}