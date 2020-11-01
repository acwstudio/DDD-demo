<?php


namespace App\Http\Shop;

use Domain\Customers\Models\Customer;
use Illuminate\Routing\Controller;

/**
 * Class ShopHomeController
 * @package App\Http\Shop
 */
class ShopHomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('web-shop');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showHomePage()
    {
        /** @var Customer $customer */
        $customer = \Auth::guard('customer')->user();

        $viewModel = new ShopViewModel($customer);

        return view('shop.pages.shop', ['viewModel' => $viewModel]);
    }
}
