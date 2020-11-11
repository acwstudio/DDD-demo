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
        $this->registerItems($menu);

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
    private function registerItems(Collection $menu)
    {
        foreach ($menu as $item) {
            /** @var Collection $item */
            if ($item->alias === 'admins'){

                $item->active = 'active';
                $item->open = 'menu-open';

                $this->recurse($item->children);

            }
        }

    }

    /**
     * @param Collection $items
     */
    private function recurse(Collection $items)
    {
        $items->map(function ($item, $key) {

            /*********************************
             * the block for middle level only
             *********************************/
//                if ($item->alias === 'any alias'){
//                    $item->open = 'menu-open';
//                    $item->active = 'active';
//                    $this->recurse($item->children);
//                }
            /********************************/

            if ($item->alias === 'register_admin') {
                $item->active = 'active';
            }
            return $item;
        });
    }
}
