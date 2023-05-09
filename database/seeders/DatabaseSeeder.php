<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tache;
use Database\Factories\TacheFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $taches = Tache::factory(100)->create();

        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'reuss@gmail.com',
            'password' => Hash::make('00000000')
         ]);
    }
}
