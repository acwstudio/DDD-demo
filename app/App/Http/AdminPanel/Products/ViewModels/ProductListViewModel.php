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
    public $canArchived;
    public $canPublished;

    /**
     * AdminViewModel constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        /** @var Admin $admin */
        $admin = \Auth::guard('admin')->user();

        parent::__construct($admin);

        $menu = $this->asideMenu;
        $this->listItems($menu);

        $this->canArchived = $this->canArchived($admin);
        $this->canPublished = $this->canPublished($admin);

        $this->products = Product::all();
    }

    /**
     * @return Collection
     */
    public function products()
    {
        return $this->products;
    }

    /**
     * @param Admin $admin
     * @return bool
     * @throws \Exception
     */
    private function canArchived(Admin $admin)
    {
        return $admin->hasAnyPermission('products.archived');
    }

    /**
     * @param Admin $admin
     * @return bool
     * @throws \Exception
     */
    private function canPublished(Admin $admin)
    {
        return $admin->hasAnyPermission('products.published');
    }

    /**
     * @param Collection $menu
     */
    private function listItems($menu)
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

            if ($item->alias === 'list_products'){
                $item->active = 'active';
            }

            return $item;
        });
    }

}
