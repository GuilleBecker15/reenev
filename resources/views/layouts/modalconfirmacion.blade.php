<div class="modalmio">
	<div class="overlay cerrar"></div>
	<div class="ventana">
		<a href="#" class="boton-cerrar cerrarModal">x</a>
		<div class="cuerpo text-justify">
			¿Esta seguro que desea realizar esta accion?
		</div>
		<div>
			<div class="row">
				<div class="col-md-6  text-right">
					<a href="#" class="btn btn-success cerrarModal">Cancelar</a>        
				</div>
				<div class="col-md-6 text-center">
					<a id="aceptarBorrado" class="btn btn-info " href="#">Aceptar</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	let borrado                 = document.getElementsByClassName('borrado_confirm');
	let ventana_confirmacion    = document.getElementsByClassName('modalmio')[0];
	let boton_cerrar            = document.getElementsByClassName('cerrarModal');
	let aceptar             = document.getElementById('aceptarBorrado');
	let idForm;
	for (let i = 0, l = boton_cerrar.length; i < l; i++) {
		boton_cerrar[i].addEventListener('click', function (evt){
			ventana.classList.remove('activo');
		});
	}
	for (let i = 0, l = borrado.length; i < l; i++) {
		borrado[i].addEventListener('click', function(evt){
			evt.preventDefault();
			ventana_confirmacion.classList.add('activo');
			idForm = borrado[i].parentElement;                                  
		});
	}
	aceptar.addEventListener('click',function(evt) {
		idForm.submit();
		ventana_confirmacion.classList.remove('activo');
		waitingDialog.show('Por favor espere', {dialogSize: 'sm', progressType: 'success'});
		setTimeout(function () {waitingDialog.hide();}, 15000 );
	});
</script>
