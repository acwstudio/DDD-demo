<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Class RoleSeeder
 * @package Database\Seeders
 */
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrRoles = config('roles-set.seeds.permissions');

        foreach ($arrRoles as $key => $arrRole) {

            \DB::table('roles')->insert([
                'name' => $key,
                'guard_name' => 'admin',
            ]);
        }

        $roles = Role::all();

        foreach ($roles as $role) {
            foreach ($arrRoles[$role->name] as $key_1 => $item) {
                foreach ($item as $value) {
                    $role->givePermissionTo($key_1 . '.' . $value);
                }
            }
        }
    }
}
