<?php


namespace App\Http\Shop\Customers\Controllers;


use App\Http\Shop\Customers\Requests\ShopLoginRequest;
use Illuminate\Routing\Controller;

/**
 * Class ShopLoginController
 * @package App\Http\Shop\Customers\Controllers
 */
class ShopLoginController extends Controller
{
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        $title = 'Login';
        return view('shop.auth.customer-login', compact('title'));
    }

    /**
     * Handle a login request to the application.
     *
     * @param ShopLoginRequest $request
     * @return array
     *
     */
    public function login(ShopLoginRequest $request)
    {
        return $request->all();
    }
}
