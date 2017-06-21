@extends('layouts.app')
@section('title', 'Encuestas')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>{{ $h1 }}</h1>
                    @include('layouts.flashes')
                </div>
                <div class="panel-body">
                @include('admin.toolbar')
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
                                    <td> <div>
                                      {{ Form::open(['method' => 'GET', 'route' => ['Encuestas.show', $encuesta->id]]) }}
                                        {{ Form::hidden('id', $encuesta->id) }}
                                        {{ Form::submit('Ver', ['class' => 'btn btn-xs btn-info']) }}
                                        {{Form::close()}}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                        {{ Form::open(['method' => 'DELETE', 'route' => ['Encuestas.destroy', $encuesta->id]]) }}
                                        {{ Form::hidden('id', $encuesta->id) }}
                                        {{ Form::submit('Borrar', ['class' => 'btn-xs btn btn-danger borrado_confirm']) }}
                                        {{Form::close()}}
                                        </div>
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
@include('layouts.modalconfirmacion')
<script>
    let borrado                 = document.getElementsByClassName('borrado_confirm');
    let ventana_confirmacion    = document.getElementsByClassName('modalmio')[0];
    let boton_cerrar            = document.getElementsByClassName('cerrarModal');
    let aceptar             =document.getElementById('aceptarBorrado');
    let idForm;
    for (let i = 0, l = boton_cerrar.length; i < l; i++){
        boton_cerrar[i].addEventListener('click', function (evt){
            ventana.classList.remove('activo');
        });
    }

    for (let i = 0, l = borrado.length; i < l; i++){
        borrado[i].addEventListener('click', function(evt){
            evt.preventDefault();
            ventana_confirmacion.classList.add('activo');
            idForm = borrado[i].parentElement;                                  
        });
    }

    aceptar.addEventListener('click',function(evt){
        idForm.submit();
        ventana_confirmacion.classList.remove('activo');
        waitingDialog.show('Por favor espere', {dialogSize: 'sm', progressType: 'success'});
        setTimeout(function () {waitingDialog.hide();}, 15000 );
    });


</script>   

@endsection
