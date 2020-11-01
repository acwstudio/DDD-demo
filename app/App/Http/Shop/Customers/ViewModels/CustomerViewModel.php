<?php


namespace App\Http\Shop\Customers\ViewModels;


use App\Http\Shop\ShopViewModel;
use Domain\Customers\Models\Customer;

/**
 * Class CustomerViewModel
 * @package App\Http\Shop\Customers\ViewModels
 */
class CustomerViewModel extends ShopViewModel
{
    /**
     * ShopViewModel constructor.
     * @param Customer $customer
     */
    public function __construct(string $title = null)
    {
        /** @var Customer $customer */
        $customer = \Auth::guard('customer')->user();
        parent::__construct($customer);

        $this->title = $title;
    }

    /**
     * @return string
     */
    public function title()
    {
        return $this->title;
    }
}
