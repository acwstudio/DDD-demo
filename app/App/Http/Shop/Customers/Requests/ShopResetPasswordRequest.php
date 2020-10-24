<?php


namespace App\Http\Shop\Customers\Requests;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ShopResetPasswordRequest
 * @package App\Http\Shop\Customers\Requests
 */
class ShopResetPasswordRequest extends FormRequest
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
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ];
    }
}
