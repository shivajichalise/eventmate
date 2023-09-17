<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            ['guard_name' => 'web', 'name' => 'attendee'],
            ['guard_name' => 'organizer', 'name' => 'organizer'],
            ['guard_name' => 'organizer', 'name' => 'super-organizer'],
        ];

        // create roles
        foreach($roles as $role) {
            Role::create($role);
        }

        $permissions = [
            ['guard_name' => 'web', 'name' => 'buy tickets'],

            ['guard_name' => 'organizer', 'name' => 'create event'],
            ['guard_name' => 'organizer', 'name' => 'view event'],
            ['guard_name' => 'organizer', 'name' => 'edit event'],
            ['guard_name' => 'organizer', 'name' => 'delete event'],

            ['guard_name' => 'organizer', 'name' => 'create user'],
            ['guard_name' => 'organizer', 'name' => 'view user'],
            ['guard_name' => 'organizer', 'name' => 'edit user'],
            ['guard_name' => 'organizer', 'name' => 'delete user'],

            ['guard_name' => 'organizer', 'name' => 'create payment'],
            ['guard_name' => 'organizer', 'name' => 'view payment'],
            ['guard_name' => 'organizer', 'name' => 'edit payment'],
            ['guard_name' => 'organizer', 'name' => 'delete payment'],

            ['guard_name' => 'organizer', 'name' => 'create result'],
            ['guard_name' => 'organizer', 'name' => 'view result'],
            ['guard_name' => 'organizer', 'name' => 'edit result'],
            ['guard_name' => 'organizer', 'name' => 'delete result'],

            ['guard_name' => 'organizer', 'name' => 'create role'],
            ['guard_name' => 'organizer', 'name' => 'view role'],
            ['guard_name' => 'organizer', 'name' => 'edit role'],
            ['guard_name' => 'organizer', 'name' => 'delete role'],
        ];

        // create permissions
        foreach($permissions as $permission) {
            Permission::create($permission);
        }

        // assign created permissions to roles
        Role::findByName('super-organizer', 'organizer')->syncPermissions(Permission::where('guard_name', 'organizer')->get());

        Role::findByName('organizer', 'organizer')->syncPermissions([
            'create event',
            'view event',
            'edit event',
            'delete event',

            'view user',

            'create result',
            'view result',
            'edit result',
            'delete result',
        ]);
    }
}
