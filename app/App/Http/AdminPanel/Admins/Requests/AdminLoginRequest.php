<?php


namespace App\Http\AdminPanel\Admins\Requests;


use Domain\Admins\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AdminLoginRequest
 * @package App\Http\AdminPanel\Admins\Requests
 */
class AdminLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Admin::where('email', $this->get('email'))->first();

        if ($user) {
            return $user->ban === 0 ? true : false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
