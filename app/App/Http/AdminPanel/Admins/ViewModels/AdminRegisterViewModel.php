<?php


namespace App\Http\AdminPanel\Admins\ViewModels;


use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

/**
 * Class AdminRegisterViewModel
 * @package App\Http\AdminPanel\Admins\ViewModels
 */
class AdminRegisterViewModel extends AdminPanelViewModel
{
    public $roles;

    /**
     * ShopViewModel constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        /** @var Admin $admin */
        $admin = \Auth::guard('admin')->user();

        parent::__construct($admin);

        $this->adminItems();

        $this->roles = Role::all();
    }

    /**
     * @return Collection
     */
    public function roles()
    {
        return $this->roles;
    }

    private function adminItems()
    {
        $menu = $this->asideMenu->where('alias', 'admins')->first();
        $childMenu = $menu->children->where('alias', 'register_admin')->first();

        $menu->active = 'active';
        $menu->open = 'menu-open';

        $childMenu->active = 'active';
    }
}
