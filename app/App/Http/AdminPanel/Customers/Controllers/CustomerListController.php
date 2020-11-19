<?php


namespace App\Http\AdminPanel\Customers\Controllers;


use App\Http\AdminPanel\Customers\ViewModels\CustomerListViewModel;
use Illuminate\Routing\Controller;

/**
 * Class CustomerListController
 * @package App\Http\AdminPanel\Customers\Controllers
 */
class CustomerListController extends Controller
{
    /**
     * AdminListController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function showList()
    {
        $viewModel = new CustomerListViewModel();

        return view('admin.pages.customers.list', compact('viewModel'));
    }
}
