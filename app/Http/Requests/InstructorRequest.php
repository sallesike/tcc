<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstructorRequest extends FormRequest
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
            'name'      =>   'required|min:3|max:250',
            'signature' =>   'required|image',
        ];
    }

    public function messages()
    {
        return
        [
            'name.required'     => 'Informe o nome do instrutor',
            'name.min'          => 'Menos de que três caracteres',
            'signature.required' => 'Faça o upload da assinatura do instrutor',
            'signature.image'   => 'Formato invalido',
        ];
    }
}
