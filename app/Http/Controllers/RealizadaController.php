<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Docente;
use App\Encuesta;
use App\Http\Controllers\MailController;
use App\Http\Traits\Utilidades;
use App\Realizada;
use App\Respuesta;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RealizadaController extends Controller
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

    	$realizadas = Encuesta::orderBy('vence', 'desc')->get();

    	foreach ($realizadas as $key => $value) {
    		$value->inicio = $this->uyDateFormat($value->inicio);
    		$value->vence = $this->uyDateFormat($value->vence);
    	}

        // return view('realizada.index', ['realizadas' => $realizadas]);
    	return view('realizada.index', compact('realizadas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    	if (!Auth::user()) return view('auth.login');

    	$encuestas = Encuesta::whereDate('vence', '>', date('Y-m-d'))->get();
    	$docentes = Docente::all();
    	$cursos = Curso::all();

        // return view('realizada.elegir',
        //         ['encuestas' => $encuestas,
        //         'docentes' => $docentes,
        //         'cursos' => $cursos]);

    	return view('realizada.elegir', compact('encuestas', 'docentes', 'cursos'));

    }

    public function continuar(Request $request)
    {

    	if (!Auth::user()) return view('auth.login');

    	$encuesta = Encuesta::findOrFail($request->get('encuesta_id'));
    	$docente = Docente::findOrFail($request->get('docente_id'));
    	$curso = Curso::findOrFail($request->get('curso_id'));
    	$preguntas = $encuesta->preguntas;

    	$realizada = Realizada::where('encuesta_id', $encuesta->id)
    	->where('docente_id', $docente->id)
    	->where('curso_id', $curso->id)
    	->where('user_id', Auth::user()->id)->first();

    	if ($realizada) return $this->edit($realizada->id);
    	
    	if ($docente->cursos->where('id', $curso->id)->count()==0) {
    		
    		$request->session()->flash(
    			'error', $docente->nombre." ".$docente->apellido.
    			"no es profesor de '".$curso->asunto."'"
    			);

    		return $this->create();
    		
    	}

    	return view('realizada.create', compact('encuesta', 'docente', 'curso', 'preguntas'));
    	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	if (!Auth::user()) return view('auth.login');

    	$encuesta_json = $request->input('encuesta');
    	$docente_json = $request->input('docente');
    	$curso_json = $request->input('curso');
    	$preguntas_json = $request->input('preguntas');

    	$encuesta_array = json_decode($encuesta_json);
    	$docente_array = json_decode($docente_json);
    	$curso_array = json_decode($curso_json);
    	$preguntas_array = json_decode($preguntas_json);

    	$realizada = new Realizada;

    	$realizada->cuando = date('Y-m-d');
    	$realizada->encuesta_id = $encuesta_array->id;
    	$realizada->docente_id = $docente_array->id;
    	$realizada->curso_id = $curso_array->id;
    	$realizada->user_id = Auth::user()->id;

    	$realizada->save();

    	foreach ($preguntas_array as $p) {
    		$respuesta = new Respuesta;
    		$respuesta->calificacion = $request->get("p".$p->id);
    		$respuesta->pregunta_id = $p->id;
    		$respuesta->realizada_id = $realizada->id;
    		$respuesta->save();
    	}

    	return $this->create();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Realizada  $realizada
     * @return \Illuminate\Http\Response
     */
    public function show(Realizada $realizada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Realizada  $realizada
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$realizada = Realizada::findOrFail($id);
    	$encuesta = Encuesta::findOrFail($realizada->encuesta_id);
    	$docente = Docente::findOrFail($realizada->docente_id);
    	$curso = Curso::findOrFail($realizada->curso_id);
    	$preguntas = $encuesta->preguntas;
    	return view('realizada.edit', compact('encuesta','docente', 'curso', 'preguntas', 'realizada'));
    }

    /**
     * Update the specified resource in storage.
     *s
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Realizada  $realizada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    	$realizada = Realizada::findOrFail($id);
    	$preguntas = Encuesta::findOrFail($realizada->encuesta_id)->preguntas;

    	foreach ($preguntas as $key => $p) {

    		$respuesta = $p->respuestas
    		->where('realizada_id', $realizada->id)->first();
    		
    		$respuesta->calificacion = $request->get("p".$p->id);

    		$respuesta->save();
    		
    	}

    	return $this->edit($realizada->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Realizada  $realizada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Realizada $realizada)
    {
        //
    }

    public function verpormateria($id)
    {
    	$this->authorize('es_admin', User::class);
    	$realizadasPorMateria = Realizada::where('encuesta_id', $id)
    	->join('cursos', 'curso_id', '=', 'cursos.id')
    	->join('docentes', 'docente_id', '=', 'docentes.id')
    	->select('realizadas.*', 'docentes.nombre as nombredocente', 'docentes.apellido', 'cursos.*')
    	->orderBy('curso_id')->get()->groupBy('curso_id');
        // return view('realizada.verpormateria',['realizadasPorMateria' => $realizadasPorMateria]);
    	return view('realizada.verpormateria', compact('realizadasPorMateria', 'id'));
    }

	public function quienes(Request $request, $id)
	{

		$this->authorize('es_admin', User::class);

		$realizadas = Realizada::where('encuesta_id', $request->get('idEncuesta'))
		->where('curso_id', $request->get('idCurso'))
		->where('docente_id', $request->get('idDocente'))
		->join('users', 'user_id' ,'=' ,'users.id')
		->select('realizadas.id as idrealizada', 'realizadas.cuando',
		'realizadas.user_id', 'users.name1', 'users.apellido1')->get();

		foreach ($realizadas as $key => $estudiante) {

			$estudiante['cuando'] = $this->uyDateFormat($estudiante['cuando']);

			$respuesta = Respuesta::where('realizada_id', $estudiante->idrealizada)->get();

			$nocorresponde=0; $muymal=0; $mal=0; $normal=0; $bien=0; $muybien=0;

			foreach ($respuesta as $key => $cadapregunta) {

				switch ($cadapregunta->calificacion) {
					case '0':
						$nocorresponde ++;
						break;
					case '1':
						$muymal ++;
						break;
					case '2':
						$mal ++;
						break;
					case '3':
						$normal ++;
						break;
					case '4':
						$bien ++;
						break;
					case '5':
						$muybien ++;
						break;
					default:
						break;
				}

			} //fin segundo for each

			$estudiante = array_add($estudiante, 'nocorresponde', $nocorresponde);
			$estudiante = array_add($estudiante, 'muymal', $muymal);
			$estudiante = array_add($estudiante, 'mal', $mal);
			$estudiante = array_add($estudiante, 'normal', $normal);
			$estudiante = array_add($estudiante, 'bien', $bien);
			$estudiante = array_add($estudiante, 'muybien', $muybien);

		} //fin primer foreach

		// return view('realizada.quienescompletaron', compact('realizadas', $realizadas));
		$idEncuesta = $request->get('idEncuesta');
		return view('realizada.quienescompletaron', compact('realizadas', 'idEncuesta'));

	} //fin function quienes

    public function rehacer(Request $request)
    {
    	
    	$this->authorize('es_admin', User::class);
    	
    	$respuestas = Respuesta::where('realizada_id',$request->get('idrealizada'))->get();
    	$realizada = Realizada::where('id', $request->get('idrealizada'))->select('realizadas.*')->get();
    	
    	$user_id = $realizada->first()->user_id;
    	$docente_id = $realizada->first()->docente_id;
    	$curso_id = $realizada->first()->curso_id;
    	
    	$urlprevia = url()->previous();

    	foreach ($respuestas as $key => $respuesta) {
    		$respuesta->forceDelete();
    	}
    	
    	$realizada = Realizada::findOrFail($request->get('idrealizada'));
    	
    	$realizada->forceDelete();

    	$controllerMail = new MailController;
    	
    	return $controllerMail->sendemail($request, $user_id, $docente_id, $curso_id, $urlprevia);
    	
    }

    public function todos()
    {

    	$this->authorize('es_admin', User::class);
    	
    	$resultados = array();

    	$todos = DB::select(DB::raw("select realizadas.encuesta_id, realizadas.id, realizadas.user_id, users.name1, users.apellido1, realizadas.cuando ,avg(respuestas.calificacion) from realizadas left join respuestas on respuestas.realizada_id = realizadas.id left join users on users.id = realizadas.user_id group by realizadas.encuesta_id, realizadas.id, realizadas.user_id, users.name1, users.apellido1,  realizadas.cuando order by avg(respuestas.calificacion) desc"));
    	
    	$todos = collect($todos)->map(function ($x) { return (array)$x; })->toArray(); 

    	foreach ($todos as $key => $estudiante) {
    		
    		$estudiante['encuesta'] = Encuesta::findOrFail($estudiante['encuesta_id']);
    		$estudiante['cuando'] = $this->uyDateFormat($estudiante['cuando']);
    		$respuesta = Respuesta::where('realizada_id', $estudiante['id'])->get();

    		$nocorresponde=0; $muymal=0; $mal=0; $normal=0; $bien=0; $muybien=0;

    		foreach ($respuesta as $key => $cadapregunta) {

    			switch ($cadapregunta->calificacion) {
    				case '0':
    					$nocorresponde ++;
    					break;
    				case '1':
    					$muymal ++;
    					break;
    				case '2':
    					$mal ++;
    					break;
    				case '3':
    					$normal ++;
    					break;
    				case '4':
    					$bien ++;
    					break;
    				case '5':
    					$muybien ++;
    					break;
    				default:
    					break;
    			}
            
            } //fin segundo for each

            $estudiante = array_add($estudiante,'nocorresponde',$nocorresponde);
            $estudiante = array_add($estudiante,'muymal',$muymal);
            $estudiante = array_add($estudiante,'mal',$mal);
            $estudiante = array_add($estudiante,'normal',$normal);
            $estudiante = array_add($estudiante,'bien',$bien);
            $estudiante = array_add($estudiante,'muybien',$muybien);
            $resultados = array_prepend($resultados,$estudiante);
        
        }

        return view('realizada.todos', ['resultados' => $resultados]);
    
    }

}
