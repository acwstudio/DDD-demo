<?php


namespace Database\Seeders;

use Database\Factories\CustomerFactory;
use Domain\Customers\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;

/**
 * Class CustomerSeeder
 * @package Database\Seeders
 */
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Customer::all()->count()) {
            foreach (Customer::all() as $item) {
                $item->delete();
            }
        }

        Customer::factory()->times(10)->create();

        foreach (Customer::all() as $item) {
            $email = strtolower(str_replace(' ', '.', $item->name)) . '@customer.loc';
            $item->update([
                'email' => $email,
                'password' => \Hash::make('12345678')
            ]);
            $this->command->info('email is ' . $email);
        }
    }
}
