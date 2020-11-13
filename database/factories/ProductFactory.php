<?php


namespace Database\Factories;


use Domain\Admins\Models\Admin;
use Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ProductFactory
 * @package Database\Factories
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = ['goods', 'service'];
        $stock = ['stock #1', 'stock #2', 'stock #3'];


        $buy_price = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 500);
        $sale_price = $buy_price * 1.20;
        $min_price = $buy_price * 1.15;
        $reserve = $this->faker->numberBetween($min = 0, $max = 10);
        $in_transit = $this->faker->numberBetween($min = 0, $max = 10);
        $quantity = $reserve + $in_transit;

        $admins = Admin::all();
        $canAdmins = [];

        foreach ($admins as $key => $admin){
            if ($admin->hasAnyPermission('products.create')){
                $canAdmins[$key] = $admin->id;
            }
        }

        return [
            'name' => ucwords($this->faker->words($nb = 3, $asText = true)),
            'description' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'vendor_code' => str_pad($this->faker
                ->randomNumber($nbDigits = NULL, $strict = false), 10, "0", STR_PAD_LEFT),
            'type' => $type[array_rand($type, 1)],
            'admin_id' => $canAdmins[array_rand($canAdmins, 1)],
            'barcode' => $this->faker->ean13,
            'stock' => $stock[array_rand($stock, 1)],
            'buy_price' => $buy_price,
            'min_price' => $min_price,
            'sale_price' => $sale_price,
            'archived' => false,
            'published' => true,
            'weight' => $this->faker->randomFloat($nbMaxDecimals = 3, $min = 1, $max = 10),
            'volume' => $this->faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 1),
            'reserve' => $reserve,
            'in_transit' => $in_transit,
            'quantity' => $quantity,
        ];
    }
}
