<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Gate;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    protected $redirectTo = '/inscricao_evento';
    public $gate;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cpf'           => ['required','cpf', 'unique:users'],            
            'birthday'      => 'required|date_format:"d/m/Y"',   
        ],
        [
            'name.required'         =>  'É necessario informar seu nome.',
            'name.min'              =>  'O nome deve conter ao menos três letras.',
            'cpf.required'          =>  'Informe seu cpf.',
            'cpf.cpf'               =>  'Informe um cpf Valido.',
            'cpf.unique'            =>  'Esse cpf já esta cadastrado.',
            'birthday.required'     =>  'Informe sua data de nascimento.',
            'birthday.date_format'  =>  'Formato de data incorreta.',
        ]);
    }

    public function messages()
    {
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {        
        if(!Gate::allows('eAdmin'))
        {
            $data['status'] = "Comum";
        }
        if(empty($data['status']))
        {
            $data['status'] = "Comum";
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status'   => $data['status'],
            'cpf'      => $data['cpf'],
            'birthday' => $data['birthday'],
        ]);
    }
}
