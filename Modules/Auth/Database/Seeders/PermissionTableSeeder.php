<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view.posts']);
        Permission::create(['name' => 'create.posts']);
        Permission::create(['name' => 'edit.posts']);
        Permission::create(['name' => 'delete.posts']);
        Permission::create(['name' => 'publish.posts']);
        Permission::create(['name' => 'unpublish.posts']);
        Permission::create(['name' => 'view.users']);
        Permission::create(['name' => 'create.users']);
        Permission::create(['name' => 'edit.users']);
        Permission::create(['name' => 'delete.users']);
        Permission::create(['name' => 'publish.users']);
        Permission::create(['name' => 'unpublish.users']);
        Permission::create(['name' => 'view.roles']);
        Permission::create(['name' => 'create.roles']);
        Permission::create(['name' => 'edit.roles']);
        Permission::create(['name' => 'delete.roles']);
        Permission::create(['name' => 'publish.roles']);
        Permission::create(['name' => 'unpublish.roles']);
        Permission::create(['name' => 'view.permissions']);
        Permission::create(['name' => 'create.permissions']);
        Permission::create(['name' => 'edit.permissions']);
        Permission::create(['name' => 'delete.permissions']);
        Permission::create(['name' => 'publish.permissions']);
        Permission::create(['name' => 'unpublish.permissions']);

        $writerRole = Role::create(['name' => 'user']);
        $writerRole->givePermissionTo('view.posts');
        $writerRole->givePermissionTo('create.posts');
        $writerRole->givePermissionTo('edit.posts');
        $writerRole->givePermissionTo('delete.posts');

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('view.posts');
        $adminRole->givePermissionTo('create.posts');
        $adminRole->givePermissionTo('edit.posts');
        $adminRole->givePermissionTo('delete.posts');
        $adminRole->givePermissionTo('publish.posts');
        $adminRole->givePermissionTo('unpublish.posts');

        $superadminRole = Role::create(['name' => 'superadmin']);
        $superadminRole->givePermissionTo(Permission::all());

        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'writer@modula.com',
            'password' => bcrypt('password'),
            'avatar' => 'noimage.webp'
        ]);
        $user->assignRole($writerRole);

        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@modula.com',
            'password' => bcrypt('password'),
            'avatar' => 'noimage.webp'
        ]);
        $user->assignRole($adminRole);

        $user = User::factory()->create([
            'name' => 'Superadmin User',
            'email' => 'superadmin@modula.com',
            'password' => bcrypt('password'),
            'avatar' => 'noimage.webp'
        ]);
        $user->assignRole($superadminRole);
    }
}
