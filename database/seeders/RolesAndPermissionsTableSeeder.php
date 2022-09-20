<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $permissions = [
        //     'role-list',
        //     'role-create',
        //     'role-edit',
        //     'role-delete',
        //     'product-list',
        //     'product-create',
        //     'product-edit',
        //     'product-delete'
        //  ];
      
        //  foreach ($permissions as $permission) {
        //       Permission::create(['name' => $permission]);
        //  }
        // $admin = Role::create(['name' => 'Admin']);
        // $manager = Role::create(['name' => 'Manager']);
        // $staff = Role::create(['name' => 'Staff']);

        // $salePerission = Permission::create(['name'=>'Sale']);
        // $viewOrdersPermission = Permission::create(['name' => 'View orders']);
        // $createOrdersPermission = Permission::create((['name'=>'Create orders']));
        // $voidOrdersPermission = Permission::create(['name'=>'Void orders']);

        // $admin->syncPermissions([$salePerission,$viewOrdersPermission,$createOrdersPermission,$voidOrdersPermission]);
        // $manager->syncPermissions([$salePerission,$viewOrdersPermission,$createOrdersPermission,$voidOrdersPermission]);
        // $staff->syncPermissions([$salePerission,$viewOrdersPermission,$createOrdersPermission]);
        
    }
}
