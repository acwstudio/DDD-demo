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
//        dd($this->admin->getPermissionsViaRoles());
        $items = MenuAdministrator::where('menu_administrator_id', null)->with('children')->get();
//        dd($items);
        foreach ($items as $item) {
            foreach ($item->children as $child) {
                if ($child->alias === 'home') {
                    $can = $this->admin->hasAnyPermission('dashboard.home');
                    $child->state = $can ? '' : 'disabled';
                    $child->badgeText = $can ? '200' : '403';
                    $child->badgeColor = $can ? 'badge-success' : 'badge-danger';
                }
                if ($child->alias === 'list_admins') {
                    $can = $this->admin->hasAnyPermission('admins.list');
                    $child->state = $can ? '' : 'disabled';
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
                    $child->state = $can ? '' : 'disabled';
                    $child->badgeText = $can ? '200' : '403';
                    $child->badgeColor = $can ? 'badge-success' : 'badge-danger';
                }
                if ($child->alias === 'ban_admin') {
                    $can = $this->admin->hasAnyPermission('admins.ban');
                    $child->state = 'disabled';
                    $child->badgeText = $can ? 'ID: NO' : '403';
                    $child->badgeColor = $can ? 'badge-warning' : 'badge-danger';
                }
                if ($child->alias === 'list_customers') {
                    $can = $this->admin->hasAnyPermission('customers.list');
                    $child->state = $can ? '' : 'disabled';
                    $child->badgeText = $can ? '200' : '403';
                    $child->badgeColor = $can ? 'badge-success' : 'badge-danger';
                }
            }
        }
//        dd($items);
        return $items;
    }
}