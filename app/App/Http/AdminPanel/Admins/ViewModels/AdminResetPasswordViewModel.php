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
    private $admin_id;

    /**
     * ShopViewModel constructor.
     * @param int $id
     * @throws \Exception
     */
    public function __construct(int $id)
    {
        /** @var Admin $admin */
        $admin = \Auth::guard('admin')->user();

        $this->adminItem = Admin::find($id);
        $this->admin_id = $id;

        parent::__construct($admin);

        $menu = $this->asideMenu;
        $this->resetPasswordItems($menu);

    }

    /**
     * @return Admin|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function adminItem()
    {
        return $this->adminItem;
    }

    /**
     * @param Collection $menu
     */
    private function resetPasswordItems($menu)
    {
        foreach ($menu as $item) {
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
                $item->badgeText = 'ID: ' . $this->admin_id;
                $item->badgeColor = 'badge-success';
            }
            return $item;
        });
    }
}
