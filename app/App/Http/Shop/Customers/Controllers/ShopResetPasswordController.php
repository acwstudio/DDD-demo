<?php


namespace App\Http\Shop\Customers\Controllers;

use App\Http\Shop\Customers\Requests\ShopResetPasswordRequest;
use App\Http\Shop\Customers\ViewModels\CustomerViewModel;
use Domain\Customers\Actions\CustomerResetPasswordAction;
use Illuminate\Http\Request;

/**
 * Class ShopResetPasswordController
 * @package App\Http\Shop\Customers\Controllers
 */
class ShopResetPasswordController
{
    protected $resetPasswordAction;

    /**
     * ShopResetPasswordController constructor.
     * @param CustomerResetPasswordAction $resetPasswordAction
     */
    public function __construct(CustomerResetPasswordAction $resetPasswordAction)
    {
        $this->resetPasswordAction = $resetPasswordAction;
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
//        $title = 'Reset Password';
        $viewModel = new CustomerViewModel('Reset Password');
        $token = $request->route()->parameter('token');

        return view('shop.auth.customer-reset')->with(
            ['token' => $token, 'email' => $request->email, 'viewModel' => $viewModel]
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
        return $this->resetPasswordAction->execute($request);
    }

}
