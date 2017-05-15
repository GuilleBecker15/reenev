$('document').ready(function(){
	
	combo = document.getElementById('generacion');
	
	var hoy = new Date();
	var html = "";
	
	for (var i = 2008; i <= hoy.getFullYear() ; i++) {
		html =  html + '<option value="' + i + '">'+ i +'</option>'
	}
	
	combo.innerHTML = html;

	$('#modificarDatos').click(function(e){
		e.preventDefault();

			var datos 			= document.getElementById('formularioModificacion');
			var url 			= datos.getAttribute('action');
			var datos 			= {};
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

			$.ajax({
				type: 	"PUT",
				url:   	url,
				data: 	datos,
				cache: 	false,
				dataType: 'json',
					 
			}).always(function(response, status){
				console.log(response);
				console.log('---------------------------------');
				console.log(status);
				console.log('---------------------------------');
				if(response.status == '442'){
					console.log('contrasenia no coincide');
				} else if(response.status == '500'){
					console.log('Error interno del server');
					}
					else{
					//location.reload();						
					}
			});

			return false;

	});

});

var inputs = document.querySelectorAll('input[type=fecha]');

for (var i=0, l=inputs.length; i<l; i++) {

	var input = inputs[i];
	var tipo = input.getAttribute('type');
	var valor = input.value;

	switch (tipo.toLowerCase()) {

		case 'fecha':

			//console.log(input, 'Es del tipo fecha');

			input.setAttribute('placeholder','dd/mm/aaaa');
			input.setAttribute('maxlength','10');
			input.setAttribute('pattern','\\d{2}\\/\\d{2}\\/\\d{4}');

		break;

	}

}

function validarFecha(id) {

	var input = document.getElementById(id);
	var atributos = input.value.split('/');

	var dd = atributos[0];
	var mm = atributos[1];
	var aaaa = atributos[2];

	if (!fechaValida(aaaa,mm,dd)) {
		document.getElementById(id).value = "";
	}

}

function fechaValida(aaaa,mm,dd) {

	//Note: The supported range is from '1000-01-01' to '9999-12-31'

	if (isNaN(aaaa)||isNaN(mm)||isNaN(dd)) return false;

	if (aaaa<1000||aaaa>9999) return false;
	if (mm<01||mm>12) return false;
	if (dd<01||dd>31) return false;
	
	return true;

}

function habilitar_o_no() {
	
	var cadena_ids = "name1,name2,apellido1,apellido2,nacimiento,generacion,ci,email,modificar,cambiarPass"
	var verModificar = document.getElementById("verModificar");
    var opcion = verModificar.options[verModificar.selectedIndex].value;
	var arreglo_ids = cadena_ids.split(',');

    for (var i=0, l=arreglo_ids.length; i<l; i++) {

    	var id = arreglo_ids[i];
    	var input = document.getElementById(id);

    	if (opcion=='si' && input.getAttribute('disabled')) {
    		input.removeAttribute('disabled');
    	} else {
    		input.setAttribute('disabled','disabled');
    	}

    }

}

/*	$(document).ready(function(){
		$("#myModal").modal('show');
	});*/
	$("#modificar").click(function() {
		$("#myModal").modal('show');		
	});












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