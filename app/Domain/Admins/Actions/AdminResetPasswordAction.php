<?php


namespace Domain\Admins\Actions;


use App\Http\AdminPanel\Admins\Mails\AdminRegisteredMail;
use Domain\Admins\Models\Admin;
use Illuminate\Http\Request;

/**
 * Class AdminResetPasswordAction
 * @package Domain\Admins\Actions
 */
class AdminResetPasswordAction
{
    /**
     * @param Admin $admin
     * @param Request $request
     */
    public function execute(Admin $admin, Request $request)
    {
        $adminId = $this->adminResetPassword($admin, $request);

        $this->sendEmail($request);

        $this->assigneRole($admin, $adminId, $request);
    }

    /**
     * @param Admin $admin
     * @param Request $request
     * @return int
     */
    private function adminResetPassword(Admin $admin, Request $request)
    {
        return $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            'email_verified_at' => $request->email_verified_at,
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

    /**
     * @param Admin $admin
     * @param int $id
     * @param Request $request
     */
    private function assigneRole(Admin $admin, int $id, Request $request)
    {
        $role = $request->role ? $request->role : 'probationer';
        $admin->find($id)->assignRole($role);
    }
}
