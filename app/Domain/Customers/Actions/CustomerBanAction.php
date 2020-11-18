<?php


namespace Domain\Customers\Actions;


use App\Http\AdminPanel\Admins\Mails\AdminRegisteredMail;
use App\Http\AdminPanel\Customers\Mails\CustomerBanMail;
use Domain\Customers\Models\Customer;
use Illuminate\Http\Request;

/**
 * Class CustomerBanAction
 * @package Domain\Customers\Actions
 */
class CustomerBanAction
{
    /**
     * @param int $id
     * @param Request $request
     */
    public function execute(int $id, Request $request)
    {
        $this->customerBan($id, $request);
    }

    /**
     * @param Customer $customer
     * @param Request $request
     * @return int
     */
    private function customerBan(int $id, Request $request)
    {
        $customer = Customer::find($id);

        $customer->update([
            'ban' => $request->ban,
            'updated_at' => $request->updated_at,
        ]);

        $emailDetails = [
            'name' => $customer->name,
            'email' => $customer->email,
            'ban' => $customer->ban,
        ];

        $this->sendEmail($emailDetails);
    }

    /**
     * @param array $emailDetails
     */
    private function sendEmail(array $emailDetails)
    {
        \Mail::to($emailDetails['email'])->send(new CustomerBanMail($emailDetails));
    }
}
