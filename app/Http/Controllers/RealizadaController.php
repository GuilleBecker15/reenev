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

}
