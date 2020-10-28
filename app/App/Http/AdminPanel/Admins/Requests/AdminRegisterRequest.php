<?php


namespace App\Http\AdminPanel\Admins\Requests;


use Domain\Admins\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AdminRegisterRequest
 * @package App\Http\AdminPanel\Admins\Requests
 */
class AdminRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /** @var Admin $admin */
//        $admin = \Auth::user();
//        dd($admin->can('admins.register'));
//        return $admin->can('admins.register');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
