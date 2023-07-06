<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
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
            'الأقسام',
            'العروض',
            'النماذج',
            'الخدمات',
            'المصاريف',
            'المشتريات',
            'اضافة فاتورة',
            'المحولون',
            'التقارير',
            'اضافة مريض',
            'تعديل مريض',
            'حذف مريض',
            'تحويل مريض',
            'المرضى',
            'المواعيد',
            'الفواتير',
            'التشخيصات',
            'تسديد الزيارات',
            'الاشعارات',
            'المرضى بالانتظار',
            'الاعدادات',
            'الصلاحيات',
            'المشرفين',
            'الموظفين',
            'خصم الفاتورة',
            'رؤية جوال المريض',
            'طلبات الأشعة داخل ملف المريض',
            'طلبات المختبر داخل ملف المريض',
            'رفع الملفات على الاشعه والمختبرات',
            'تعديل السعر',
            'بيانات المواعيد',
            'حذف الفواتير',
            'تحضير المرضى',
            'عرض الملف الشخصي للمريض',
            'اضافة الفواتير',
            'تعديل الفواتير',
            'استرجاع الفواتير',
            'حذف الموعد',
            'تعديل الموعد',
        ];

        Permission::truncate();
        Role::truncate();
        $admin_role = Role::create(['name' => 'مدير']);
        $role2 = Role::create(['name' => 'الاستقبال']);
        $role3 = Role::create(['name' => 'الأطباء']);
        $role4 = Role::create(['name' => 'المحاسبين']);
        $role5 = Role::create(['name' => 'الأشعة']);
        $role6 = Role::create(['name' => 'المختبر']);
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
            $admin_role->givePermissionTo($permission);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
