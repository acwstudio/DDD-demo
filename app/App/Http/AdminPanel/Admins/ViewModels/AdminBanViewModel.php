<?php


namespace App\Http\AdminPanel\Admins\ViewModels;


use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;
use Illuminate\Database\Eloquent\Collection;


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

        $this->adminItem = Admin::find($id);
        $this->admin_id = $id;

        parent::__construct($admin);

        $menu = $this->asideMenu;
        $this->adminItems($menu);
    }

    /**
     * @return Admin|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function adminItem()
    {
        return $this->adminItem;
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
                if ($item->permission && $item->alias === 'ban_admin'){
                    $item->active = 'active';
                    $item->badgeText = 'ID: ' . $this->admin_id;
                    $item->badgeColor = 'badge-success';
                }

                $this->adminItems($item->children);
            }
        });

    }
}
