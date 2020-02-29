<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['sometimes','required', 'string', 'max:255'],
            'email' => ['sometimes','required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['sometimes','required', 'string', 'min:8', 'confirmed'],
            'cpf'           => 'required|cpf',            
            'birthday'      => 'sometimes|required|date_format:"d/m/Y"',   
        ];
    }

    public function messages()
    {
        return 
        [
            'name.required'         =>  'É necessario informar seu nome.',
            'name.min'              =>  'O nome deve conter ao menos três letras.',
            'cpf.required'          =>  'Informe seu cpf.',
            'cpf.cpf'               =>  'Informe um cpf Valido.',
            'birthday.required'     =>  'Informe sua data de nascimento.',
            'birthday.date_format'  =>  'Formato de data incorreta.',

        ];
    }
}
