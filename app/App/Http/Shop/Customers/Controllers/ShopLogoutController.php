<?php


namespace App\Http\Shop\Customers\Controllers;

use Domain\Customers\Actions\CustomerLogoutAction;
use Illuminate\Http\Request;

/**
 * Class ShopLogoutController
 * @package App\Http\Shop\Customers\Controllers
 */
class ShopLogoutController
{
    protected $logoutAction;

    /**
     * ShopLogoutController constructor.
     * @param CustomerLogoutAction $logoutAction
     */
    public function __construct(CustomerLogoutAction $logoutAction)
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
