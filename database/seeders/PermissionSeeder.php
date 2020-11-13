<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;

/**
 * Class PermissionSeeder
 * @package Database\Seeders
 */
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = config('roles-set.seeds.permissions.super-admin');

        foreach ($permissions as $key => $permission) {
            foreach ($permissions[$key] as $item) {
                \DB::table('permissions')->insert([
                    'name' => $key . '.' . $item,
                    'guard_name' => 'admin'
                ]);
            }
        }
    }
}
