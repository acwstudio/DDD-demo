<?php


namespace App\Http\AdminPanel\Admins\Controllers;

use Domain\Admins\Actions\AdminLogoutAction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class AdminLogoutController
 * @package App\Http\AdminPanel\Admins\Controllers
 */
class AdminLogoutController extends Controller
{
    protected AdminLogoutAction $logoutAction;

    /**
     * ShopLogoutController constructor.
     * @param AdminLogoutAction $logoutAction
     */
    public function __construct(AdminLogoutAction $logoutAction)
    {
        $this->logoutAction = $logoutAction;
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        return $this->logoutAction->execute($request);
    }
}
