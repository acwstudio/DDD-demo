<?php


namespace Support\AdminMenu;


use Illuminate\Database\Eloquent\Model;

/**
 * Class MenuAdministrator
 * @package Support\AdminMenu
 */
class MenuAdministrator extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_administrator_id', 'item', 'alias', 'icon', 'route', 'father'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(MenuAdministrator::class, 'menu_administrator_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(MenuAdministrator::class, 'menu_administrator_id', 'id');
    }

}
