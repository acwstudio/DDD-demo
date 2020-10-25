<?php


namespace App\Http\Shop\Customers\Controllers;

use App\Http\Shop\Customers\Services\ShopForgotPasswordService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class ShopForgotPasswordController
 * @package App\Http\Shop\Customers\Controllers
 */
class ShopForgotPasswordController
{
    protected $forgotPasswordService;

    /**
     * ShopForgotPasswordController constructor.
     * @param ShopForgotPasswordService $forgotPasswordService
     */
    public function __construct(ShopForgotPasswordService $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        $title = 'Send Password Reset Link';
        return view('shop.auth.customer-email', compact('title'));
    }

    /**
     * Send a reset link to the given user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function sendResetLinkEmail(Request $request)
    {
        return $this->forgotPasswordService->startSendResetLinkEmail($request);
    }
}
