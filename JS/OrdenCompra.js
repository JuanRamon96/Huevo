$(document).ready(function() {
	var folio="", proveedor="",tipo="0",lfolio=0,lproveedor=0,lproducto=0,fila=0;
	var eliminarOC = new Array();
	ordenesCompra();

	//$("#OrdenFecha").val(fecha()+'T'+hora());
	
	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});


	$("#OrdenBuscarFolio").click(function() {
		verFolios();	
		lfolio=1;
	});

	$("#OrdenMBuscarFolio").click(function() {
		verFolios();
		$('#ModalOrdenFolio').css('z-index', '1100');	
		lfolio=2;
	});

	$('#ModalOrdenFolio').on('hidden.bs.modal',function() {
		if(lfolio == 2){
			$('body').addClass('modal-open');
		}
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
		if(lfolio == 1){
			$("#OrdenNombreF").val(padre.children('td:eq(1)').text());
		}else{
			$("#OrdenMNombreF").val(padre.children('td:eq(1)').text());
			$("#OrdenMNombreF").attr('attrFolio', folio);
		}
		
		valorFolio();

		$('#ModalOrdenFolio').modal('hide');
	});

	$("#OrdenBuscarProveedor").click(function() {
		proveedores();
		lproveedor=1;
	});

	$("#OrdenMBuscarProveedor").click(function() {
		proveedores();
		$('#ModalSeleProveedor').css('z-index', '1100');
		lproveedor=2;
	});

	$('#ModalSeleProveedor').on('hidden.bs.modal',function() {
		if(lproveedor == 2){
			$('body').addClass('modal-open');
		}
	});

	$(document).on('click', '.seleccionarProveedor', function() {
		var padre = $(this).parent().parent();
		proveedor = $(this).attr('attrID');
		if(lproveedor == 1){
			$("#OrdenProveedor").val(padre.children('td:eq(1)').text());
		}else{
			$("#OrdenMProveedor").val(padre.children('td:eq(1)').text());
			$("#OrdenMProveedor").attr('attrID', proveedor);
		}

		var data="metodo=7&id="+$(this).attr('attrID');
		$.ajax({
			url: 'php/OrdenCompra.php',
			type: 'POST',
			data: data
		})
		.done(function(res) {
			if(lproveedor == 1){
				$("#OrdenDatosProveedor").html(res);
			}else{
				$("#OrdenMDatosProveedor").html(res);
			}
			$("#ModalSeleProveedor").modal('hide');
		})
		.fail(function() {
			console.log("Error");
		});	
	});

	$("#OrdenBuscarProducto").click(function() {
		productos();
		lproducto=1;
	});

	$("#OrdenMBuscarProducto").click(function() {
		productos();
		$('#ModalSeleProducto').css('z-index', '1100');
		lproducto=2;
	});

	$('#ModalSeleProducto').on('hidden.bs.modal',function() {
		if(lproducto == 2){
			$('body').addClass('modal-open');
		}
	});

	$(document).on('click', '.seleccionarProducto', function() {
		var padre=$(this).parent().parent();
		if(lproducto == 1){
			$("#OrdenProducto").val(padre.children('td:eq(1)').text());
			$("#OrdenCodigoP").val(padre.children('td:eq(0)').text());
			$("#OrdenUMEP").val(padre.children('td:eq(2)').text());
			$("#OrdenCodigoP").attr('attrID', $(this).attr('attrID'));
		}else{
			$("#OrdenMProducto").val(padre.children('td:eq(1)').text());
			$("#OrdenMCodigoP").val(padre.children('td:eq(0)').text());
			$("#OrdenMUMEP").val(padre.children('td:eq(2)').text());
			$("#OrdenMCodigoP").attr('attrID', $(this).attr('attrID'));
		}
		$("#ModalSeleProducto").modal('hide');
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
 			total($("#Ordendetalles"),$("#OrdenCostoTotal"));
		}else{
			swal({
				type: 'warning',
				title: 'Debes seleccionar un producto',
			}).then((result) => {
				if (result.value) {
					$("#OrdenBuscarProducto").click();
				}
			});
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
		total($("#Ordendetalles"),$("#OrdenCostoTotal"));
		total($("#OrdenMdetalles"),$("#OrdenMCostoTotal"));
	});

	$(document).on('click', '.BorrarDetalle', function() {
		$(this).parent().parent().remove();
		total($("#Ordendetalles"),$("#OrdenCostoTotal"));
	});

	function total(tabla,campo) {
		var suma=0;
		tabla.children('tr').each(function() {
			suma += parseFloat($(this).children('td:eq(8)').text());
		});
		campo.val(suma);
	}

	$("#GuardarOrdenCompra").click(function() {
		if($("#OrdenFolio").val() == ""){
			swal({
				type: 'warning',
				title: 'Debes seleccionar un folio',
			}).then((result) => {
				if (result.value) {
					$("#OrdenBuscarFolio").click();
				}
			});	
		}else if($("#OrdenProveedor").val() == ""){
			swal({
				type: 'warning',
				title: 'Debes seleccionar un proveedor',
			}).then((result) => {
				if (result.value) {
					$("#OrdenBuscarProveedor").click();
				}
			});
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
		 			total($("#Ordendetalles"),$("#OrdenCostoTotal"));
		 			valorFolio();
		 			ordenesCompra();
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

	$("input[name=ROrdenC]").click(function() {
		tipo=$(this).val();
		ordenesCompra();
	});

	$(".busOrden").on('keyup change', function() {
		ordenesCompra();
	});

	$(document).on('click', '.vermasOrden', function() {
		var fila= $(this).parent().parent().index();
		$(this).parent().parent().parent().children('tr').eq(fila+1).toggle('fast');
	});

	$(document).on('click', '.bBorrarOrden', function() {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres eliminar la Orden de Compra?',
		  	text: 'Una vez eliminada ya no podrá ser recuperada jamás ',
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=11&id="+$(this).attr('attrID');

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
						  	title: 'La orden de compra ha sido eliminada',
						});  
						ordenesCompra();
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'La orden de compra no ha podido ser eliminada',
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

	$(document).on('click', '.bModificarOrden', function() {
		fila = $(this).parent().parent().parent().parent().parent().parent().index();
		var Npadre=$(this).parent().parent().parent().parent().parent().parent().index();
		var padreS=$("#ContenidoOrden").children('tr').eq(Npadre-1);
		$("#OrdenMFolio").val(padreS.children('td:eq(0)').children('p').text());
		$("#OrdenMNombreF").val(padreS.children('td:eq(0)').children('span').text());
		$("#OrdenMProveedor").val(padreS.children('td:eq(1)').children('p').text());
		$("#OrdenMDatosProveedor").html(padreS.children('td:eq(1)').children('span:eq(1)').html());
		$("#OrdenMdetalles").html("");
		if($(this).parent().parent().children('div:eq(0)').children('table').children('tbody').children('tr').children('td').text() != "No se encontraron detalles"){
			$(this).parent().parent().children('div:eq(0)').children('table').children('tbody').children('tr').each(function(index) {
				$("#OrdenMdetalles").append("<tr><td><span hidden>"+$(this).children('td:eq(0)').children('span').text()+"</span>"+$(this).children('td:eq(0)').children('p').text()+"</td><td><span hidden>"+$(this).children('td:eq(1)').children('span').text()+"</span>"+$(this).children('td:eq(1)').children('p').text()+"</td><td>"+$(this).children('td:eq(2)').text()+"</td><td><input type='number' class='IntDetalles MDetalles' step='any' min='1' value='"+$(this).children('td:eq(3)').text()+"'></td><td><input type='number' class='IntDetalles MDetalles' step='any' min='1' value='"+$(this).children('td:eq(4)').text()+"'></td><td>"+$(this).children('td:eq(5)').text()+"</td><td><input type='number' class='IntDetalles MDetalles' step='any' min='1' max='100' value='"+$(this).children('td:eq(6)').text()+"'></td><td><input type='number' class='IntDetalles MDetalles' step='any' min='1' value='"+$(this).children('td:eq(7)').text()+"'></td><td>"+$(this).children('td:eq(8)').text()+"</td><td><button type='button' class='btn btn-danger btn-sm BorrarMDetalle'><i class='fas fa-times'></i></button></td></tr>");
			});
		}
		$("#OrdenMCostoTotal").val(padreS.children('td:eq(2)').text());
		$("#OrdenMFecha").val(padreS.children('td:eq(3)').children('span').text().replace(" ","T"));

		$(".IntMOrDetalle").val('0');
		$(".IntMOrPro").val("");
		eliminarOC.length = 0;
		$("#OrdenMNombreF").attr('attrFolio', "");
		$("#OrdenMProveedor").attr('attrID', "");
		$("#GuardarMOrdenCompra").attr('attrID', $(this).attr('attrID'));
	});

	$(document).on('click', '.BorrarMDetalle', function() {
		padre = $(this).parent().parent();
		padre.remove();
		total($("#OrdenMdetalles"),$("#OrdenMCostoTotal"));
		if(padre.children('td:eq(0)').children('span').text() != ""){
			eliminarOC.push(padre.children('td:eq(0)').children('span').text());
		}
	});

	$(".IntMOrDetalle").on('keyup change', function() {
		if(parseFloat($("#OrdenMCantidad").val()) >= 0 && parseFloat($("#OrdenMPrecio").val()) >= 0){
			$("#OrdenMSubtotal").val(parseFloat($("#OrdenMCantidad").val())*parseFloat($("#OrdenMPrecio").val()));

			if(parseFloat($("#OrdenMDescuento").val()) >= 0 && parseFloat($("#OrdenMIVA").val()) >= 0){
				var subtotal= parseFloat($("#OrdenMSubtotal").val())-(parseFloat($("#OrdenMSubtotal").val())*(parseFloat($("#OrdenMDescuento").val())/100));
				$("#OrdenMTotal").val(subtotal + ((parseFloat($("#OrdenMIVA").val())/100)*subtotal));
			}
		}
	});

	$("#FormMGuardarOrden").submit(function(e) {
		e.preventDefault();
		if($("#OrdenMProducto").val() != ""){
 			$("#OrdenMdetalles").append("<tr><td>"+$("#OrdenMCodigoP").val()+"</td><td><span hidden>"+$("#OrdenMCodigoP").attr('attrID')+"</span>"+$("#OrdenMProducto").val()+"</td><td>"+$("#OrdenMUMEP").val()+"</td><td><input type='number' class='IntDetalles MDetalles' step='any' min='1' value='"+$("#OrdenMCantidad").val()+"'></td><td><input type='number' class='IntDetalles MDetalles' step='any' min='1' value='"+$("#OrdenMPrecio").val()+"'></td><td>"+$("#OrdenMSubtotal").val()+"</td><td><input type='number' class='IntDetalles MDetalles' step='any' min='1' max='100' value='"+$("#OrdenMDescuento").val()+"'></td><td><input type='number' class='IntDetalles MDetalles' step='any' min='1' value='"+$("#OrdenMIVA").val()+"'></td><td>"+$("#OrdenMTotal").val()+"</td><td><button type='button' class='btn btn-danger btn-sm BorrarMDetalle'><i class='fas fa-times'></i></button></td></tr>");
 			$(".IntMOrPro").val("");
 			$(".IntMOrDetalle").val("0");
 			total($("#OrdenMdetalles"),$("#OrdenMCostoTotal"));
		}else{
			swal({
				type: 'warning',
				title: 'Debes seleccionar un producto',
			}).then((result) => {
				if (result.value) {
					$("#OrdenMBuscarProducto").click();
				}
			});
		}
	});

	$("#GuardarMOrdenCompra").click(function() {
		if($("#OrdenMFecha").val() == ""){
			swal({
				type: 'warning',
				title: 'Debes seleccionar una fecha',
			}).then((result) => {
				if (result.value) {
					$("#OrdenMFecha").focus();
				}
			});
		}else if($("#OrdenMdetalles").children('tr').index() < 0){
			swal({
				type: 'warning',
				title: 'Debes ingresar productos a la orden',
			});
		}else{
			swalWithBootstrapButtons({
			  	title: '¿Estas seguro que quieres modificar la Orden de Compra?',
			  	text: 'Una vez modificada ya no podrán ser recuperados sus datos jamás',
			  	type: 'warning',
			  	showCancelButton: true,
			 	confirmButtonText: 'Aceptar',
			  	cancelButtonText: 'Cancelar',
			  	reverseButtons: true
			}).then((result) => {
			  	if (result.value) {
					var insertarOC = new Array();
					var actualizarOC = new Array();
					var x=0,y=0;
					$("#OrdenMdetalles").children('tr').each(function(index) {
						if ($(this).children('td:eq(0)').children('span').text() != "") {
							actualizarOC[x]= [$(this).children('td:eq(0)').children('span').text(),$(this).children('td:eq(3)').children('input').val(),$(this).children('td:eq(4)').children('input').val(),$(this).children('td:eq(5)').text(),$(this).children('td:eq(6)').children('input').val(),$(this).children('td:eq(7)').children('input').val(),$(this).children('td:eq(8)').text()];
							x++;
						}else{
							insertarOC[y] = [$(this).children('td:eq(1)').children('span').text(),$(this).children('td:eq(3)').children('input').val(),$(this).children('td:eq(4)').children('input').val(),$(this).children('td:eq(5)').text(),$(this).children('td:eq(6)').children('input').val(),$(this).children('td:eq(7)').children('input').val(),$(this).children('td:eq(8)').text()];
							y++;
						}
					});
				
					var data="metodo=12&id="+$(this).attr('attrID')+"&folio="+$("#OrdenMNombreF").attr('attrFolio')+"&proveedor="+$("#OrdenMProveedor").attr('attrID')+"&total="+$("#OrdenMCostoTotal").val()+"&fecha="+$("#OrdenMFecha").val()+"&insertar="+JSON.stringify(insertarOC)+"&actualizar="+JSON.stringify(actualizarOC)+"&eliminar="+JSON.stringify(eliminarOC);

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
								title: 'La orden de compra ha sido eliminada',
							}); 
				 			ordenesCompra();
				 			setTimeout(function() {
								$("#ContenidoOrden").children('tr').eq(fila).show();
							},1000);
						}else{
							swal({
								type: 'error',
								title: 'Error:',
								text: 'La orden de compra no ha podido ser eliminada',
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
		}
	});

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	
	function ordenesCompra() {
		var data = "metodo=10&buscar="+$.trim($("#BuscarOC").val())+"&desde="+$("#fechaDesde").val()+"&hasta="+$("#fechaHasta").val()+"&tipo="+tipo;
		$.ajax({
			url: 'php/OrdenCompra.php',
			type: 'POST',
			data: data
		})
		.done(function(res) {
			$("#ContenidoOrden").html(res);	
		})
		.fail(function() {
			console.log("Error");
		});
		
	}

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

	function proveedores() {
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
	}

	function productos() {
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
				if (lfolio == 1) {
					$("#OrdenFolio").val(folio+'1');
				}else{
					$("#OrdenMFolio").val(folio+'1');
				}
			}else if(!isNaN(res)){
				if(lfolio == 1){
					$("#OrdenFolio").val(folio+(parseInt(res)+1));
				}else{
					$("#OrdenMFolio").val(folio+(parseInt(res)+1));
				}
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