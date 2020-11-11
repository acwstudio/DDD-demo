<?php


namespace Database\Seeders;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Seeder;
use Support\AdminMenu\MenuAdministrator;

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

        foreach ($items as $key => $item){
            if ($item['icon']){
                $level = 0;
            } elseif ($item['route']){
                $level = null;
            } else {
                $level = 1;
            }
            $this->id = $menuTable->insertGetId([
                'icon' => $item['icon'],
                'item' => $item['item'],
                'route' => $item['route'],
                'permission' => $item['permission'],
                'alias' => strtolower(str_replace(' ', '_', $item['item'])),
                'father' => $item['father'],
                'level' => $level
            ]);
        }

        $menuTable->get()->map(function ($item, $key) use($menuTable) {

            $this->fatherId($item);
            return $item;

        });

    }

    /**
     * @param $father
     * @return mixed|null
     */
    private function fatherId($item)
    {
        $fatherId = \DB::table('menu_administrators')->where('alias', $item->father)->first();

        if ($fatherId){
            \DB::table('menu_administrators')->where('id', $item->id)->update([
                'menu_administrator_id' => $fatherId->id
            ]);
        }

    }

}
