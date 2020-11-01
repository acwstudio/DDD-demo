<?php


namespace App\Http\Shop\Customers\Controllers;

use App\Http\Shop\Customers\ViewModels\CustomerViewModel;
use Domain\Customers\Actions\CustomerForgotPasswordAction;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class ShopForgotPasswordController
 * @package App\Http\Shop\Customers\Controllers
 */
class ShopForgotPasswordController
{
    protected $forgotPasswordAction;

    /**
     * ShopForgotPasswordController constructor.
     * @param CustomerForgotPasswordAction $forgotPasswordAction
     */
    public function __construct(CustomerForgotPasswordAction $forgotPasswordAction)
    {
        $this->forgotPasswordAction = $forgotPasswordAction;
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        $viewModel = new CustomerViewModel('Send Password Reset Link');

        return view('shop.auth.customer-email', compact('viewModel'));
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
        return $this->forgotPasswordAction->execute($request);
    }
}
