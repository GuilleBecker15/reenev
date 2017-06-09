<?php

namespace App\Http\Controllers;

use App\Http\Traits\Utilidades;
use App\Realizada;
use App\Encuesta;
use App\Docente;
use App\Curso;
use App\User;
use Illuminate\Http\Request;
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
        //Hacer?
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $encuestas = Encuesta::all();
        $docentes = Docente::all();
        $cursos = Curso::all();

        return view('realizada.elegir',
                ['encuestas' => $encuestas,
                'docentes' => $docentes,
                'cursos' => $cursos]);
    }

    public function continuar(Request $request)
    {

        if ($this->cursoNoValido($request)) {
            $request->session()->flash('message', 'XXX no dicta el curso YYY');
            return $this->create();
        }

        $encuesta = null;
        $docente = null;
        $curso = null;

        return view('realizada.create', compact('encuesta', 'docente', 'curso'));
    
    }

    public function cursoNoValido()
    {
        return false;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Realizada $realizada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Realizada  $realizada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Realizada $realizada)
    {
        //
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
}
