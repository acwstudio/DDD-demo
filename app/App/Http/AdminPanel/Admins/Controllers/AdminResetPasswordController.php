<?php


namespace App\Http\AdminPanel\Admins\Controllers;


use App\Http\AdminPanel\Admins\Requests\AdminResetPasswordRequest;
use Domain\Admins\Actions\AdminResetPasswordAction;
use Domain\Admins\Models\Admin;
use Illuminate\Routing\Controller;

/**
 * Class AdminResetPasswordController
 * @package App\Http\AdminPanel\Admins\Controllers
 */
class AdminResetPasswordController extends Controller
{
    protected $resetPasswordAction;

    /**
     * ShopResetPasswordController constructor.
     * @param AdminResetPasswordAction $resetPasswordAction
     */
    public function __construct(AdminResetPasswordAction $resetPasswordAction)
    {
        $this->middleware('auth:admin');
        $this->middleware(['role:super-admin,admin']);
        $this->resetPasswordAction = $resetPasswordAction;
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(int $id)
    {
        $admin = Admin::find($id);

        return view('admin.pages.password-reset', compact('admin'));
    }

    /**
     * Reset the given user's password.
     *
     * @param AdminResetPasswordRequest $request
     * @param $id
     * @return void
     */
    public function reset(AdminResetPasswordRequest $request, $id)
    {
        $admin = Admin::find($id);

        $this->resetPasswordAction->execute($admin, $request);
    }
}
