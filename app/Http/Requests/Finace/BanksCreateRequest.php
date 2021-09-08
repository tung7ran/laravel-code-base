<?php

namespace App\Http\Requests\Finace;

use App\Models\Finace\Banks;
use Illuminate\Foundation\Http\FormRequest;

class BanksCreateRequest extends FormRequest
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
            Banks::BANK_NAME => 'required',
            Banks::BANK_ACCOUNT => 'required',
            Banks::BANK_NUMBER => 'required',
            Banks::BANK_IMAGE => 'required',
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
