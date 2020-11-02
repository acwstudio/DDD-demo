<?php


namespace App\Http\AdminPanel\Admins\Controllers;


use App\Http\AdminPanel\Admins\Requests\AdminRegisterRequest;
use App\Http\AdminPanel\Admins\ViewModels\AdminRegisterViewModel;
use Domain\Admins\Actions\AdminRegisterAction;
use Domain\Admins\Models\Admin;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;

/**
 * Class AdminRegisterController
 * @package App\Http\AdminPanel\Admins\Controllers
 */
class AdminRegisterController extends Controller
{
    protected $registerAction;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AdminRegisterAction $registerAction)
    {
        $this->middleware('auth:admin');
        $this->middleware(['permission:admins.register']);
        $this->registerAction = $registerAction;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function showRegisterForm()
    {
        $viewModel = new AdminRegisterViewModel();

        return view('admin.pages.admins.register', compact('viewModel'));
    }

    /**
     * @param AdminRegisterRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function register(AdminRegisterRequest $request)
    {

        $this->registerAction->execute($request);

        return redirect()->route('admin.list');
    }

}
