<?php

namespace App\Http\Controllers;

use App\Encuesta;
use App\Http\Traits\Utilidades;
use App\Pregunta;
use App\Realizada;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

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
    	
    	$this->authorize('es_admin', User::class);

    	$encuesta = Encuesta::findOrFail($id);
    	$preguntas = Pregunta::where('encuesta_id', $id)->get();

    	for ($i=0; $i<($preguntas->count()); $i++) {
    		$preguntas[$i]->enunciado = str_replace("/", ",", $preguntas[$i]->enunciado);
    	}
    	
        // return view('pregunta.create', ['encuesta' => $encuesta, 'preguntas' => $preguntas]);
    	return view('pregunta.create', compact('encuesta', 'preguntas'));
    	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

    	$this->authorize('es_admin', User::class);

    	$enun = str_replace(",", "/", $request->get('enunciado'));
    	$request->merge(['enunciado' => $enun]);

    	$validator = Validator::make($request->all(), [
    		'enunciado' => 'required|string|max:255|unique:preguntas,enunciado,NULL,'
    		.$request->get('enunciado').',encuesta_id,'.$id.'',
    		]);

    	$encuesta = Encuesta::findOrFail($id);
    	$preguntas = Pregunta::where('encuesta_id', $id)->get();

    	if (Realizada::where('encuesta_id', $id)->get()->isNotEmpty()) {
    		$request->session()->flash('error', 'La encuesta ya ha generado estadísticas');
            // return view('pregunta.create',['encuesta' => $encuesta, 'preguntas' => $preguntas]);
    		return view('pregunta.create', compact('encuesta', 'preguntas'));
    	}

    	if ($validator->fails()) {
    		$request->session()->flash('error', 'Pregunta no agregada a la encuesta');
    		return view('pregunta.create', compact('encuesta', 'preguntas'))->withErrors($validator);
    	}

    	$pregunta = new Pregunta;

    	$preguntas = Pregunta::where('encuesta_id',$id)->get();
    	$num = $preguntas->count();

    	$data = [
    	'enunciado' => $request->get('enunciado'),
    	'numero' => $num,
    	];
    	
    	$pregunta->encuesta()->associate($encuesta);
    	
    	$pregunta->numero = $num + 1;
    	$pregunta->enunciado = $request->get('enunciado');
    	
    	$pregunta->save();

        // return view('Pregunta.create', ['encuesta' => $encuesta, 'preguntas' => $preguntas]);
    	$request->session()->flash('message', 'Pregunta agregada a la encuesta');
    	return $this->create($encuesta->id);

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
    public function edit($id_encuesta, $id_pregunta)
    {
    	$this->authorize('es_admin', User::class);
    	$pregunta = Pregunta::findOrFail($id_pregunta);
    	$pregunta->enunciado = str_replace("/", ",", $pregunta->enunciado);
    	$encuesta = Encuesta::findOrFail($pregunta->encuesta()->get()[0]->id);
        // return view('pregunta.edit', ['encuesta' => $encuesta,'pregunta' => $pregunta]);
    	return view('pregunta.edit', compact('encuesta', 'pregunta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idEncuesta, $idPreg)
    {
    	
    	$this->authorize('es_admin', User::class);

    	$pregunta = Pregunta::findOrFail($idPreg);

    	$enun = str_replace(",", "/", $request->get('enunciado'));
    	$request->merge(['enunciado' => $enun]);

    	$validator = Validator::make($request->all(), [
    		'enunciado' => 'required|string|max:255|unique:preguntas,enunciado,NULL,'
    		.$request->get('enunciado').',encuesta_id,'.$idEncuesta.'',
    		]);

    	if ($validator->fails()) {
    		$encuesta = Encuesta::findOrFail($idEncuesta);
    		$request->session()->flash('error', 'La pregunta no se pudo actualizar');
            // return view('pregunta.edit', ['encuesta' => $encuesta, 'pregunta' => $pregunta])
            // ->withErrors($validator, 'enunciado');
    		return view('pregunta.edit', compact('encuesta', 'pregunta'))->withErrors($validator);
    	}

    	$idEncuesta = $pregunta->encuesta()->get()[0]->id;

    	$pregunta->enunciado = $enun ;

    	if (Realizada::where('encuesta_id', $idEncuesta)->get()->isNotEmpty()) {
    		$request->session()->flash('error', 'La encuesta a la cual pertenece, ya se completó');
    	} else {
    		$pregunta->save();
    		$request->session()->flash('message', 'Pregunta actualizada para la encuesta');
    	}

    	return $this->create($idEncuesta);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $idEncuesta, $idPregunta)
    {

    	$this->authorize('es_admin', User::class);

    	$pregunta = Pregunta::findOrFail($idPregunta);

    	$idEncuesta = $pregunta->encuesta()->get()[0]->id;

    	if (Realizada::where('encuesta_id', $idEncuesta)->get()->isNotEmpty()) {
    		$request->session()->flash('error', 'La encuesta a la cual pertenece, ya se completó');
    		return $this->create($idEncuesta);
    	}

    	$pregunta->forceDelete();

    	$request->session()->flash('message', 'Pregunta eliminada de la encuesta');
    	return $this->create($idEncuesta);

    }

}
