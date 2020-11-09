$(buscar_datos());

function buscar_datos(consulta1){
	$.ajax({
		url: 'buscadorproductos.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta1: consulta1},
	})
	.done(function(respuesta){
		$("#datos1").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}


$(document).on('keyup','#caja_busqueda1', function(){
	var valor = $(this).val();
	if (valor != "") {
		buscar_datos(valor);
	}else{
		buscar_datos();
	}
});