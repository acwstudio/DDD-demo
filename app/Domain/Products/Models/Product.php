<?php


namespace Domain\Products\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package Domain\Products\Models
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'category_id', 'vendor_code', 'type', 'admin_id', 'barcode', 'stock',
        'min_price', 'sale_price', 'buy_price', 'archived', 'published', 'weight', 'volume', 'reserve',
        'in_transit', 'quantity'
    ];
}
