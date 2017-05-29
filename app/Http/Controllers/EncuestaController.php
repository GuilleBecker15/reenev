<?php

namespace App\Http\Controllers;

use App\Encuesta;
use App\Http\Traits\Utilidades;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;


class EncuestaController extends Controller
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
        
        $route = Route::getFacadeRoot()->current()->uri().'/buscar'; //No esta en buscar
        
        $encuestas = Encuesta::all();
        
        $title = "ID, Fecha inicial, Fecha limite, Asunto o Descripcion"; //Para el tooltrip

        $c = "";

        return view(
            'admin.encuestas',
            ['encuestas' => $encuestas, 'route' => $route, 'title' => $title, 'c' => $c]);
    
    }

    public function buscar(Request $request)
    {

        $this->authorize('es_admin', User::class);
        
        $route = Route::getFacadeRoot()->current()->uri(); //Ya esta en buscar
        
        $encuestas1 = Encuesta::where('id', 'like','%'.$request->get('q').'%')->get();
        $encuestas2 = Encuesta::where('inicio', 'like','%'.$request->get('q').'%')->get();
        $encuestas3 = Encuesta::where('vence', 'like','%'.$request->get('q').'%')->get();
        $encuestas4 = Encuesta::where('asunto', 'like','%'.$request->get('q').'%')->get();
        $encuestas5 = Encuesta::where('descripcion', 'like','%'.$request->get('q').'%')->get();

        $encuestas =
        $encuestas5->merge(
            $encuestas4->merge(
                $encuestas3->merge(
                    $encuestas2->merge(
                        $encuestas1))));

        $title = "ID, Fecha inicial, Fecha limite, Asunto o Descripcion"; //Para el tooltrip

        $c = $request->consulta;

        return view(
            'admin.encuestas',
            ['encuestas' => $encuestas, 'route' => $route, 'title' => $title, 'c' => $c]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('encuesta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inicio = Carbon::now()->toDateString();  // 1975-12-25
        $vence = $this->sqlDateFormat($request->get('vence'));

        /*$encuesta = Encuesta::newModelInstance();
        $encuesta->asunto = $request->get('asunto');
        $encuesta->descripcion = $request->get('descripcion');
        $encuesta->vence = $vence;
        $encuesta->inicio = $inicio;
        $encuesta->save();*/

        $data = [
            'asunto'=>$request->get('asunto'),
            'descripcion'=>$request->get('descripcion'),
            'inicio'=>$inicio,
            'vence'=>$vence,
        ];

        $encuesta = Encuesta::create($data)->id;

        return $this->edit($encuesta);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $encuesta = Encuesta::findOrFail($id);
        $encuesta->vence = $this->uyDateFormat($encuesta->vence);
        return view('encuesta.show', ['encuesta' => $encuesta]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return view('encuesta.edit', compact($encuesta));
        $encuesta = Encuesta::findOrFail($id);
        $encuesta->vence = $this->uyDateFormat($encuesta->vence);
        // return View::make('encuesta.edit', ['id'=>$encuesta->id])->with('encuesta', $encuesta);        
        return view('encuesta.edit', ['id'=>$encuesta->id])->with('encuesta', $encuesta);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$algo = $request->all();
        // return $this->show($id);
        return view('encuesta.show', ['encuesta' => $request]);
        /*$encuesta = Encuesta::findOrFail($id);

        $encuesta->asunto = $request->get('asunto');
        $encuesta->descripcion = $request->get('descripcion');
        $encuesta->vence = $this->sqlDateFormat($request->vence);

        if(Request::exists('descPregunto0')){
            //public function toArray()
        }

        $encuesta->save();*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Encuesta $encuesta)
    {
        //
    }
}
