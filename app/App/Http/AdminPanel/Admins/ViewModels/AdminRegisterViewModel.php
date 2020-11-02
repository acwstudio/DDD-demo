<?php


namespace App\Http\AdminPanel\Admins\ViewModels;


use Domain\Admins\Models\Admin;
use Illuminate\Database\Eloquent\Collection;
use Route;

/**
 * Class AdminRegisterViewModel
 * @package App\Http\AdminPanel\Admins\ViewModels
 */
class AdminRegisterViewModel extends AdminViewModel
{
    public $roles;

    /**
     * ShopViewModel constructor.
     * @param Collection $admins
     * @throws \Exception
     */
    public function __construct(Collection $roles)
    {
        /** @var Admin $admin */
        $admin = \Auth::guard('admin')->user();
        $active = Route::getCurrentRoute()->getName();
        $activeGroup = 'admin';

        parent::__construct($admin, $active, $activeGroup);

        $this->roles = $roles;
    }

    /**
     * @return Collection
     */
    public function roles()
    {
        return $this->roles;
    }
}
