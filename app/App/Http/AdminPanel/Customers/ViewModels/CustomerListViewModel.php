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

    /**
     * AdminViewModel constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        /** @var Admin $admin */
        $admin = \Auth::guard('admin')->user();


        parent::__construct($admin);

        $this->customerItems();
        $this->canResetPassword = $this->canResetPassword($admin);
        $this->customers = Customer::all();
    }

    /**
     * @return Collection
     */
    public function admins()
    {
        return $this->customers;
    }

    private function customerItems()
    {
        $menu = $this->asideMenu->where('alias', 'customers')->first();
        $childMenu = $menu->children->where('alias', 'list_customers')->first();

        $menu->active = 'active';
        $menu->open = 'menu-open';

        $childMenu->active = 'active';
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
}
