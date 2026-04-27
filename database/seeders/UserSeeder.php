<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

public function run(): void
{

/*
Create Roles
*/

$superAdmin = Role::firstOrCreate([
'slug' => 'super-admin'
],[
'name' => 'Super Admin'
]);

$admin = Role::firstOrCreate([
'slug' => 'admin'
],[
'name' => 'Admin'
]);

$userRole = Role::firstOrCreate([
'slug' => 'user'
],[
'name' => 'User'
]);


/*
Create Users
*/

$superAdminUser = User::updateOrCreate([
'email' => 'superadmin@gmail.com'
],[
'name' => 'Super Admin',
'password' => Hash::make('12345678')
]);

$adminUser = User::updateOrCreate([
'email' => 'admin@gmail.com'
],[
'name' => 'Admin',
'password' => Hash::make('12345678')
]);

$normalUser = User::updateOrCreate([
'email' => 'user@gmail.com'
],[
'name' => 'User',
'password' => Hash::make('12345678')
]);


/*
Assign Roles
*/

$superAdminUser->roles()->sync([$superAdmin->id]);

$adminUser->roles()->sync([$admin->id]);

$normalUser->roles()->sync([$userRole->id]);

}
}
