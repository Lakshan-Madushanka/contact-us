<?php

namespace Lakm\Contact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class ContactFormRequest extends FormRequest
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
            'name' => ['required', 'between:3,50'],
            'email' => ['required', 'email'],
            'contact_number' => ['required_if:email,=,null', 'digits:10'],
            'description' => ['required', 'between:10,1000']
        ];
    }
}
