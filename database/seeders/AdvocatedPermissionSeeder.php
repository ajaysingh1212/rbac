<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AdvocatedPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissionIds = [];

        foreach (config('advocated_content.sections', []) as $section) {
            foreach (['list', 'create', 'edit', 'delete'] as $action) {
                $permission = Permission::firstOrCreate(
                    ['slug' => $section['permission_prefix'].'-'.$action],
                    ['name' => $section['singular'].' '.ucfirst($action)]
                );

                $permissionIds[] = $permission->id;
            }
        }

        foreach (['list', 'create', 'edit', 'delete'] as $action) {
            $permission = Permission::firstOrCreate(
                ['slug' => 'gallery-'.$action],
                ['name' => 'Gallery '.ucfirst($action)]
            );

            $permissionIds[] = $permission->id;
        }

        if ($adminRole = Role::where('slug', 'admin')->first()) {
            $adminRole->permissions()->syncWithoutDetaching($permissionIds);
        }
    }
}
