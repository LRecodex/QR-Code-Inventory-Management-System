<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Define permissions
        $permissions = [
            'manage-admins',
            'manage-staff',
            'view-dashboard',
            'create-vehicles',
            'edit-vehicles',
            'delete-vehicles',
            'generate-qr',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $superadmin = Role::findByName('superadmin');
        $admin = Role::findByName('admin');
        $staff = Role::findByName('staff');

        // Superadmin gets all permissions
        $superadmin->givePermissionTo(Permission::all());

        // Admin gets some permissions
        $admin->givePermissionTo([
            'manage-staff',
            'view-dashboard',
            'create-vehicles',
            'edit-vehicles',
            'generate-qr',
        ]);

        // Staff gets minimal permissions
        $staff->givePermissionTo([
            'view-dashboard',
            'generate-qr',
        ]);
    }
}
