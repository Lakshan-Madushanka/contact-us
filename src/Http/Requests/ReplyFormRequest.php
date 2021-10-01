<?php

namespace Lakm\Contact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class ReplyFormRequest extends FormRequest
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
        /*echo request()->subject;
        echo request()->message;
        dd();*/

        return [
            'subject' => [
                'required',
                'between:3,100',
            ],
            'message' => [
                'required',
                'between:10,1000',
                Rule::unique('replies')->where(function ($query){
                    return $query->where('subject', 'like', request()->subject);
                }),
            ],

        ];
    }

    public function messages()
    {
        return [
            'subject.unique' => 'This response has already been sent',
        ];
    }
}
