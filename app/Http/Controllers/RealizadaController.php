<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Docente;
use App\Encuesta;
use App\Realizada;
use App\Respuesta;
use App\User;
use App\Http\Traits\Utilidades;
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
        $realizadas = Encuesta::orderBy('inicio', 'desc')->get();
        // dd($realizadas[0]->realizadas->groupBy('user_id'));
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
        $realizadasPorMateria = Realizada::where('encuesta_id', $id)->join('cursos','curso_id', '=','cursos.id')->join('docentes','docente_id', '=', 'docentes.id')->select('realizadas.*','docentes.nombre as nombredocente','docentes.apellido','cursos.*')->orderBy('curso_id')->get()->groupBy('curso_id');
        // dd($realizadasPorMateria);
        return view('realizada.verpormateria',['realizadasPorMateria' => $realizadasPorMateria]);
    }

    public function quienes(Request $request, $id){
        // dd($request);
        $realizadas = Realizada::where('encuesta_id', $request->get('idEncuesta'))->where('curso_id',$request->get('idCurso'))->where('docente_id',$request->get('idDocente'))->join('users','user_id','=','users.id')->select('realizadas.id as idrealizada', 'realizadas.cuando','realizadas.user_id','users.name1','users.apellido1')->get();
        foreach ($realizadas as $key => $estudiante) {
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
        $respuestas = Respuesta::where('realizada_id',$request->get('idrealizada'))->get();
        $iduser = Realizada::where('id',$request->get('idrealizada'))->select('realizadas.user_id')->get()->first()->user_id;
        dd($iduser);
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

        
    }


}
