<?php


namespace App\Http\AdminPanel\Admins\Controllers;


use App\Http\AdminPanel\Admins\Requests\AdminBanRequest;
use App\Http\AdminPanel\Admins\ViewModels\AdminBanViewModel;
use Domain\Admins\Actions\AdminBanAction;
use Domain\Admins\Models\Admin;
use Illuminate\Routing\Controller;

/**
 * Class AdminBanController
 * @package App\Http\AdminPanel\Admins\Controllers
 */
class AdminBanController extends Controller
{
    public $banAction;

    /**
     * AdminBanController constructor.
     * @param AdminBanAction $banAction
     */
    public function __construct(AdminBanAction $banAction)
    {
        $this->middleware('auth:admin');
        $this->middleware(['permission:admins.reset']);

        $this->banAction = $banAction;
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function showBanForm(int $id)
    {
        $viewModel = new AdminBanViewModel($id);

        return view('admin.pages.admins.ban', compact('viewModel'));
    }

    /**
     * @param AdminBanRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ban(AdminBanRequest $request, int $id)
    {
        $this->banAction->execute($id, $request);

        return redirect()->route('admin.list');
    }
}
