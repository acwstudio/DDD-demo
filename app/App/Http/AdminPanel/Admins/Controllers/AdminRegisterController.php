<?php


namespace App\Http\AdminPanel\Admins\Controllers;


use App\Http\AdminPanel\Admins\Requests\AdminRegisterRequest;
use Domain\Admins\Actions\AdminRegisterAction;
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
        $this->middleware(['role:super-admin,admin']);
        $this->registerAction = $registerAction;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showRegisterForm()
    {
        $viewModel = Role::all();
        return view('admin.pages.register', compact('viewModel'));
    }

    /**
     * @param AdminRegisterRequest $request
     */
    public function register(AdminRegisterRequest $request)
    {
        return $this->registerAction->execute($request);
    }

}
