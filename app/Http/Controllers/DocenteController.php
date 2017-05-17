<?php

namespace App\Http\Controllers;

use App\Docente;
use App\Http\Traits\Utilidades;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
        return view(
            'admin.docentes',
            ['docentes' => $docentes, 'route' => $route, 'title' => $title]);
    }

    public function buscar(Request $request)
    {

        $this->authorize('es_admin', User::class);
        
        $route = Route::getFacadeRoot()->current()->uri(); //Ya esta en buscar
        
        $docentes1 = Docente::where('id', 'like','%'.$request->get('q').'%')->get();
        $docentes2 = Docente::where('email', 'like','%'.$request->get('q').'%')->get();
        $docentes3 = Docente::where('ci', 'like','%'.$request->get('q').'%')->get();
        $docentes4 = Docente::where('nombre', 'like','%'.$request->get('q').'%')->get();
        $docentes5 = Docente::where('apellido', 'like','%'.$request->get('q').'%')->get();

        $docentes =
        $docentes5->merge(
            $docentes4->merge(
                $docentes3->merge(
                    $docentes2->merge(
                        $docentes1))));

        $title = $request->get('title'); //No se altera

        return view(
            'admin.docentes',
            ['docentes' => $docentes, 'route' => $route, 'title' => $title]);
    
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
