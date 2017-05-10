@extends('layouts.app')

@section('title', 'Perfil - Reenev')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
            	
                <!-- @if (Auth::user()->esAdmin)
                	<div class="panel-heading">
                		<strong>Admin de Reenev :</strong>
                		{{ Auth::user()->name }} {{ Auth::user()->apellido }}
                	</div>
                @else
                	<div class="panel-heading">
                		<strong>Estudiante del TIP :</strong>
                		{{ Auth::user()->name }} {{ Auth::user()->apellido }}
                	</div>
                @endif -->

                <div class="panel-heading">
                    
                    <center><h1>Perfil de '{{ Auth::user()->name1 }}'</h1></center>

                </div>
                
                <div class="panel-body">

                    <p>Aca irian todos los datos del perfil</p>

                </div>
            
            </div>
        
        </div>
    
    </div>

</div>
@endsection
