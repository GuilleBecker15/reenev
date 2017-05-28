<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Docente;
use App\Http\Traits\Utilidades;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use Illuminate\Validation\Rule;

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

    public function docente($id) {
        $this->authorize('es_admin', User::class);
        $route = Route::getFacadeRoot()->current()->uri().'/buscar'; //No esta en buscar
        $cursos = Curso::all()->where('docente_id', $id);
        $title = "ID, Nombre, Semestre o Abreviatura"; //Para el tooltrip
        $c = "";
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
        $this->authorize('es_admin', User::class);
        $docentes = Docente::all();
        return view('curso.create', compact('docentes'));
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
            'nombre' => 'required|string|max:255|unique:cursos',
            'abreviatura' => 'required|string|max:25|unique:cursos',
            'semestre' => 'required|integer|min:1|max:6',
        ]);

        $curso = new Curso;

        $docente_id = $request->get('docente_id');
        $docente = Docente::find($docente_id);

        if ($validator->fails())
            return redirect('Cursos/create')->withErrors($validator)->withInput();

        if (!$docente) {

            $docente = Docente::create();
            
            $docente->email = 'N/A';
            $docente->ci = 'N/A';
            $docente->nombre = 'Docente';
            $docente->apellido = 'Anonimo';
            
            $docente->save();

        }
        
        $curso->docente()->associate($docente);
        $curso->nombre = $request->get('nombre');
        $curso->semestre = $request->get('semestre');
        $curso->abreviatura = $request->get('abreviatura');
        $curso->save();

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

    public function edit($id)
    {
        $this->authorize('es_admin', User::class);
        $curso = Curso::find($id);
        $docente = $curso->docente;
        $docentes = Docente::all()->whereNotIn('id', [$docente->id]);
        return view('curso.edit', compact('curso','docente','docentes'));     
    }

    public function update(Request $request, $id)
    {

        $this->authorize('es_admin', User::class);

        $curso = Curso::find($id);

        $validator = Validator::make($request->all(),
            [
            'semestre' => 'required|integer|min:1|max:6',
            'nombre' => ['required', 'string', 'max:255',
            Rule::unique('cursos')->ignore($curso->id)],
            'abreviatura' => ['required', 'string', 'max:25',
            Rule::unique('cursos')->ignore($curso->id)],
            ]);

        $docente_id = $request->get('docente_id');
        $docente = Docente::find($docente_id);

        $curso->docente()->associate($docente);
        $curso->semestre = $request->get('semestre');
        $curso->nombre = $request->get('nombre');
        $curso->abreviatura = $request->get('abreviatura');

        if ($validator->fails()) {

            $request->session()->flash('message', 'Ocurrieron errores al actualizar');
            $docentes = Docente::all()->whereNotIn('id', [$docente->id]);
            return view('curso.edit',
                compact('curso','docente','docentes'))->withErrors($validator);

        }

        $curso->save();

        $request->session()->flash('message', '¡Curso actualizado con exito!');

        return $this->edit($curso->id);

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
