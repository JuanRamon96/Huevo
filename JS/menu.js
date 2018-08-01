$(document).ready(function() {
	generales();

	$("#openBtn").click(function() {
		$("#mySidenav").css('width', '250px');
	});
	
	$("#closeBtn").click(function() {
		$("#mySidenav").css('width', '0');
	});

	$("#VerUsuarios").click(function() {
		$(".oculto").hide();
		$("#VistaUsuarios").show();
		$("#mySidenav").css('width', '0');
	});

	$("#DatosGenerales").click(function() {
		$(".oculto").hide();
		$("#VistaGenerales").show();
		$("#mySidenav").css('width', '0');
	});

	$("#ConfiguracionUsu").click(function() {
		$(".oculto").hide();
		$("#VistaConfiguracion").show();
		$("#mySidenav").css('width', '0');
	});

	$("#verNuevoProducto").click(function() {
		$(".oculto").hide();
		$("#VistaNuevoProducto").show();
		$("#mySidenav").css('width', '0');
	});

	$("#verProductos1").click(function() {
		$(".oculto").hide();
		$("#VistaProductos1").show();
		$("#mySidenav").css('width', '0');
	});

	$("#verProductos2").click(function() {
		$(".oculto").hide();
		$("#VistaProductos2").show();
		$("#mySidenav").css('width', '0');
	});

	$("#verProductos3").click(function() {
		$(".oculto").hide();
		$("#VistaProductos3").show();
		$("#mySidenav").css('width', '0');
	});

	$(document).on('keyup change', '.generales', function() {
		$("#GuardarGeneral").attr('disabled', false);
	});

	$("#FormGenerales").submit(function(e) {
		e.preventDefault();
		var confir= confirm("Estas seguro que quieres cambiar los datos generales");

        if(confir==true){
        	var datos = $(this).serializeArray();
			$.ajax({
				url: 'php/generales.php',
				type: 'POST',
				data: datos,
				beforeSend: function() {
		            $("#carga").show();
		        }
			})
			.done(function(res) {
				if(res=="1"){
					alert("Los datos se han cambiado"); 
					$("#GuardarGeneral").attr('disabled', false);
				}else{
					alert("Error: No se han podido cambiar los datos");
					console.log(res);
				}
				$("#carga").hide();	
			})
			.fail(function() {
				console.log("Error");
			});  
        }else{
          alert("Has cancelado la operación");
        }
	});

	$("#mySidenav").children("ul").children('span').click(function() {
		$(this).parent().children('li').toggle("fast");
	});	

	function generales() {
		$.ajax({
			url: 'php/generales.php',
			type: 'POST',
			data: "metodo=1"
		})
		.done(function(res) {
			var separa =  res.split("*");
			$("#GDentista").val(separa[0]);
			$("#GClinica").val(separa[1]);
			$("#GDomicilio").val(separa[2]);
			$("#GColonia").val(separa[3]);
			$("#GCiudad").val(separa[4]);
			$("#GEstado").val(separa[5]);
			$("#GCP").val(separa[6]);
			$("#GTelefono").val(separa[7]);
			$("#GEmail").val(separa[8]);
		})
		.fail(function() {
			console.log("Error");
		});
	}
});
