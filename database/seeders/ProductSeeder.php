<?php


namespace Database\Seeders;


use Domain\Admins\Models\Admin;
use Domain\Products\Models\Product;
use Illuminate\Database\Seeder;

/**
 * Class ProductSeeder
 * @package Database\Seeders
 */
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        Product::factory()->count(30)->create();
//        if (Admin::all()->count()) {
//            foreach (Admin::all() as $item) {
//                $item->delete();
//            }
//        }
//
//        Admin::factory()->times(6)->create();
//
//        foreach ($this->adminsDB->all() as $key => $item) {
//
//            $data = ['role' => $this->roles[$key], 'name' => $this->names[$key]];
//            $this->updateAdmin($item, $data);
//
//        }

    }
}
