<?php


namespace App\Http\Shop\Customers\Controllers;

use Domain\Customers\Actions\CustomerResendAction;
use Domain\Customers\Actions\CustomerVerifyAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class ShopVerifyController
 * @package App\Http\Shop\Customers\Controllers
 */
class ShopVerifyController extends Controller
{
    protected $verifyAction;
    protected $resendAction;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CustomerVerifyAction $verifyAction, CustomerResendAction $resendAction)
    {
        $this->middleware('auth:customer');
        $this->middleware('signed:customer')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');

        $this->verifyAction = $verifyAction;
        $this->resendAction = $resendAction;
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        return $this->verifyAction->execute($request);
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        return $this->resendAction->execute($request);
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $title = 'Verify';
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->verifyAction->redirectPath())
            : view('shop.auth.customer-verify', compact('title'));
    }
}
