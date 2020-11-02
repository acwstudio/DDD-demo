<?php


namespace App\Http\AdminPanel\Admins\ViewModels;

use Domain\Admins\Models\Admin;
use Illuminate\Database\Eloquent\Collection;
use Route;

/**
 * Class AdminListViewModel
 * @package App\Http\AdminPanel\Admins\ViewModels
 */
class AdminListViewModel extends AdminViewModel
{
    /**
     * ShopViewModel constructor.
     * @param Collection $admins
     * @throws \Exception
     */
    public function __construct(Collection $admins)
    {
        /** @var Admin $admin */
        $admin = \Auth::guard('admin')->user();
        $active = Route::getCurrentRoute()->getName();
        $activeGroup = 'admin';

        parent::__construct($admin, $active, $activeGroup);

        $this->admins = $admins;
    }

    /**
     * @return Collection
     */
    public function admins()
    {
        return $this->admins;
    }

}
