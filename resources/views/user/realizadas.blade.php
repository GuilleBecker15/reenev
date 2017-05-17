@extends('layouts.app')
@section('title', 'Encuestas completadas')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Encuestas completadas</h1></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha de cuando la completaste</th>
                                </tr>
                            </thead>
                            @foreach ($realizadas as $key => $realizada)
                            <tbody>
                                <tr>
                                    <td>{{ $realizada->id }}</td>
                                    <td>{{ $realizada->cuando }}</td>
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
