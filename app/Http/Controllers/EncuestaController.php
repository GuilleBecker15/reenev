<?php

namespace App\Http\Controllers;

use App\Encuesta;
use App\Http\Traits\Utilidades;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
        
        $title = "ID, Fecha inicial, Fecha limite, Asunto o Descripcion"; //Para el tooltrip

        $c = "";

        return view(
            'admin.encuestas',
            ['encuestas' => $encuestas, 'route' => $route, 'title' => $title, 'c' => $c]);
    
    }

    public function buscar(Request $request)
    {

        $this->authorize('es_admin', User::class);
        
        $route = Route::getFacadeRoot()->current()->uri(); //Ya esta en buscar
        
        $query = $request->get('q');

        // $encuestas1 = collect([]);
        // $encuestas2 = collect([]);
        // $encuestas3 = collect([]);

        // if (is_numeric($query)) $encuestas1 = Encuesta::where('id', $query)->get();
        
        // if ($this->es_fecha($query)) {

        //     $encuestas2 = Encuesta::where('inicio', $query)->get();
        //     $encuestas3 = Encuesta::where('vence', $query)->get();

        // }

        // $encuestas4 = Encuesta::where('asunto', 'like','%'.$query.'%')->get();
        // $encuestas5 = Encuesta::where('descripcion', 'like','%'.$query.'%')->get();

        // $encuestas =
        // $encuestas5->merge(
        //     $encuestas4->merge(
        //         $encuestas3->merge(
        //             $encuestas2->merge(
        //                 $encuestas1))));

        $encuestas = collect([]);

        if (is_numeric($query)) {

            $encuestas = Encuesta::where('id', $query)->get();
        
        } else if ($this->es_fecha($query)) {

            $encuestas = Encuesta::where('inicio', $query)
            ->orWhere('vence', $query)->get();

        } else {

            $encuestas = Encuesta::where('asunto', 'like', '%'.$query.'%')
            ->orWhere('descripcion', 'like', '%'.$query.'%')->get();

        }

        // dd(DB::getQueryLog());

        $title = "ID, Fecha inicial, Fecha limite, Asunto o Descripcion"; //Para el tooltrip

        $c = $request->consulta;

        return view(
            'admin.encuestas',
            ['encuestas' => $encuestas, 'route' => $route, 'title' => $title, 'c' => $c]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('es_admin', User::class);
        return view('encuesta.create');
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
