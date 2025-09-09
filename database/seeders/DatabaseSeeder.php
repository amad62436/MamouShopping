<?php

namespace Database\Seeders;

use App\Models\User;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Amadou Mouctar Diallo',
            'email' => 'mamoushopping@gmail.com',
            'password' => Hash::make('Di621304708'),
            'role' => 'admin',
            'phone' => '621304708',
            'address' => 'Mamou, Sabou',
            'email_verified_at' => now(),
        ]);
    }
}
