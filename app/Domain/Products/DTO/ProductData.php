<?php


namespace Domain\Products\DTO;


use Domain\Admins\Models\Admin;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * Class ProductData
 * @package Domain\Products\DTO
 */
class ProductData extends DataTransferObject
{
    public string $name;

    public string $description;

    public ?Category $category;

    public string $vendor_code;

    public string $type;

    public Admin $admin;

    public string $barcode;

    public string $stock;

    public string $buyPrice;

    public string $min_price;

    public string $sale_price;

    public bool $archived;

    public bool $published;

    public string $weight;

    public string $volume;

    public string $reserve;

    public string $in_transit;

    public string $quantity;

    /**
     * @param Request $request
     * @return ProductData
     */
    public static function fromRequest(Request $request): self
    {
        return new self([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'category' => $request->get('category_id'),
            'vendor_code' => $request->get('vendor_code'),
            'type' => $request->get('type'),
            'admin' => Admin::find($request->get('admin_id')),
            'barcode' => $request->get('barcode'),
            'stock' => $request->get('stock'),
            'buyPrice' => $request->get('buy_price'),
            'min_price' => $request->get('min_price'),
            'sale_price' => $request->get('sale_price'),
            'archived' => $request->get('archived'),
            'published' => $request->get('published'),
            'weight' => $request->get('weight'),
            'volume' => $request->get('volume'),
            'reserve' => $request->get('reserve'),
            'in_transit' => $request->get('in_transit'),
            'quantity' => $request->get('quantity'),
        ]);
    }

}
