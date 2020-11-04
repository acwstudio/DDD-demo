<?php


namespace App\Http\AdminPanel;


use Domain\Admins\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;
use Support\AdminMenu\MenuAdministrator;

/**
 * Class AdminPanelViewModel
 * @package App\Http\AdminPanel
 */
class AdminPanelViewModel extends ViewModel
{
    public $asideMenu;

    /**
     * AdminViewModel constructor.
     * @param Admin $admin
     * @throws \Exception
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
        $this->asideMenu = $this->asideMenu();
    }

    /**
     * @return string
     */
    public function admin()
    {
        return $this->admin;
    }

    /**
     * @return Builder[]|Collection|MenuAdministrator[]
     * @throws \Exception
     */
    private function asideMenu()
    {
        $items = MenuAdministrator::where('menu_administrator_id', null)->with('children')->get();

        foreach ($items as $item) {
            foreach ($item->children as $child) {

                if ($child->alias === 'home') {
                    $can = $this->admin->hasAnyPermission('dashboard.home');
                    $child->badgeText = $can ? '200' : '403';
                    $child->badgeColor = $can ? 'badge-success' : 'badge-danger';
                }
                if ($child->alias === 'list_admins') {
                    $can = $this->admin->hasAnyPermission('admins.list');
                    $child->badgeText = $can ? '200' : '403';
                    $child->badgeColor = $can ? 'badge-success' : 'badge-danger';
                }
                if ($child->alias === 'reset_password') {
                    $can = $this->admin->hasAnyPermission('admins.reset');
                    $child->state = 'disabled';
                    $child->badgeText = $can ? 'ID: NO' : '403';
                    $child->badgeColor = $can ? 'badge-warning' : 'badge-danger';
                }
                if ($child->alias === 'register_admin') {
                    $can = $this->admin->hasAnyPermission('admins.register');
                    $child->badgeText = $can ? '200' : '403';
                    $child->badgeColor = $can ? 'badge-success' : 'badge-danger';
                }
            }
        }

        return $items;
    }
}
