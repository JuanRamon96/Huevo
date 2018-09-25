$(document).ready(function() {
	var folio="", proveedor="";

	//$("#OrdenFecha").val(fecha()+'T'+hora());
	
	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});


	$("#OrdenBuscarFolio").click(function() {
		verFolios();	
	});

	$("#formGuardarFolio").submit(function(e) {
		e.preventDefault();
		var data="metodo=2&serie="+$.trim($("#folioSerie").val())+"&nombre="+$.trim($("#folioNombre").val());

		$.ajax({
			url: 'php/OrdenCompra.php',
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
				  	title: 'El folio se ha guardado',
				}); 
				$(".intFolio").val("");
				verFolios();	
			}else{
				swal({
				  	type: 'error',
				  	title: 'Error:',
				  	text: 'El folio no se ha podido guardar. Es posible que el folio ya exista',
				});
				console.log(res);
			}
			$("#carga").hide();
		})
		.fail(function() {
			console.log("Error");
		});
	});

	$(document).on('click', '.BorrarOrdenFolio', function() {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres eliminar el folio?',
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=3&id="+$(this).attr('attrID');

				$.ajax({
					url: 'php/OrdenCompra.php',
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
						  	title: 'El folio ha sido borrado',
						});  
						verFolios();	
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'El folio no ha podido ser borrado',
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

	$(".intMfolio").on('change keyup', function() {
		$("#bModificarFolio").attr('disabled', false);
	});

	$(document).on('click', '.ModificarOrdenFolio', function() {
		var padre = $(this).parent().parent();
		$("#folioMSerie").val(padre.children('td:eq(0)').text());
		$("#folioMNombre").val(padre.children('td:eq(1)').text());
		$("#bModificarFolio").attr('disabled', true);
		$("#bModificarFolio").attr('attrID', $(this).attr('attrID'));
	});

	$("#formGuardarMFolio").submit(function(e) {
		e.preventDefault();
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres modificar los datos del folio?',
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=4&id="+$("#bModificarFolio").attr('attrID')+"&serie="+$.trim($("#folioMSerie").val())+"&nombre="+$.trim($("#folioMNombre").val());

				$.ajax({
					url: 'php/OrdenCompra.php',
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
						  	title: 'Los datos del folio han sido modificados',
						});  
						verFolios();	
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'Los datos del folio no han podido ser modificados',
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

	$(document).on("click","#agregarFolio",function() {
		$(".intFolio").val("");
	});

	$(document).on('click', '.seleccionarFolio', function() {
		var padre = $(this).parent().parent();
		folio = padre.children('td:eq(0)').text();
		$("#OrdenNombreF").val(padre.children('td:eq(1)').text());
		
		valorFolio();

		$('#ModalOrdenFolio').modal('hide');
	});

	$("#OrdenBuscarProveedor").click(function() {
		$.ajax({
			url: 'php/OrdenCompra.php',
			type: 'POST',
			data: 'metodo=6'
		})
		.done(function(res) {
			$("#verOrdenProveedores").html(res);
			$("#tablaOrdenProveedores").DataTable({
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
				    }
				}
			});	
		})
		.fail(function() {
			console.log("Error");
		});
	});

	$(document).on('click', '.seleccionarProveedor', function() {
		var padre = $(this).parent().parent();
		$("#OrdenProveedor").val(padre.children('td:eq(1)').text());
		proveedor = $(this).attr('attrID');

		var data="metodo=7&id="+$(this).attr('attrID');
		$.ajax({
			url: 'php/OrdenCompra.php',
			type: 'POST',
			data: data
		})
		.done(function(res) {
			$("#OrdenDatosProveedor").html(res);
			$("#ModalSeleProveedor").modal('hide');
		})
		.fail(function() {
			console.log("Error");
		});	
	});

	$("#OrdenBuscarProducto").click(function() {
		$.ajax({
			url: 'php/OrdenCompra.php',
			type: 'POST',
			data: 'metodo=8'
		})
		.done(function(res) {
			$("#verOrdenProductos").html(res);
			$("#tablaOrdenProductos").DataTable({
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
				    }
				}
			});	
		})
		.fail(function() {
			console.log("Error");
		});	
	});

	$(document).on('click', '.seleccionarProducto', function() {
		var padre=$(this).parent().parent();
		$("#OrdenProducto").val(padre.children('td:eq(1)').text());
		$("#OrdenCodigoP").val(padre.children('td:eq(0)').text());
		$("#OrdenUMEP").val(padre.children('td:eq(2)').text());
		$("#ModalSeleProducto").modal('hide');
		$("#OrdenCodigoP").attr('attrID', $(this).attr('attrID'));
	});

	$(".IntOrDetalle").on('keyup change', function() {
		if(parseFloat($("#OrdenCantidad").val()) >= 0 && parseFloat($("#OrdenPrecio").val()) >= 0){
			$("#OrdenSubtotal").val(parseFloat($("#OrdenCantidad").val())*parseFloat($("#OrdenPrecio").val()));

			if(parseFloat($("#OrdenDescuento").val()) >= 0 && parseFloat($("#OrdenIVA").val()) >= 0){
				var subtotal= parseFloat($("#OrdenSubtotal").val())-(parseFloat($("#OrdenSubtotal").val())*(parseFloat($("#OrdenDescuento").val())/100));
				$("#OrdenTotal").val(subtotal + ((parseFloat($("#OrdenIVA").val())/100)*subtotal));
			}
		}
	});

	$("#FormGuardarOrden").submit(function(e) {
		e.preventDefault();
		if($("#OrdenProducto").val() != ""){
 			$("#Ordendetalles").append("<tr><td><span hidden>"+$("#OrdenCodigoP").attr('attrID')+"</span>"+$("#OrdenCodigoP").val()+"</td><td>"+$("#OrdenProducto").val()+"</td><td>"+$("#OrdenUMEP").val()+"</td><td><input type='number' class='IntDetalles' step='any' min='1' value='"+$("#OrdenCantidad").val()+"'></td><td><input type='number' class='IntDetalles' step='any' min='1' value='"+$("#OrdenPrecio").val()+"'></td><td>"+$("#OrdenSubtotal").val()+"</td><td><input type='number' class='IntDetalles' step='any' min='1' max='100' value='"+$("#OrdenDescuento").val()+"'></td><td><input type='number' class='IntDetalles' step='any' min='1' value='"+$("#OrdenIVA").val()+"'></td><td>"+$("#OrdenTotal").val()+"</td><td><button type='button' class='btn btn-danger btn-sm BorrarDetalle'><i class='fas fa-times'></i></button></td></tr>");
 			$(".IntOrPro").val("");
 			$(".IntOrDetalle").val("0");
 			total();
		}else{
			swal({
				type: 'warning',
				title: 'Debes seleccionar un producto',
			});
			$("#OrdenBuscarProducto").click();
		}
	});

	$(document).on('keyup change', '.IntDetalles', function() {
		var padre = $(this).parent().parent();
		if(parseFloat(padre.children('td:eq(3)').children('input').val()) >= 0 && parseFloat(padre.children('td:eq(4)').children('input').val()) >= 0){
			padre.children('td:eq(5)').html(parseFloat(padre.children('td:eq(3)').children('input').val())*parseFloat(padre.children('td:eq(4)').children('input').val()));
		
			if(parseFloat(padre.children('td:eq(6)').children('input').val()) >= 0 && parseFloat(padre.children('td:eq(7)').children('input').val()) >= 0){
				var subtotal=parseFloat(padre.children('td:eq(5)').text()) - (parseFloat(padre.children('td:eq(5)').text())*(parseFloat(padre.children('td:eq(6)').children('input').val())/100));
				padre.children('td:eq(8)').html(subtotal + (subtotal*(parseFloat(padre.children('td:eq(7)').children('input').val())/100)));
			}
		}
		total();
	});

	$(document).on('click', '.BorrarDetalle', function() {
		$(this).parent().parent().remove();
		total();
	});

	function total() {
		var suma=0;
		$("#Ordendetalles").children('tr').each(function() {
			suma += parseFloat($(this).children('td:eq(8)').text());
		});
		$("#OrdenCostoTotal").val(suma);
	}

	$("#GuardarOrdenCompra").click(function() {
		if($("#OrdenFolio").val() == ""){
			swal({
				type: 'warning',
				title: 'Debes seleccionar un folio',
			});
			$("#OrdenBuscarFolio").click();
		}else if($("#OrdenProveedor").val() == ""){
			swal({
				type: 'warning',
				title: 'Debes seleccionar un proveedor',
			});
			$("#OrdenBuscarProveedor").click();
		}else if($("#Ordendetalles").children('tr').index() < 0){
			swal({
				type: 'warning',
				title: 'Debes ingresar productos a la orden',
			});
		}else{
			var detalles = new Array();
			$("#Ordendetalles").children('tr').each(function(index) {
				detalles[index] = [$(this).children('td:eq(0)').children('span').text(),$(this).children('td:eq(3)').children('input').val(),$(this).children('td:eq(4)').children('input').val(),$(this).children('td:eq(5)').text(),$(this).children('td:eq(6)').children('input').val(),$(this).children('td:eq(7)').children('input').val(),$(this).children('td:eq(8)').text()];
			});

			var data="metodo=9&folio="+folio+"&proveedor="+proveedor+"&total="+$("#OrdenCostoTotal").val()+"&detalles="+JSON.stringify(detalles);

			$.ajax({
				url: 'php/OrdenCompra.php',
				type: 'POST',
				data: data,
				beforeSend: function() {
				    $("#carga").show();
				}
			})
			.done(function(res) {
				if(res=="Correcto"){
					swal({
						type: 'success',
						title: 'La orden de compra ha sido guardada',
					}); 
					$("#Ordendetalles tr").remove();
					proveedor="";
					$(".IntOrPro").val("");
		 			$(".IntOrDetalle").val("0");
		 			$("#OrdenProveedor").val("");
		 			$("#OrdenDatosProveedor").html("");
		 			total();
		 			valorFolio();
		 			//ordenesCompra();
				}else{
					swal({
						type: 'error',
						title: 'Error:',
						text: 'La orden de compra no ha podido ser guardada',
					});
					console.log(res);
				}
				$("#carga").hide();	
			})
			.fail(function() {
				console.log("Error");
			});
		}
	});
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	function verFolios() {
		$.ajax({
			url: 'php/OrdenCompra.php',
			type: 'POST',
			data: 'metodo=1'
		})
		.done(function(res) {
			$("#verOrdenFolios").html(res);
			$("#tablaOrdenFolios").DataTable({
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
				    }
				}
			});	
		})
		.fail(function() {
			console.log("Error");
		});	
	}

	function valorFolio() {
		var data = "metodo=5&folio="+folio; 

		$.ajax({
			url: 'php/OrdenCompra.php',
			type: 'POST',
			data: data
		})
		.done(function(res) {
			if(res == ""){
				$("#OrdenFolio").val(folio+'1');
			}else if(!isNaN(res)){
				$("#OrdenFolio").val(folio+(parseInt(res)+1));
			}else{
				swal({
					type: 'error',
					title: 'Error:',
					text: 'No se ha podido obtener el folio',
				});
				console.log(res);
			}
		})
		.fail(function() {
			console.log("Error");
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

	function hora() {
	    var d = new Date(),
	        hora = '' + d.getHours(),
	        minuto = ''+ d.getMinutes();

	    if (hora.length < 2) hora = '0' + hora;
	    if (minuto.length < 2) minuto = '0' + minuto;

	    return [hora, minuto].join(':');
	}
});