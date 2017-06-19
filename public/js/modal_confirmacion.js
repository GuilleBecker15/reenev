let borrado					= document.getElementsByClassName('borrado_confirm');
let ventana_confirmacion 	= document.getElementsByClassName('modalmio')[0];
let boton_cerrar			= document.getElementsByClassName('cerrarModal');

for (let i = 0, l = borrado.length; i < l; i++){
	borrado[i].addEventListener('click', function(evt){
		alert("esto seria un modal");
	});
}