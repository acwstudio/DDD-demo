<?php


namespace App\Http\AdminPanel\Dashboard\Controllers;


use App\Http\AdminPanel\Dashboard\ViewModels\DashboardHomeViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

/**
 * Class DashboardHomeController
 * @package App\Http\AdminPanel\Dashboard\Controllers
 */
class DashboardHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @return Factory|View|RedirectResponse
     * @throws \Exception
     */
    public function showHomePage()
    {
        $viewModel = new DashboardHomeViewModel();
//        dd($viewModel->asideMenu);
        return view('admin.pages.home', compact('viewModel'));
    }
}
