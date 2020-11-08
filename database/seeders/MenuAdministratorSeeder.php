<?php


namespace Database\Seeders;


use Illuminate\Database\Query\Builder;
use Illuminate\Database\Seeder;

/**
 * Class MenuAdministratorSeeder
 * @package Database\Seeders
 */
class MenuAdministratorSeeder extends Seeder
{
    private $id;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuTable = \DB::table('menu_administrators');

        $items = config('menu-admin.items');

        $this->recurse($items, $menuTable);
    }

    /**
     * @param $items
     * @param Builder $menuTable
     * @param int $level
     */
    private function recurse($items, Builder $menuTable, $level = 0)
    {
        foreach ($items as $key => $item) {
            $isArray = is_array($item);
            if ($isArray) {
                if ($item['icon']){
                    $this->id = $menuTable->insertGetId([
                        'menu_administrator_id' => $level ? $this->id : null,
                        'icon' => $item['icon'],
                        'item' => $item['item'],
                        'route' => $item['route'],
                        'permission' => $item['permission'],
                        'alias' => strtolower(str_replace(' ', '_', $item['item']))
                    ]);
                } elseif (!$item['route']) {
                    $this->id = $menuTable->insertGetId([
                        'menu_administrator_id' => $level ? $this->id : null,
                        'icon' => $item['icon'],
                        'item' => $item['item'],
                        'route' => $item['route'],
                        'permission' => $item['permission'],
                        'alias' => strtolower(str_replace(' ', '_', $item['item']))
                    ]);
                } else {
                    $menuTable->insertGetId([
                        'menu_administrator_id' => $level ? $this->id : null,
                        'icon' => $item['icon'],
                        'item' => $item['item'],
                        'route' => $item['route'],
                        'permission' => $item['permission'],
                        'alias' => strtolower(str_replace(' ', '_', $item['item']))
                    ]);
                }

                $isArray ? $this->recurse($item, $menuTable, $level + 1) : null;

            }

        }
    }

}
