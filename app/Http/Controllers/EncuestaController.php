<?php

namespace App\Http\Controllers;

use App\Encuesta;
use App\Http\Traits\Utilidades;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EncuestaController extends Controller
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
        $encuestas = Encuesta::all();
        $title = "ID, Inicia, Vence, Asunto o Descripcion"; //Para el tooltrip
        return view(
            'admin.encuestas',
            ['encuestas' => $encuestas, 'route' => $route, 'title' => $title]);
    }

    public function buscar(Request $request)
    {

        $this->authorize('es_admin', User::class);
        
        $route = Route::getFacadeRoot()->current()->uri(); //Ya esta en buscar
        
        $encuestas1 = Docente::where('id', 'like','%'.$request->get('q').'%')->get();
        $encuestas2 = Docente::where('inicio', 'like','%'.$request->get('q').'%')->get();
        $encuestas3 = Docente::where('vence', 'like','%'.$request->get('q').'%')->get();
        $encuestas4 = Docente::where('asunto', 'like','%'.$request->get('q').'%')->get();
        $encuestas5 = Docente::where('descripcion', 'like','%'.$request->get('q').'%')->get();

        $encuestas =
        $encuestas5->merge(
            $encuestas4->merge(
                $encuestas3->merge(
                    $encuestas2->merge(
                        $encuestas1))));

        $title = $request->get('title'); //No se altera

        return view(
            'admin.encuestas',
            ['encuestas' => $encuestas, 'route' => $route, 'title' => $title]);
    
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
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function show(Encuesta $encuesta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function edit(Encuesta $encuesta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Encuesta $encuesta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Encuesta $encuesta)
    {
        //
    }
}
