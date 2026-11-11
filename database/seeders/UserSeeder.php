<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Administrateur
        $admin = User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrateur',
                'email' => 'admin@stock.local',
                'password' => Hash::make('Admin@123456'),
            ]
        );

        $admin->syncRoles(['Administrateur']);

        // Régisseur
        $regisseur = User::updateOrCreate(
            ['username' => 'regisseur'],
            [
                'name' => 'Régisseur',
                'email' => 'regisseur@stock.local',
                'password' => Hash::make('Regisseur@123456'),
            ]
        );

        $regisseur->syncRoles(['Régisseur']);

        // Caissier
        $caissier = User::updateOrCreate(
            ['username' => 'caissier'],
            [
                'name' => 'Caissier',
                'email' => 'caissier@stock.local',
                'password' => Hash::make('Caissier@123456'),
            ]
        );

        $caissier->syncRoles(['Caissier']);

        $this->command->info('Les utilisateurs et leurs rôles ont été créés avec succès.');
    }
}
