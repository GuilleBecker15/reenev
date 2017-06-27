<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Docente;
use App\Encuesta;
use App\Realizada;
use App\Respuesta;
use App\User;
use DB;
use App\Http\Traits\Utilidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

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

        $realizadas = Encuesta::orderBy('inicio', 'desc')->get();
        // dd($realizadas[0]->realizadas->groupBy('user_id'));
        foreach ($realizadas as $key => $value) {
            $value->inicio = $this->uyDateFormat($value->inicio);
            $value->vence = $this->uyDateFormat($value->vence);
        }
        return view('realizada.index',['realizadas' => $realizadas]);
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

        return view('realizada.elegir',
                ['encuestas' => $encuestas,
                'docentes' => $docentes,
                'cursos' => $cursos]);

    }

    public function continuar(Request $request)
    {

        if (!Auth::user()) return view('auth.login');

        $encuesta = Encuesta::find($request->get('encuesta_id'));
        $docente = Docente::find($request->get('docente_id'));
        $curso = Curso::find($request->get('curso_id'));
        $preguntas = $encuesta->preguntas;

        $realizada = Realizada::where('encuesta_id', $encuesta->id)
        ->where('docente_id', $docente->id)
        ->where('curso_id', $curso->id)
        ->where('user_id', Auth::user()->id)->first();

        if ($realizada) return $this->edit($realizada->id);
        
        if ($docente->cursos->where('id', $curso->id)->count()==0) {
        
            $request->session()->flash(
                'message', "El docente ID:".$docente->id.
                " (".$docente->nombre." ".$docente->apellido.
                ") no dicta el curso ID:".$curso->id." (".$curso->nombre.")");

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
        $realizada = Realizada::find($id);
        $encuesta = Encuesta::find($realizada->encuesta_id);
        $docente = Docente::find($realizada->docente_id);
        $curso = Curso::find($realizada->curso_id);
        $preguntas = $encuesta->preguntas;
        return view('realizada.edit',
            compact('encuesta','docente', 'curso', 'preguntas', 'realizada'));
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

        $realizada = Realizada::find($id);
        $preguntas = Encuesta::find($realizada->encuesta_id)->preguntas;

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

    public function verpormateria($id){
        $this->authorize('es_admin', User::class);
        $realizadasPorMateria = Realizada::where('encuesta_id', $id)->join('cursos','curso_id', '=','cursos.id')->join('docentes','docente_id', '=', 'docentes.id')->select('realizadas.*','docentes.nombre as nombredocente','docentes.apellido','cursos.*')->orderBy('curso_id')->get()->groupBy('curso_id');
        // foreach ($realizadaspormateria as $key => $value) {
        //     dd($value);
        // }
        // dd($realizadasPorMateria);
        return view('realizada.verpormateria',['realizadasPorMateria' => $realizadasPorMateria]);
    }

    public function quienes(Request $request, $id){
        $this->authorize('es_admin', User::class);
        $realizadas = Realizada::where('encuesta_id', $request->get('idEncuesta'))->where('curso_id',$request->get('idCurso'))->where('docente_id',$request->get('idDocente'))->join('users','user_id','=','users.id')->select('realizadas.id as idrealizada', 'realizadas.cuando','realizadas.user_id','users.name1','users.apellido1')->get();
        foreach ($realizadas as $key => $estudiante) {
            $estudiante['cuando'] = $this->uyDateFormat($estudiante['cuando']);
            // dd($estudiante->cuando);
            $respuesta = Respuesta::where('realizada_id', $estudiante->idrealizada)->get();

                // dd($cantRespuestas);
                $nocorresponde=0; $muymal=0; $mal=0; $normal=0; $bien=0; $muybien=0;

                foreach ($respuesta as $key => $cadapregunta) {
                    // dd($cadapregunta->calificacion);
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
                            # code...
                            break;
                    }
                }//fin segundo for each
                //$estudiante->toArray();
                $estudiante = array_add($estudiante,'nocorresponde',$nocorresponde);
                $estudiante = array_add($estudiante,'muymal',$muymal);
                $estudiante = array_add($estudiante,'mal',$mal);
                $estudiante = array_add($estudiante,'normal',$normal);
                $estudiante = array_add($estudiante,'bien',$bien);
                $estudiante = array_add($estudiante,'muybien',$muybien);
            // dd($estudiante);
        }//fin primer foreach
        // dd($realizadas);
    return view('realizada.quienescompletaron',compact('realizadas',$realizadas));
    }//fin function quienes

    public function rehacer(Request $request){
        $this->authorize('es_admin', User::class);
        $respuestas = Respuesta::where('realizada_id',$request->get('idrealizada'))->get();
        $realizada = Realizada::where('id',$request->get('idrealizada'))->select('realizadas.*')->get();//->first()->user_id;
        $user_id = $realizada->first()->user_id;
        $docente_id = $realizada->first()->docente_id;
        $curso_id = $realizada->first()->curso_id;
        // dd();
        // dd($respuestas);

        /*------Aca seteo a cero (no corresponde) todas las respuestas, no borro nada -------------- */
        foreach ($respuestas as $key => $respuesta) {
            // dd($respuesta->calificacion);
            $respuesta->calificacion = 0;
            $respuesta->save();
        }
        /*-------------------------------------------------------------------------------------------*/
        // dd($respuestas);
        /*-----------Esto borra fisicamente la encuestas realizada y todas las respuestas asociadas-------*/
        // foreach ($respuestas as $key => $respuesta) {
        //     $respuesta->forceDelete();
        // }
        // $realizada = Realizada::findOrFail($request->get('idrealizada'));
        // $realizada->forceDelete();
        // echo("borrado!");
        /*-------------------------------------------------------------------------------------------*/

       /*envio mail*/ 
       $controllerMail = new MailController;
       $controllerMail->sendemail($user_id, $docente_id, $curso_id);
       /**/
    }

    public function todos(){
        $resultados = array();
        // $todos = Realizada::select('realizadas.*')->join('respuestas','respuestas.realizada_id','=','realizadas.id')->get()->groupBy('realizadas.id');
        $todos = DB::select(DB::raw("select realizadas.id, realizadas.user_id, users.name1, users.apellido1, realizadas.cuando ,avg(respuestas.calificacion) from realizadas left join respuestas on respuestas.realizada_id = realizadas.id left join users on users.id = realizadas.user_id group by realizadas.id, realizadas.user_id, users.name1, users.apellido1,  realizadas.cuando order by avg(respuestas.calificacion) desc"));
        $todos = collect($todos)->map(function($x){ return (array) $x; })->toArray(); 
        // dd($todos);
        // dd($todos);
        foreach ($todos as $key => $estudiante) {
            $estudiante['cuando'] = $this->uyDateFormat($estudiante['cuando']);
            // dd($estudiante['cuando']);
            $respuesta = Respuesta::where('realizada_id', $estudiante['id'])->get();

                // dd($cantRespuestas);
                $nocorresponde=0; $muymal=0; $mal=0; $normal=0; $bien=0; $muybien=0;

                foreach ($respuesta as $key => $cadapregunta) {
                    // dd($cadapregunta->calificacion);
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
                            # code...
                            break;
                    }
                }//fin segundo for each
                // $estudiante = collect($estudiante)->map(function($x){ return (array) $x; })->toArray(); 
                // $data = array();
                // $data = array_map(function($estudiante){
                //     return (array) $estudiante;
                // }, $estudiante);
                // dd($data);
                // dd(gettype($estudiante));
                $estudiante = array_add($estudiante,'nocorresponde',$nocorresponde);
                $estudiante = array_add($estudiante,'muymal',$muymal);
                $estudiante = array_add($estudiante,'mal',$mal);
                $estudiante = array_add($estudiante,'normal',$normal);
                $estudiante = array_add($estudiante,'bien',$bien);
                $estudiante = array_add($estudiante,'muybien',$muybien);
                // var_dump($estudiante);
                $resultados = array_prepend($resultados,$estudiante);
            // dd($estudiante);
        }
        // $resultado = array_value(array_sort($resultado,function ($value){
        //     return $value['avg(respuestas.calificacion)'];
        // }));
        // dd($resultados);
        return view('realizada.todos', ['resultados'=>$resultados]);
    }

}
