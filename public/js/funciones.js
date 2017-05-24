/*VARIABLES REUTILIZABLES*/

var border_error = 'border-color:Tomato;';
var border_ok = 'border-color:Lime;';
var patron_fecha = /\d{2}\/\d{2}\/\d{4}/g;
var patron_cedula = /\d{1}[.]\d{3}[.]\d{3}[-]\d{1}/g;

var cadena_ids = "name1,name2,apellido1,apellido2,nacimiento,generacion,ci,email,modificar,cambiarPass,pass";

var arreglo_ids = cadena_ids.split(',');

/*FORMATEO DE CAMPOS DEL DOCUMENTO*/

$('document').ready( function() {
	
	var combo = document.getElementById('generacion');
	
	if (combo) {

		var valor = combo.getAttribute('value');
	
		var hoy = new Date();
		var html = ""; //Luego se concatenara
		var selected = false;

		if (isNaN(valor)) valor = 2008; //No es lo mismo que "i"

		for (var i=2008; i<=hoy.getFullYear(); i++) {
			
			if (i==valor && valor>2008 && !selected) {

				html =  html + '<option selected value="' + i + '">'+ i +'</option>';
				selected = true;

			} else {

				html =  html + '<option value="' + i + '">'+ i +'</option>';
			
			}
		
		}
		
		combo.innerHTML = html;

	}

	/*$(document).on('click','.btn-modificar',function(e){
		$('#myModal').modal('show');
	});

	$('#modificarDatos').click(function(e){
		e.preventDefault();
			$('#myModal').modal('hide');
			var datos 			= document.getElementById('formularioModificacion');
			var url 			= datos.getAttribute('action');
			var datos 			= {};
			var token			= $('[name="_token"]').val();
			datos.name1 		= $('#name1').val();
			datos.name2 		= $('#name2').val();
			datos.apellido1 	= $('#apellido1').val();
			datos.apellido2 	= $('#apellido2').val();
			datos.nacimiento 	= $('#nacimiento').val();
			datos.generacion 	= $('#generacion').val();
			datos.email 		= $('#email').val();
			datos.ci 			= $('#ci').val();
			datos.confirmarPass = $('#confirmarPass').val();
			console.log(datos);
			console.log(token);

			

			$.ajax({
				type: 	'post',
				url:   	url,
				data: 	JSON.stringify(datos),
				dataType: 'json',
				async : true,
				cache : false,
				headers: {'X-CSRF-TOKEN': token,
						'Content-Type': 'application/json'
				},
				success: function(response){
					console.log("Repuest bien");
					console.log(response);

				},
				error: function(response){
					console.log("paso un error");
					console.log(response);
				} 
			});

			// return false;
	});*/

	/*$('#modificarDatos')
	var ultimo = document.getElementById('divpass')
	var string = ultimo.outerHTML
	todo = document.getElementById('divaniadir').innerHTML = string*/

	/*$("#formularioModificacion").submit(function(e) {
		e.preventDefault();
		$("#myModal").modal('show');
			$("#modificarDatos").click(function() {
				document.getElementById("divpass").style.display = 'none';
				var ultimo = document.getElementById('divpass');
				var string = ultimo.outerHTML;
				todo = document.getElementById('divaniadir').innerHTML = string;
				console.log(todo);
				alert(todo);
			$("#formularioModificacion").unbind('submit').submit();
			});
	});*/

	$("#btn-buscar").click(function (e) {
		// e.preventDefault();
		var consulta = $("#consulta").val();
		var nueva_consulta = procesarCampo(consulta);
		$("#q").val(nueva_consulta);
	});

});

/*$(document).on("submit", "formularioModificacion", function(e){
	e.preventDefault();
	alert('It works!!');
	return false;
});*/

var inputs = document.querySelectorAll('input[type=fecha],input[type=cedula]');

for (var i=0, l=inputs.length; i<l; i++) {

	var input = inputs[i];
	var tipo = input.getAttribute('type');
	var valor = input.value;

	switch (tipo.toLowerCase()) {

		case 'fecha':

			//console.log(input, 'Es del tipo fecha');

			input.setAttribute('placeholder', 'dd/mm/aaaa');
			input.setAttribute('maxlength', '10');
			input.setAttribute('pattern', '\\d{2}\\/\\d{2}\\/\\d{4}');

		break;

		case 'cedula':

			//console.log(input, 'Es del tipo cedula');

			input.setAttribute('placeholder', '1.234.567-8');
			input.setAttribute('maxlength', '11');
			input.setAttribute('pattern', '\\d{1}[.]\\d{3}[.]\\d{3}[-]\\d{1}');

		break;
	
	}

}

function procesarCampo(campo) {
	
	var nuevo_patron_fecha = new RegExp(patron_fecha);
    var es_fecha = nuevo_patron_fecha.test(campo);
        
    if (es_fecha) {
    
    	console.log("es_fecha");
    
    	return sqlDateFormat(campo);
    
    }

    return campo;

}

function sqlDateFormat(uyDateFormat) {

	//Recibe "dd/mm/aaaa" y retorna "aaaa-mm-dd"

    var arreglo = uyDateFormat.split('/')
        
    var dd = arreglo[0];
    var mm = arreglo[1];
    var aaaa = arreglo[2];

    return aaaa+"-"+mm+"-"+dd;

}

/*ASIGNACION DE EVENTOS A CAMPOS EXISTENTES*/

for (var i=0, l=arreglo_ids.length; i<l; i++) {

	var id = arreglo_ids[i];
	var input = document.getElementById(id);

	if (input) input.addEventListener("keyup", validarCampos);

}

/*VALIDACIONES DE CAMPOS*/

function validarCampos() {

	var nacimiento_ok = validarFecha('nacimiento');
	var ci_ok = validarCedula('ci');

	if (nacimiento_ok && ci_ok) return true;
	return false;

}

//******************************************

function validarFecha(id) {

	var input = document.getElementById(id);

	if (!input) return true;

	var fecha = input.value;
	var atributos = fecha.split('/');

	var dd = atributos[0];
	var mm = atributos[1];
	var aaaa = atributos[2];
	var patron = new RegExp(patron_fecha);
    var bien_formada = patron.test(fecha);

	if (!fechaValida(aaaa,mm,dd) || !bien_formada) {
		
		input.setAttribute ('style',border_error);
		return false;
	
	} 

	input.setAttribute ('style',border_ok);
	return true;

}

function fechaValida(aaaa,mm,dd) {

	//Note: The supported range is from '1000-01-01' to '9999-12-31'

	if (isNaN(aaaa)||isNaN(mm)||isNaN(dd)) return false;

	if (aaaa<1000||aaaa>9999) return false;
	if (mm<01||mm>12) return false;
	if (dd<01||dd>31) return false;
	
	return true;

}

//******************************************

function validarCedula(id) {

	var input = document.getElementById(id);

	if (!input) return true;

	var cedula = input.value;
	var patron = new RegExp(patron_cedula);
    var bien_formada = patron.test(cedula);

	if (!cedulaValida(cedula) || !bien_formada) {
		
		input.setAttribute ('style',border_error);
		return false;
	
	} 

	input.setAttribute ('style',border_ok);
	return true;

}

function cedulaValida(ci) {
	
	ci = ci.replace(/\D/g, '');
	var digito = ci[ci.length - 1];
	ci = ci.replace(/[0-9]$/, '');
	
	return (digito == digito_verificador(ci));

}

function digito_verificador(ci) {
	
	var a = 0;
	var i = 0;

	if (ci.length <= 6) {

		for (i = ci.length; i < 7; i++) {
			ci = '0' + ci;
		}

	}

	for (i = 0; i < 7; i++) {
		a += (parseInt("2987634"[i]) * parseInt(ci[i])) % 10;
	}

	if (a%10 === 0) {

		return 0;
	
	} else {
		
		return 10 - a % 10;
	
	}

}

//******************************************

function habilitar_o_no() {
	

	// var verModificar = document.getElementById("verModificar");

	// if (!verModificar) return;

    // var opcion = verModificar.options[verModificar.selectedIndex].value;

    for (var i=0, l=arreglo_ids.length; i<l; i++) {

    	var id = arreglo_ids[i];
    	var input = document.getElementById(id);

    	if (!input) return;

    	if (input.getAttribute("disabled")=="") input.removeAttribute('disabled');
    	else input.setAttribute("disabled","");
    	
    }

}

/*	$(document).ready(function(){
		$("#myModal").modal('show');
	});*/
	
//---------------------------------------------------//

/*var inputemail = document.getElementById('email');
inputemail.addEventListener('change', validarEmail);
function vaildarEmail(evt){
	var texto = inputemail.value, xhr = new XMLHttpRequest();
	xhr.onload = function(evt){
		var resultado = xhr.responseText;
		//------algo algo-----/
	};
	xhr.error = function(evt){
		console.log('error',err);
	};
	xhr.open('GET', 'controladoralgo.php');
	xhr.send({email:texto});

}*/

//---------------------------------------------------//