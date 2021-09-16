<?php

namespace App\Http\Requests\Products;

use App\Models\Products\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Product::PRODUCT_NAME => 'required',
            Product::PRODUCT_IMAGE => 'required',
            Product::PRODUCT_PRICE => 'required',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'required' => trans('validation.required'),
            'max:191'  => trans('validation.max.string'),
        ];
    }

    public function attributes() {
        return Product::getFieldVietnamese();
    }
}
