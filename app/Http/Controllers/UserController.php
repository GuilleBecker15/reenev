<?php

namespace App\Http\Controllers;

use App\Http\Traits\Utilidades;
use App\Realizada;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Log;
use Session;
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
        
        $this->authorize('es_admin', User::class);
    
        $routeEntera = Route::getFacadeRoot()->current()->uri(); //No esta en buscar
        $routeSeparada = explode('/', $routeEntera);

        if (last($routeSeparada)!='buscar') {
            $route = implode('/', $routeSeparada);
            $route = $route.'/buscar';
        } else {
            $route = implode('/', $routeSeparada);
        }
                
        $users = User::withTrashed()->get();

        $h1 = "Usuarios en el sistema";
        $title = "ID, Nombres, Apellidos, Fecha de nacimiento, Generacion, C.I. o eMail"; //Para el tooltrip
        $c = "";

        // return view(
        //     'admin.users',
        //     ['users' => $users, 'route' => $route,
        //     'title' => $title, 'c' => $c, 'h1' => $h1]);

        return view('admin.users', compact('users', 'route', 'title', 'c', 'h1'));

    }

    public function buscar(Request $request)
    {

        $this->authorize('es_admin', User::class);
        
        $route = Route::getFacadeRoot()->current()->uri(); //Ya esta en buscar

        $query = $request->get('q');
        if (!$query) return $this->index();

        $users = collect([]);

        if (is_numeric($query)) {
        	$users = User::withTrashed()->where('id', $query)->orWhere('generacion', $query)->get();
        } else if ($this->es_fecha($query)) {
            $users = User::withTrashed()->where('nacimiento', $query)->get();
        } else {
            $users = User::withTrashed()->where('name1', 'like', '%'.$query.'%')
            ->orWhere('name2', 'like', '%'.$query.'%')
            ->orWhere('apellido1', 'like', '%'.$query.'%')
            ->orWhere('apellido2', 'like', '%'.$query.'%')
            ->orWhere('ci', 'like', '%'.$query.'%')
            ->orWhere('email', 'like', '%'.$query.'%')->get();
        }

        $h1 = "Se encontraron ".$users->count()." usuarios";
        if ($users->count()==0) $h1 = "No se encontraron usuarios";
        $title = "ID, Nombres, Apellidos, Fecha de nacimiento, Generacion, C.I. o eMail"; //Para el tooltrip
        $c = $request->consulta;

        // return view(
        //     'admin.users',
        //     ['users' => $users, 'route' => $route,
        //     'title' => $title, 'c' => $c, 'h1' => $h1]);

        return view('admin.users', compact('users', 'route', 'title', 'c', 'h1'));
    
    }

    public function show($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $this->authorize('es_admin_o_es_el', $user);
        return view('user.show', compact('user'));
    }

    public function realizadas($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $this->authorize('es_el', $user);
        $realizadas = $user->realizadas()->get();
        return view('user.realizadas', compact('realizadas'));
    }

    public function edit($id)
    {
        
        $user = User::withTrashed()->findOrFail($id);

        $this->authorize('es_admin_o_es_el', $user);
        
        session(['habilitar' => 'no']);
        
        if (session('datos')==null || session('actualizado')=='ok'){
            $datos = User::newModelInstance();
            $datos->name1 = $user->name1;
            $datos->name2 = $user->name2;
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
        
        $user = User::withTrashed()->findOrFail($id);
            
        $this->authorize('es_admin_o_es_el', $user);

		$nacimiento = $this->sqlDateFormat($request->get('nacimiento'));

		if ($request->get('name2')=='') $user->name2="-";
		else $user->name2=$request->get('name2');
		if ($request->get('apellido2')=='') $user->apellido2="-";
		else $user->apellido2=$request->get('apellido2');

		$user->name1=$request->get('name1');
		$user->apellido1=$request->get('apellido1');
		$user->nacimiento= $nacimiento;
		$user->generacion=$request->get('generacion');
		$user->ci=$request->get('ci');
		$user->email=$request->get('email');

        $message = ['same' => 'Las dos contraseñas deben ser iguales'];

        $validator=Validator::make($request->all(), [
        	'name1' => 'required|string|max:255',
            'name2' => 'nullable|string|max:255',
            'apellido1' => 'required|string|max:255',
            'apellido2' => 'nullable|string|max:255',
            'nacimiento' => 'required|string', 
            'generacion' => 'required|integer',
            'ci' => Rule::unique('users')->ignore($user->id ),
            'email' => Rule::unique('users')->ignore($user->id),], $message);

        if ($validator->fails()) {
        	return view('user.edit', ['user'=>$user])->withErrors($validator, 'name1');
        }

        if (Hash::check($request->get('pass'), $user->password) || Auth::user()->esAdmin) {
        	$user->save();
        	$request->session()->flash('message', 'Usuario actualizado');
            session(['actualizado' => 'ok']);
            return $this->edit($user->id);
        }

        $datos = User::newModelInstance();
        $datos->name1 = $request->get('name1');
        $datos->name2 = $request->get('name2');
        $datos->apellido1 = $request->get('apellido1');
        $datos->apellido2 = $request->get('apellido2');
        $datos->nacimiento = $this->sqlDateFormat($request->get('nacimiento'));
        $datos->generacion = $request->get('generacion');
        $datos->ci = $request->get('ci');
        $datos->email = $request->get('email');
        session(['habilitar' => 'si', 'datos' => $datos]);
        $validator->errors()->add('pass', 'La contraseña actual es incorrecta');
        return view('user.edit', ['user'=>$user])->withErrors($validator, 'pass');

    }

    public function hacerAdmin($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $this->authorize('es_admin_y_no_es_el', $user);
        $this->authorize('es_supervisor', $user);
        $user->supervisor=Auth::user()->id;
        $user->esAdmin=!$user->esAdmin;
        $user->save();
        return redirect()->action('UserController@show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
    	
        $user = User::withTrashed()->findOrFail($id);

        $this->authorize('es_admin_y_no_es_el', $user);

        /* 
        
        La siguiente politica es devil con datos de prueba:
        ---------------------------------------------------

        Ya que los usuarios de prueba no tienen supervisor,
        cualquier administrador del sistema podria eliminarlos.
        (Ver linea 97 del archivo app/Policies/UserPolicies.php)

        Esto no deberia de afectar, si los admins son delegados
        utilizando la opcion 'Hacer admin' del panel de control.

        */
        $this->authorize('es_supervisor', $user);

    	if (Realizada::where('user_id', $id)->get()->isNotEmpty()) {
    		$request->session()->flash('error',
    			$user->name1."' ya ha generado estadísticas");
    		return $this->index();
    	}
    	
    	$user->delete();

    	return $this->show($id);
    
    }

    public function recuperar(Request $request, $id)
    {
    	$this->authorize('es_admin', User::class);
    	User::withTrashed()->findOrFail($id)->restore();
        return $this->show($id);
    }

    public function redirectCambiarPass($user)
    {
        $users = User::withTrashed()->findOrFail($user);
        return view('user.cambiarPass', ['user' => $users]);
    }

    public function updatePass(Request $request, $id)
    {

        $usuario = User::withTrashed()->findOrFail($id);
        
        $this->authorize('es_admin_o_es_el', $usuario);

        $password = $request->get('pass');
    
        if (Auth::user()->id==$id) {
        	
        	$message = ['same' => 'Las dos contraseñas deben ser iguales'];
            $validator=Validator::make($request->all(), [
                'pass' => 'required|min:6',
                'pass1' => 'required|min:6',
                'pass2' => 'required|min:6|same:pass1'], $message);

            if ($validator->fails()) {
            	$request->session()->flash('error', 'Contraseña no actualizada');
            	return view('user.cambiarPass', ['user'=>$usuario])->withErrors($validator, 'pass1');
            }

            if (Hash::check($request->get('pass'), $usuario->password)) {
                $usuario->password=bcrypt($request->pass1);
                $usuario->save();
                $request->session()->flash('message', 'Contraseña actualizada');
                return $this->edit($usuario->id);
            } else {
                $validator->errors()->add('pass', 'La contraseña actual es incorrecta');
                return view('user.cambiarPass', ['user'=>$usuario])->withErrors($validator,'pass');
            }

        }

        return view('welcome');

    }

}
