@extends('layouts.app')
@section('title', 'Administrar Encuestas')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Administrar Encuestas</h1></div>
                <div class="panel-body">
                <div class="row">
                  
                  <div class="col-md-12">

                      <form class="navbar-form navbar-left">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Asunto o descripcion">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Buscar</button>
                          </span>
                        </div>
                      </form>
                      
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
                                    <th>Inicia</th>
                                    <th>Vence</th>
                                    <th>Asunto</th>
                                    <th>Descripcion</th>
                                </tr>
                            </thead>
                            @foreach ($encuestas as $key => $encuesta)
                            <tbody>
                                <tr>
                                    <td>{{ $encuesta->id }}</td>
                                    <td>{{ $encuesta->inicio }}</td>
                                    <td>{{ $encuesta->vence }}</td>
                                    <td>{{ $encuesta->asunto }}</td>
                                    <td>{{ $encuesta->descripcion }}</td>
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
