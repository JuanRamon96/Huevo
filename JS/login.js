$(document).ready(function() {
	$("#login").submit(function(e) {
		e.preventDefault();
		var datos = $(this).serializeArray();
		$.ajax({
			url: 'login.php',
			type: 'POST',
			data: datos,
			beforeSend: function() {
            	//$("#carga").show();
            	$("#btnIni").html('Iniciando...');
        	}
		})
		.done(function(res) {
			if(res=="1"){
				location.href = "App/"; 	
			}else if(res=="0"){
				$("#alerta").show();
				$("#Usuario").focus();
			}else{
				console.log(res);
			}
		})
		.fail(function() {
			console.log("Error");
		})
		.always(function() {
			//$("#carga").hide();
			setTimeout(function(){
				$("#btnIni").html('Iniciar sesión');
			},1000);
		});
	});
});