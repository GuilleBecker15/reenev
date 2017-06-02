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
        return view('pregunta.create',['encuesta'=>$encuesta]);
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
        // $num = $encuesta->withCount('preguntas')->get();
        $preguntas = Pregunta::with('encuesta')->get();
        $num = $preguntas->count();
        //$num = 0;
        $data = [
            'enunciado' => $request->get('descPregunta'),
            'numero' => $num,
        ];

        

        // $pregunta->numero = $num;
        // $pregunta->enunciado = $request->get('descPregunta');

        // $pregunta->save();
        // $encuesta->pregunta()->associate($pregunta);

        $pregunta->encuesta()->associate($encuesta);
        $pregunta->numero = $num + 1;
        $pregunta->enunciado = $request->get('descPregunta');
        $pregunta->save();

        return view('Pregunta.create', ['encuesta'=>$encuesta]);
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
