<?php


namespace App\Http\Shop\Customers\Controllers;

use App\Http\Shop\Customers\Requests\ShopResetPasswordRequest;
use App\Http\Shop\Customers\Services\ShopResetPasswordService;
use Illuminate\Http\Request;

/**
 * Class ShopResetPasswordController
 * @package App\Http\Shop\Customers\Controllers
 */
class ShopResetPasswordController
{
    protected $resetPasswordService;

    /**
     * ShopResetPasswordController constructor.
     * @param ShopResetPasswordService $resetPasswordService
     */
    public function __construct(ShopResetPasswordService $resetPasswordService)
    {
        $this->resetPasswordService = $resetPasswordService;
    }


    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request)
    {
        $title = 'Reset Password';
        $token = $request->route()->parameter('token');

        return view('shop.auth.customer-reset')->with(
            ['token' => $token, 'email' => $request->email, 'title' => $title]
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(ShopResetPasswordRequest $request)
    {
        return $this->resetPasswordService->startReset($request);
    }

}
