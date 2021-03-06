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
    public $admin;

    /**
     * AdminViewModel constructor.
     * @param Admin $admin
     * @throws \Exception
     */
    public function __construct()
    {
        $this->admin = $this->admin();

        $this->asideMenu = $this->asideMenu();
    }

    /**
     * @return string
     */
    public function admin(): Admin
    {
        return \Auth::guard('admin')->user();
    }


    /**
     * @return Builder[]|Collection
     * @throws \Exception
     */
    private function asideMenu()
    {
        $items = MenuAdministrator::where('level', 0)->with('children')->get();

        /** Collection $items */
        $this->baseLevel($items);

        return $items;
    }

    /**
     * @param Collection $items
     */
    private function baseLevel(Collection $items)
    {
        $items->map(function ($item, $key) {

            if ($item->children){
                if (is_null($item->level)){
                    $item->hasPermission = $this->admin->hasAnyPermission($item->permission);
                    if ($item->alias === 'ban_admin' || $item->alias === 'reset_password'
                        || $item->alias === 'ban_customer' || $item->alias === 'show_product'
                        || $item->alias === 'edit_product'
                    ){
                        $item->state = 'disabled';
                        $item->badgeText = $item->hasPermission ? 'ID NO' : '403';
                        $item->badgeColor = $item->hasPermission ? 'badge-warning' : 'badge-danger';
                    } else {
                        $item->badgeText = $item->hasPermission ? '200' : '403';
                        $item->badgeColor = $item->hasPermission ? 'badge-success' : 'badge-danger';
                        $item->state = $item->hasPermission ? '' : 'disabled';
                    }

                }

                $this->baseLevel($item->children);
            }
            return $item;
        });

    }

}
