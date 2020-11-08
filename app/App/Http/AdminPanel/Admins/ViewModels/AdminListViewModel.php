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
    public $canBan;

    /**
     * AdminViewModel constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        /** @var Admin $admin */
        $admin = \Auth::guard('admin')->user();


        parent::__construct($admin);

        $menu = $this->asideMenu;
        $this->adminItems($menu);

        $this->canResetPassword = $this->canResetPassword($admin);
        $this->canBan = $this->canBan($admin);

        $this->admins = Admin::all();
    }

    /**
     * @return Collection
     */
    public function admins()
    {
        return $this->admins;
    }

    /**
     * @param Admin $admin
     * @return bool
     * @throws \Exception
     */
    private function canResetPassword(Admin $admin)
    {
        return $admin->hasAnyPermission('admins.reset');
    }

    /**
     * @param Admin $admin
     * @return bool
     * @throws \Exception
     */
    private function canBan(Admin $admin)
    {
        return $admin->hasAnyPermission('admins.ban');
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
                if ($item->permission && $item->alias === 'list_admins'){
                    $item->active = 'active';
                }

                $this->adminItems($item->children);
            }
        });

    }

}
