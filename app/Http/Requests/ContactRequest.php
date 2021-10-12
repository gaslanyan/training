<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class ContactRequest extends FormRequest
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
            'email' => 'required|email',
            'name' => 'required|min:3|max:64',
            'subject' => 'required|min:3|max:64',
            'message' => 'string|min:3|max:1024',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {

        $email = __('messages.email');
        $message = __('messages.message');
        return [

            'email.required' => $email . __('validation.required'),
            'subject.required' => __('messages.subject') . __('validation.required'),
            'name.required' => __('messages.name') . __('validation.required'),
            'email.email' => $email . __('validation.email'),
            'message.required' => $message . __('validation.required'),
            'message.max' => __('messages.message') . __('validation.max.string'),
            'name.max' => __('messages.name') . __('validation.max.string'),
            'subject.max' => __('messages.subject') . __('validation.max.string'),
            'message.min' => __('messages.message') . __('validation.min.string'),
            'name.min' => __('messages.name') . __('validation.min.string'),
            'subject.min' => __('messages.subject') . __('validation.min.string'),
        ];
    }
}
