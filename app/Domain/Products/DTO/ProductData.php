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

    public float $buy_price;

    public float $min_price;

    public float $sale_price;

    public bool $archived;

    public bool $published;

    public float $weight;

    public float $volume;

    public int $reserve;

    public int $in_transit;

    public int $quantity;

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
            'buy_price' => (float)$request->get('buy_price'),
            'min_price' => (float)$request->get('min_price'),
            'sale_price' => (float)$request->get('sale_price'),
            'archived' => $request->get('archived'),
            'published' => $request->get('published'),
            'weight' => (float)$request->get('weight'),
            'volume' => (float)$request->get('volume'),
            'reserve' => (int)$request->get('reserve'),
            'in_transit' => (int)$request->get('in_transit'),
            'quantity' => (int)$request->get('quantity'),
        ]);
    }
}
