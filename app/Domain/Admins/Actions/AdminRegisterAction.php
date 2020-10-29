<?php


namespace Domain\Admins\Actions;


use App\Providers\RouteServiceProvider;
use Domain\Admins\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AdminRegisterAction
 * @package Domain\Admins\Actions
 */
class AdminRegisterAction
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME_ADMIN;


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
     * @return JsonResponse
     */
    public function execute(Request $request)
    {
        $admin = $this->create($request->all());

        $this->guard()->login($admin);
        $this->assigneRole($admin, $admin->id, $request);

        if ($response = $this->registered($request, $admin)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
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
     * @param int $id
     * @param Request $request
     */
    private function assigneRole(Admin $admin, int $id, $request)
    {
        $role = $request->role ? $request->role : 'probationer';
        $admin->find($id)->assignRole($role);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return \Auth::guard('admin');
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

}
