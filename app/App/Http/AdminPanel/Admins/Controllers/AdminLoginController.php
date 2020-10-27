<?php


namespace App\Http\AdminPanel\Admins\Controllers;


use App\Http\AdminPanel\Admins\Requests\AdminLoginRequest;
use Domain\Admins\Actions\AdminLoginAction;
use Illuminate\Routing\Controller;

/**
 * Class AdminLoginController
 * @package App\Http\AdminPanel\Admins\Controllers
 */
class AdminLoginController extends Controller
{
    protected $loginAction;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AdminLoginAction $loginAction)
    {
        $this->middleware('guest:admin');
        $this->loginAction = $loginAction;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.pages.login');
    }

    /**
     * @param AdminLoginRequest $loginRequest
     */
    public function login(AdminLoginRequest $request)
    {
        return $this->loginAction->execute($request);
    }
}
