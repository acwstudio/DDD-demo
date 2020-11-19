<?php


namespace App\Http\AdminPanel\Customers\ViewModels;


use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;
use Domain\Customers\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CustomerBanViewModel
 * @package App\Http\AdminPanel\Customers\ViewModels
 */
class CustomerBanViewModel extends AdminPanelViewModel
{
    public $customerItem;

    /**
     * ShopViewModel constructor.
     * @param int $id
     * @throws \Exception
     */
    public function __construct(int $id)
    {
        parent::__construct();

        $this->customerItem = $this->customerItem($id);

        $this->banItems();
    }

    /**
     * @return Admin|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function customerItem(int $id)
    {
        return Customer::find($id);
    }

    /**
     * @param Collection $menu
     */
    private function banItems()
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
     * @param $items
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

            if ($item->alias === 'ban_customer'){
                $item->active = 'active';
                $item->badgeText = 'ID: ' . $this->customerItem->id;
                $item->badgeColor = 'badge-success';
            }
            return $item;
        });
    }
}
