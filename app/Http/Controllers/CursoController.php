<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Http\Traits\Utilidades;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;

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

        $c = "";

        return view(
            'admin.cursos',
            ['cursos' => $cursos, 'route' => $route, 'title' => $title, 'c' => $c]);
    
    }

    public function buscar(Request $request)
    {

        $this->authorize('es_admin', User::class);

        $route = Route::getFacadeRoot()->current()->uri(); //Ya esta en buscar
        
        $query = $request->get('q');

        $cursos1 = collect([]);
        $cursos3 = collect([]);

        if (is_numeric($query)) {

            $cursos1 = Curso::where('id', $query)->get();
            $cursos3 = Curso::where('semestre', $query)->get();

        }
        
        $cursos2 = Curso::where('nombre', 'like','%'.$query.'%')->get();
        $cursos4 = Curso::where('abreviatura', 'like','%'.$query.'%')->get();

        $cursos =
        $cursos4->merge(
            $cursos3->merge(
                $cursos2->merge(
                    $cursos1)));

        $title = "ID, Nombre, Semestre o Abreviatura"; //Para el tooltrip

        $c = $request->consulta;

        return view(
            'admin.cursos',
            ['cursos' => $cursos, 'route' => $route, 'title' => $title, 'c' => $c]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('curso.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:cursos',
            'abreviatura' => 'required|string|max:25|unique:cursos',
            'semestre' => 'required|integer|min:1|max:6',
        ]);

        if ($validator->fails()) {

            return redirect('Cursos/create')->withErrors($validator)->withInput();

        } else {

            $curso = Curso::create();

            $curso->nombre=$request->get('nombre');
            $curso->semestre=$request->get('semestre');
            $curso->abreviatura=$request->get('abreviatura');

            $curso->save();

        }

        return $this->index();

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
