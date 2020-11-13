<?php


namespace Domain\Admins\Actions;


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
     * @param Admin $admin
     * @param Request $request
     */
    public function execute(Admin $admin, Request $request)
    {
        $adminId = $this->adminBan($admin, $request);

        $this->sendEmail($request);

    }

    /**
     * @param Admin $admin
     * @param Request $request
     * @return int
     */
    private function adminBan(Admin $admin, Request $request)
    {
        return $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'email_verified_at' => $request->email_verified_at,
            'ban' => $request->ban,
            'remember_token' => $request->remember_token,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);
    }

    /**
     * @param Request $request
     */
    private function sendEmail(Request $request)
    {
        \Mail::to($request->email)->send(new AdminRegisteredMail($request->all()));
    }
}
