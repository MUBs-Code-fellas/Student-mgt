<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $all = ['manage students', 'manage courses', 'manage registrations', 'manage users',
                'view assigned courses', 'view own registrations', 'view courses', 'register course'];
        foreach ($all as $p) Permission::firstOrCreate(['name' => $p]);

        Role::firstOrCreate(['name' => 'Administrator'])->syncPermissions($all);
        Role::firstOrCreate(['name' => 'Lecturer'])->syncPermissions(['view assigned courses']);
        Role::firstOrCreate(['name' => 'Student'])->syncPermissions(['view courses', 'view own registrations', 'register course']);
    }
}
