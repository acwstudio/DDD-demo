<?php


namespace App\Http\AdminPanel\Customers\ViewModels;

use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;
use Domain\Customers\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CustomerListViewModel
 * @package App\Http\AdminPanel\Customers\ViewModels
 */
class CustomerListViewModel extends AdminPanelViewModel
{
    public $customers;
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
        $this->customerItems($menu);

        $this->canResetPassword = $this->canResetPassword($admin);
        $this->canBan = $this->canBan($admin);

        $this->customers = Customer::all();
    }

    /**
     * @return Collection
     */
    public function admins()
    {
        return $this->customers;
    }

    /**
     * @param Collection $menu
     */
    private function customerItems($menu)
    {
        $menu->map(function ($item, $key){
            if ($item->alias === 'customers'){
                $item->active = 'active';
                $item->open = 'menu-open';
            }
            if ($item->children){
                if ($item->permission && $item->alias === 'list_customers'){
                    $item->active = 'active';
                }

                $this->customerItems($item->children);
            }
        });
    }

    /**
     * @param Admin $admin
     * @return bool
     * @throws \Exception
     */
    private function canResetPassword(Admin $admin)
    {
        return $admin->hasAnyPermission('customers.reset');
    }

    /**
     * @param Admin $admin
     * @return bool
     * @throws \Exception
     */
    private function canBan(Admin $admin)
    {
        return $admin->hasAnyPermission('customers.ban');
    }
}
