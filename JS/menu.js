$(document).ready(function() {
	generales();

	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});

	$("#openBtn").click(function() {
		$("#mySidenav").css('width', '250px');
		$("#mySidenav").focus();
	});

	$("#mySidenav").focusout(function(){
		$(this).css('width', '0');
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

	$("#verNuevoCliente").click(function() {
		$(".oculto").hide();
		$("#VistaNuevoCliente").show();
		$("#mySidenav").css('width', '0');
	});

	$("#verClientes").click(function() {
		$(".oculto").hide();
		$("#VistaClientes").show();
		$("#mySidenav").css('width', '0');
	});

	$("#verNuevoProveedor").click(function() {
		$(".oculto").hide();
		$("#VistaNuevoProveedor").show();
		$("#mySidenav").css('width', '0');
	});

	$("#verProveedores").click(function() {
		$(".oculto").hide();
		$("#VistaProveedores").show();
		$("#mySidenav").css('width', '0');
	});

	$("#verAyP").click(function() {
		$(".oculto").hide();
		$("#VistaAreasyPuestos").show();
		$("#mySidenav").css('width', '0');
	});

	$("#verNuevoEmpleado").click(function() {
		$(".oculto").hide();
		$("#VistaNuevoEmpleado").show();
		$("#mySidenav").css('width', '0');
	});

	$("#verEmpleados").click(function() {
		$(".oculto").hide();
		$("#VistaEmpleados").show();
		$("#mySidenav").css('width', '0');
	});

	$("#verNuevaOrden").click(function() {
		$(".oculto").hide();
		$("#VistaOrdendeCompra").show();
		$("#mySidenav").css('width', '0');
	});

	$("#verOrdenesCompra").click(function() {
		$(".oculto").hide();
		$("#VistaVerOrdenCompra").show();
		$("#mySidenav").css('width', '0');
	});

	$("#verPrecios").click(function() {
		$(".oculto").hide();
		$("#VistaPrecios").show();
		$("#mySidenav").css('width', '0');
	});

	$(document).on('keyup change', '.generales', function() {
		$("#GuardarGeneral").attr('disabled', false);
	});

	$("#FormGenerales").submit(function(e) {
		e.preventDefault();
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres cambiar los datos generales?',
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
	        	var datos = "metodo=2&nombre="+$.trim($("#GNombre").val())+"&domicilio="+$.trim($("#GDomicilio").val())+"&colonia="+$.trim($("#GColonia").val())+"&ciudad="+$.trim($("#GCiudad").val())+"&estado="+$.trim($("#GEstado").val())+"&pais="+$.trim($("#GPais").val())+"&CP="+$("#GCP").val()+"&RZ="+$.trim($("#GRZ").val())+"&RFC="+$.trim($("#GRFC").val())+"&telefono="+$.trim($("#GTelefono").val())+"&email="+$.trim($("#GEmail").val());
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
						swal({
						  	type: 'success',
						  	title: 'Los datos se han cambiado',
						});
						$("#GuardarGeneral").attr('disabled', false);
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'No se han podido cambiar los datos',
						});
						console.log(res);
					}
					$("#carga").hide();	
				})
				.fail(function() {
					console.log("Error");
				});  
        	} else if (result.dismiss === swal.DismissReason.cancel) {
		    	swal('Has cancelado la operación');
		  	}
		});	
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
			$("#GNombre").val(separa[0]);
			$("#GDomicilio").val(separa[1]);
			$("#GColonia").val(separa[2]);
			$("#GCiudad").val(separa[3]);
			$("#GEstado").val(separa[4]);
			$("#GPais").val(separa[5]);
			$("#GCP").val(separa[6]);
			$("#GRZ").val(separa[7]);
			$("#GRFC").val(separa[8]);
			$("#GTelefono").val(separa[9]);
			$("#GEmail").val(separa[10]);
		})
		.fail(function() {
			console.log("Error");
		});
	}
});
