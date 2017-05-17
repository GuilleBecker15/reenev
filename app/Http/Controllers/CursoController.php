<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Http\Traits\Utilidades;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CursoController extends Controller
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
        $cursos = Curso::all();
        $title = "ID, Nombre, Semestre o Abreviatura"; //Para el tooltrip
        return view(
            'admin.cursos',
            ['cursos' => $cursos, 'route' => $route, 'title' => $title]);
    }

    public function buscar(Request $request)
    {

        $this->authorize('es_admin', User::class);

        $route = Route::getFacadeRoot()->current()->uri(); //Ya esta en buscar

        $cursos1 = Curso::where('id', 'like','%'.$request->get('q').'%')->get();
        $cursos2 = Curso::where('nombre', 'like','%'.$request->get('q').'%')->get();
        $cursos3 = Curso::where('semestre', 'like','%'.$request->get('q').'%')->get();
        $cursos4 = Curso::where('abreviatura', 'like','%'.$request->get('q').'%')->get();

        $cursos =
        $cursos4->merge(
            $cursos3->merge(
                $cursos2->merge(
                    $cursos1)));

        $title = "ID, Nombre, Semestre o Abreviatura"; //Para el tooltrip

        return view(
            'admin.cursos',
            ['cursos' => $cursos, 'route' => $route, 'title' => $title]);

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
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        //
    }

}
