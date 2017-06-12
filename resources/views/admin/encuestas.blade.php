@extends('layouts.app')
@section('title', 'Encuestas')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h1>{{ $h1 }}</h1>
                </div>
                <div class="panel-body">

                @include('admin.toolbar')
                @if(Session::has('message'))
                    <div class="alert alert-success success-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            {{ Session::get('message') }}
                    </div>
                @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha inicial</th>
                                    <th>Fecha limite</th>
                                    <th>Asunto</th>
                                    <th>Descripcion</th>
                                </tr>
                            </thead>
                            @foreach ($encuestas as $key => $encuesta)
                            <tbody>
                                <tr>
                                    <td>{{ $encuesta->id }}</td>
                                    <td>{{ $encuesta->uyInicioVence($encuesta->inicio) }}</td>
                                    <td>{{ $encuesta->uyInicioVence($encuesta->vence) }}</td>
                                    <td>{{ $encuesta->asunto }}</td>
                                    <td>{{ $encuesta->descripcion }}</td>
                                    <td>
                                        {{ Form::open(['method' => 'GET', 'route' => ['Encuestas.show', $encuesta->id]]) }}
                                        <!-- {{ Form::hidden('id', $encuesta->id) }} -->
                                        {{ Form::submit('Ver', ['class' => 'btn btn-xs btn-info']) }}
                                        {{Form::close()}}
                                    </td>
                                    <td>
                                        {{ Form::open(['method' => 'POST', 'route' => ['Encuestas.destroy', $encuesta->id]]) }}
                                        {{ method_field('DELETE') }}
                                        {{ Form::submit('Borrar', ['class' => 'btn btn-xs btn-danger']) }}
                                    </td>
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
