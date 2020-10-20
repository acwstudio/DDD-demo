<?php


namespace App\Http\Shop\Customers\Requests;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ShopLoginRequest
 * @package App\Http\Shop\Customers\Requests
 */
class ShopLoginRequest extends FormRequest
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
            'email' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
