<?php


namespace App\Http\Shop\Customers\Controllers;

use App\Http\Shop\Customers\Services\ShopVerifyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class ShopVerifyController
 * @package App\Http\Shop\Customers\Controllers
 */
class ShopVerifyController extends Controller
{
    protected $verifyService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ShopVerifyService $verifyService)
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');

        $this->verifyService = $verifyService;
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
        return $this->verifyService->startVerify($request);
    }

    /**
     * The user has been verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function verified(Request $request)
    {
        //
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        return $this->verifyService->startResend($request);
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
            ? redirect($this->verifyService->redirectPath())
            : view('shop.auth.customer-verify', compact('title'));
    }
}
