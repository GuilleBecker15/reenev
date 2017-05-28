<?php

namespace App\Http\Controllers;

use App\Docente;
use App\Http\Traits\Utilidades;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;

class DocenteController extends Controller
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
        
        $docentes = Docente::all();
        
        $title = "ID, eMail, C.I., Nombre o Apellido"; //Para el tooltrip

        $c = "";

        return view(
            'admin.docentes',
            ['docentes' => $docentes, 'route' => $route, 'title' => $title, 'c' => $c]);
    
    }

    public function buscar(Request $request)
    {

        $this->authorize('es_admin', User::class);
        
        $route = Route::getFacadeRoot()->current()->uri(); //Ya esta en buscar
     
        $query = $request->get('q');

        $docentes1 = collect([]);

        if (is_numeric($query)) $docentes1 = Docente::where('id', $query)->get();
        
        $docentes2 = Docente::where('email', 'like','%'.$query.'%')->get();
        $docentes3 = Docente::where('ci', 'like','%'.$query.'%')->get();
        $docentes4 = Docente::where('nombre', 'like','%'.$query.'%')->get();
        $docentes5 = Docente::where('apellido', 'like','%'.$query.'%')->get();

        $docentes =
        $docentes5->merge(
            $docentes4->merge(
                $docentes3->merge(
                    $docentes2->merge(
                        $docentes1))));

        $title = "ID, eMail, C.I., Nombre o Apellido"; //Para el tooltrip

        $c = $request->consulta;

        return view(
            'admin.docentes',
            ['docentes' => $docentes, 'route' => $route, 'title' => $title, 'c' => $c]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('es_admin', User::class);
        return view('docente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('es_admin', User::class);
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255|unique:users|unique:docentes',
            'ci' => 'required|string|max:255|unique:users|unique:docentes',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {

            return redirect('Docentes/create')->withErrors($validator)->withInput();

        } else {

            $docente = Docente::create();

            $docente->email=$request->get('email');
            $docente->ci=$request->get('ci');
            $docente->nombre=$request->get('nombre');
            $docente->apellido=$request->get('apellido');

            $docente->save();

        }

        return $this->index();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Docente $docente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit(Docente $docente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Docente $docente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docente $docente)
    {
        //
    }
}
