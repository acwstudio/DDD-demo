<?php


namespace App\Http\Shop;

use Domain\Customers\Models\Customer;
use Spatie\ViewModels\ViewModel;

/**
 * Class ShopViewModel
 * @package App\Http\Shop
 */
class ShopViewModel extends ViewModel
{
    public $customer;

    /**
     * ShopViewModel constructor.
     * @param Customer $customer
     */
    public function __construct(Customer $customer = null)
    {
        $this->customer = $customer;
    }

    /**
     * @return string
     */
    public function customer()
    {
        return $this->currentUser($this->customer);
    }

    /**
     * @return string
     */
    private function currentUser($customer)
    {
        /** @var Customer $customer */
        if ($customer) {
            if ($customer->hasVerifiedEmail()) {
                $customerName = $customer->name;
                return $customerName;
            } else {
                return redirect()->route('verification.notice');
            }
        } else {
            return null;
        }

    }
}
