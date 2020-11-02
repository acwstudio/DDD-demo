<?php


namespace App\Http\AdminPanel\Admins\ViewModels;


use Domain\Admins\Models\Admin;
use Spatie\ViewModels\ViewModel;

/**
 * Class AdminViewModel
 * @package App\Http\AdminPanel\Admins\ViewModels
 */
class AdminViewModel extends ViewModel
{
    public $canRegister;
    public $canList;

    /**
     * ShopViewModel constructor.
     * @param Admin $admin
     * @throws \Exception
     */
    public function __construct(Admin $admin, string $active, string $activeGroup)
    {
        $this->admin = $admin;
        $this->active = $active;
        $this->activeGroup = $activeGroup;
        $this->canRegister = $admin->hasAnyPermission('admins.register');
        $this->canList = $admin->hasAnyPermission('admins.list');
    }

    /**
     * @return string
     */
    public function admin()
    {
        return $this->admin;
    }

    /**
     * @return string
     */
    public function active()
    {
        return $this->active;
    }

    /**
     * @return string
     */
    public function activeGroup()
    {
        return $this->activeGroup;
    }

    /**
     * @return bool
     */
    public function canRegister()
    {
        return $this->canRegister;
    }

    /**
     * @return bool
     */
    public function canList()
    {
        return $this->canList;
    }
}
