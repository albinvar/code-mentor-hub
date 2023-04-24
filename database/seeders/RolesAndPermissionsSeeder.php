<?php

namespace Database\Seeders;

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

        Permission::create(['name' => 'promote-to-mentor']);
        Permission::create(['name' => 'demote-to-mentor']);

        Permission::create(['name' => 'is-upgraded']);

        $userRole = Role::create(['name' => 'User']);
        $premiumRole = Role::create(['name' => 'Premium']);
        $mentorRole = Role::create(['name' => 'Mentor']);
        $adminRole = Role::create(['name' => 'Admin']);

        $userRole->givePermissionTo([
            //
        ]);

        $userRole->givePermissionTo([
            'is-upgraded'
        ]);

        $mentorRole->givePermissionTo([
            'create-solutions',
            'edit-solutions',
            'delete-solutions',
        ]);

        $mentorRole->givePermissionTo([
            'create-solutions',
            'edit-solutions',
            'delete-solutions',
            'promote-to-mentor',
            'demote-to-mentor',
        ]);
    }
}
