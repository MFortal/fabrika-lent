<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create products
        Product::factory(5)->create();

        // create roles
        $role_admin = Role::create([
            'name' => 'administrator',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $role_user = Role::create([
            'name' => 'user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // create permissions
        $permission_show =  Permission::create(['name' => 'show product']);
        $permission_delete =  Permission::create(['name' => 'delete product']);
        $permission_create =  Permission::create(['name' => 'create product']);
        $permission_update =  Permission::create(['name' => 'update product']);
        $permission_update_article =  Permission::create(['name' => 'update article product']);

        $permission_show->assignRole($role_admin);
        $permission_show->assignRole($role_user);

        $permission_create->assignRole($role_admin);
        $permission_create->assignRole($role_user);

        $permission_update->assignRole($role_admin);
        $permission_update->assignRole($role_user);

        $permission_delete->assignRole($role_admin);
        $permission_delete->assignRole($role_user);

        $permission_update_article->assignRole($role_admin);

        // create admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'is_admin' => 1,
            'password' => Hash::make('12345'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $admin->assignRole($role_admin);

        // create users
        $users = User::factory(10)->create();

        foreach ($users as $user) {
            $user->assignRole($role_user->name);
        }
    }
}
