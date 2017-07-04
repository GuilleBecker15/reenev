<div class="modalmio">
	<div class="overlay cerrar"></div>
	<div class="ventana">
		<a href="#" class="boton-cerrar cerrarModal">
			<span class="glyphicon glyphicon-remove-sign"></span>
		</a>
		<div class="cuerpo text-justify">
			¿Está seguro que desea realizar esta acción?
		</div>
		<div>
			<div class="row">
			<div class="col-md-6  text-center">
					<a href="#" class="btn btn-default cerrarModal">No, cancelar</a>        
				</div>
				<div class="col-md-6 text-center">
					<a id="aceptarBorrado" class="btn btn-primary " href="#">Si, proseguir</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	let borrado              = document.getElementsByClassName('borrado_confirm');
	let ventana_confirmacion = document.getElementsByClassName('modalmio')[0];
	let boton_cerrar         = document.getElementsByClassName('cerrarModal');
	let aceptar              = document.getElementById('aceptarBorrado');
	let idForm;
	for (let i=0, l=boton_cerrar.length; i<l; i++) {
		boton_cerrar[i].addEventListener('click', function (evt){
			ventana.classList.remove('activo');
		});
	}
	for (let i=0, l=borrado.length; i<l; i++) {
		borrado[i].addEventListener('click', function(evt){
			evt.preventDefault();
			ventana_confirmacion.classList.add('activo');
			idForm = borrado[i].parentElement;                                  
		});
	}
	aceptar.addEventListener('click',function(evt) {
		idForm.submit();
		ventana_confirmacion.classList.remove('activo');
		waitingDialog.show('Por favor espere...', {dialogSize: 'sm', progressType: 'primary'});
		// setTimeout(function () {waitingDialog.hide();}, 15000 );
	});
</script>
