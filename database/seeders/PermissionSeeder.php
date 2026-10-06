<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // --- Define Permissions ---
        $permissions = [
            // User management
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // Role management
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',

            // Settings
            'settings.view',
            'settings.edit',

            // Dashboard
            'dashboard.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // --- Create Roles ---

        /** @var Role $superadminRole */
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);

        /** @var Role $userRole */
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // Superadmin gets ALL permissions
        $superadminRole->syncPermissions(Permission::all());

        // User role gets only basic permissions
        $userRole->syncPermissions([
            'dashboard.view',
        ]);

        // --- Assign superadmin role to default superadmin user ---
        $superadmin = User::where('email', 'superadmin@gmail.com')->first();

        if ($superadmin) {
            $superadmin->syncRoles([$superadminRole]);
        }

        $this->command->info('✅ Roles and permissions seeded successfully.');
        $this->command->table(
            ['Role', 'Permissions'],
            [
                ['superadmin', 'ALL ('.Permission::count().' permissions)'],
                ['user', 'dashboard.view'],
            ],
        );
    }
}
