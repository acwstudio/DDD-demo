<?php


namespace Domain\Products\Models;


use Domain\Admins\Models\Admin;
use Domain\Products\Events\ProductCreateEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class Product
 * @package Domain\Products\Models
 */
class Product extends Model
{
    use HasFactory, Notifiable;

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

    protected $dispatchesEvents = [
        'saved' => ProductCreateEvent::class
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
