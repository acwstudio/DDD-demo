<?php


namespace App\Http\AdminPanel\Admins\ViewModels;


use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;


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

        $this->adminItems();
    }

    /**
     * @return Admin|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function adminItem()
    {
        return $this->adminItem;
    }

    private function adminItems()
    {
        $menu = $this->asideMenu->where('alias', 'admins')->first();
        $childMenu = $menu->children->where('alias', 'ban_admin')->first();

        $menu->active = 'active';
        $menu->open = 'menu-open';
        $childMenu->badgeText = 'ID: ' . $this->admin_id;
        $childMenu->badgeColor = 'badge-success';

        $childMenu->active = 'active';
    }
}
