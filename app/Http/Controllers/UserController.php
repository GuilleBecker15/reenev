<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\Utilidades;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

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
        
        if (Auth::user()->id==$id) {

            $user = User::findOrFail($id);

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

}
