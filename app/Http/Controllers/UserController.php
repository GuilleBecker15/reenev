<?php

namespace App\Http\Controllers;

use App\Http\Traits\Utilidades;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Log;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\Rule;
use Session;


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
        return $this->borrados(false);
    }

    public function borrados($si_o_no) 
    {

        $this->authorize('es_admin', User::class);
    
        $route = Route::getFacadeRoot()->current()->uri().'/buscar'; //No esta en buscar
        
        $users = User::where('estaBorrado',$si_o_no)->get();
        
        $title = "ID, Nombres, Apellidos, Fecha de nacimiento, Generacion, C.I. o eMail"; //Para el tooltrip

        $c = "";

        return view(
            'admin.users',
            ['users' => $users, 'route' => $route, 'title' => $title, 'c' => $c]);

    }

    public function buscar(Request $request)
    {

        $this->authorize('es_admin', User::class);
        
        $route = Route::getFacadeRoot()->current()->uri(); //Ya esta en buscar
        
        $users1 = User::where('id', 'like','%'.$request->get('q').'%')->get();
        $users2 = User::where('name1', 'like','%'.$request->get('q').'%')->get();
        $users3 = User::where('name2', 'like','%'.$request->get('q').'%')->get();
        $users4 = User::where('apellido1', 'like','%'.$request->get('q').'%')->get();
        $users5 = User::where('apellido2', 'like','%'.$request->get('q').'%')->get();
        $users6 = User::where('nacimiento', 'like','%'.$request->get('q').'%')->get();
        $users7 = User::where('generacion', 'like','%'.$request->get('q').'%')->get();
        $users8 = User::where('ci', 'like','%'.$request->get('q').'%')->get();
        $users9 = User::where('email', 'like','%'.$request->get('q').'%')->get();

        $users =
        $users9->merge(
            $users8->merge(
                $users7->merge(
                    $users6->merge(
                        $users5->merge(
                            $users4->merge(
                                $users3->merge(
                                    $users2->merge(
                                        $users1))))))));

        $title = "ID, Nombres, Apellidos, Fecha de nacimiento, Generacion, C.I. o eMail"; //Para el tooltrip

        $c = $request->consulta;

        return view(
            'admin.users',
            ['users' => $users, 'route' => $route, 'title' => $title, 'c' => $c]);
    
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('es_admin_o_es_el', $user);
        return view('user.show', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('es_admin_o_es_el', $user);
        //Session::set('algo','mi_nombre');
        session(['habilitar' => 'no']);
        if( session('datos') == null || session('actualizado') == 'ok'){
            $datos = User::newModelInstance();
            $datos->name1 = $user->name1;
            $datos->name2 = $user->name1;
            $datos->apellido1 = $user->apellido1;
            $datos->apellido2 = $user->apellido2;
            $nacimiento = $this->uyDateFormat($user->nacimiento);
            $datos->nacimiento = $nacimiento;
            $datos->generacion = $user->generacion;
            $datos->ci = $user->ci;
            $datos->email = $user->email;
            session(['datos' => $datos]);
            return view('user.edit', compact('user'));
         }
        return view('user.edit', compact('user'));        
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
        
        $user = User::findOrFail($id);
            
        $this->authorize('es_admin_o_es_el', $user);

        $message = [
                'same' => 'Las contraseñas deben coincidir.'
            ];
            $validator=Validator::make($request->all(),[
                'name1' => 'required|string|max:255',
                'name2' => 'required|string|max:255',
                'apellido1' => 'required|string|max:255',
                'apellido2' => 'required|string|max:255',
                'nacimiento' => 'required|string', 
                'generacion' => 'required|integer',
                'ci' => Rule::unique('users')->ignore($user->id ),
                'email' => Rule::unique('users')->ignore($user->id),
                ], $message);

            if($validator->fails())
               return view('user.edit', ['user'=>$user])->withErrors($validator, 'name1');

            if(Hash::check($request->get('pass'), $user->password)){
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
                
                $request->session()->flash('message', 'Usuario actualizado con exito!');
                session(['actualizado' => 'ok']);

                return $this->edit($user->id);

            }
            else{
                // $request->session()->flash('message', 'La contraseña actual es incorrecta');
                $datos = User::newModelInstance();
                $datos->name1 = $request->get('name1');
                $datos->name2 = $request->get('name2');
                $datos->apellido1 = $request->get('apellido1');
                $datos->apellido2 = $request->get('apellido2');
                $datos->nacimiento = $request->get('nacimiento');
                $datos->generacion = $request->get('generacion');
                $datos->ci = $request->get('ci');
                $datos->email = $request->get('email');
                session(['habilitar' => 'si', 'datos' => $datos]);
                $validator->errors()->add('pass', 'La contraseña actual es incorrecta');
                return view('user.edit', ['user'=>$user])->withErrors($validator,'pass');
            }

        

        return $this->edit($user->id);
// =======
//         if (Auth::user()->id==$id) {

//             $user = User::findOrFail($id);

//             // if($user->password == bcrypt($request->get('confirmarPass'))){
//             if(Hash::check($request->get('confirmarPass'), $user->password)){

//                 $nacimiento = $this->sqlDateFormat($request->get('nacimiento'));

//                 $user->name1=$request->get('name1');
//                 $user->name2=$request->get('name2');
//                 $user->apellido1=$request->get('apellido1');
//                 $user->apellido2=$request->get('apellido2');
//                 $user->nacimiento= $nacimiento;
//                 $user->generacion=$request->get('generacion');
//                 $user->ci=$request->get('ci');
//                 $user->email=$request->get('email');

//                 $user->save();

//                 //return $this->edit($user->id);
//                 $request->session()->flash('message', 'Perfil modificado con exito');
//                 return redirect()->back();
//             }
                        
//             return redirect()->back()->withErrors('error', 'la contraseña introducida no coincide');
//         }
// >>>>>>> master

    }

    public function hacerAdmin($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('es_admin_y_no_es_el', $user);
        $this->authorize('es_supervisor', $user);
        $user->supervisor=Auth::user()->id;
        $user->esAdmin=!$user->esAdmin;
        $user->save();
        return $this->show($user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->authorize('es_admin', User::class);
        $user = User::findOrFail($id);
        $this->authorize('es_admin_y_no_es_el', $user);
        $this->authorize('es_supervisor', $user);
        $user->supervisor=Auth::user()->id;
        $user->estaBorrado=!$user->estaBorrado;
        $user->save();
        return $this->show($user->id);
    }

    public function redirectCambiarPass($user){
        $users = User::findOrFail($user);
        return view('user.cambiarPass', ['user' => $users]);
    }

    public function updatePass(Request $request, $id){
        $usuario = User::findOrFail($id);
        $password = $request->get('pass');
        if(Auth::user()->id == $id){
            $message = [
                'same' => 'Las contraseñas deben coincidir.'
            ];
            $validator=Validator::make($request->all(),[
                'pass' => 'required|min:6',
                'pass1' => 'required|min:6',
                'pass2' => 'required|min:6|same:pass1'
            ], $message);

            /*$validator->after(function ($validator) {
                if (  ) {
                    $validator->errors()->add('incorrecta', 'Algo esta mal con el campo');
                }
            });*/
            if($validator->fails())
               return view('user.cambiarPass', ['user'=>$usuario])->withErrors($validator, 'pass1');



            if(Hash::check($request->get('pass'), $usuario->password)){
                $usuario->password=bcrypt($request->pass1);
                $usuario->save();
                $request->session()->flash('message', 'Contraseña actualizada con exito!');
                // return view('user.cambiarPass', ['user'=>$usuario ]);
                return $this->edit($usuario->id);
            }
            else{
                $validator->errors()->add('pass', 'La contraseña actual es incorrecta');
                // return view('user.cambiarPass', ['user'=>$usuario])->withErrors($validator,'pass');
                return view('user.cambiarPass', ['user'=>$usuario])->withErrors($validator,'pass');
            }
            
        }

        return view('welcome');
    }

    public function updateByAjax(Request $request, $id){
        if($request->ajax()){
            $user = User::findOrFail($id);
            if(Hash::check($request->get('confirmarPass'),$user->password)){
                $nacimiento = $this->sqlDateFormat($request->get('nacimiento'));
                $user->name1=$request->get('name1');
                $user->name2=$request->get('name2');
                $user->apellido1=$request->get('apellido1');
                $user->apellido2=$request->get('apellido2');
                $user->nacimiento= $nacimiento;
                $user->generacion=$request->get('generacion');
                $user->email=$request->get('email');
                $user->ci=$request->get('ci');

                $user->save();
                $request->session()->flash('message', 'Perfil modificado con exito');
                return response(['msg'=>'Actualizado con exito']);
            }
            $request->session()->flash('error', 'Contrseña incorrecta');
            return response(['error'=>'Contraseña incorrecta']);
        }
        return response(['error'=>'No es ajax']);
        /*if($request->ajax()){
            
            return response(['msg'=>'Es ajax']);            
        }
        return response(['msg'=>'No es ajax']);*/
    }

    //------------end-----------
}
