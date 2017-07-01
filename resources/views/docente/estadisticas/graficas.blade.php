@extends('layouts.app')
@section('title', 'Graficos estadisticos de un docente')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<h1>
	                	Estadísticas del docente
	                	<a href="">
							{{$docente->nombre}} {{$docente->apellido}}
	                	</a>
                	</h1>
                </div>
                <div id="chartparent" class="panel-body">
	                <!-- <ul class="nav nav-tabs">
		                <li class="active">
		                	<a href="/Docentes/estadisticas/{{$docente->id}}/graficas">
		                	Gráficas</a>
		                </li>
		                <li>
		                	<a href="/Docentes/estadisticas/{{$docente->id}}/exportar">
		                	Exportar</a>
		                </li>
		                <li><a href="#">Enviar</a></li>
	                </ul> -->
					@foreach ($encuestas as $encuesta)
        				@if ($encuesta->preguntas->count()>0)
					       	<h3>
					       		<a href="">
					        		{{$encuesta->asunto}}
					        	</a>
					        </h3>
					       	<p>{{$encuesta->descripcion}}</p>
					       	<p><strong>- A completarse entre el
					       	{{$encuesta->uyInicioVence($encuesta->inicio)}}
					       	y el
					       	{{$encuesta->uyInicioVence($encuesta->vence)}} -
					       	</strong></p>
						    @foreach ($cursos as $curso) 
							    @include('docente.estadisticas.chart_preguntas')
							    <div class="grafica" id="chart_div_{{$encuesta->id}}{{$curso->id}}"></div>
							    <div>
								    <i class="fa fa-paperclip" aria-hidden="true"></i>
								    <a id="mail" onclick="verCcMail({{$curso->id}});" href="#formcopias">Enviar por e-Mail</a>
							    </div>


								<div id="formcopias{{$curso->id}}" class="formcopias">
									

								    <form id="formulario{{$curso->id}}" class="formulario" action="/prueba/{{$docente->id}}/{{$encuesta->id}}/{{$curso->id}}" method="get">
								    	<label style="text-align: center" class="col-md-12 control-label">Si desea realizar una copia del email ingrese cada una de los destinatarios separados por un espacio</label>
								    	<input class="form-control" id="copias" name="copias" placeholder="ejemplo@ejemplo.com example@example.com">
								    	<div id="btnAceptar">
											<button type="submit" class="btn btn-primary">Aceptar</button>
										</div>
								    </form>


							    </div>


							    <div>
								    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
								    <a target="_blank" href="/Docentes/exportar/{{$docente->id}}/{{$encuesta->id}}/{{$curso->id}}">Exportar a PDF</a>
							    </div>
							    <hr>
						    @endforeach
					    @endif
				    @endforeach
				    <center><p>
				    @if ($encuestas->count()==0)
				    	Este docente aun no ha generado estadísticas
				    @else
				    	Fin de las estadísticas para este docente
				    @endif
				    </p></center>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css" media="screen">
	.formcopias {
		opacity: 	0;
		visibility: hidden;
		display: none;
		transition: opacity .6s, visibility .6s;

	}

	.formcopias.activo {
		opacity: 	1;
		visibility: visible;
		
	}
	
	.formcopias.display {
		display: block;
	}

	div#btnAceptar{
	    text-align: center;
	    margin-top: 1rem;
	}
</style>
<script type="text/javascript">
	function verCcMail(cursoID){
		let form = document.getElementById("formcopias"+cursoID);
		let clases = form.className.split(" ");
		let existe = "";
		for (let i = 0; i < clases.length; i++){
			if(clases[i] == 'activo'){
				console.log(clases[i]);
				existe = 's';
				break;
			}
		}
		if(existe == 's'){
			form.classList.remove('activo')
			setTimeout(c => form.classList.remove('display'),601);
			// form.classList.remove('activo');
		}
		else{
			form.classList.add('display')
			// form.classList.add('activo');
			setTimeout(c => form.classList.add('activo'), 10);
		}
	}

	let form = document.getElementsByClassName("formulario");
	let divform = document.getElementsByClassName("formcopias");
	// let formulario = 
	let iterador = 0;
	while ( iterador < form.length ) {
		form[iterador].addEventListener('submit', function (evt){
			console.log("variable v: " + iterador); 
			console.log(form); 
			console.log(evt); 
			console.log(evt.target); 
			evt.preventDefault();
			console.log(validarMail(evt.target));
			if(validarMail(evt.target)){
				evt.target.submit();
			}else{
				evt.target.parentElement.classList.add('has-error');
				// let btnAceptar = document.getElementById('btnAceptar');
				let span = document.createElement('span');
				let strong = document.createElement('strong');
				let texto = document.createTextNode('Compruebe los email ingresados, uno de ello no corresponde a una direccion de email valida');
				span.classList.add('help-block');
				span.appendChild(strong);
				strong.appendChild(texto);
				evt.target.insertBefore(span, evt.target.childNodes[5]);
				// divform.appendChild(span);
			}
		});
		iterador++;
	}

	function validarMail(form){
		// let form = document.getElementById('formcopias');
		// form[0].getElementsByTagName('input')
		console.log("dentr de validar");
		console.log(form);
		console.log("-----------");
		let input= form.getElementsByTagName('input');
		let texto = input[0].value.trim().split(" ");
		let valido = true;
		let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		for (let i = 0; i < texto.length; i++){
			if(texto[i]==""){
				texto.splice(i,1);
				i--;
			}
			
				console.log("est0", texto[i]);
		  	if(!re.test(texto[i])){
		  		return false;
		  	}
		}
		console.log("texto: ", texto);
  		return true;
		
	}

</script>
@endsection
