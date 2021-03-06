<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class ProfessionEditRequest extends FormRequest
{
    /**
     * @param array $errors
     * @return mixed
     */
    public function response(array $errors)
    {
        return Redirect::back()->withErrors($errors)->withInput();
    }

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
            'specialty_id' => 'required|integer',
            'education_id' => 'required|integer',
            'profession' => 'required|integer',
            'info' => 'string|max:1024|nullable',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'specialty_id.required' => __('messages.specialty_name') . __('validation.required'),
            'specialty_id.integer' => __('messages.specialty_name') . __('validation.integer'),
            'education_id.required' => __('messages.education__name') . __('validation.required'),
            'education_id.integer' => __('messages.education__name') . __('validation.integer'),
            'profession.required' => __('messages.profession') . __('validation.required'),
        ];
    }
}
