<?php


namespace Database\Seeders;


use Domain\Admins\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Class AdminSeeder
 * @package Database\Seeders
 */
class AdminSeeder extends Seeder
{
    /** @var array */
    private array $roles;

    /** @var array */
    private array $names;

    /** @var Admin */
    private Admin $adminsDB;

    /**
     * AdminSeeder constructor.
     * @param Admin $admin
     * @param Role $role
     */
    public function __construct(Admin $admin, Role $role)
    {
        $this->adminsDB = $admin;

        $this->roles = config('roles-set.seeds.roles');
        $this->names = config('roles-set.seeds.names');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Admin::all()->count()) {
            foreach (Admin::all() as $item) {
                $item->delete();
            }
        }

        Admin::factory()->times(6)->create();

        foreach ($this->adminsDB->all() as $key => $item) {

            $data = ['role' => $this->roles[$key], 'name' => $this->names[$key]];
            $this->updateAdmin($item, $data);

        }

    }

    /**
     * Replace factory data to config data_seed
     *
     * @param Admin $item
     */
    private function updateAdmin(Admin $item, array $data)
    {
        $email = strtolower($data['name']) . '@admin.loc';

        $item->assignRole($data['role']);
        $item->update([
            'name' => $data['name'],
            'email' => $email,
            'password' => \Hash::make('12345678'),
        ]);

        $this->command->info('email is ' . $email);
    }
}
