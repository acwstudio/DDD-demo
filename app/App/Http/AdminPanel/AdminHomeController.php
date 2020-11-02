<?php


namespace App\Http\AdminPanel;


use App\Http\AdminPanel\Admins\ViewModels\AdminViewModel;
use Domain\Admins\Models\Admin;
use Illuminate\Routing\Controller;
use Route;

/**
 * Class AdminHomeController
 * @package App\Http\AdminPanel
 */
class AdminHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showHomePage()
    {
        /** @var Admin $admin */
        $admin = \Auth::guard('admin')->user();
        $routeName = Route::getCurrentRoute()->getName();
        $activeGroup = 'dashboard';

        $viewModel = new AdminViewModel($admin, $routeName, $activeGroup);

        return view('admin.pages.home', compact('viewModel'));
    }
}
