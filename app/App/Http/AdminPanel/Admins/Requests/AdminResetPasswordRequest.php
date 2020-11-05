<?php


namespace App\Http\AdminPanel\Admins\Requests;


use Domain\Admins\Rules\AdminPasswordVerifyRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AdminResetPasswordRequest
 * @package App\Http\AdminPanel\Admins\Requests
 */
class AdminResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'oldPassword' => ['required', 'string', 'min:8', new AdminPasswordVerifyRule($this->id)],
        ];
    }
}
