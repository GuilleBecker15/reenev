$('document').ready(function(){
	
	combo = document.getElementById('generacion');
	var hoy = new Date();
	var html = "";
	for (var i = 2008; i <= hoy.getFullYear() ; i++) {
		html =  html + '<option value="' + i + '">'+ i +'</option>'
	}
	combo.innerHTML = html;
});
