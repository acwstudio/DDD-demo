<?php


namespace App\Http\AdminPanel\Products\Requests;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductEditRequest
 * @package App\Http\AdminPanel\Products\Requests
 */
class ProductEditRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
//            'category_id' => ['required', 'numeric'],
            'vendor_code' => ['required', 'string'],
            'type' => ['required', 'string'],
            'admin_id' => ['required', 'numeric'],
            'barcode' => ['required', 'string'],
            'stock' => ['required', 'string'],
            'buy_price' => ['required', 'numeric'],
            'min_price' => ['required', 'numeric'],
            'sale_price' => ['required', 'numeric'],
            'archived' => ['required', 'boolean'],
            'published' => ['required', 'boolean'],
            'weight' => ['required', 'numeric'],
            'volume' => ['required', 'numeric'],
            'reserve' => ['required', 'numeric'],
            'in_transit' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
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
            'archived' => $this->has('archived'),
            'published' => $this->has('published'),
            'category_id' => $this->has('category_id') ? null : null,
        ]);
    }
}
