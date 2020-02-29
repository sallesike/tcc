<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'name'          => 'required|min:3|max:100',
            'date'          => 'required|date_format:"d/m/Y"',
            'address'       => 'required|min:3',
            'workload'      => 'required|numeric',
            'min_workload'  => 'required|numeric',
            'instructor_id' => 'required',
        ];
    }

    public function messages ()
    {
        return [
                'name.required'             =>  'É necesario identificar o evento com um nome.',
                'name.min'                  =>  'Digite ao menos 3 letras para o nome do evento.',
                'date.date_format'          =>  'Digite uma data valida.',
                'date.required'             =>  'Data invalida.',
                'address.required'          =>  'Digite o local aonde será realizado o evento.',
                'workload.required'         =>  'Informe a carga horária desse evento.',
                'min_workload.required'     =>  'Informe a carga horária minima para que o 
                 estudante tenha seu certificado emitido',
                'workload.numeric'          =>  'Informe um valor com apenas números',
                'min_work.numeric'          =>  'Informe um valor com apenas números',
                'instructor_id.required'    =>  'O instrutor é obrigatório',
                ];
    }
}
