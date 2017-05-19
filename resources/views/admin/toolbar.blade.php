<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ url($route) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div data-toggle="tooltip" class="input-group">
                <input title="Puedes escribir un {{ $title }}" autofocus required name="consulta" id="consulta" type="text" class="form-control" placeholder="Cualquier dato" value="{{ $c }}">
                <input type="hidden" name="q" id="q" class="form-control">
                <span class="input-group-btn">
                    <button id="btn-buscar" type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-option-vertical"></span>
                        <span class="sr-only">Acciones</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('Cursos.create') }}"><span class="glyphicon glyphicon-education"></span> Nuevo curso</a></li>
                        <li><a href="{{ route('Docentes.create') }}"><span class="glyphicon glyphicon-user"></span> Nuevo docente</a></li>
                        <li><a href="{{ route('Encuestas.create') }}"><span class="glyphicon glyphicon-stats"></span> Nueva encuesta</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#"><span class="glyphicon glyphicon-info-sign"></span> Cursos eliminados</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-info-sign"></span> Docentes eliminados</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-info-sign"></span> Encuestas eliminadas</a></li>
                        <li><a href="{{ url('Users/borrados', true) }}"><span class="glyphicon glyphicon-info-sign"></span> Usuarios eliminados</a></li>
                    </ul>
                </span>
            </div>
        </form>
    </div>
</div>
<hr>
