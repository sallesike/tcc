<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
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
            'name'  => 'required|min:3|max:100|unique:school'
        ];
    }

    public function messages()
    {
        return
        [
            'name.required' =>     'Campo nome é obrigatório!',
            'name.min'      =>     'Minimo de três caracteres',
            'name.unique'   =>     'Esta escola já esta cadastradas'
        ];
    }
}
