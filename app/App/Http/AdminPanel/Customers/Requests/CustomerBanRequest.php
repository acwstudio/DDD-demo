<?php


namespace App\Http\AdminPanel\Customers\Requests;


use Domain\Customers\Rules\CustomerPasswordVerifyRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CustomerBanRequest
 * @package App\Http\AdminPanel\Customers\Requests
 */
class CustomerBanRequest extends FormRequest
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
            'password' => ['required', 'string', 'min:8', new CustomerPasswordVerifyRule($this->id)],
            'ban' => ['boolean'],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'ban' => $this->has('ban')
        ]);
    }
}
