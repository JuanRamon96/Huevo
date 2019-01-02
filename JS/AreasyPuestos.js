$(document).ready(function() {
	nuevaArea();
	nuevoPuesto();
	areas();
	setTimeout(function() {
		verAreas();
	},500);
	puestos();

	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});

	$(document).on('submit', '#FormArea', function(e) {
		e.preventDefault();
		var data = "metodo=2&codigo="+$.trim($("#codigoArea").val())+"&nombre="+$.trim($("#nombreArea").val());

		$.ajax({
			url: 'php/AreasyPuestos.php',
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
				  	title: 'El área se ha guardado',
				}); 
				$(".intArea").val("");
				areas();
				setTimeout(function() {
					verAreas();
				},500);	
			}else{
				swal({
				  	type: 'error',
				  	title: 'Error:',
				  	text: 'El área no se ha podido guardar',
				});
				console.log(res);
			}
			$("#carga").hide();
		})
		.fail(function() {
			console.log("Error");
		});
	});

	$(document).on('click', '.BorrarAreas', function() {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres eliminar el área?',
		  	text: "¡Una vez eliminada no podrá ser recuperada jamás!",
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=4&id="+$(this).attr('attrID');

				$.ajax({
					url: 'php/AreasyPuestos.php',
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
						  	title: 'El área ha sido borrada',
						});  
						areas();
						areasB();	
						setTimeout(function() {
							verAreas();
						},500);
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'El área no ha podido ser borrada',
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

	$(document).on('click', '.ModificarAreas', function() {
		var padre =  $(this).parent().parent();
		$("#areaMCodigo").val(padre.children('td:eq(0)').text());
		$("#areaMNombre").val(padre.children('td:eq(1)').text());
		
		if(padre.children('td:eq(2)').children('p').text() == 'Activa'){
			$("#AreaMActivo").prop('checked', true);
		}else{
			$("#AreaMActivo").prop('checked', false);
		}

		$("#GuardarMAreas").attr('disabled', true);
		$("#GuardarMAreas").attr('attrID', $(this).attr('attrID'));
	});

	$(".ModiAreas").on('change keyup', function() {
		$("#GuardarMAreas").attr('disabled', false);
	});

	$("#FormModiArea").submit(function(e) {
		e.preventDefault();
		var activo=0;
		if($("#AreaMActivo").is(':checked')){
			activo=1;
		}else{
			activo=0;
		}
		
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres modificar los datos del área?',
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=5&id="+$("#GuardarMAreas").attr('attrID')+"&codigo="+$.trim($("#areaMCodigo").val())+"&nombre="+$.trim($("#areaMNombre").val())+"&activo="+activo;

				$.ajax({
					url: 'php/AreasyPuestos.php',
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
						  	title: 'Los datos del área han sido modificados',
						});  
						areas();	
						setTimeout(function() {
							verAreas();
						},500);
						$("#GuardarMAreas").attr('disabled', true);
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'Los datos del área no han podido ser modificados',
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

	$(document).on('submit', '#FormPuesto', function(e) {
		e.preventDefault();
		var data = "metodo=8&codigo="+$.trim($("#codigoPuesto").val())+"&nombre="+$.trim($("#nombrePuesto").val())+"&area="+$("#areaPuesto").val();

		$.ajax({
			url: 'php/AreasyPuestos.php',
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
				  	title: 'El puesto se ha guardado',
				}); 
				$(".intPuesto").val("");
				puestos();
			}else{
				swal({
				  	type: 'error',
				  	title: 'Error:',
				  	text: 'El puesto no se ha podido guardar',
				});
				console.log(res);
			}
			$("#carga").hide();
		})
		.fail(function() {
			console.log("Error");
		});
	});

	$(document).on('click', '.BorrarPuestos', function() {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres eliminar el puesto?',
		  	text: "¡Una vez eliminado no podrá ser recuperado jamás!",
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=10&id="+$(this).attr('attrID');

				$.ajax({
					url: 'php/AreasyPuestos.php',
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
						  	title: 'El puesto ha sido borrado',
						});  
						puestos();
						puestosB()
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'El puesto no ha podido ser borrado',
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

	$(document).on('click', '.ModificarPuestos', function() {
		var padre =  $(this).parent().parent();
		$("#puestoMCodigo").val(padre.children('td:eq(0)').text());
		$("#puestoMNombre").val(padre.children('td:eq(1)').text());
		$("#puestoMArea").val($(this).attr('attrArea'));

		if(padre.children('td:eq(3)').text() == 'Activo'){
			$("#PuestoMActivo").prop('checked', true);
		}else{
			$("#PuestoMActivo").prop('checked', false);
		}

		$("#GuardarMPuestos").attr('disabled', true);
		$("#GuardarMPuestos").attr('attrID', $(this).attr('attrID'));
	});

	$(".ModiPuestos").on('change keyup', function() {
		$("#GuardarMPuestos").attr('disabled', false);
	});

	$("#FormModiPuestos").submit(function(e) {
		e.preventDefault();
		var activo=0;
		if($("#PuestoMActivo").is(':checked')){
			activo=1;
		}else{
			activo=0;
		}
		
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres modificar los datos del puesto?',
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=11&id="+$("#GuardarMPuestos").attr('attrID')+"&codigo="+$.trim($("#puestoMCodigo").val())+"&nombre="+$.trim($("#puestoMNombre").val())+"&area="+$("#puestoMArea").val()+"&activo="+activo;

				$.ajax({
					url: 'php/AreasyPuestos.php',
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
						  	title: 'Los datos del puesto han sido modificados',
						});  
						puestos();
						$("#GuardarMPuestos").attr('disabled', true);
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'Los datos del puesto no han podido ser modificados',
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
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	function nuevaArea() {
		$.ajax({
			url: 'php/AreasyPuestos.php',
			type: 'POST',
			data: "metodo=1"
		})
		.done(function(res) {
			$("#nuevaArea").html(res);
		})
		.fail(function() {
			console.log("Error");
		});
	}

	function nuevoPuesto() {
		$.ajax({
			url: 'php/AreasyPuestos.php',
			type: 'POST',
			data: "metodo=6"
		})
		.done(function(res) {
			$("#nuevoPuesto").html(res);
		})
		.fail(function() {
			console.log("Error");
		});
	}

	function verAreas() {
		$.ajax({
			url: 'php/AreasyPuestos.php',
			type: 'POST',
			data: "metodo=7"
		})
		.done(function(res) {
			$("#areaPuesto").html(res);
			$("#puestoMArea").html(res);
			$("#empleadoArea").html(res);
			$("#empleadoMArea").html(res);
		})
		.fail(function() {
			console.log("Error");
		});
	}

	$.fn.dataTable.ext.errMode = 'none';
	function areas() {
		$("#tablaAreas").dataTable({
			"destroy": true,
			"ajax":{
				"url": 'php/AreasyPuestos.php',
				"method": 'POST',
				"data": {
			        "metodo": '3'
			    }
			},
			"columns": [
				{ "data": "Codigo" },
	            { "data": "Nombre" },
	            { "data": "Activo" },
	            { "data": "Botones" }
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
	            	filename: 'Áreas',
	            	title: 'Áreas'
	            },
	            {
	            	extend: 'pdfHtml5',
	            	text: "<i class='fas fa-file-pdf'></i>",
	            	titleAttr: 'PDF',
	            	filename: 'Áreas',
	            	title: 'Áreas',
	            	customize: function(doc) {
					    doc.defaultStyle.alignment = 'center';
					}
	            }
	        ]
		});
	}

	function puestos() {
		$("#tablaPuestos").dataTable({
			"destroy": true,
			"ajax":{
				"url": 'php/AreasyPuestos.php',
				"method": 'POST',
				"data": {
			        "metodo": '9'
			    }
			},
			"columns": [
				{ "data": "Codigo" },
	            { "data": "Nombre" },
	            { "data": "Area" },
	            { "data": "Activo" },
	            { "data": "Botones" }
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
	            	filename: 'Puestos',
	            	title: 'Puestos'
	            },
	            {
	            	extend: 'pdfHtml5',
	            	text: "<i class='fas fa-file-pdf'></i>",
	            	titleAttr: 'PDF',
	            	filename: 'Puestos',
	            	title: 'Puestos',
	            	customize: function(doc) {
					    doc.defaultStyle.alignment = 'center';
					}
	            }
	        ]
		});
	}

	function puestosB() {
		$.ajax({
			url: 'php/papelera.php',
			type: 'POST',
			data: 'metodo=7'
		})
		.done(function(res) {
			$("#puestos").html(res);
		})
		.fail(function() {
			console.log("Error");
		});
	}

	function areasB() {
		$.ajax({
			url: 'php/papelera.php',
			type: 'POST',
			data: 'metodo=8'
		})
		.done(function(res) {
			$("#areas").html(res);
		})
		.fail(function() {
			console.log("Error");
		});
	}
});