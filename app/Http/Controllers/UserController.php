<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\Utilidades;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{

    use Utilidades;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {

        if (Auth::user()->id==$id||Auth::user()->esAdmin) {
        
            return view('user.show', ['user' => User::findOrFail($id)]);
        
        } else {

            return view('welcome');
        }

    }

    public function edit($id)
    {
        
        if (Auth::user()->id==$id) {
            
            $user = User::findOrFail($id);
            return view('user.edit', compact('user'));
        
        } 

        return view('welcome');
                
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Debugbar::error('Error!');
        if (Auth::user()->id==$id) {

            $user = User::findOrFail($id);
                Log::debug();

            // if($user->password == bcrypt($request->get('confirmarPass'))){
            if(Hash::check($request->get('confirmarPass'), $user->password)){
                $nacimiento = $this->sqlDateFormat($request->get('nacimiento'));

                $user->name1=$request->get('name1');
                $user->name2=$request->get('name2');
                $user->apellido1=$request->get('apellido1');
                $user->apellido2=$request->get('apellido2');
                $user->nacimiento= $nacimiento;
                $user->generacion=$request->get('generacion');
                $user->ci=$request->get('ci');
                $user->email=$request->get('email');

                $user->save();

                //return $this->edit($user->id);
                $request->session()->flash('message', 'Perfil moificado con exito');
                $request->session()->flash('message-type', 'success');

                return response()->json(['status'=>'Hooray']);
            }
            // return response()->json(['message' => 'Password fail']);
            $request->session()->flash('error', 'La contrasenia no coincide');
            $request->session()->flash('error-type', 'danger');
            return response()->json(['status'=>'442']);
        }

        return view('welcome');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user=User::findOrFail($id);
        $user->delete();

        return $this->index();

    }

    public function redirectCambiarPass($user){
        $users = User::findOrFail($user);
        return view('user.cambiarPass', ['user' => $users]);
    }

    public function updatePass(Request $request, $id){
        $usuario = User::findOrFail($id);
        // $validator = parent::getValidatorInstance();
        // return view('user.cambiarPass', ['user'=>$usuario])->withErrors('La contraseña introducida es incorrecta');
        // return view('user.cambiarPass', ['user'=>$usuario, 'errores' => 'maloso']);
        if(Auth::user()->id == $id){
            $message = [
                'same' => 'Las contraseñas deben coincidir.'
            ];
            $validator=Validator::make($request->all(),[
                'pass' => 'required|min:6',
                'pass1' => 'required|min:6',
                'pass2' => 'required|min:6|same:pass1'
            ], $message);
            if($validator->fails())
               return view('user.cambiarPass', ['user'=>$usuario])->withErrors($validator, 'pass1');
            // if(bcrypt($request->get('pass'))==$usuario->password){
            if(Hash::check($request->get('pass'), $usuario->password)){
                $usuario->password=bcrypt($request->pass1);
                $usuario->save();
                return view('user.cambiarPass', ['user'=>$usuario ])->with('algo','BIeN');
            }
            return view('user.cambiarPass', ['user'=>$usuario])->with('algo','TodoMAL');
            
        }

        return view('welcome');
    }
}
