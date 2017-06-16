<?php

namespace App\Http\Controllers;

use App\Encuesta;
use App\Pregunta;
use Validator;
use App\Http\Traits\Utilidades;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        // $preguntas = Pregunta::with('encuesta')->get();
        $preguntas = Pregunta::where('encuesta_id',$id)->get();

        for ($i=0; $i < $preguntas->count() ; $i++) { 
            $preguntas[$i]->enunciado = str_replace("/", ",", $preguntas[$i]->enunciado);
        }
        
        return view('pregunta.create',['encuesta'=>$encuesta, 'preguntas'=>$preguntas]);
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

        $validator = Validator::make($request->all(),[
            'enunciado' => 'required|string|max:255|unique:preguntas,enunciado,NULL,'.$request->get('enunciado').',encuesta_id,'.$id.'',
            
          ]);

        

        $encuesta = Encuesta::findOrFail($id);
        $preguntas = Pregunta::where('encuesta_id',$id)->get();

        if($validator->fails() ){
            return view('pregunta.create',['encuesta'=>$encuesta, 'preguntas'=>$preguntas])->withErrors($validator,'enunciado');
        }

        $pregunta = new Pregunta;
        // $preguntas = Pregunta::with('encuesta')->get();
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
        $request->session()->flash('message', 'Pregunta guardada exitosamente!');

        // return view('Pregunta.create', ['encuesta'=>$encuesta, 'preguntas'=>$preguntas]);
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
        $encuesta = Encuesta::find($pregunta->encuesta()->get()[0]->id);
        return view('pregunta.edit', ['encuesta'=>$encuesta,'pregunta'=>$pregunta]);
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
        $idEncuesta = $pregunta->encuesta()->get()[0]->id;
        $pregunta->enunciado = $request->get('enunciado');
        $pregunta->save();
        $request->session()->flash('message', 'Pregunta actualizada exitosmente!');

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
        $pregunta->forceDelete();

        //$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        $request->session()->flash('error', 'Pregunta borrada exitosamente');
        return $this->create($idEncuesta);
    }
}
