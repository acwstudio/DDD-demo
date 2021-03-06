<?php

namespace App\Http\AdminPanel\Dashboard\ViewModels;

use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;
use Illuminate\Database\Eloquent\Collection;
use Support\AdminMenu\MenuAdministrator;

/**
 * Class DashboardHomeViewModel
 * @package App\Http\AdminPanel\Dashboard\ViewModels
 */
class DashboardHomeViewModel extends AdminPanelViewModel
{
    /**
     * AdminViewModel constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();

        $this->dashboardItems();
    }

    /**
     * @param Collection $menu
     */
    private function dashboardItems()
    {
        foreach ($this->asideMenu as $item) {
            /** @var Collection $item */
            if ($item->alias === 'dashboard'){

                $item->active = 'active';
                $item->open = 'menu-open';

                $this->recurse($item->children);

            }
        }
    }

    /**
     * @param Collection $items
     */
    private function recurse($items)
    {
        $items->map(function ($item, $key){

            /*********************************
             the block for middle level only
             *********************************/
//                if ($item->alias === 'any alias'){
//                    $item->open = 'menu-open';
//                    $item->active = 'active';
//                    $this->recurse($item->children);
//                }
             /********************************/

                if ($item->alias === 'home'){
                    $item->active = 'active';
                }

            return $item;
        });
    }
}
