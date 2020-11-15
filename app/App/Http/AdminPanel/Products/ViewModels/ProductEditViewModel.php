<?php


namespace App\Http\AdminPanel\Products\ViewModels;


use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;
use Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

/**
 * Class ProductEditViewModel
 * @package App\Http\AdminPanel\Products\ViewModels
 */
class ProductEditViewModel extends AdminPanelViewModel
{
    public $productItem;
    private $product_id;
    public $admins;

    /**
     * AdminViewModel constructor.
     * @param int $id
     * @throws \Exception
     */
    public function __construct(int $id)
    {
        /** @var Admin $admin */
        $admin = \Auth::guard('admin')->user();

        parent::__construct($admin);

        $this->productItem = Product::find($id);
        $this->product_id = $id;

        $menu = $this->asideMenu;
        $this->showProduct($menu);
        $this->admins = Admin::all();
    }

    /**
     * @return Collection
     */
    public function admins()
    {
        return $this->admins;
    }

    /**
     * @param Collection $menu
     */
    private function showProduct($menu)
    {
        foreach ($menu as $item) {
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

            if ($item->alias === 'edit_product'){
                $item->active = 'active';
                $item->badgeText = 'ID: ' . $this->product_id;
                $item->badgeColor = 'badge-success';
            }
            return $item;
        });
    }
}
