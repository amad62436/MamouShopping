<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Créer l'administrateur
        User::create([
            'name' => 'Amadou Mouctar Diallo',
            'email' => 'mamoushopping@gmail.com',
            'password' => Hash::make('Di621304708'),
            'role' => 'admin',
            'phone' => '621304708',
            'address' => 'Mamou, Sabou',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Administrateur et client créés avec succès!');
    }
}