<?php

namespace App\Http\AdminPanel\Products\Controllers;

use App\Http\AdminPanel\Products\Requests\ProductEditRequest;
use App\Http\AdminPanel\Products\ViewModels\ProductEditViewModel;
use Domain\Products\Actions\ProductUpdateAction;
use Domain\Products\DTO\ProductData;
use Domain\Products\Models\Product;
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

        return view('admin.pages.products.edit', compact('viewModel'));
    }

    /**
     * @param ProductEditRequest $editRequest
     * @param $id
     */
    public function update(ProductEditRequest $editRequest, $id, ProductUpdateAction $updateAction)
    {
        $data = ProductData::fromRequest($editRequest);
//        $data1 = ProductData::fromCommand();
//        dd($data);
        $product = Product::find($id);
        $updateAction->execute($product, $data);
//        dd($product);
        return redirect()->route('product.list');
    }
}
