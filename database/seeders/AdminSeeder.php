<?php


namespace Database\Seeders;


use Domain\Admins\Models\Admin;
use Illuminate\Database\Seeder;

/**
 * Class AdminSeeder
 * @package Database\Seeders
 */
class AdminSeeder extends Seeder
{
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

        Admin::factory()->times(5)->create();

        foreach (Admin::all() as $item) {
            $email = strtolower(str_replace(' ', '.', $item->name)) . '@admin.loc';
            $item->update([
                'email' => $email,
                'password' => \Hash::make('12345678')
            ]);
            $this->command->info('email is ' . $email);
        }
    }
}
