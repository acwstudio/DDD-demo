<?php


namespace App\Http\Shop\Customers\Controllers;

use App\Http\Shop\Customers\Requests\ShopLoginRequest;
use App\Http\Shop\Customers\Services\ShopLoginService;
use Illuminate\Routing\Controller;

/**
 * Class ShopLoginController
 * @package App\Http\Shop\Customers\Controllers
 */
class ShopLoginController extends Controller
{
    private $loginService;

    /**
     * Create a new controller instance.
     *
     * @param ShopLoginService $loginService
     */
    public function __construct(ShopLoginService $loginService)
    {
        $this->loginService = $loginService;
        $this->middleware('guest');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        $title = 'LogIn';
        return view('shop.auth.customer-login', compact('title'));
    }

    /**
     * Handle a login request to the application.
     *
     * @param ShopLoginRequest $request
     * @return string | void
     *
     */
    public function login(ShopLoginRequest $request)
    {
        return $this->loginService->startLogin($request);

    }
}
