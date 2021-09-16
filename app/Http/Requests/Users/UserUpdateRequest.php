<?php

namespace App\Http\Requests\Users;

use App\Models\Products\Product;
use App\Models\Users\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            User::USER_NAME   => 'required|unique:users,user_name|regex:/^[A-Za-z0-9_\.]{6,32}$/',
            User::NAME        => 'required',
            User::PHONE       => 'required|max:12|min:10|unique:users,phone',
            User::EMAIL       => 'required|email|unique:users,email',
            User::PASSWORD    => 'required|min:6',
            User::RE_PASSWORD => 'required|same:password'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'required'       => trans('validation.required'),
            'max:191'        => trans('validation.max.string'),
            'confirmed'      => trans('validation.confirmed'),
            'date_format'    => trans('validation.date_format'),
            'regex'          => trans('validation.regex'),
            'digits_between' => trans('validation.digits_between'),
        ];
    }

    public function attributes() {
        return Product::getFieldVietnamese();
    }
}
