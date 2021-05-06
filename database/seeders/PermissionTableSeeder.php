<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'guard_name' => 'admin',
                'title' => 'Admin',
            ]
        ]);

       $permissions = [
           'role_list',
           'role_create',
           'role_edit',
           'role_delete',
           'user_list',
           'user_create',
           'user_edit',
           'user_delete',
           'permission_list',
           'permission_create',
           'permission_edit',
           'permission_delete',
           'product_list',
           'product_create',
           'product_edit',
           'product_delete',
           'banner_list',
           'banner_create',
           'banner_edit',
           'banner_delete',
           'categori_list',
           'categori_create',
           'categori_edit',
           'categori_delete',
           'user_list',
           'user_create',
           'user_edit',
           'user_delete',
        ];

        foreach ($permissions as $permission) {
             Permission::updateOrCreate([
                'name' => $permission,
                'guard_name' => 'admin',
             ]);
        }

        $role = Role::where('name', 'admin')->first();
        $role->syncPermissions($permissions);

    }
}
