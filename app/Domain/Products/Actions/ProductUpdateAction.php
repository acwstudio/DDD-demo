<?php


namespace Domain\Products\Actions;


use Domain\Products\DTO\ProductData;
use Domain\Products\Models\Product;

/**
 * Class ProductUpdateAction
 * @package Domain\Products\Actions
 */
class ProductUpdateAction
{
    /**
     * @param Product $product
     * @param ProductData $productData
     */
    public function execute(Product $product, ProductData $productData)
    {
        $this->productUpdate($product, $productData);
    }

    /**
     * @param Product $product
     * @param ProductData $request
     * @return bool
     */
    private function productUpdate(Product $product, ProductData $productData)
    {
        return $product->update([
            'name' => $productData->name,
            'description' => $productData->description,
            'category' => $productData->category,
            'vendor_code' => $productData->vendor_code,
            'type' => $productData->type,
            'admin' => $productData->admin->id,
            'barcode' => $productData->barcode,
            'stock' => $productData->stock,
            'buy_price' => $productData->buy_price,
            'min_price' => $productData->min_price,
            'sale_price' => $productData->sale_price,
            'archived' => $productData->archived,
            'published' => $productData->published,
            'weight' => $productData->weight,
            'volume' => $productData->volume,
            'reserve' => $productData->reserve,
            'in_transit' => $productData->in_transit,
            'quantity' => $productData->quantity,
        ]);
    }
}
