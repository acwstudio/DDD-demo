<?php


namespace App\Http\Shop\Customers\Controllers;


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
}
