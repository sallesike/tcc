<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
           'student_id'    =>  'unique_with:subscription,tb_event_id',
        ];
    }

     public function messages()
    {
        return 
        [
            'student_id.unique' => 'Esse evento já foi cadastrado, para esse estudante'
        ];
    }
}
