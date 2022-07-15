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

        $writerRole = Role::create(['name' => 'writer']);
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
