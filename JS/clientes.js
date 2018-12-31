$(document).ready(function() {
	clientes();

	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});

	$("#FormGuardarCliente").submit(function(e) {
		e.preventDefault();
		var data = "metodo=1&codigo="+$.trim($("#clienteCodigo").val())+"&nombre="+$.trim($("#clienteNombre").val())+"&domicilio="+$.trim($("#clienteDomicilio").val())+"&colonia="+$.trim($("#clienteColonia").val())+"&ciudad="+$.trim($("#clienteCiudad").val())+"&estado="+$.trim($("#clienteEstado").val())+"&pais="+$.trim($("#clientePais").val())+"&cp="+$("#clienteCP").val()+"&rz="+$.trim($("#clienteRZ").val())+"&rfc="+$.trim($("#clienteRFC").val())+"&telefono="+$.trim($("#clienteTelefono").val())+"&email="+$.trim($("#clienteEmail").val())+"&contacto="+$.trim($("#clienteContacto").val())+"&telconta="+$.trim($("#clienteContactoTel").val());

		$.ajax({
			url: 'php/clientes.php',
			type: 'POST',
			data: data,
			beforeSend: function() {
	           	$("#carga").show();
	        }
		})
		.done(function(res) {
			if(res=="1"){
				swal({
				  	type: 'success',
				  	title: 'El cliente se ha guardado',
				}); 
				$(".IntClientes").val("");
				clientes();	
			}else{
				swal({
				  	type: 'error',
				  	title: 'Error:',
				  	text: 'El cliente no se ha podido guardar. Es posible que el código del cliente ya exista',
				});
				console.log(res);
			}
			$("#carga").hide();
		})
		.fail(function() {
			console.log("Error");
		});
	});

	$(document).on('click', '.BorrarCliente', function() {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres eliminar el cliente?',
		  	text: "¡Una vez eliminado no podrá ser recuperado jamás!",
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=3&id="+$(this).attr('attrID');

				$.ajax({
					url: 'php/clientes.php',
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
						  	title: 'El cliente ha sido borrado',
						});  
						clientes();
						clientesB();	
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'El cliente no ha podido ser borrado',
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

	$(document).on('click', '.ModificarCliente', function() {
		var padre = $(this).parent().parent();

		$("#clienteMCodigo").val(padre.children('td:eq(0)').text());
		$("#clienteMNombre").val(padre.children('td:eq(1)').text());
		$("#clienteMDomicilio").val(padre.children('td:eq(2)').text());
		$("#clienteMColonia").val(padre.children('td:eq(3)').text());
		$("#clienteMCiudad").val(padre.children('td:eq(4)').text());
		$("#clienteMEstado").val(padre.children('td:eq(5)').text());
		$("#clienteMPais").val(padre.children('td:eq(6)').text());
		$("#clienteMCP").val(padre.children('td:eq(7)').text());
		$("#clienteMRZ").val(padre.children('td:eq(8)').text());
		$("#clienteMRFC").val(padre.children('td:eq(9)').text());
		$("#clienteMTelefono").val(padre.children('td:eq(10)').text());
		$("#clienteMEmail").val(padre.children('td:eq(11)').text());
		$("#clienteMContacto").val(padre.children('td:eq(12)').text());
		$("#clienteMContactoTel").val(padre.children('td:eq(13)').text());

		if(padre.children('td:eq(14)').text() == 'Activo'){
			$("#ClienteMActivo").prop('checked', true);
		}else{
			$("#ClienteMActivo").prop('checked', false);
		}

		$("#GuardarMCliente").attr('disabled', true);
		$("#GuardarMCliente").attr('attrID', $(this).attr('attrID'));
	});

	$(".ModiClientes").on('keyup change', function() {
		$("#GuardarMCliente").attr('disabled', false);
	});

	$("#FormModiCliente").submit(function(e) {
		e.preventDefault();
		var activo=0;
		if($("#ClienteMActivo").is(':checked')){
			activo=1;
		}else{
			activo=0;
		}
		
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres modificar los datos del cliente?',
		  	text: "¡Una vez modificados no podrán ser recuperados jamás!",
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=4&id="+$("#GuardarMCliente").attr('attrID')+"&codigo="+$.trim($("#clienteMCodigo").val())+"&nombre="+$.trim($("#clienteMNombre").val())+"&domicilio="+$.trim($("#clienteMDomicilio").val())+"&colonia="+$.trim($("#clienteMColonia").val())+"&ciudad="+$.trim($("#clienteMCiudad").val())+"&estado="+$.trim($("#clienteMEstado").val())+"&pais="+$.trim($("#clienteMPais").val())+"&cp="+$("#clienteMCP").val()+"&rz="+$.trim($("#clienteMRZ").val())+"&rfc="+$.trim($("#clienteMRFC").val())+"&telefono="+$.trim($("#clienteMTelefono").val())+"&email="+$.trim($("#clienteMEmail").val())+"&contacto="+$.trim($("#clienteMContacto").val())+"&telconta="+$.trim($("#clienteMContactoTel").val())+"&activo="+activo;

				$.ajax({
					url: 'php/clientes.php',
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
						  	title: 'Los datos del cliente han sido modificados',
						});  
						clientes();	
						$("#GuardarMCliente").attr('disabled', true);
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'Los datos del cliente no han podido ser modificados. Es posible que el código del cliente ya exista',
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
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	$.fn.dataTable.ext.errMode = 'none';
	function clientes() {
		$("#tablaClientes").dataTable({
			"destroy": true,
			"ajax":{
				"url": 'php/clientes.php',
				"method": 'POST',
				"data": {
			        "metodo": '2'
			    }
			},
			"columns": [
	            { "data": "Codigo" },
	            { "data": "Nombre" },
	            { "data": "Domicilio" },
	            { "data": "Colonia" },
	            { "data": "Ciudad" },
	            { "data": "Estado" },
	            { "data": "Pais" },
	            { "data": "CP" },
	            { "data": "RazonSocial" },
	            { "data": "RFC" },
	            { "data": "Telefono" },
	            { "data": "Email" },
	            { "data": "Contacto" },
	            { "data": "TelContacto" },
	            { "data": "Activo" },
	            { "data": "Botones1" },
	            { "data": "Botones2" }
	        ], 
	        "language": {
			    "sProcessing":     "Procesando...",
			    "sLengthMenu":     "Mostrar _MENU_ registros",
			    "sZeroRecords":    "No se encontraron resultados",
			    "sEmptyTable":     "Ningún dato disponible en esta tabla",
			    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			    "sInfoPostFix":    "",
			    "sSearch":         "Buscar:",
			    "sUrl":            "",
			    "sInfoThousands":  ",",
			    "sLoadingRecords": "Cargando...",
			    "oPaginate": {
			        "sFirst":    "Primero",
			        "sLast":     "Último",
			        "sNext":     "Siguiente",
			        "sPrevious": "Anterior"
			    },
			    "oAria": {
			        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			    },
			     buttons: {
		            copy: 'Copiar',
				    copySuccess: {
				        1: "Se ha copiado una fila",
				        _: "Se han copiado %d filas"
				    },
				    copyTitle: 'Elementos copiados'
		        }
			},
			dom:"<'row'<'col-sm-12 col-md-12'B>>"+ 
				"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",//'Bfrtip',
	        buttons: [
	            {
	            	extend: 'copyHtml5',
	            	text: "<i class='fas fa-copy'></i>",
	            	titleAttr: 'Copiar'
	            },
	            {
	            	extend: 'excelHtml5',
	            	text: "<i class='fas fa-file-excel'></i>",
	            	titleAttr: 'Excel',
	            	filename: 'Clientes',
	            	title: 'Clientes'
	            },
	            {
	            	extend: 'pdfHtml5',
	            	text: "<i class='fas fa-file-pdf'></i>",
	            	titleAttr: 'PDF',
	            	filename: 'Clientes',
	            	title: 'Clientes',
	            	orientation: 'landscape',
	            	pageSize: 'TABLOID',
	            	customize: function(doc) {
					    doc.defaultStyle.fontSize = 11;
					    doc.styles.tableHeader.fontSize = 12;
					    doc.defaultStyle.alignment = 'center';
					}
	            }
	        ]
		});
	}

	function clientesB() {
		$.ajax({
			url: 'php/papelera.php',
			type: 'POST',
			data: 'metodo=4'
		})
		.done(function(res) {
			$("#clientes").html(res);
		})
		.fail(function() {
			console.log("Error");
		});
	}
});