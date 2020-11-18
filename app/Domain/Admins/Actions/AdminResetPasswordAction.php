<?php


namespace Domain\Admins\Actions;

use App\Http\AdminPanel\Admins\Mails\AdminRegisteredMail;
use App\Http\AdminPanel\Admins\Mails\AdminResetPasswordMail;
use Domain\Admins\Models\Admin;
use Illuminate\Http\Request;

/**
 * Class AdminResetPasswordAction
 * @package Domain\Admins\Actions
 */
class AdminResetPasswordAction
{
    /**
     * @param int $id
     * @param Request $request
     */
    public function execute(int $id, Request $request)
    {
        $this->adminResetPassword($id, $request);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return int
     */
    private function adminResetPassword(int $id, Request $request)
    {
        $admin = Admin::find($id);

        $admin->update([
            'password' => \Hash::make($request->password),
            'updated_at' => $request->updated_at,
        ]);

        $emailDetails = [
            'name' => $admin->name,
            'email' => $admin->email,
            'password' => $request->password,
        ];

        $this->sendEmail($emailDetails);
    }

    /**
     * @param array $emailDetails
     */
    private function sendEmail(array $emailDetails)
    {
        \Mail::to($emailDetails['email'])->send(new AdminResetPasswordMail($emailDetails));
    }
}
