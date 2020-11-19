<?php


namespace App\Http\AdminPanel\Admins\ViewModels;

use App\Http\AdminPanel\AdminPanelViewModel;
use Domain\Admins\Models\Admin;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AdminListViewModel
 * @package App\Http\AdminPanel\Admins\ViewModels
 */
class AdminListViewModel extends AdminPanelViewModel
{
    public $admins;
    public $canResetPassword;
    public $canBan;

    /**
     * AdminViewModel constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();

        $this->canResetPassword = $this->canResetPassword();
        $this->canBan = $this->canBan();

        $this->admins = $this->admins();
        $this->listItems();
    }

    /**
     * @return Collection
     */
    public function admins()
    {
        return Admin::all();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    private function canResetPassword()
    {
        return $this->admin->hasAnyPermission('admins.reset');
    }

    /**
     * @return bool
     * @throws \Exception
     */
    private function canBan()
    {
        return $this->admin->hasAnyPermission('admins.ban');
    }


    private function listItems()
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

            if ($item->alias === 'list_admins'){
                $item->active = 'active';
            }

            return $item;
        });
    }

}
