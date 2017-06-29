<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Docente;
use App\Encuesta;
use App\Http\Traits\Utilidades;
use App\Pregunta;
use App\Realizada;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
                
        $routeEntera = Route::getFacadeRoot()->current()->uri(); //No esta en buscar
        $routeSeparada = explode('/', $routeEntera);

        if (last($routeSeparada)!='buscar') {
            $route = implode('/', $routeSeparada);
            $route = $route.'/buscar';
        } else {
            $route = implode('/', $routeSeparada);
        }

        $docentes = Docente::all();

        $h1 = "Docentes en el sistema";
        
        $title = "ID, eMail, C.I., Nombre o Apellido"; //Para el tooltrip

        $c = "";

        return view(
            'admin.docentes',
            ['docentes' => $docentes, 'route' => $route,
            'title' => $title, 'c' => $c, 'h1' => $h1]);
    
    }

    public function buscar(Request $request)
    {

        $this->authorize('es_admin', User::class);
        
        $route = Route::getFacadeRoot()->current()->uri(); //Ya esta en buscar
     
        $query = $request->get('q');

        if (!$query) return $this->index();

        // $docentes1 = collect([]);

        // if (is_numeric($query)) $docentes1 = Docente::where('id', $query)->get();
        
        // $docentes2 = Docente::where('email', 'like','%'.$query.'%')->get();
        // $docentes3 = Docente::where('ci', 'like','%'.$query.'%')->get();
        // $docentes4 = Docente::where('nombre', 'like','%'.$query.'%')->get();
        // $docentes5 = Docente::where('apellido', 'like','%'.$query.'%')->get();

        // $docentes =
        // $docentes5->merge(
        //     $docentes4->merge(
        //         $docentes3->merge(
        //             $docentes2->merge(
        //                 $docentes1))));

        if (is_numeric($query)) {

            $docentes = Docente::where('id', $query)->get();

        } else {

            $docentes = Docente::where('email', 'like', '%'.$query.'%')
            ->orWhere('ci', 'like', '%'.$query.'%')
            ->orWhere('nombre', 'like', '%'.$query.'%')
            ->orWhere('apellido', 'like', '%'.$query.'%')->get();

        }

        $h1 = "Se encontraron ".$docentes->count()." docentes";

        if ($docentes->count()==0) $h1 = "No se encontraron docentes";

        $title = "ID, eMail, C.I., Nombre o Apellido"; //Para el tooltrip

        $c = $request->consulta;

        return view(
            'admin.docentes',
            ['docentes' => $docentes, 'route' => $route,
            'title' => $title, 'c' => $c, 'h1' => $h1]);
    
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
    public function show($idDocente)
    {
        $docente = Docente::findOrFail($idDocente);
        return view('docente.show', compact('docente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('es_admin', User::class);

        $docente = Docente::findOrFail($id);
        return view('docente.edit', compact('docente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $docente = Docente::findOrFail($id);

        $docente->email=$request->get('email');
        $docente->ci=$request->get('ci');
        $docente->nombre=$request->get('nombre');
        $docente->apellido=$request->get('apellido');

        $docente->save();

        $request->session()->flash('message', 'Datos del docente actualizados con exito');

        return $this->edit($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->authorize('es_admin', User::class);

        $docente = Docente::find($id);
        $nomApe = $docente->nombre." ".$docente->apellido;
        
        if (Realizada::where('docente_id', $id)->get()->isNotEmpty()) {
            $request->session()->flash(
                'message',
                'No se puede eliminar el docente. Existen encuestas completadas para el');
            return $this->index();
        }
        
        $docente->delete();

        $request->session()->flash('message', 'El docente '.$nomApe. ' fue borrado exitosamente');
        return $this->index();
    }

    public function graficas($id_docente) {
    
    	/*
    
    	1) Mostrar para este docente, cada encuesta que apunte a el
    	2) Mostrar para cada encuesta, cada curso a la cual se dirige
    	3) Mostrar para cada curso, la grafica

    	*/

        $docente = Docente::find($id_docente);

        $realizadas_encuesta_id = Realizada::where('docente_id', $id_docente)->select('realizadas.encuesta_id')->distinct()->get();
        $realizadas_curso_id = Realizada::where('docente_id', $id_docente)->select('realizadas.curso_id')->distinct()->get();
        
        $encuesta_ids = array('');
        $cursos_ids = array('');

        foreach ($realizadas_encuesta_id as $r) {
        	array_push($encuesta_ids, $r->encuesta_id);
        }

        foreach ($realizadas_curso_id as $r) {
        	array_push($cursos_ids, $r->curso_id);
        }

        $encuestas = Encuesta::whereIn('id', $encuesta_ids)->get();
        $cursos = Curso::whereIn('id', $cursos_ids)->get();

    	return view('docente.estadisticas.graficas', compact('encuestas', 'cursos', 'docente'));
    	
        // if ($opcion=='ver_pdf') {
        // 	$data = compact('encuestas', 'cursos', 'docente');
        // 	return $this->html_to_pdf($data)->stream();
        // }

        // if ($opcion=='bajar_pdf') {
        // 	$data = compact('encuestas', 'cursos', 'docente');
        // 	$name = $docente->nombre."_".$docente->apellido."_".date('d/m/Y');
        // 	return $this->html_to_pdf($data)->download($name.".pdf");
        // }

        return $this->debug($encuestas, $cursos, $docente); //SOLO TESTING

    }

    public function exportar($id_docente, $id_encuesta, $id_curso) {
    	$docente = Docente::find($id_docente);
    	$encuesta = Encuesta::find($id_encuesta);
    	$curso = Curso::find($id_curso);
        // dd($encuesta->preguntas);
    	if (!$docente) return "No se encontro el docente de id=".$id_docente;
    	if (!$encuesta) return "No se encontro la encuesta de id=".$id_encuesta;
    	if (!$curso) return "No se encontro el curso de id=".$id_curso;
    	return view('docente.estadisticas.exportar', compact('docente', 'encuesta', 'curso'));
    }

    private function html_to_pdf($data) {
        // $data = "nombre del docente";
    	$pdf = \PDF::loadView('docente.html', $data);
    	return $pdf;
	}

    private function debug($encuestas, $cursos, $docente) {

    	return view('docente.estadisticas.html_for_pdf',
    			compact('encuestas', 'cursos', 'docente'));

	    echo "<ul>";
        foreach ($encuestas as $encuesta) {
        	echo "<li>Encuesta (".$encuesta->id.") ".$encuesta->asunto."</li>";
	        echo "<ul>";
        	foreach ($cursos as $curso) {
				echo "<li>Curso (".$curso->id.") ".$curso->nombre."</li>";
		        echo "<ul>";
		        foreach ($encuesta->preguntas as $pregunta) {
		        	echo "<li>Pregunta (".$pregunta->id.") ".$pregunta->enunciado."</li>";
		        	echo "<ul>";
		        	$no_corresponde = $docente->responden(0, $curso->id, $pregunta->id);
		        	$muy_mal = $docente->responden(1, $curso->id, $pregunta->id);
		        	$mal = $docente->responden(2, $curso->id, $pregunta->id);
		        	$normal = $docente->responden(3, $curso->id, $pregunta->id);
		        	$bien = $docente->responden(4, $curso->id, $pregunta->id);
		        	$muy_bien = $docente->responden(5, $curso->id, $pregunta->id);
		        	echo "<li>No corresponde: ".$no_corresponde." alumnos</li>";
		        	echo "<li>Muy mal: ".$muy_mal." alumnos</li>";
		        	echo "<li>Mal: ".$mal." alumnos</li>";
		        	echo "<li>Normal: ".$normal." alumnos</li>";
		        	echo "<li>Bien: ".$bien." alumnos</li>";
		        	echo "<li>Muy bien: ".$muy_bien." alumnos</li>";
		        	echo "</ul>";
	        	}
	        	echo "</ul>";        			
        	}
        	echo "</ul>";
        }
	    echo "</ul>";
	}

}
