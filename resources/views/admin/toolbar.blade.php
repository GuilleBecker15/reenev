<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ url($route) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div data-toggle="tooltip" class="input-group">
                <input title="Puedes escribir un {{ $title }}" autofocus name="consulta" id="consulta" type="text" class="form-control" placeholder="Escribe algun dato" value="{{ $c }}">
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
                        <li><a href="{{ route('Cursos.create') }}"><span class="glyphicon glyphicon-book"></span> Nuevo curso</a></li>
                        <li><a href="{{ route('Docentes.create') }}"><span class="glyphicon glyphicon-user"></span> Nuevo docente</a></li>
                        <li><a href="{{ route('Encuestas.create') }}"><span class="glyphicon glyphicon-stats"></span> Nueva encuesta</a></li>
                    </ul>
                </span>
            </div>
        </form>
    </div>
</div>
<hr>
