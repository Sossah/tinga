<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        // User permissions
        Permission::create(['name' => 'voir users']);
        Permission::create(['name' => 'creer users']);
        Permission::create(['name' => 'modifier users']);
        Permission::create(['name' => 'supprimer users']);
        
        // Role permissions
        Permission::create(['name' => 'voir roles']);
        Permission::create(['name' => 'creer roles']);
        Permission::create(['name' => 'modifier roles']);
        Permission::create(['name' => 'supprimer roles']);
        
        // Subscription permissions
        Permission::create(['name' => 'voir subscriptions']);
        Permission::create(['name' => 'creer subscriptions']);
        Permission::create(['name' => 'modifier subscriptions']);
        Permission::create(['name' => 'supprimer subscriptions']);
        
        // Report permissions
        Permission::create(['name' => 'voir rapports']);
        Permission::create(['name' => 'creer rapports']);
        Permission::create(['name' => 'exporter rapports']);

        // Create roles and assign permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
        
        $role = Role::create(['name' => 'manager']);
        $role->givePermissionTo([
            'voir users', 
            'voir roles',
            'voir subscriptions', 'creer subscriptions', 'modifier subscriptions',
            'voir rapports', 'creer rapports', 'exporter rapports'
        ]);
        
        $role = Role::create(['name' => 'agent']);
        $role->givePermissionTo([
            'voir subscriptions', 'creer subscriptions',
            'voir rapports'
        ]);
    }
}
