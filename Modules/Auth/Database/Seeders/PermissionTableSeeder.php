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

        Permission::create(['name' => 'users.view']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'users.delete']);
        Permission::create(['name' => 'users.publish']);
        Permission::create(['name' => 'users.unpublish']);
        Permission::create(['name' => 'roles.view']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.update']);
        Permission::create(['name' => 'roles.delete']);
        Permission::create(['name' => 'roles.publish']);
        Permission::create(['name' => 'roles.unpublish']);
        Permission::create(['name' => 'permissions.view']);
        Permission::create(['name' => 'permissions.create']);
        Permission::create(['name' => 'permissions.update']);
        Permission::create(['name' => 'permissions.delete']);
        Permission::create(['name' => 'permissions.publish']);
        Permission::create(['name' => 'permissions.unpublish']);

        $writerRole = Role::create(['name' => 'user']);

        $adminRole = Role::create(['name' => 'admin']);

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
