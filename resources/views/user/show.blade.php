@extends('layouts.app')

@section('title', 'Perfil del usuario')

@section('content')

<div class="container">

  <div class="row">

    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">

      <div class="panel-heading"><h1><strong>Informacion del usuario</strong></h1></div>

        <div class="panel-body">

          @if($user->esAdmin)
          <h2> * Administrador del sistema</h2>
          @endif

          @if(!$user->esAdmin)
          <h2> * Estudiante de la carrera</h2>
          @endif

          <table class="table table-user-information">
            <tbody>
                <tr>
                <td>Primer nombre:</td>
                <td>{{ $user->name1 }}</td>
              </tr>
              <tr>
                <td>Segundo nombre:</td>
                <td>{{ $user->name2 }}</td>
              </tr>
              <td>Primer apellido:</td>
              <td>{{ $user->apellido1 }}</td>
            </tr>
            <tr>
              <td>Segundo apellido:</td>
              <td>{{ $user->apellido2 }}</td>
            </tr>
            <tr>
              <td>Fecha de nacimiento:</td>
              <td>{{ $user->uyNacimiento($user->nacimiento) }}</td>
            </tr>
            <tr>
              <td>Generacion:</td>
              <td>{{ $user->generacion }}</td>
            </tr>
            <tr>
              <td>Cedula:</td>
              <td>{{ $user->ci }}</td>
            </tr>
            <tr>
              <td>Correo electronico</td>
              <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
            </tr>
          </tbody>
        </table>

      </div>

    </div>

  </div>

</div>

</div>

@endsection
