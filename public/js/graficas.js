function verCcMail(cursoID){
		let form = document.getElementById("formcopias"+cursoID);
		let clases = form.className.split(" ");
		let existe = "";
		for (let i = 0; i < clases.length; i++){
			if(clases[i] == 'activo'){
				existe = 's';
				break;
			}
		}
		if(existe == 's'){
			form.classList.remove('activo')
			setTimeout(c => form.classList.remove('display'),601);
		}
		else{
			form.classList.add('display')
			setTimeout(c => form.classList.add('activo'), 10);
		}
	}

	let form = document.getElementsByClassName("formulario");
	let divform = document.getElementsByClassName("formcopias");
	// let formulario = 
	let iterador = 0;
	while ( iterador < form.length ) {
		form[iterador].addEventListener('submit', function (evt){
			evt.preventDefault();
			let clases = evt.target.parentElement.classList;
			for (let i = 0; i < clases.length; i++) {
				if(clases[i] == 'has-error'){
					evt.target.classList.remove('has-error');
					let hijo = evt.target.getElementsByTagName('span')
					if (hijo.length > 0){
					evt.target.removeChild(hijo[0]);
					//evt.target.removeChild(hijo[0]);
					}
				}
			}
			// if(validarMail(evt.target)){
			if(validar(evt.target)){
				evt.target.submit();
				// alert("se puede enviar!");
			}else{
				evt.target.parentElement.classList.add('has-error');
				let span = document.createElement('span');
				let strong = document.createElement('strong');
				let texto = document.createTextNode('Compruebe los email ingresados, uno de ello no corresponde a una direccion de email valida');
				span.classList.add('help-block');
				span.appendChild(strong);
				strong.appendChild(texto);
				evt.target.insertBefore(span, evt.target.childNodes[5]);
			}
		});
		iterador++;
	}

	// function validarMail(form){
	// 	let input= form.getElementsByTagName('input');
	// 	let texto = input[0].value.trim().split(" ");
	// 	let valido = true;
	// 	let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	// 	console.log(texto);
	// 	if(texto == "") return true;
	// 	for (let i = 0; i < texto.length; i++){
	// 		if(texto[i]==""){
	// 			texto.splice(i,1);
	// 			i--;
	// 		}
	// 	  	if(!re.test(texto[i])){
	// 	  		return false;
	// 	  	}
	// 	}
 //  		return true;
	// }

	function validar(form){
		let spans = form.querySelectorAll(".input-container > .fake-textarea > span");
		for (let i = 0; i < spans.length; i++) {
			let clases = spans[i].className.split(" ");
			for (let i = 0; i < clases.length; i++){
				if(clases[i] == 'novalido'){
					return false;
				}
			}
		}
		return true;
	}