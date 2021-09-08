<?php

namespace App\Http\Requests\Post;

use App\Models\Post\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            Category::CATE_NAME => 'required',
            Category::CATE_SLUG => 'required',
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
        return Category::getFieldVietnamese();
    }
}
