<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest_ extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cpf'           => 'required|cpf',            
            'birthday'      => 'required|date_format:"d/m/Y"',   
            'event'         => 'required',
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
            'event.required'        =>  'Selecione um evento.'
        ];
    }
}
