<?php

namespace App\Http\Controllers;

use App\Http\Traits\Utilidades;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    
        $route = Route::getFacadeRoot()->current()->uri().'/buscar'; //No esta en buscar
        
        $users = User::where('estaBorrado',false)->get();
        
        $title = "ID, Nombres, Apellidos, Fecha de nacimiento,
        Generacion, C.I. o eMail"; //Para el tooltrip
        
        return view(
            'admin.users',
            ['users' => $users, 'route' => $route, 'title' => $title]);
    
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

        $title = "ID, Nombres, Apellidos, Fecha de nacimiento,
        Generacion, C.I. o eMail"; //Para el tooltrip

        return view(
            'admin.users',
            ['users' => $users, 'route' => $route, 'title' => $title]);
    
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

        return $this->edit($user->id);

    }

    public function hacerAdmin($id)
    {
        $this->authorize('es_admin', User::class);
        $user = User::findOrFail($id);
        $user->esAdmin=true;
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
        $this->authorize('es_admin', User::class);
        $user = User::findOrFail($id);
        // $user->delete();
        $user->estaBorrado=true;
        $user->save();
        return $this->show($user->id);
    }

    public function recuperar($id)
    {
        $this->authorize('es_admin', User::class);
        $user = User::findOrFail($id);
        $user->estaBorrado=false;
        $user->save();
        return $this->show($user->id);
    }

}
