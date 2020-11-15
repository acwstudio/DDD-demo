<?php

namespace App\Http\AdminPanel\Products\Controllers;

use App\Http\AdminPanel\Products\Requests\ProductEditRequest;
use App\Http\AdminPanel\Products\ViewModels\ProductEditViewModel;
use Domain\Products\DTO\ProductData;
use Illuminate\Routing\Controller;

/**
 * Class ProductEditController
 * @package App\Http\AdminPanel\Products\Controllers
 */
class ProductEditController extends Controller
{
    /**
     * ProductEditController constructor.
     * @param ProductEditRequest $editRequest
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(['permission:products.edit']);
    }

    /**
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function showEditForm(int $id)
    {
        $viewModel = new ProductEditViewModel($id);
//        $data = new ProductData([
//            'name' => 'Andrey',
//        ]);
//        dd($data);
        return view('admin.pages.products.edit', compact('viewModel'));
    }

    /**
     * @param ProductEditRequest $editRequest
     * @param $id
     */
    public function update(ProductEditRequest $editRequest, $id)
    {
        $data = ProductData::fromRequest($editRequest);
        dd($data);
    }
}
