<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'manage buildings',
            'manage units',
            'manage tenants',
            'manage leases',
            'manage invoices',
            'manage payments',
            'manage expenses',
            'view reports',
            'view audit logs',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $owner = Role::firstOrCreate(['name' => 'Owner']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $accountant = Role::firstOrCreate(['name' => 'Accountant']);

        $owner->syncPermissions($permissions);
        $manager->syncPermissions(array_filter($permissions, fn ($p) => $p !== 'view audit logs'));
        $accountant->syncPermissions([
            'manage invoices',
            'manage payments',
            'manage expenses',
            'view reports',
        ]);
    }
}
