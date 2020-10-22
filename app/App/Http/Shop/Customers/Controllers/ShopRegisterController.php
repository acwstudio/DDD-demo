<?php


namespace App\Http\Shop\Customers\Controllers;


use App\Http\Shop\Customers\Requests\ShopRegisterRequest;

/**
 * Class ShopRegisterController
 * @package App\Http\Shop\Customers\Controllers
 */
class ShopRegisterController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showRegisterForm()
    {
        $title = 'Register';
        return view('shop.auth.customer-register', compact('title'));
    }

    /**
     * @param ShopRegisterRequest $request
     * @return array
     */
    public function register(ShopRegisterRequest $request)
    {
        return $request->all();
    }
}
