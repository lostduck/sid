<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'news-list',
           'news-create',
           'news-edit',
           'news-delete',
           'surat-list',
           'surat-create',
           'surat-edit',
           'surat-delete',
		   'users-list',
           'users-create',
           'users-edit',
           'users-delete'
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
