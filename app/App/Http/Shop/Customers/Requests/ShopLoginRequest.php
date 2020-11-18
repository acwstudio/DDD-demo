<?php


namespace App\Http\Shop\Customers\Requests;


use Domain\Customers\Models\Customer;
use Illuminate\Auth\Access\AuthorizationException;
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
        $user = Customer::where('email', $this->get('email'))->first();

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

    protected function failedAuthorization()
    {
        throw new AuthorizationException('Sorry, you were banned.');
    }


}
