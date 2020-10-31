<?php


namespace App\Http\AdminPanel\Admins\Controllers;


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
     */
    public function showList()
    {
        $admins = Admin::all();
        $admin = Admin::find(\Auth::guard('admin')->user()->getAuthIdentifier());

        return view('admin.pages.list', [
            'admins' => $admins,
            'admin' => $admin,
        ]);
    }
}
