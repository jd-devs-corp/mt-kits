<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@gmail.com',
             'role' => 'admin',
             'password' => Hash::make('admin'),
         ]);
         \App\Models\User::factory()->create([
            'name' => 'fournisseur',
            'email' => 'fournisseur@gmail.com',
            'role' => 'fournisseur',
            'pourcentage' => 12,
            'somme_a_percevoir' => 0,
            'password' => Hash::make('fournisseur'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'fournisseur2',
            'email' => 'fournisseur2@gmail.com',
            'role' => 'fournisseur',
            'pourcentage' => 10,
            'somme_a_percevoir' => 0,
            'password' => Hash::make('fournisseur'),
        ]);
    }
}
