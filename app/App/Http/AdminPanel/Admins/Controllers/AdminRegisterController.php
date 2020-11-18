<?php


namespace App\Http\AdminPanel\Admins\Controllers;


use App\Http\AdminPanel\Admins\Requests\AdminRegisterRequest;
use App\Http\AdminPanel\Admins\ViewModels\AdminRegisterViewModel;
use Domain\Admins\Actions\AdminRegisterAction;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

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
     * @return Factory|View
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
     * @return Factory|View
     */
    public function register(AdminRegisterRequest $request)
    {

        $this->registerAction->execute($request);

        return redirect()->route('admin.list');
    }

}
