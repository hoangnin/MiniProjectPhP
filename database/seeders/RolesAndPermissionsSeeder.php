<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Tạo permission
        $permissions = [
            'create project',
            'create task',
            'update task',
            'delete task',
            'view task',
            'change task status',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Tạo role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $ownerRole = Role::firstOrCreate(['name' => 'owner']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Gán permission
        $adminRole->givePermissionTo(Permission::all());

        // Owner: CRUD task + change status, nhưng không tạo project
        $ownerRole->givePermissionTo([
            'create task',
            'update task',
            'delete task',
            'view task',
            'change task status',
        ]);

        // User: chỉ update task
        $userRole->givePermissionTo([
            'update task',
        ]);

        // Gán role cho user mẫu
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );
        $admin->assignRole($adminRole);

        $owner = User::firstOrCreate(
            ['email' => 'owner@example.com'],
            ['name' => 'Owner', 'password' => bcrypt('password')]
        );
        $owner->assignRole($ownerRole);

        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            ['name' => 'User', 'password' => bcrypt('password')]
        );
        $user->assignRole($userRole);
    }
}
