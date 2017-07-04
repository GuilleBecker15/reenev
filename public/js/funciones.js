var border_error = 'border-color:Tomato;';
var border_ok = 'border-color:Lime;';

var patron_fecha = /\d{2}\/\d{2}\/\d{4}/g;
var patron_cedula = /\d{1}[.]\d{3}[.]\d{3}[-]\d{1}/g;

var cadena_ids = "name1,name2,apellido1,apellido2,nacimiento,generacion,ci,email,modificar,cambiarPass,pass";

var arreglo_ids = cadena_ids.split(',');

let idPregunta = 0;

$('document').ready( function() {

	$('.datepicker').datepicker({
	    format: 'yyyy-mm-dd',
	    language: 'es',
	});
	
	var combo = document.getElementById('generacion');
	
  if (combo) {
		var valor = combo.getAttribute('value');
		var hoy = new Date();
		var html = "<option value='0'>- Sin generación -</option>"; //Luego se concatenara
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
  
	$("#btn-buscar").click(function (e) {
		var consulta = $("#consulta").val();
		var nueva_consulta = procesarCampo(consulta);
		$("#q").val(nueva_consulta);
	});

	// ---------------------------//

  $("#btn-guardar").click(function (e) {
		var vence = $("#vence").val();
		var nuevo_vence = procesarCampo(vence);
		$("#hidden_vence").val(nuevo_vence);
	});
  
	$('.datepicker').datepicker();

  var id = document.getElementById('habilitar');
  
	if(id!=null){
		console.log("se puede habilitar");
		$( ":checkbox" ).trigger( "click" );
		console.log("paso");
	}
  
});

var inputs = document.querySelectorAll('input[type=fecha],input[type=cedula]');

for (var i=0, l=inputs.length; i<l; i++) {
	var input = inputs[i];
	var tipo = input.getAttribute('type');
	var valor = input.value;
	switch (tipo.toLowerCase()) {
		case 'fecha':
			input.setAttribute('placeholder', 'dd/mm/aaaa');
			input.setAttribute('maxlength', '10');
			input.setAttribute('pattern', '\\d{2}\\/\\d{2}\\/\\d{4}');
		break;
		case 'cedula':
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
    var arreglo = uyDateFormat.split('/')
        
    var dd = arreglo[0];
    var mm = arreglo[1];
    var aaaa = arreglo[2];

    return aaaa+"-"+mm+"-"+dd;
}

for (var i=0, l=arreglo_ids.length; i<l; i++) {

	var id = arreglo_ids[i];
	var input = document.getElementById(id);

	if (input) input.addEventListener("keyup", validarCampos);

}

function validarCampos() {

	var nacimiento_ok = validarFecha('nacimiento');
	var ci_ok = validarCedula('ci');

	if (nacimiento_ok && ci_ok) return true;
	return false;

}

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

	if (isNaN(aaaa)||isNaN(mm)||isNaN(dd)) return false;

	if (aaaa<1000||aaaa>9999) return false;
	if (mm<01||mm>12) return false;
	if (dd<01||dd>31) return false;
	
	return true;

}

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

function habilitar_o_no() {
  
    for (var i=0, l=arreglo_ids.length; i<l; i++) {

    	var id = arreglo_ids[i];
    	var input = document.getElementById(id);

    	if (!input) return;

    	if (input.getAttribute("disabled")=="") input.removeAttribute('disabled');
    	else input.setAttribute("disabled","");
    	
    }

}

jQuery("#agregarPregunta").click(function(){
	console.log("entro a la funcion");

    var newQuestion = '<div id=remove'+idPregunta+' class="form-group text-center"><div class="col-md-11"><label type="text" name="pregunta" form="pregunta">Ingrese una pregunta para la encuesta</label></div><span id=close'+idPregunta+' class="col-md-1" onclick="removerPregunta()">x</span></div><div class="form-group"><div class="col-md-12"><input type="text" class="form-control" id=descPregunta'+idPregunta+' placeholder="¿Que pregunta desea formular?"></div></div>';
    jQuery("#agregarUno").append(newQuestion); 
    console.log("Deberia agregar algo");
    console.log(newQuestion);
    idPregunta ++;   
});

function removerPregunta(){
	$('#remove'+idPregunta+'').remove();
}

	window.setTimeout(function() {
    	$(".alert").fadeTo(500, 0).slideUp(500, function(){
        	$(this).remove(); 
    	});
	}, 7000);

let bot_abrir   = document.getElementById('activar');
let ventana     = document.getElementsByClassName('modalmio')[0];
let bots_cerrar = ventana.getElementsByClassName('cerrarYvolver');

if ( document.getElementById('comboDocentesParaCrearCurso').childElementCount == 0) {
    ventana.classList.add('activo');
}

for (let i = 0, l = bots_cerrar.length; i < l; i++)
{
    bots_cerrar[i].addEventListener('click', function (evt)
    {
        history.back();
    })
}
