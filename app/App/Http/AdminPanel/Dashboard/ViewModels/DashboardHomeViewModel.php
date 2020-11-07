<?php


namespace App\Http\AdminPanel\Dashboard\ViewModels;


use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;

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

        $this->dashboardItems();
    }

    private function dashboardItems()
    {
        $menu = $this->asideMenu->where('alias', 'dashboard')->first();
        $childMenu = $menu->children->where('alias', 'home')->first();
//        $can = $this->admin->hasAnyPermission('dashboard.home');

        $menu->active = 'active';
        $menu->open = 'menu-open';

        $childMenu->active = 'active';
//        $childMenu->state = $can ? '' : 'disabled';
//        $childMenu->badgeText = $can ? '200' : '403';
//        $childMenu->badgeColor = $can ? 'badge-success' : 'badge-danger';
    }
}
