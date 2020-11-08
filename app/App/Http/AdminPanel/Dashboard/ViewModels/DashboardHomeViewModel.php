<?php


namespace App\Http\AdminPanel\Dashboard\ViewModels;


use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class DashboardHomeViewModel
 * @package App\Http\AdminPanel\Dashboard\ViewModels
 */
class DashboardHomeViewModel extends AdminPanelViewModel
{
    /**
     * AdminViewModel constructor.
     * @param Admin $admin
     * @throws \Exception
     */
    public function __construct()
    {
        /** @var Admin $admin */
        $admin = \Auth::guard('admin')->user();

        parent::__construct($admin);

        $menu = $this->asideMenu;
        $this->dashboardItems($menu);
    }

    /**
     * @param Collection $menu
     */
    private function dashboardItems($menu)
    {
        $menu->map(function ($item, $key){

            if ($item->alias === 'dashboard'){
                $item->active = 'active';
                $item->open = 'menu-open';
            }

            if ($item->children){
                if ($item->permission && $item->alias === 'home'){
                    $item->active = 'active';
                }

                $this->dashboardItems($item->children);
            }

            return $item;
        });

    }
}
