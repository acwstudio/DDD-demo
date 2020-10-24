<?php


namespace App\Http\Shop;

use Domain\Customers\Models\Customer;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class ShopHomeController
 * @package App\Http\Shop
 */
class ShopHomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showHomePage()
    {
        $customer = Auth::user();

        if ($customer) {
            /** @var Customer $customer */
            if ($customer->hasVerifiedEmail()) {
                return view('shop.pages.shop');
            } else {
                return redirect()->route('verification.notice');
            }
        }

        return view('shop.pages.shop');
    }
}
