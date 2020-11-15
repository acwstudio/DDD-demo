<?php


namespace App\Http\AdminPanel\Products\Controllers;


use App\Http\AdminPanel\Products\ViewModels\ProductListViewModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class ProductListController
 * @package App\Http\AdminPanel\Products\Controllers
 */
class ProductListController extends Controller
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
    public function showList(Request $request)
    {
        $viewModel = new ProductListViewModel();

        return view('admin.pages.products.list', compact('viewModel'));
    }
}
