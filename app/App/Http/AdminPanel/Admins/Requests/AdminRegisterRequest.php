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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->get('id');
        return [
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
