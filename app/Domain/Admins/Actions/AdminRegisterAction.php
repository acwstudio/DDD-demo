<?php


namespace Domain\Admins\Actions;

use App\Http\AdminPanel\Admins\Mails\AdminRegisteredMail;
use Domain\Admins\Models\Admin;
use Illuminate\Http\Request;

/**
 * Class AdminRegisterAction
 * @package Domain\Admins\Actions
 */
class AdminRegisterAction
{
    /**
     * Admin model.
     *
     * @var Admin
     */

    protected Admin $admin;

    /**
     * CustomerRegisterAction constructor.
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function execute(Request $request)
    {
        $this->admin = $this->create($request->all());

        $this->assigneRole($request);

        $this->sendEmail($request);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Admin
     */
    protected function create(array $data)
    {
        return $this->admin->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Hash::make($data['password']),
        ]);
    }

    /**
     * Assigne role to admin
     *
     * @param Admin $admin
     * @param Request $request
     */
    private function assigneRole($request)
    {
        $role = $request->role ? $request->role : 'probationer';
        $this->admin->assignRole($role);
    }

    /**
     * @param Request $request
     */
    private function sendEmail(Request $request)
    {
        \Mail::to($request->email)->send(new AdminRegisteredMail($request->all()));
    }

}
