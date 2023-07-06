<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class NewPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $permissions = [
            'رفع الملفات على الاشعه والمختبرات',
            'تعديل السعر'
        ];
        Permission::truncate();
        Role::truncate();
        $admin_role = Role::create(['name' => 'مدير']);

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
            $admin_role->givePermissionTo($permission);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
