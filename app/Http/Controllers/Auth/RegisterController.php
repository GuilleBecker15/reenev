<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Traits\Utilidades;
use Carbon\Carbon;


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
    use Utilidades;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
            'name1' => 'required|string|max:255',
            'name2' => 'nullable|string|max:255',
            'apellido1' => 'required|string|max:255',
            'apellido2' => 'nullable|string|max:255',
            'nacimiento' => 'required|string|before:'.Carbon::now()->toDateString(), 
            'generacion' => 'required|integer',
            'ci' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], ['before' => 'El campo nacimiento no es una fecha valida']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        
        $nacimiento = $this->sqlDateFormat($data['nacimiento']);
        $name2 = '-';
        $apellido2 = '-';

    	if ($data['name2']!='') $name2=$data['name2'];
    	if ($data['apellido2']!='') $apellido2=$data['apellido2'];

        return User::create([
            'name1' => $data['name1'],
            'name2' => $name2,
            'apellido1' => $data['apellido1'],
            'apellido2' => $apellido2,
            'nacimiento' => $nacimiento,
            'generacion' => $data['generacion'],
            'ci' => $data['ci'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    
    }

}
