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
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        Permission::create(['name' => 'can_view_system_configs']);
        Permission::create(['name' => 'can_create_user']);
        Permission::create(['name' => 'can_update_user']);
        Permission::create(['name' => 'can_delete_user']);

        /**
         * TODO
         *
         * Make the static id better
         */
        Role::find(1)->syncPermissions(Permission::all());
    }
}
