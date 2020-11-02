<?php


namespace App\Http\AdminPanel\Admins\Controllers;


use App\Http\AdminPanel\Admins\ViewModels\AdminListViewModel;
use Domain\Admins\Actions\AdminResetPasswordAction;
use Domain\Admins\Models\Admin;
use Illuminate\Routing\Controller;

/**
 * Class AdminListController
 * @package App\Http\AdminPanel\Admins\Controllers
 */
class AdminListController extends Controller
{
    /**
     * AdminListController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function showList()
    {
        $admins = Admin::all();

        $viewModel = new AdminListViewModel($admins);

        return view('admin.pages.admins.list', compact('viewModel'));
    }
}
