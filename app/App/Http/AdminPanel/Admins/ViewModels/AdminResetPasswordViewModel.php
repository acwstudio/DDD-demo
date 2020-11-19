<?php


namespace App\Http\AdminPanel\Admins\ViewModels;


use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AdminResetPasswordViewModel
 * @package App\Http\AdminPanel\Admins\ViewModels
 */
class AdminResetPasswordViewModel extends AdminPanelViewModel
{
    public $adminItem;

    /**
     * ShopViewModel constructor.
     * @param int $id
     * @throws \Exception
     */
    public function __construct(int $id)
    {
        parent::__construct();

        $this->adminItem = $this->adminItem($id);

        $this->resetPasswordItems();

    }

    /**
     * @return Admin|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function adminItem(int $id)
    {
        return Admin::find($id);
    }

    /**
     * @param Collection $menu
     */
    private function resetPasswordItems()
    {
        foreach ($this->asideMenu as $item) {
            /** @var Collection $item */
            if ($item->alias === 'admins'){

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

            if ($item->alias === 'reset_password'){
                $item->active = 'active';
                $item->badgeText = 'ID: ' . $this->adminItem->id;
                $item->badgeColor = 'badge-success';
            }
            return $item;
        });
    }
}
