<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        // 1. Liste des permissions
        $permissions = [
            // Tableau de bord
            'dashboard.view',

            // Produits
            'products.view',
            'products.create',
            'products.update',
            'products.delete',

            // Approvisionnements
            'supplies.view',
            'supplies.create',
            'supplies.print',
            'supplies.validate_receipt',
            'supplies.modify_validated',

            // Ventes
            'sales.daily_report',

            // Stock
            'stock.view',
            'stock.view_limited',

            // Inventaire
            'inventory.view',
            'inventory.manage',

            // Utilisateurs
            'users.manage',

            // Demandes de correction
            'corrections.create',
            'corrections.process',

            // Journal d'audit
            'audit.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // 2. Création des rôles
        $admin = Role::firstOrCreate([
            'name' => 'Administrateur',
            'guard_name' => 'web',
        ]);

        $regisseur = Role::firstOrCreate([
            'name' => 'Régisseur',
            'guard_name' => 'web',
        ]);

        $caissier = Role::firstOrCreate([
            'name' => 'Caissier',
            'guard_name' => 'web',
        ]);

        // 3. Attribution des permissions

        // ADMINISTRATEUR
        $admin->syncPermissions([
            'dashboard.view',
            'products.view',
            'products.create',
            'products.update',
            'products.delete',
            'supplies.view',
            'supplies.print',
            'supplies.modify_validated',
            'stock.view',
            'inventory.view',
            'inventory.manage',
            'users.manage',
            'corrections.process',
            'audit.view',
        ]);

        // REGISSEUR
        $regisseur->syncPermissions([
            'dashboard.view',
            'products.view',
            'products.create',
            'supplies.view',
            'supplies.create',
            'supplies.print',
            'supplies.validate_receipt',
            'stock.view',
            'inventory.view',
            'inventory.manage',
            'corrections.create',
        ]);

        // CAISSIER
        $caissier->syncPermissions([
            'dashboard.view',
            'supplies.view',
            'supplies.print',
            'supplies.validate_receipt',
            'sales.daily_report',
            'stock.view_limited',
            'inventory.view',
        ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        $this->command->info('Rôles et permissions créés avec succès !');
    }
}
