<?php


namespace App\Http\Shop\Customers\Controllers;

use App\Http\Shop\Customers\Requests\ShopRegisterRequest;
use App\Http\Shop\Customers\ViewModels\CustomerViewModel;
use Domain\Customers\Actions\CustomerRegisterAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class ShopRegisterController
 * @package App\Http\Shop\Customers\Controllers
 */
class ShopRegisterController extends Controller
{
    protected $registerAction;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CustomerRegisterAction $registerAction)
    {
        $this->middleware('guest:customer');
        $this->registerAction = $registerAction;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showRegisterForm()
    {
        $viewModel = new CustomerViewModel('Register');
//        $title = 'Register';
        return view('shop.auth.customer-register', compact('viewModel'));
    }

    /**
     * @param ShopRegisterRequest $request
     * @return JsonResponse
     */
    public function register(ShopRegisterRequest $request)
    {
        return $this->registerAction->execute($request);
    }

}
