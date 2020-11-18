<?php


namespace Domain\Customers\Actions;


use App\Http\AdminPanel\Admins\Mails\AdminRegisteredMail;
use Domain\Customers\Models\Customer;
use Illuminate\Http\Request;

/**
 * Class CustomerBanAction
 * @package Domain\Customers\Actions
 */
class CustomerBanAction
{
    /**
     * @param Customer $customer
     * @param Request $request
     */
    public function execute(Customer $customer, Request $request)
    {
        $this->customerBan($customer, $request);

        $this->sendEmail($request);
    }

    /**
     * @param Customer $customer
     * @param Request $request
     * @return int
     */
    private function customerBan(Customer $customer, Request $request)
    {
        return $customer->update([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => \Hash::make($request->password),
//            'email_verified_at' => $request->email_verified_at,
            'ban' => $request->ban,
//            'remember_token' => $request->remember_token,
//            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);
    }

    /**
     * @param Request $request
     */
    private function sendEmail(Request $request)
    {
//        \Mail::to($request->email)->send(new AdminRegisteredMail($request->all()));
    }
}
