<?php

namespace App\Http\Controllers;

use App\Encuesta;
use App\Pregunta;

use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $encuesta = Encuesta::findOrFail($id);
        // $preguntas = Pregunta::with('encuesta')->get();
        $preguntas = Pregunta::where('encuesta_id',$id)->get();

        
        return view('Pregunta.create',['encuesta'=>$encuesta, 'preguntas'=>$preguntas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $encuesta = Encuesta::findOrFail($id);
        $pregunta = new Pregunta;
        // $preguntas = Pregunta::with('encuesta')->get();
        $preguntas = Pregunta::where('encuesta_id',$id)->get();
        $num = $preguntas->count();
        $data = [
            'enunciado' => $request->get('descPregunta'),
            'numero' => $num,
        ];
        $pregunta->encuesta()->associate($encuesta);
        $pregunta->numero = $num + 1;
        $pregunta->enunciado = $request->get('descPregunta');
        $pregunta->save();

        return view('Pregunta.create', ['encuesta'=>$encuesta, 'preguntas'=>$preguntas]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
