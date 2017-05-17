<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ url($route) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div data-toggle="tooltip" title="{{ $title }}" class="input-group">
                <input name="q" id="q" type="text" class="form-control" placeholder="Columna de esta tabla">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-th-large"></span>
                        <span class="sr-only">Acciones</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Nuevo curso</a></li>
                        <li><a href="#">Nuevo docente</a></li>
                        <li><a href="#">Nueva encuesta</a></li>
                    </ul>
                </span>
            </div>
        </form>
    </div>
</div>
<hr>
