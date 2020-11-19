<?php


namespace App\Http\AdminPanel\Products\ViewModels;


use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;
use Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProductItemViewModel
 * @package App\Http\AdminPanel\Products\ViewModels
 */
class ProductItemViewModel extends AdminPanelViewModel
{
    public $productItem;
    public $canEdit;

    /**
     * AdminViewModel constructor.
     * @param int $id
     * @throws \Exception
     */
    public function __construct(int $id)
    {
        parent::__construct();

        $this->productItem = $this->productItem($id);

        $this->canEdit = $this->canEdit();

        $this->showProduct();
    }

    /**
     * @return Admin|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function productItem(int $id)
    {
        return Product::find($id);
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
     * @param Collection $menu
     */
    private function showProduct()
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

            if ($item->alias === 'show_product'){
                $item->active = 'active';
                $item->badgeText = 'ID: ' . $this->productItem->id;
                $item->badgeColor = 'badge-success';
            }
            return $item;
        });
    }
}
