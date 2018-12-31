$(document).ready(function() {
	proveedores();

	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});

	$("#FormGuardarProveedor").submit(function(e) {
		e.preventDefault();
		var data = "metodo=1&codigo="+$.trim($("#proveedorCodigo").val())+"&nombre="+$.trim($("#proveedorNombre").val())+"&domicilio="+$.trim($("#proveedorDomicilio").val())+"&colonia="+$.trim($("#proveedorColonia").val())+"&ciudad="+$.trim($("#proveedorCiudad").val())+"&estado="+$.trim($("#proveedorEstado").val())+"&pais="+$.trim($("#proveedorPais").val())+"&cp="+$("#proveedorCP").val()+"&rz="+$.trim($("#proveedorRZ").val())+"&rfc="+$.trim($("#proveedorRFC").val())+"&telefono="+$.trim($("#proveedorTelefono").val())+"&email="+$.trim($("#proveedorEmail").val())+"&contacto="+$.trim($("#proveedorContacto").val())+"&telconta="+$.trim($("#proveedorContactoTel").val());

		$.ajax({
			url: 'php/proveedores.php',
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
				  	title: 'El proveedor se ha guardado',
				}); 
				$(".IntProveedores").val("");
				proveedores();	
			}else{
				swal({
				  	type: 'error',
				  	title: 'Error:',
				  	text: 'El proveedor no se ha podido guardar. Es posible que el código del proveedor ya exista',
				});
				console.log(res);
			}
			$("#carga").hide();
		})
		.fail(function() {
			console.log("Error");
		});
	});

	$(document).on('click', '.BorrarProveedor', function() {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres eliminar el proveedor?',
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
					url: 'php/proveedores.php',
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
						  	title: 'El proveedor ha sido borrado',
						});  
						proveedores();	
						proveedoresB();
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'El proveedor no ha podido ser borrado',
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

	$(document).on('click', '.ModificarProveedor', function() {
		var padre = $(this).parent().parent();

		$("#proveedorMCodigo").val(padre.children('td:eq(0)').text());
		$("#proveedorMNombre").val(padre.children('td:eq(1)').text());
		$("#proveedorMDomicilio").val(padre.children('td:eq(2)').text());
		$("#proveedorMColonia").val(padre.children('td:eq(3)').text());
		$("#proveedorMCiudad").val(padre.children('td:eq(4)').text());
		$("#proveedorMEstado").val(padre.children('td:eq(5)').text());
		$("#proveedorMPais").val(padre.children('td:eq(6)').text());
		$("#proveedorMCP").val(padre.children('td:eq(7)').text());
		$("#proveedorMRZ").val(padre.children('td:eq(8)').text());
		$("#proveedorMRFC").val(padre.children('td:eq(9)').text());
		$("#proveedorMTelefono").val(padre.children('td:eq(10)').text());
		$("#proveedorMEmail").val(padre.children('td:eq(11)').text());
		$("#proveedorMContacto").val(padre.children('td:eq(12)').text());
		$("#proveedorMContactoTel").val(padre.children('td:eq(13)').text());

		if(padre.children('td:eq(14)').text() == 'Activo'){
			$("#ProveedorMActivo").prop('checked', true);
		}else{
			$("#ProveedorMActivo").prop('checked', false);
		}

		$("#GuardarMProveedor").attr('disabled', true);
		$("#GuardarMProveedor").attr('attrID', $(this).attr('attrID'));
	});

	$(".ModiProveedores").on('keyup change', function() {
		$("#GuardarMProveedor").attr('disabled', false);
	});

	$("#FormModiProveedor").submit(function(e) {
		e.preventDefault();
		var activo=0;
		if($("#ProveedorMActivo").is(':checked')){
			activo=1;
		}else{
			activo=0;
		}
		
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres modificar los datos del proveedor?',
		  	text: "¡Una vez modificados no podrán ser recuperados jamás!",
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=4&id="+$("#GuardarMProveedor").attr('attrID')+"&codigo="+$.trim($("#proveedorMCodigo").val())+"&nombre="+$.trim($("#proveedorMNombre").val())+"&domicilio="+$.trim($("#proveedorMDomicilio").val())+"&colonia="+$.trim($("#proveedorMColonia").val())+"&ciudad="+$.trim($("#proveedorMCiudad").val())+"&estado="+$.trim($("#proveedorMEstado").val())+"&pais="+$.trim($("#proveedorMPais").val())+"&cp="+$("#proveedorMCP").val()+"&rz="+$.trim($("#proveedorMRZ").val())+"&rfc="+$.trim($("#proveedorMRFC").val())+"&telefono="+$.trim($("#proveedorMTelefono").val())+"&email="+$.trim($("#proveedorMEmail").val())+"&contacto="+$.trim($("#proveedorMContacto").val())+"&telconta="+$.trim($("#proveedorMContactoTel").val())+"&activo="+activo;

				$.ajax({
					url: 'php/proveedores.php',
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
						  	title: 'Los datos del proveedor han sido modificados',
						});  
						proveedores();	
						$("#GuardarMProveedor").attr('disabled', true);
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'Los datos del proveedor no han podido ser modificados. Es posible que el código del proveedor ya exista',
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
	function proveedores() {
		$("#tablaProveedores").dataTable({
			"destroy": true,
			"ajax":{
				"url": 'php/proveedores.php',
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
	            	filename: 'Proveedores',
	            	title: 'Proveedores'
	            },
	            {
	            	extend: 'pdfHtml5',
	            	text: "<i class='fas fa-file-pdf'></i>",
	            	titleAttr: 'PDF',
	            	filename: 'Proveedores',
	            	title: 'Proveedores',
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

	function proveedoresB() {
		$.ajax({
			url: 'php/papelera.php',
			type: 'POST',
			data: 'metodo=5'
		})
		.done(function(res) {
			$("#proveedores").html(res);
		})
		.fail(function() {
			console.log("Error");
		});
	}
});