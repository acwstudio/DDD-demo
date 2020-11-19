<?php


namespace App\Http\AdminPanel\Products\ViewModels;


use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;
use Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProductListViewModel
 * @package App\Http\AdminPanel\Products\ViewModels
 */
class ProductListViewModel extends AdminPanelViewModel
{
    public $products;
    public $canEdit;
    public $canShowItem;

    /**
     * AdminViewModel constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();

        $this->listItems();

        $this->canEdit = $this->canEdit();
        $this->canShowItem = $this->canShowItem();

        $this->products = $this->products();
    }

    /**
     * @return Collection
     */
    public function products()
    {
        return Product::all();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    private function canEdit()
    {
        return $this->admin->hasAnyPermission('products.edit');
    }

    /**
     * @return bool
     * @throws \Exception
     */
    private function canShowItem()
    {
        return $this->admin->hasAnyPermission('products.show');
    }

    /**
     * @param Collection $menu
     */
    private function listItems()
    {
        foreach ($this->asideMenu as $item) {
            /** @var Collection $item */
            if ($item->alias === 'products'){

                $item->active = 'active';
                $item->open = 'menu-open';

                $this->recurse($item->children);

            }
        }
    }

    /**
     * @param $items
     */
    private function recurse(Collection $items)
    {
        $items->map(function ($item, $key){

            /*********************************
            the block for middle level only
             *********************************/
//                if ($item->alias === 'any alias'){
//                    $item->open = 'menu-open';
//                    $item->active = 'active';
//                    $this->recurse($item->children);
//                }
            /********************************/

            if ($item->alias === 'list_products'){
                $item->active = 'active';
            }

            return $item;
        });
    }

}
