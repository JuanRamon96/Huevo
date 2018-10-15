$(document).ready(function() {
	puestos();
	empleados();
	$("#empleadoFechaIn").val(fecha());
	
	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});

	$("#empleadoArea").change(function() {
		puestos();
	});

	$("#FormGuardarEmpleado").submit(function(e) {
		e.preventDefault();
		var data = "metodo=2&codigo="+$.trim($("#empleadoCodigo").val())+"&nombre="+$.trim($("#empleadoNombre").val())+"&apPat="+$.trim($("#empleadoApPat").val())+"&apMat="+$.trim($("#empleadoApMat").val())+"&domicilio="+$.trim($("#empleadoDomicilio").val())+"&colonia="+$.trim($("#empleadoColonia").val())+"&ciudad="+$.trim($("#empleadoCiudad").val())+"&estado="+$.trim($("#empleadoEstado").val())+"&pais="+$.trim($("#empleadoPais").val())+"&cp="+$("#empleadoCP").val()+"&telefono="+$.trim($("#empleadoTelefono").val())+"&email="+$.trim($("#empleadoEmail").val())+"&puesto="+$.trim($("#empleadoPuesto").val())+"&sdi="+$.trim($("#empleadoSDI").val())+"&alergias="+$.trim($("#empleadoAlergias").val())+"&ts="+$.trim($("#empleadoTS").val())+"&pEmergen="+$.trim($("#empleadoEmergencia").val())+"&telEmergen="+$.trim($("#empleadoTelEmergencia").val())+"&fechaIn="+$.trim($("#empleadoFechaIn").val());

		$.ajax({
			url: 'php/empleados.php',
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
				  	title: 'El empleado se ha guardado',
				}); 
				$(".IntEmpleado").val("");
				$("#empleadoPuesto").html("");
				empleados();	
			}else{
				swal({
				  	type: 'error',
				  	title: 'Error:',
				  	text: 'El empleado no se ha podido guardar. Es posible que el código del cliente ya exista',
				});
				console.log(res);
			}
			$("#carga").hide();
		})
		.fail(function() {
			console.log("Error");
		});
	});

	$(document).on('click', '.BorrarEmpleado', function() {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres eliminar el empleado?',
		  	text: "¡Una vez eliminado no podrá ser recuperado jamás!",
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=4&id="+$(this).attr('attrID');

				$.ajax({
					url: 'php/empleados.php',
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
						  	title: 'El empleado ha sido borrado',
						});  
						empleados();	
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'El empleado no ha podido ser borrado',
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

	$(document).on('click', '.ModificarEmpleado', function() {
		var padre = $(this).parent().parent();
		$("#empleadoMCodigo").val(padre.children('td:eq(0)').text());
		$("#empleadoMNombre").val(padre.children('td:eq(1)').text());
		$("#empleadoMApPat").val(padre.children('td:eq(2)').text());
		$("#empleadoMApMat").val(padre.children('td:eq(3)').text());
		$("#empleadoMDomicilio").val(padre.children('td:eq(4)').text());
		$("#empleadoMColonia").val(padre.children('td:eq(5)').text());
		$("#empleadoMCiudad").val(padre.children('td:eq(6)').text());
		$("#empleadoMEstado").val(padre.children('td:eq(7)').text());
		$("#empleadoMPais").val(padre.children('td:eq(8)').text());
		$("#empleadoMCP").val(padre.children('td:eq(9)').text());
		$("#empleadoMTelefono").val(padre.children('td:eq(10)').text());
		$("#empleadoMEmail").val(padre.children('td:eq(11)').text());
		$("#empleadoMArea").val(padre.children('td:eq(12)').children('span').text());
		puestos1();
		setTimeout(function() {
			$("#empleadoMPuesto").val(padre.children('td:eq(13)').children('span').text());
		},300);
		$("#empleadoMSDI").val(padre.children('td:eq(14)').text());
		$("#empleadoMTS").val(padre.children('td:eq(15)').text());
		$("#empleadoMAlergias").val(padre.children('td:eq(16)').text());
		$("#empleadoMEmergencia").val(padre.children('td:eq(17)').text());
		$("#empleadoMTelEmergencia").val(padre.children('td:eq(18)').text());
		$("#empleadoMFechaIn").val(padre.children('td:eq(19)').children('span').text());
		$("#empleadoMFechaBa").val(padre.children('td:eq(20)').children('span').text());
		$("#empleadoMFechaRe").val(padre.children('td:eq(21)').children('span').text());
		if(padre.children('td:eq(22)').text() == 'Activo'){
			$("#EmpleadoMActivo").prop('checked', true);
		}else{
			$("#EmpleadoMActivo").prop('checked', false);
		}
		$("#GuardarMEmpleado").attr('attrID', $(this).attr('attrID'));
		$("#GuardarMEmpleado").attr('disabled', true);
	});

	$("#empleadoMArea").change(function() {
		puestos1();
	});

	$(".ModiEmpleados").on('change keyup', function() {
		$("#GuardarMEmpleado").attr('disabled', false);
	});

	$("#FormModiEmpleado").submit(function(e) {
		e.preventDefault();
		var activo=0;
		if($("#EmpleadoMActivo").is(':checked')){
			activo=0;
		}else{
			activo=1;
		}
		
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres modificar los datos del empleado?',
		  	text: "¡Una vez modificados no podrán ser recuperados jamás!",
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=5&id="+$("#GuardarMEmpleado").attr('attrID')+"&codigo="+$.trim($("#empleadoMCodigo").val())+"&nombre="+$.trim($("#empleadoMNombre").val())+"&apPat="+$.trim($("#empleadoMApPat").val())+"&apMat="+$.trim($("#empleadoMApMat").val())+"&domicilio="+$.trim($("#empleadoMDomicilio").val())+"&colonia="+$.trim($("#empleadoMColonia").val())+"&ciudad="+$.trim($("#empleadoMCiudad").val())+"&estado="+$.trim($("#empleadoMEstado").val())+"&pais="+$.trim($("#empleadoMPais").val())+"&cp="+$("#empleadoMCP").val()+"&telefono="+$.trim($("#empleadoMTelefono").val())+"&email="+$.trim($("#empleadoMEmail").val())+"&puesto="+$.trim($("#empleadoMPuesto").val())+"&sdi="+$.trim($("#empleadoMSDI").val())+"&alergias="+$.trim($("#empleadoMAlergias").val())+"&ts="+$.trim($("#empleadoMTS").val())+"&pEmergen="+$.trim($("#empleadoMEmergencia").val())+"&telEmergen="+$.trim($("#empleadoMTelEmergencia").val())+"&fechaIn="+$.trim($("#empleadoMFechaIn").val())+"&fechaBa="+$.trim($("#empleadoMFechaBa").val())+"&fechaRe="+$.trim($("#empleadoMFechaRe").val())+"&activo="+activo;

				$.ajax({
					url: 'php/empleados.php',
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
						  	title: 'Los datos del empleado han sido modificados',
						});  
						empleados();	
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'Los datos del empleado no han podido ser modificados',
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
	function puestos() {
		var data = "metodo=1&area="+$("#empleadoArea").val();

		$.ajax({
			url: 'php/empleados.php',
			type: 'POST',
			data: data
		})
		.done(function(res) {
			$("#empleadoPuesto").html(res);
		})
		.fail(function() {
			console.log("Error");
		});
	}

	function puestos1() {
		var data = "metodo=1&area="+$("#empleadoMArea").val();

		$.ajax({
			url: 'php/empleados.php',
			type: 'POST',
			data: data
		})
		.done(function(res) {
			$("#empleadoMPuesto").html(res);
		})
		.fail(function() {
			console.log("Error");
		});
	}

	//$.fn.dataTable.ext.errMode = 'none';
	function empleados() {
		$("#tablaEmpleados").dataTable({
			"destroy": true,
			"ajax":{
				"url": 'php/empleados.php',
				"method": 'POST',
				"data": {
			        "metodo": '3'
			    }
			},
			"columns": [
	            { "data": "Codigo" },
	            { "data": "Nombre" },
	            { "data": "ApPat" },
	            { "data": "ApMat" },
	            { "data": "Domicilio" },
	            { "data": "Colonia" },
	            { "data": "Ciudad" },
	            { "data": "Estado" },
	            { "data": "Pais" },
	            { "data": "CP" },
	            { "data": "Telefono" },
	            { "data": "Email" },
	            { "data": "Area" },
	            { "data": "Puesto" },
	            { "data": "SDI" },
	            { "data": "TI" },
	            { "data": "Alergias" },
	            { "data": "Emergencia" },
	            { "data": "TelEmergencia" },
	            { "data": "FechaIn" },
	            { "data": "FechaBa" },
	            { "data": "FechaRe" },
	            { "data": "Estatus" },
	            { "data": "Boton1" },
	            { "data": "Boton2" }
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
	            	filename: 'Empleados',
	            	title: 'Empleados'
	            },
	            {
	            	extend: 'pdfHtml5',
	            	text: "<i class='fas fa-file-pdf'></i>",
	            	titleAttr: 'PDF',
	            	filename: 'Empleados',
	            	title: 'Empleados',
	            	orientation: 'landscape',
	            	pageSize: 'TABLOID',
	            	customize: function(doc) {
					    doc.defaultStyle.fontSize = 9;
					    doc.styles.tableHeader.fontSize = 10;
					    doc.defaultStyle.alignment = 'center';
					}
	            }
	        ]
		});
	}

	function fecha() {
	    var d = new Date(),
	        month = '' + (d.getMonth() + 1),
	        day = '' + d.getDate(),
	        year = d.getFullYear();

	    if (month.length < 2) month = '0' + month;
	    if (day.length < 2) day = '0' + day;

	    return [year, month, day].join('-');
	}
});