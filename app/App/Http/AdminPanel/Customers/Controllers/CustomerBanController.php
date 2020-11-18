<?php


namespace App\Http\AdminPanel\Customers\Controllers;


use App\Http\AdminPanel\Customers\Requests\CustomerBanRequest;
use App\Http\AdminPanel\Customers\ViewModels\CustomerBanViewModel;
use Domain\Customers\Actions\CustomerBanAction;
use Domain\Customers\Models\Customer;
use Illuminate\Routing\Controller;

/**
 * Class CustomerBanController
 * @package App\Http\AdminPanel\Customers\Controllers
 */
class CustomerBanController extends Controller
{
    public $banAction;

    /**
     * CustomerBanController constructor.
     * @param CustomerBanAction $banAction
     */
    public function __construct(CustomerBanAction $banAction)
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
        $viewModel = new CustomerBanViewModel($id);

        return view('admin.pages.customers.ban', compact('viewModel'));
    }

    /**
     * @param CustomerBanRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ban(CustomerBanRequest $request, int $id)
    {
        $this->banAction->execute($id, $request);

        return redirect()->route('customer.list');
    }
}
