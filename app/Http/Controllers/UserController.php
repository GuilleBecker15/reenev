<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Log;


class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

            /*// get all the nerds
            $nerds = Nerd::all();

            // load the view and pass the nerds
            return View::make('nerds.index')
                ->with('nerds', $nerds);
            */


        //$users = User::latest()->paginate();
        //$users = User::all();
        $users = User::all();
        //var_dump($users->toJson());
        //dd($users->toJson());
        return view('userAll', compact('users'));






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

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    //public function show(User $user)
    public function show($id)
    {
        //

        if(Auth::user()->id == $id || Auth::user()->esAdmin){
            return view('userProfile', ['user' => User::findOrFail($id)]);
        }
        else{
            return view('welcome');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    //public function edit(User $user)
    public function edit($id)
    {
        //
        //Log::info('Showing user profile for user:-------------    '.$id);
        //$user=$id;
        $user = User::findOrFail($id);
        return view('userEdit', compact('user'));
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
        /*$user = User::findOrFail($id);
        $user->name1=$request->get('name1');
        $user->name2=$request->get('name2');
        $user->apellido1=$request->get('apellido1');
        $user->apellido2=$request->get('apellido2');
        $user->nacimiento=$request->get('nacimiento');
        $user->generacion=$request->get('generacion');
        $user->ci=$request->get('ci');
        $user->email=$request->get('email');
        $user->password=$request->get('password');
        
        $user->save($user);
        */
        
        $user=User::findOrFail($id);
        $user->update($request->all());
        //return redirect(action('userProfile',['id' => $user->id])->with('status', 'ok'));
        return redirect(route('Users.index', ['status' => 'ok']));

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
        return redirect(route('Users.index', ['status' => 'ok']));
        
    }
}
