<?php

namespace App\Http\Controllers;

use App\Encuesta;
use App\Http\Traits\Utilidades;
use App\Pregunta;
use App\Realizada;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Validator;

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
    	
        $routeEntera = Route::getFacadeRoot()->current()->uri(); //No esta en buscar
        $routeSeparada = explode('/', $routeEntera);

        if (last($routeSeparada)!='buscar') {
        	$route = implode('/', $routeSeparada);
        	$route = $route.'/buscar';
        } else {
        	$route = implode('/', $routeSeparada);
        }
        
        $encuestas = Encuesta::all();

        $h1 = "Encuestas disponibles";
        
        $title = "ID, Fecha inicial, Fecha limite, Asunto o Descripcion"; //Para el tooltrip

        $c = "";

        // return view(
        //     'admin.encuestas',
        //     ['encuestas' => $encuestas, 'route' => $route,
        //     'title' => $title, 'c' => $c, 'h1' => $h1]);

        return view('admin.encuestas', compact('encuestas', 'route', 'title', 'c', 'h1'));
        
    }

    public function buscar(Request $request)
    {

    	$this->authorize('es_admin', User::class);
    	
        $route = Route::getFacadeRoot()->current()->uri(); //Ya esta en buscar
        
        $query = $request->get('q');
        if (!$query) return $this->index();

        $encuestas = collect([]);

        if (is_numeric($query)) {
        	$encuestas = Encuesta::where('id', $query)->get();
        } else if ($this->es_fecha($query)) {
        	$encuestas = Encuesta::where('inicio', $query)
        	->orWhere('vence', $query)->get();
        } else {
        	$encuestas = Encuesta::where('asunto', 'like', '%'.$query.'%')
        	->orWhere('descripcion', 'like', '%'.$query.'%')->get();
        }

        $h1 = "Se encontraron ".$encuestas->count()." encuestas";

        if ($encuestas->count()==0) $h1 = "No se encontraron encuestas";

        $title = "ID, Fecha inicial, Fecha limite, Asunto o Descripcion"; //Para el tooltrip

        $c = $request->consulta;

        // return view(
        //     'admin.encuestas',
        //     ['encuestas' => $encuestas, 'route' => $route,
        //     'title' => $title, 'c' => $c, 'h1' => $h1]);

        return view('admin.encuestas', compact('encuestas', 'route', 'title', 'c', 'h1'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$this->authorize('es_admin', User::class);
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

    	$this->authorize('es_admin', User::class);

        $inicio = Carbon::now()->toDateString();  // 1975-12-25

        $validator = Validator::make($request->all(), [
        	'vence' => 'required|date|after:today',
        	'asunto' => 'required|string|max:50',
        	'descripcion' => 'required|string|max:100',
        	]);

        if ($validator->fails()) {
        	$request->session()->flash('error', 'Encuesta no creada');
        	return redirect('Encuestas/create')->withErrors($validator)->withInput();
        }

        $data = [
        'asunto' => $request->get('asunto'),
        'descripcion' => $request->get('descripcion'),
        'inicio' =>$inicio,
        'vence' => $request->get('vence')
        ];

        $ultima_encuesta = Encuesta::all()->sortBy('updated_at')->last();
        
        $encuesta = Encuesta::create($data);

        if ($ultima_encuesta) {

        	$ultimas_preguntas = $ultima_encuesta->preguntas()->get()->toArray();

        	foreach ($ultimas_preguntas as $u_p) {
        		$pregunta = new Pregunta;
        		$n = $encuesta->preguntas()->count();
        		$pregunta->encuesta()->associate($encuesta);
        		$pregunta->numero = $n+1;
        		$pregunta->enunciado = $u_p['enunciado'];
        		$pregunta->save();
        	}

        }

        return $this->show($encuesta->id);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$this->authorize('es_admin', User::class);
    	$encuesta = Encuesta::findOrFail($id);
    	$preguntas = Pregunta::where('encuesta_id',$id)->get();
    	$cant = $preguntas->count();
    	$encuesta->vence = $this->uyDateFormat($encuesta->vence);
    	$encuesta->inicio = $this->uyDateFormat($encuesta->inicio);
        // return view('encuesta.show', ['encuesta' => $encuesta,'preguntas'=>$preguntas,'cant'=>$cant]);
    	return view('encuesta.show', compact('encuesta', 'preguntas', 'cant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$this->authorize('es_admin', User::class);
    	$encuesta = Encuesta::findOrFail($id);        
    	return view('encuesta.edit', ['id' => $encuesta->id])->with('encuesta', $encuesta);
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

    	$this->authorize('es_admin', User::class);

    	$encuesta = Encuesta::findOrFail($id);

    	$encuesta->asunto = $request->get('asunto');
    	$encuesta->descripcion = $request->get('descripcion');
    	$encuesta->vence = $request->get('vence');
    	
    	$validator = Validator::make($request->all(), [
    		'vence' => 'required|date|after:inicio',
    		'asunto' => ['required', 'string', 'max:50',
    		Rule::unique('encuestas')->ignore($encuesta->id),],
    		'descripcion' => ['required', 'string', 'max:100',
    		Rule::unique('encuestas')->ignore($encuesta->id),],
    		]);

    	if ($validator->fails()) {
    		$request->session()->flash('error','Encuesta no actualizada');
    		return redirect('Encuestas/'.$id.'/edit')->withErrors($validator)->withInput();
    	}

    	$encuesta->save();

    	return $this->show($id);
    	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
    	
    	$this->authorize('es_admin', User::class);
    	
    	$encuesta = Encuesta::findOrFail($id);

    	if (Realizada::where('encuesta_id', $id)->get()->isNotEmpty()) {
    		$request->session()->flash('error',
    			"La encuesta '".$encuesta->asunto."' ya ha generado estadísticas");
    		return $this->index();
    	}

    	// $encuesta->preguntas()->delete();
    	$encuesta->preguntas()->forceDelete();
    	
        // $encuesta->delete();
    	$encuesta->forceDelete();
    	
    	$request->session()->flash('message',
    			"La encuesta '".$encuesta->asunto."' ha sido eliminada");
    	return $this->index();

    }

    public function completadas()
    {

    	$this->authorize('es_admin', User::class);

    	$realizadas = Realizada::all()->reject(function ($item, $key) {
    		$user = User::find($item->user_id);
    		return !$user;
    	});

    	return view('encuesta.realizadas', compact('realizadas'));
    	
    }

}
