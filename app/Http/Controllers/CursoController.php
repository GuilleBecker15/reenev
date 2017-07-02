<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Docente;
use App\Http\Traits\Utilidades;
use App\Realizada;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
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
    	
        $routeEntera = Route::getFacadeRoot()->current()->uri(); //No esta en buscar
        $routeSeparada = explode('/', $routeEntera);

        if (last($routeSeparada)!='buscar') {
        	$route = implode('/', $routeSeparada);
        	$route = $route.'/buscar';
        } else {
        	$route = implode('/', $routeSeparada);
        }
        
        $cursos = Curso::all();

        $h1 = "Cursos en el sistema";
        $title = "ID, Nombre, Semestre o Abreviatura"; //Para el tooltrip
        $c = "";

        // return view(
        //     'admin.cursos',
        //     ['cursos' => $cursos, 'route' => $route,
        //     'title' => $title, 'c' => $c, 'h1' => $h1]);

        return view('admin.cursos', compact('cursos', 'route', 'title', 'c', 'h1'));
        
    }

    public function buscar(Request $request)
    {

    	$this->authorize('es_admin', User::class);

        $route = Route::getFacadeRoot()->current()->uri(); //Ya esta en buscar
        
        $query = $request->get('q');
        if (!$query) return $this->index();

        $cursos = collect([]);

        if (is_numeric($query)) {
        	$cursos = Curso::where('id', $query)
        	->orWhere('semestre', $query)->get();
        } else {
        	$cursos = Curso::where('nombre', 'like', '%'.$query.'%')
        	->orWhere('abreviatura', 'like', '%'.$query.'%')->get();
        }

        $h1 = "Se encontraron ".$cursos->count()." cursos";
        if ($cursos->count()==0) $h1 = "No se encontraron cursos";
        $title = "ID, Nombre, Semestre o Abreviatura"; //Para el tooltrip
        $c = $request->consulta;

        // return view(
        //     'admin.cursos',
        //     ['cursos' => $cursos, 'route' => $route,
        //     'title' => $title, 'c' => $c, 'h1' => $h1]);

        // dd(DB::getQueryLog()); //Para ver el registro de consultas a la BD

        return view('admin.cursos', compact('cursos', 'route', 'title', 'c', 'h1'));

    }

    public function docente($id)
    {
    	$this->authorize('es_admin', User::class);     
    	$docente = Docente::findOrFail($id);
    	$h1 = "Cursos del docente ";
        $routeEntera = Route::getFacadeRoot()->current()->uri(); //No esta en buscar
        $routeSeparada = explode('/', $routeEntera, -2);
        $route = implode('/', $routeSeparada);
        $route = $route.'/buscar';
        $cursos = $docente->cursos()->get();
        $title = "ID, Nombre, Semestre o Abreviatura"; //Para el tooltrip
        $c = "";
        // return view(
        //     'admin.cursos',
        //     ['cursos' => $cursos, 'route' => $route,
        //     'title' => $title, 'c' => $c, 'h1' => $h1, 'docente' => $docente]);
        return view('admin.cursos', compact('cursos', 'route', 'title', 'c', 'h1', 'docente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$this->authorize('es_admin', User::class);
    	$docentes = Docente::where('nombre','<>','Docente')
    	->where('apellido', '<>', 'Anonimo')->get();
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

    	if ($validator->fails()) {
    		$request->session()->flash('error', 'Curso no creado');
    		return redirect('Cursos/create')->withErrors($validator)->withInput();
    	}
    	
    	$curso->nombre = $request->get('nombre');
    	$curso->semestre = $request->get('semestre');
    	$curso->abreviatura = $request->get('abreviatura');

    	$curso->save();

    	return $this->show($curso->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$curso = Curso::findOrFail($id);
    	return view('curso.show', compact('curso'));
    }

    public function edit($id)
    {

    	$this->authorize('es_admin', User::class);
    	
    	$curso = Curso::findOrFail($id);
    	
    	$DocentesCurso = $curso->docentes()->get();
    	$ids = [];
    	
    	for ($i=0; $i<($curso->docentes()->get()->count()); $i++) { 
    		$ids = array_prepend($ids, $DocentesCurso[$i]->id);
    	} 
    	
    	$docente = $curso->docentes()->get();
    	$docentes = Docente::all()->whereNotIn('id', $ids);
    	
    	return view('curso.edit', compact('curso', 'docente', 'docentes'));     
    	
    }

    public function update(Request $request, $id)
    {

    	$this->authorize('es_admin', User::class);

    	$curso = Curso::findOrFail($id);

    	$curso->semestre = $request->get('semestre');
    	$curso->nombre = $request->get('nombre');
    	$curso->abreviatura = $request->get('abreviatura');
    	
    	$validator = Validator::make($request->all(), [
    		'semestre' => 'required|integer|min:1|max:6',
    		'nombre' => ['required', 'string', 'max:255',
    		Rule::unique('cursos')->ignore($curso->id)],
    		'abreviatura' => ['required', 'string', 'max:25',
    		Rule::unique('cursos')->ignore($curso->id)],
    		]);

    	if ($validator->fails()) {
    		$request->session()->flash('error', 'Curso no actualizado');
    		return redirect('Cursos/'.$id.'/edit')->withErrors($validator)->withInput();
    	}

    	$curso->save();

    	$request->session()->flash('message', 'Curso actualizado');
    	return $this->edit($curso->id);

    }

    public function editdocente($idCurso)
    {
    	
    	$this->authorize('es_admin', User::class);

    	$curso = Curso::findOrFail($idCurso);
    	
    	$docentesActuales = $curso->docentes()->get();
    	$ids = [];
    	
    	for ($i=0; $i<($curso->docentes()->get()->count()); $i++) { 
    		$ids = array_prepend($ids, $docentesActuales[$i]->id);
    	}
    	
    	$otrosDocentes =  Docente::all()->whereNotIn('id', $ids);
    	return view('curso.editdocentes',compact('curso','docentesActuales','otrosDocentes'));
    	
    }

    public function actualizardocente(Request $request, $idCurso)
    {
    	
    	$this->authorize('es_admin', User::class);
    	
    	$curso = Curso::find($idCurso);
    	
    	$docente = Docente::find($request->get('docente_id'));
    	
    	if (!$curso || !$docente) {
    		$request->session()->flash('error', 'Docente no agregado');
    		return $this->editdocente($idCurso);
    	}
    	
    	$nombreDocente = $docente->nombre.' '.$docente->apellido;
    	$nombreCurso = $curso->nombre; 
    	
    	$curso->docentes()->attach($docente);
    	
    	$request->session()->flash('message', $nombreDocente.' ahora es profesor de '.$nombreCurso);
    	return $this->editdocente($idCurso);
    	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
    	
    	$this->authorize('es_admin', User::class);

    	$curso = Curso::findOrFail($id);
    	
    	if (Realizada::where('curso_id', $id)->get()->isNotEmpty()) {
    		$request->session()->flash('error',
    			"El curso '".$curso->nombre."' ya ha generado estadísticas");
    		return $this->index();
    	}
    	
    	$curso->forceDelete();

    	$request->session()->flash('message',
    		"El curso '".$curso->nombre."' ha sido eliminado");
    	return $this->index();
    
    }

    public function borrardocente(Request $request, $idCurso)
    {
    	$this->authorize('es_admin', User::class);
    	$curso = Curso::findOrFail($idCurso);
    	$curso->docentes()->detach($request->get('docente_id'));
    	$request->session()->flash('message', 'Docente quitado');
    	return $this->editdocente($idCurso);
    }

}
