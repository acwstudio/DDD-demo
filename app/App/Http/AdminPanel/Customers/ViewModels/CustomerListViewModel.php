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
        $this->listItems($menu);

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
    private function listItems($menu)
    {
        foreach ($menu as $item) {
            /** @var Collection $item */
            if ($item->alias === 'customers'){

                $item->active = 'active';
                $item->open = 'menu-open';

                $this->recurse($item->children);

            }
        }

    }

    /**
     * @param Collection $items
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

            if ($item->alias === 'list_customers'){
                $item->active = 'active';
            }

            return $item;
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
