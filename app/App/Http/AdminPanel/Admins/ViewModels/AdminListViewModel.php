<?php


namespace App\Http\AdminPanel\Admins\ViewModels;

use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AdminListViewModel
 * @package App\Http\AdminPanel\Admins\ViewModels
 */
class AdminListViewModel extends AdminPanelViewModel
{
    public $admins;
    public $canResetPassword;

    /**
     * AdminViewModel constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        /** @var Admin $admin */
        $admin = \Auth::guard('admin')->user();


        parent::__construct($admin);

        $this->adminItems();
        $this->canResetPassword = $this->canResetPassword($admin);
        $this->admins = Admin::all();
    }

    /**
     * @return Collection
     */
    public function admins()
    {
        return $this->admins;
    }

    private function adminItems()
    {
        $menu = $this->asideMenu->where('alias', 'admins')->first();
        $childMenu = $menu->children->where('alias', 'list_admins')->first();

        $menu->active = 'active';
        $menu->open = 'menu-open';

        $childMenu->active = 'active';
    }

    /**
     * @param Admin $admin
     * @throws \Exception
     */
    private function canResetPassword(Admin $admin)
    {
        return $admin->hasAnyPermission('admins.reset');
    }
}
