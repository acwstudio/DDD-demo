<?php


namespace App\Http\Shop\Customers\Services;


use App\Http\Shop\Customers\Requests\ShopLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class ShopLoginService
 * @package App\Http\Shop\Customers\Services
 */
class ShopLoginService
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $throttlesLoginsService;

    /**
     * ShopLoginService constructor.
     * @param ShopThrottlesLoginsService $throttlesLoginsService
     */
    public function __construct(ShopThrottlesLoginsService $throttlesLoginsService)
    {
        $this->throttlesLoginsService = $throttlesLoginsService;
    }

    /**
     * Handle a login request to the application.
     *
     * @param ShopLoginRequest $request
     * @return string | void
     *
     */
    public function startLogin(ShopLoginRequest $request)
    {
        if ($this->throttlesLoginsService->hasTooManyLoginAttempts($request)) {

            $this->throttlesLoginsService->fireLockoutEvent($request);

            return $this->throttlesLoginsService->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->throttlesLoginsService->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param Request $request
     * @return bool
     */
    public function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->throttlesLoginsService->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    public function authenticated(ShopLoginRequest $request, $user)
    {
        //
    }

    /**
     * Get the failed login response instance.
     *
     * @param ShopLoginRequest $request
     * @return string | void
     *
     */
    public function sendFailedLoginResponse(ShopLoginRequest $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    public function guard()
    {
        return \Auth::guard();
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
}
