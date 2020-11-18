<?php


namespace Domain\Admins\Actions;


use App\Http\AdminPanel\Admins\Mails\AdminBanMail;
use App\Http\AdminPanel\Admins\Mails\AdminRegisteredMail;
use Domain\Admins\Models\Admin;
use Illuminate\Http\Request;

/**
 * Class AdminBanAction
 * @package Domain\Admins\Actions
 */
class AdminBanAction
{
    /**
     * @param int $id
     * @param Request $request
     */
    public function execute(int $id, Request $request)
    {
        $this->adminBan($id, $request);

    }

    /**
     * @param Admin $admin
     * @param Request $request
     * @return int
     */
    private function adminBan(int $id, Request $request)
    {
        $admin = Admin::find($id);

        $admin->update([
            'ban' => $request->ban,
            'updated_at' => $request->updated_at,
        ]);

        $emailDetails = [
            'name' => $admin->name,
            'email' => $admin->email,
            'ban' => $admin->ban,
        ];

        $this->sendEmail($emailDetails);
    }

    /**
     * @param array $emailDetails
     */
    private function sendEmail(array $emailDetails)
    {
        \Mail::to($emailDetails['email'])->send(new AdminBanMail($emailDetails));
    }
}
