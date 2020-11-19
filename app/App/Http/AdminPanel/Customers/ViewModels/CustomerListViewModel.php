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
        parent::__construct();

        $this->canResetPassword = $this->canResetPassword();
        $this->canBan = $this->canBan();

        $this->customers = $this->customers();
        $this->listItems();
    }

    /**
     * @return Collection
     */
    public function customers()
    {
        return Customer::all();
    }


    private function listItems()
    {
        foreach ($this->asideMenu as $item) {
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
     * @return bool
     * @throws \Exception
     */
    private function canResetPassword()
    {
        return $this->admin->hasAnyPermission('customers.reset');
    }

    /**
     * @return bool
     * @throws \Exception
     */
    private function canBan()
    {
        return $this->admin->hasAnyPermission('customers.ban');
    }
}
