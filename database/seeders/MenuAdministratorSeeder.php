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
        $icons = config('menu-admin.icons');
        $routes = config('menu-admin.routes');
//        dd('menu-admin.routes');
        $this->recurse($items, $icons, $routes, $menuTable);
    }

    /**
     * @param $items
     * @param $icons
     * @param $routes
     * @param Builder $menuTable
     * @param int $level
     */
    private function recurse($items, $icons, $routes, Builder $menuTable, $level = 0)
    {
        foreach ($items as $key => $item) {
            $isArray = is_array($items[$key]);
//            dd($icons[$item]);
            if ($isArray) {
                $this->id = $menuTable->insertGetId([
                    'menu_administrator_id' => $level ? $this->id : null,
                    'icon' => $level ? null : $icons[$key],
                    'item' => $key,
                    'route' => null,
                    'alias' => strtolower(str_replace(' ', '_', $key))
                ]);
            } else {
                $menuTable->insertGetId([
                    'menu_administrator_id' => $level ? $this->id : null,
                    'icon' => $level ? null : $icons[$item],
                    'item' => $item,
                    'route' => $routes[strtolower(str_replace(' ', '_', $item))],
                    'alias' => strtolower(str_replace(' ', '_', $item))
                ]);
            }
//            dump($level);
            if ($isArray) {
                $this->recurse($item, $icons, $routes, $menuTable, $level + 1);
            }
        }
    }

}
