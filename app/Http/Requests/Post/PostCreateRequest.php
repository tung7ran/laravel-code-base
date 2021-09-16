<?php

namespace App\Http\Requests\Post;

use App\Models\Post\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
            Post::POST_NAME => 'required',
            Post::POST_IMAGE => 'required',
            Post::POST_TYPE => 'required',
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
        return Post::getFieldVietnamese();
    }
}
