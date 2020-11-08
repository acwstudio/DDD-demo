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
     * @return Builder[]|Collection
     */
    private function asideMenu()
    {
        $items = MenuAdministrator::where('menu_administrator_id', null)->with('children')->get();

        /** Collection $items */
        $this->recurse($items);

        return $items;
    }

    /**
     * @param Collection $items
     * @param int $level
     * @return void
     */
    private function recurse(Collection $items, $level = 0)
    {
        $items->map(function ($item, $key) {

            if ($item->children){
                if ($item->permission){
                    $item->canItem = $this->admin->hasAnyPermission($item->permission);
                    if ($item->alias === 'ban_admin' || $item->alias === 'reset_password'){
                        $item->state = 'disabled';
                        $item->badgeText = $item->canItem ? 'ID NO' : '403';
                        $item->badgeColor = $item->canItem ? 'badge-warning' : 'badge-danger';
                    } else {
                        $item->badgeText = $item->canItem ? '200' : '403';
                        $item->badgeColor = $item->canItem ? 'badge-success' : 'badge-danger';
                        $item->state = $item->canItem ? '' : 'disabled';
                    }

                }

                $this->recurse($item->children);
            }
            return $item;
        });

    }
}
