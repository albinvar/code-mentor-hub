<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Permission::create(['name' => 'create-solutions']);
        Permission::create(['name' => 'edit-solutions']);
        Permission::create(['name' => 'delete-solutions']);

        Permission::create(['name' => 'create-blog-posts']);
        Permission::create(['name' => 'edit-blog-posts']);
        Permission::create(['name' => 'delete-blog-posts']);


        $userRole = Role::create(['name' => 'User']);
        $mentorRole = Role::create(['name' => 'Mentor']);

        $userRole->givePermissionTo([
            //
        ]);

        $mentorRole->givePermissionTo([
            'create-solutions',
            'edit-solutions',
            'delete-solutions',
        ]);
    }
}
