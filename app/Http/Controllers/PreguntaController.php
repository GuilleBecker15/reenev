<?php

namespace App\Http\Controllers;

use App\Encuesta;
use App\Pregunta;
use Validator;

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
        //$this->authorize('es_admin', User::class);

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
        //$this->autorize('es_admin', User::class);

        $validator = Validator::make($request->all(),[
            'enunciado' => 'required|string|max:255',
            // 'enunciado' => Rule::unique('preguntas'),
 
          ]);

        if($validator->fails()){
            redirect('Pregunta.create',['id'=>$id])->whitErrors($validator,'enunciado');
        }

        $encuesta = Encuesta::findOrFail($id);
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
        $request->session()->flash('message', 'Pregunta guardada con exito!');

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
        //$this->authorize('es_admin', User::class);
        $pregunta = Pregunta::findOrFail($id_pregunta);
        $encuesta = Encuesta::find($pregunta->encuesta()->get()[0]->id);
        return view('Pregunta.edit', ['encuesta'=>$encuesta,'pregunta'=>$pregunta]);
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
        $pregunta = Pregunta::findOrFail($idPreg);
        $idEncuesta = $pregunta->encuesta()->get()[0]->id;
        $pregunta->enunciado = $request->get('enunciado');
        $pregunta->save();
        $request->session()->flash('message', 'Pregunta actualizado con exito!');

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
        //$this->autorize('es_admin', User::class);
        $pregunta = Pregunta::findOrFail($idPregunta);
        $idEncuesta = $pregunta->encuesta()->get()[0]->id;  
        $pregunta->delete();

        //$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        $request->session()->flash('error', 'Pregunta borrada con exito!');
        return $this->create($idEncuesta);
    }
}
