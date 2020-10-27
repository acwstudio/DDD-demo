<?php


namespace App\Http\AdminPanel;


use Domain\Admins\Models\Admin;
use Illuminate\Routing\Controller;

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
        return view('admin.pages.home');
    }
}
