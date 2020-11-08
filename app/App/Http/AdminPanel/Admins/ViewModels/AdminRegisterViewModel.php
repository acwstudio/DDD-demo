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

        $menu = $this->asideMenu;
        $this->adminItems($menu);

        $this->roles = Role::all();
    }

    /**
     * @return Collection
     */
    public function roles()
    {
        return $this->roles;
    }

    /**
     * @param Collection $menu
     */
    private function adminItems($menu)
    {
        $menu->map(function ($item, $key){
            if ($item->alias === 'admins'){
                $item->active = 'active';
                $item->open = 'menu-open';
            }
            if ($item->children){
                if ($item->permission && $item->alias === 'register_admin'){
                    $item->active = 'active';
                }

                $this->adminItems($item->children);
            }
        });

    }
}
