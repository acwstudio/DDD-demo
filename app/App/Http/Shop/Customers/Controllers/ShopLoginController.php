<?php


namespace App\Http\Shop\Customers\Controllers;

use App\Http\Shop\Customers\Requests\ShopLoginRequest;
use App\Http\Shop\Customers\ViewModels\CustomerViewModel;
use Domain\Customers\Actions\CustomerLoginAction;
use Illuminate\Routing\Controller;

/**
 * Class ShopLoginController
 * @package App\Http\Shop\Customers\Controllers
 */
class ShopLoginController extends Controller
{
    protected $loginAction;

    /**
     * Create a new controller instance.
     *
     * @param CustomerLoginAction $loginAction
     */
    public function __construct(CustomerLoginAction $loginAction)
    {
        $this->middleware('guest:customer');
        $this->loginAction = $loginAction;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        $viewModel = new CustomerViewModel('LogIn');

        return view('shop.auth.customer-login', compact('viewModel'));
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
        return $this->loginAction->execute($request);
    }
}
