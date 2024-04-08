<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'is_active' => true,
            'password' => Hash::make('admin'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'fournisseur',
            'email' => 'fournisseur@gmail.com',
            'role' => 'fournisseur',
            'is_active' => true,
            'pourcentage' => 12,
            'password' => Hash::make('fournisseur'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'fournisseur2',
            'email' => 'fournisseur2@gmail.com',
            'role' => 'fournisseur',
            'is_active' => false,
            'pourcentage' => 10,
            'password' => Hash::make('fournisseur'),
        ]);
        User::factory()
            ->count(50)
            ->create();
        Client::factory()
            ->count(50)
            ->create();
    }
}
