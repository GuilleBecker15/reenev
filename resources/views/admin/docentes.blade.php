@extends('layouts.app')
@section('title', 'Administrar Docentes')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Administrar Docentes</h1></div>
                <div class="panel-body">
                <div class="row">
                  
                  <div class="col-md-8">

                      <form class="navbar-form navbar-left">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Apellido o C.I.">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Buscar</button>
                          </span>
                        </div>
                      </form>

                      </div>
                  <div class="col-md-4">
                      <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Tareas administrativas <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="#">Crear un curso</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Ayuda</a></li>
                          </ul>
                        </li>
                      </ul>

                  </div>

                </div>

                <hr>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>eMail</th>
                                    <th>C.I.</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                </tr>
                            </thead>
                            @foreach ($docentes as $key => $docente)
                            <tbody>
                                <tr>
                                    <td>{{ $docente->id }}</td>
                                    <td>{{ $docente->email }}</td>
                                    <td>{{ $docente->ci }}</td>
                                    <td>{{ $docente->nombre }}</td>
                                    <td>{{ $docente->apellido }}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
