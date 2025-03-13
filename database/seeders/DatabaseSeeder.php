<?php

namespace Database\Seeders;

use App\Models\Categorias;
use App\Models\Receita;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Quick Bites Test',
            'email' => 'test@quickbites.pt',
        ]);

        Receita::factory(2)->create();

        Categorias::factory(5)->create();

    }
}
