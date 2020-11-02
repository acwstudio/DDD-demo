<?php


namespace App\Http\AdminPanel\Admins\ViewModels;


use Domain\Admins\Models\Admin;
use Route;

/**
 * Class AdminResetPasswordViewModel
 * @package App\Http\AdminPanel\Admins\ViewModels
 */
class AdminResetPasswordViewModel extends AdminViewModel
{
    public $adminItem;

    /**
     * ShopViewModel constructor.
     * @param int $id
     * @throws \Exception
     */
    public function __construct(int $id)
    {
        /** @var Admin $admin */
        $admin = \Auth::guard('admin')->user();
        $active = Route::getCurrentRoute()->getName();
        $activeGroup = 'admin';
        $this->adminItem = Admin::find($id);

        parent::__construct($admin, $active, $activeGroup);
    }

    /**
     * @return Admin|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function adminItem()
    {
        return $this->adminItem;
    }
}
