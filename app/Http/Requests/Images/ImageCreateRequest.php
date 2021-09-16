<?php

namespace App\Http\Requests\Images;

use App\Models\Finace\Banks;
use App\Models\Images\Image;
use Illuminate\Foundation\Http\FormRequest;

class ImageCreateRequest extends FormRequest
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
            Image::IMAGE_NAME => 'required',
            Image::IMAGE_IMAGE => 'required'
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
        return Banks::getFieldVietnamese();
    }
}
