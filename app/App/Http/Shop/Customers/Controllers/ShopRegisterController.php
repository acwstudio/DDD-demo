<?php


namespace App\Http\Shop\Customers\Controllers;


use App\Http\Shop\Customers\Requests\ShopRegisterRequest;
use App\Http\Shop\Customers\Services\ShopRegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class ShopRegisterController
 * @package App\Http\Shop\Customers\Controllers
 */
class ShopRegisterController extends Controller
{
    protected $registerService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ShopRegisterService $registerService)
    {
        $this->middleware('guest');
        $this->registerService = $registerService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showRegisterForm()
    {
        $title = 'Register';
        return view('shop.auth.customer-register', compact('title'));
    }

    /**
     * @param ShopRegisterRequest $request
     * @return JsonResponse
     */
    public function register(ShopRegisterRequest $request)
    {
        return $this->registerService->startRegister($request);
    }

}
