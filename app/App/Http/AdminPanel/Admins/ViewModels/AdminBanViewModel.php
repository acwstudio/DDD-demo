<?php

namespace App\Http\AdminPanel\Admins\ViewModels;

use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminBanViewModel
 * @package App\Http\AdminPanel\Admins\ViewModels
 */
class AdminBanViewModel extends AdminPanelViewModel
{
    public $adminItem;
    private $admin_id;

    /**
     * ShopViewModel constructor.
     * @param int $id
     * @throws \Exception
     */
    public function __construct(int $id)
    {
        /** @var Admin $admin */
        $admin = \Auth::guard('admin')->user();

        parent::__construct($admin);

        $this->adminItem = $this->adminItem($id);
        $this->admin_id = $id;

        $menu = $this->asideMenu;
        $this->banItems($menu);
    }

    /**
     * @return Admin|Model|object|null
     */
    public function adminItem($id)
    {
        return Admin::find($id);
    }

    /**
     * @param Collection $menu
     */
    private function banItems($menu)
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
     * @param $items
     */
    private function recurse(Collection $items)
    {
        $items->map(function ($item, $key){

            /*********************************
            the block for middle level only
             *********************************/
//                if ($item->alias === 'any alias'){
//                    $item->open = 'menu-open';
//                    $item->active = 'active';
//                    $this->recurse($item->children);
//                }
            /********************************/

            if ($item->alias === 'ban_admin'){
                $item->active = 'active';
                $item->badgeText = 'ID: ' . $this->admin_id;
                $item->badgeColor = 'badge-success';
            }
            return $item;
        });
    }
}
