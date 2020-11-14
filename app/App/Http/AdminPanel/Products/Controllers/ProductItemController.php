<?php


namespace App\Http\AdminPanel\Products\Controllers;


use App\Http\AdminPanel\Products\ViewModels\ProductItemViewModel;
use Illuminate\Routing\Controller;

/**
 * Class ProductItemController
 * @package App\Http\AdminPanel\Products\Controllers
 */
class ProductItemController extends Controller
{
    /**
     * AdminListController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function showItem($id)
    {
        $viewModel = new ProductItemViewModel($id);
//        dd($viewModel);
        return view('admin.pages.products.item', compact('viewModel'));
    }
}
