$(document).ready(function() {
	var tipo="0", fila=0, clien=0, produ=0;
	var eliminarDE = new Array();
	verVentas();

	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});

	$("#VentaBuscarCliente").click(function() {
		clien=1;
		clientes();
	});

	$(document).on('click','.seleccionarCliente',function() {
		var padre=$(this).parent().parent();
		var id = $(this).attr('attrID');

		if(clien == 1){
			$("#VentaDatosCliente").html("<p>Código: "+padre.children('td:eq(0)').text()+"</p><p>Nombre: "+padre.children('td:eq(1)').text()+"</p><p>Domicilio: "+padre.children('td:eq(2)').text()+"</p><p>Colonia: "+padre.children('td:eq(3)').text()+"</p><p>Ciudad: "+padre.children('td:eq(4)').text()+"</p><p>Estado:"+padre.children('td:eq(5)').text()+"</p><p>País: "+padre.children('td:eq(6)').text()+"</p><p>CP: "+padre.children('td:eq(7)').text()+"</p><p>Razón social: "+padre.children('td:eq(8)').text()+"</p><p>RFC: "+padre.children('td:eq(9)').text()+"</p><p>Teléfono: "+padre.children('td:eq(10)').text()+"</p><p>Email: "+padre.children('td:eq(11)').text()+"</p><p>Contacto: "+padre.children('td:eq(12)').text()+"</p><p>Teléfono Contacto: "+padre.children('td:eq(13)').text()+"</p>");
			$("#VentaCliente").val(padre.children('td:eq(1)').text());
			$("#VentaCliente").attr("attrID", id);	
		}else{
			$("#VentaMDatosCliente").html("<p>Código: "+padre.children('td:eq(0)').text()+"</p><p>Nombre: "+padre.children('td:eq(1)').text()+"</p><p>Domicilio: "+padre.children('td:eq(2)').text()+"</p><p>Colonia: "+padre.children('td:eq(3)').text()+"</p><p>Ciudad: "+padre.children('td:eq(4)').text()+"</p><p>Estado:"+padre.children('td:eq(5)').text()+"</p><p>País: "+padre.children('td:eq(6)').text()+"</p><p>CP: "+padre.children('td:eq(7)').text()+"</p><p>Razón social: "+padre.children('td:eq(8)').text()+"</p><p>RFC: "+padre.children('td:eq(9)').text()+"</p><p>Teléfono: "+padre.children('td:eq(10)').text()+"</p><p>Email: "+padre.children('td:eq(11)').text()+"</p><p>Contacto: "+padre.children('td:eq(12)').text()+"</p><p>Teléfono Contacto: "+padre.children('td:eq(13)').text()+"</p>");
			$("#VentaMCliente").val(padre.children('td:eq(1)').text());
			$("#VentaMCliente").attr("attrID", id);
		}
		$("#ModalSeleCliente").modal("hide");
	});

	$("#VentaBuscarProducto").click(function() {
		produ=1;
		productos();
	});

	$(document).on('click', '.seleccionarVProducto', function() {
		var padre= $(this).parent().parent();
		if(produ==1){
			$("#VentaProducto").val(padre.children('td:eq(1)').text());
			$("#VentaProducto").attr('attrID', $(this).attr('attrID'));
			$("#VentaCodigoP").val(padre.children('td:eq(0)').text());
			$("#VentaUMEP").val(padre.children('td:eq(2)').text());
			$("#VentaEX").val(padre.children('td:eq(4)').text());
			$("#VentaIVA").val(padre.children('td:eq(5)').text());
			$("#VentaCantidad").attr('max', padre.children('td:eq(4)').text());
			calcular();
		}else{
			$("#VentaMProducto").val(padre.children('td:eq(1)').text());
			$("#VentaMProducto").attr('attrID', $(this).attr('attrID'));
			$("#VentaMCodigoP").val(padre.children('td:eq(0)').text());
			$("#VentaMUMEP").val(padre.children('td:eq(2)').text());
			$("#VentaMEX").val(padre.children('td:eq(4)').text());
			$("#VentaMIVA").val(padre.children('td:eq(5)').text());
			$("#VentaMCantidad").attr('max', padre.children('td:eq(4)').text());
			calcular1();
		}
		$("#ModalSeleVentaProducto").modal("hide");
	});

	$(".IntVenDetalle").on('change keyup', function() {
		calcular();
	});

	$(".IntMVenDetalle").on('change keyup', function() {
		calcular1();
	});

	function calcular() {
		if(parseFloat($("#VentaCantidad").val()) >= 0 && parseFloat($("#VentaPrecio").val()) >= 0 && parseFloat($("#VentaDescuento").val()) >= 0){
			var num = parseFloat($("#VentaCantidad").val())*parseFloat($("#VentaPrecio").val());
			var subtotal = num - (num * (parseFloat($("#VentaDescuento").val())/100)); 
			var total = subtotal+(subtotal * (parseFloat($("#VentaIVA").val())/100));
			$("#VentaSubtotal").val(subtotal.toFixed(2));
			$("#VentaTotal").val(total.toFixed(2));
		}
	}

	function calcular1() {
		if(parseFloat($("#VentaMCantidad").val()) >= 0 && parseFloat($("#VentaMPrecio").val()) >= 0 && parseFloat($("#VentaDescuento").val()) >= 0){
			var num = parseFloat($("#VentaMCantidad").val())*parseFloat($("#VentaMPrecio").val());
			var subtotal = num - (num * (parseFloat($("#VentaMDescuento").val())/100)); 
			var total = subtotal+(subtotal * (parseFloat($("#VentaMIVA").val())/100));
			$("#VentaMSubtotal").val(subtotal.toFixed(2));
			$("#VentaMTotal").val(total.toFixed(2));
		}
	}

	$("#FormGuardarVenta").submit(function(e) {
		e.preventDefault();
		if(parseFloat($("#VentaProducto").val()) != ""){
			$("#Ventadetalles").append("<tr><td><span hidden>"+$("#VentaProducto").attr('attrID')+"</span>"+$("#VentaCodigoP").val()+"</td><td>"+$("#VentaProducto").val()+"</td><td>"+$("#VentaUMEP").val()+"</td><td><input type='number' min='0' class='CantidadVM' max='"+$("#VentaEX").val()+"' value='"+$("#VentaCantidad").val()+"'></td><td><input type='number' min='0' class='CantidadVM' value='"+$("#VentaPrecio").val()+"'></td><td><input type='number' min='0' class='CantidadVM' value='"+$("#VentaDescuento").val()+"'></td><td>"+$("#VentaSubtotal").val()+"</td><td>"+$("#VentaIVA").val()+"</td><td>"+$("#VentaTotal").val()+"</td><td><button type='button' class='btn btn-danger btn-sm borrarDeVen'><i class='fas fa-times'></i></button></td></tr>");
			calTotal($("#Ventadetalles"),$("#VentaCostoTotal"));
			$(".IntVenDetalle").val("0");
			$(".IntVenPro").val("");
		}else{
			swal({
				type: 'warning',
				title: 'Debes seleccionar un producto',
			}).then((result) => {
				if (result.value) {
					$("#VentaBuscarProducto").click();
				}
			}); 
		}
	});

	$("#FormMGuardarVenta").submit(function(e) {
		e.preventDefault();
		if(parseFloat($("#VentaMProducto").val()) != ""){
			$("#VentaMdetalles").append("<tr><td><span hidden>"+$("#VentaMProducto").attr('attrID')+"</span>"+$("#VentaMCodigoP").val()+"</td><td>"+$("#VentaMProducto").val()+"</td><td>"+$("#VentaMUMEP").val()+"</td><td><input type='number' min='0' class='CantidadVMM' max='"+$("#VentaMEX").val()+"' value='"+$("#VentaMCantidad").val()+"'></td><td><input type='number' min='0' class='CantidadVMM' value='"+$("#VentaMPrecio").val()+"'></td><td><input type='number' min='0' class='CantidadVMM' value='"+$("#VentaMDescuento").val()+"'></td><td>"+$("#VentaMSubtotal").val()+"</td><td>"+$("#VentaMIVA").val()+"</td><td>"+$("#VentaMTotal").val()+"</td><td><button type='button' class='btn btn-danger btn-sm borrarMDeVen'><i class='fas fa-times'></i></button></td></tr>");
			calTotal($("#VentaMdetalles"),$("#VentaMCostoTotal"));
			$(".IntMVenDetalle").val("0");
			$(".IntMVenPro").val("");
		}else{
			swal({
				type: 'warning',
				title: 'Debes seleccionar un producto',
			}).then((result) => {
				if (result.value) {
					$("#VentaMBuscarProducto").click();
				}
			}); 
		}
	});

	$(document).on('change keyup', '.CantidadVM', function() {
		if(parseFloat($(".CantidadVM").val()) >= 0 ){
			var padre = $(this).parent().parent();
			var num = parseFloat(padre.children('td:eq(3)').children('input').val())*parseFloat(padre.children('td:eq(4)').children('input').val());
			var subtotal = num - (num * (parseFloat(padre.children('td:eq(5)').children('input').val())/100));
			var total = subtotal+(subtotal * (parseFloat(padre.children('td:eq(7)').text())/100));
			padre.children('td:eq(6)').text(subtotal.toFixed(2));
			padre.children('td:eq(8)').text(total.toFixed(2));
			calTotal($("#Ventadetalles"),$("#VentaCostoTotal"));
		}
	});

	$(document).on('change keyup', '.CantidadVMM', function() {
		if(parseFloat($(".CantidadVMM").val()) >= 0 ){
			var padre = $(this).parent().parent();
			var num = parseFloat(padre.children('td:eq(3)').children('input').val())*parseFloat(padre.children('td:eq(4)').children('input').val());
			var subtotal = num - (num * (parseFloat(padre.children('td:eq(5)').children('input').val())/100));
			var total = subtotal+(subtotal * (parseFloat(padre.children('td:eq(7)').text())/100));
			padre.children('td:eq(6)').text(subtotal.toFixed(2));
			padre.children('td:eq(8)').text(total.toFixed(2));
			calTotal($("#VentaMdetalles"),$("#VentaMCostoTotal"));
		}
	});

	$(document).on('click', '.borrarDeVen', function() {
		$(this).parent().parent().remove();
		calTotal($("#Ventadetalles"),$("#VentaCostoTotal"));
	});

	function calTotal(tabla,campo) {
		var suma=0;
		tabla.children('tr').each(function() {
			suma += parseFloat($(this).children('td:eq(8)').text());
		});
		campo.val(suma.toFixed(2));
	}

	$("#GuardarVenta").click(function() {
		if($("#VentaFolio").val() == ""){
			swal({
				type: 'warning',
				title: 'Debes seleccionar un folio',
			}).then((result) => {
				if (result.value) {
					$("#VentaBuscarFolio").click();
				}
			});	
		}else if($("#VentaCliente").val() == ""){
			swal({
				type: 'warning',
				title: 'Debes seleccionar un responsable',
			}).then((result) => {
				if (result.value) {
					$("#VentaBuscarCliente").click();
				}
			});
		}else if($("#Ventadetalles").children('tr').index() < 0){
			swal({
				type: 'warning',
				title: 'Debes ingresar productos a la entrega',
			});
		}else{
			var detalles = new Array();
			var error=0, contador=0;
			$("#Ventadetalles").children('tr').each(function(index) {
				if(parseFloat($(this).children('td:eq(3)').children('input').val()) > parseFloat($(this).children('td:eq(3)').children('input').attr('max')) || parseFloat($(this).children('td:eq(3)').children('input').val()) < parseFloat($(this).children('td:eq(3)').children('input').attr('min'))){
					error=1;
					contador=index;
					return false;
				}
				detalles[index] = [$(this).children('td:eq(0)').children('span').text(),$(this).children('td:eq(3)').children('input').val(),$(this).children('td:eq(4)').children('input').val(),$(this).children('td:eq(5)').children('input').val(),$(this).children('td:eq(6)').text(),$(this).children('td:eq(7)').text(),$(this).children('td:eq(8)').text()];			
			});

			if(error==0){

				var data="metodo=3&folio="+$("#VentaNombreF").attr('attrFolio')+"&cliente="+$("#VentaCliente").attr("attrID")+"&total="+$("#VentaCostoTotal").val()+"&detalles="+JSON.stringify(detalles);
				
				$.ajax({
					url: 'php/ventas.php',
					type: 'POST',
					data: data,
					beforeSend: function() {
					    $("#carga").show();
					}
				})
				.done(function(res) {
					var separa = res.split("*");
					if(separa[2]=="Correcto"){
						swal({
							type: 'success',
							title: 'La venta ha sido guardada',
						}); 
						$("#Ventadetalles tr").remove();
						$(".IntVenDetalle").val("0");
						$(".IntVenPro").val("");
			 			$("#VentaCliente").val("");
			 			$("#VentaDatosCliente").html("");
			 			calTotal($("#Ventadetalles"),$("#VentaCostoTotal"));
			 			valorFolio('ventas',$("#VentaNombreF").attr('attrFolio'));
			 			verVentas();
			 			verProductos();
			 			//window.open("Venta.php?id="+separa[0]+"&empleado="+separa[1]);
					}else{
						swal({
							type: 'error',
							title: 'Error:',
							text: 'La venta no ha podido ser guardada',
						});
						console.log(res);
					}
					$("#carga").hide();	
				})
				.fail(function() {
					console.log("Error");
				});
			}else{
				swal({
					type: 'warning',
					text: 'La cantidad de un producto en la lista es incorrecta o no hay suficientes productos en existencia',
				}).then((result) => {
					if (result.value) {
						setTimeout(function() {
							$("#Ventadetalles").children('tr').eq(contador).children('td:eq(3)').children('input').focus();
						},500);
					}
				});
			}
		}
	});

	$("input[name=RVenta]").click(function() {
		tipo=$(this).val();
		verVentas();
	});
	
	$(document).on('click', '.vermasVenta', function() {
		var fila= $(this).parent().parent().index();
		$(this).parent().parent().parent().children('tr').eq(fila+1).toggle('fast');
	});

	$(document).on('change keyup','.busVentas', function() {
		verVentas();
	});

	$(document).on('click', '.bCancelarVenta', function() {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres cancelar la venta?',
		  	text: "¡Una vez cancelada no podrá ser recuperada!",
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
				fila = $(this).parent().parent().parent().parent().parent().parent().index();
				var regre = Array();
				$(this).parent().parent().children('div:eq(0)').children('table').children('tbody').children('tr').each(function(index) {
					regre[index]=[$(this).children('td:eq(1)').children('span').text(),$(this).children('td:eq(3)').text()];
				});

				var data = "metodo=5&id="+$(this).attr('attrID')+"&regre="+JSON.stringify(regre);

				$.ajax({
					url: 'php/ventas.php',
					type: 'POST',
					data: data,
					beforeSend: function() {
						$("#carga").show();
					}
				})
				.done(function(res) {
					if(res == "Correcto"){
						swal({
							type: 'success',
							title: 'La venta ha sido cancelada',
						}); 
						verVentas();
						verProductos();
						setTimeout(function() {
							$("#ContenidoVentas").children('tr').eq(fila).show();
						},1500);
					}else{
						swal({
							type: 'error',
							title: 'Error:',
							text: 'La venta no ha podido ser cancelada',
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

	/*$(document).on('click', '.bBorrarEntre', function() {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres eliminar la entrega?',
		  	text: "¡Una vez eliminada no podrá ser recuperada!",
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
				var regre = Array();
				$(this).parent().parent().children('div:eq(0)').children('table').children('tbody').children('tr').each(function(index) {
					regre[index]=[$(this).children('td:eq(1)').children('span').text(),$(this).children('td:eq(3)').text()];
				});

				var data = "metodo=7&id="+$(this).attr('attrID')+"&cancela="+$(this).attr('attrCan')+"&regre="+JSON.stringify(regre);

				$.ajax({
					url: 'php/entregas.php',
					type: 'POST',
					data: data,
					beforeSend: function() {
						$("#carga").show();
					}
				})
				.done(function(res) {
					if(res == "Correcto"){
						swal({
							type: 'success',
							title: 'La entrega ha sido eliminada',
						}); 
						verEntregas();
						verProductos();
					}else{
						swal({
							type: 'error',
							title: 'Error:',
							text: 'La entrega no ha podido ser eliminada',
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

	$(document).on('click', '.bModificarEntre', function() {
		fila = $(this).parent().parent().parent().parent().parent().parent().index();
		var Npadre=$(this).parent().parent().parent().parent().parent().parent().index();
		var padreS=$("#ContenidoEntregas").children('tr').eq(Npadre-1);
		$("#EntregaMFolio").val(padreS.children('td:eq(0)').children('p').text());
		$("#EntregaMNombreF").val(padreS.children('td:eq(0)').children('span').text());
		$("#EntregaMResponsable").val(padreS.children('td:eq(1)').children('p').text());
		$("#EntregaMDatosResponsable").html(padreS.children('td:eq(1)').children('span:eq(1)').html());
		$("#EntregaMdetalles").html("");
		if($(this).parent().parent().children('div:eq(0)').children('table').children('tbody').children('tr').children('td').text() != "No se encontraron detalles"){
			$(this).parent().parent().children('div:eq(0)').children('table').children('tbody').children('tr').each(function(index) {
				$("#EntregaMdetalles").append("<tr><td><span hidden>"+$(this).children('td:eq(0)').children('span').text()+"</span>"+$(this).children('td:eq(0)').children('p').text()+"</td><td><span hidden>"+$(this).children('td:eq(1)').children('span').text()+"</span>"+$(this).children('td:eq(1)').children('p').text()+"</td><td>"+$(this).children('td:eq(2)').text()+"</td><td><input type='number' class='CantidadMM' max='"+$(this).children('td:eq(3)').attr('attrMax')+"' step='any' min='1' value='"+$(this).children('td:eq(3)').text()+"'></td><td>"+$(this).children('td:eq(4)').text()+"</td><td>"+$(this).children('td:eq(5)').text()+"</td><td>"+$(this).children('td:eq(6)').text()+"</td><td>"+$(this).children('td:eq(7)').text()+"</td><td><button type='button' class='btn btn-danger btn-sm borrarMDeEn'><i class='fas fa-times'></i></button></td></tr>");
			});
		}
		$("#EntregaMCostoTotal").val(padreS.children('td:eq(2)').text());
		$("#EntregaMFecha").val(padreS.children('td:eq(3)').children('span').text().replace(" ","T"));

		$(".IntMENDetalle").val('0');
		$(".IntMENPro").val("");
		eliminarDE.length = 0;
		$("#EntregaMNombreF").attr('attrFolio', "");
		$("#EntregaMResponsable").attr('attrID', "");
		$("#GuardarMEntrega").attr('attrID', $(this).attr('attrID'));
	});

	$("#EntregaMBuscarResponsable").click(function() {
		$('#ModalSeleResponsable').css('z-index', '1060');
		responsables();
		respo=2;
	});

	$('#ModalSeleResponsable').on('hidden.bs.modal',function() {
		if(respo == 2){
			$('body').addClass('modal-open');
		}
	});

	$("#EntregaMBuscarProducto").click(function(event) {
		$('#ModalSeleEntregaProducto').css('z-index', '1060');
		productos();
		produ=2;
	});

	$('#ModalSeleEntregaProducto').on('hidden.bs.modal',function() {
		if(produ == 2){
			$('body').addClass('modal-open');
		}
	});

	$(document).on('click', '.borrarMDeEn', function() {
		var padre=$(this).parent().parent();
		if (padre.children('td:eq(0)').children('span').text() != "") {
			eliminarDE.push(padre.children('td:eq(0)').children('span').text());
		}
		padre.remove();
		calTotal($("#EntregaMdetalles"),$("#EntregaMCostoTotal"));
	});

	$("#GuardarMEntrega").click(function() {
		if($("#EntregaMFolio").val() == ""){
			swal({
				type: 'warning',
				title: 'Debes seleccionar un folio',
			}).then((result) => {
				if (result.value) {
					$("#EntregaMBuscarFolio").click();
				}
			});	
		}else if($("#EntregaMFecha").val() == ""){
			swal({
				type: 'warning',
				title: 'Debes seleccionar una fecha',
			}).then((result) => {
				if (result.value) {
					$("#EntregaMFecha").focus();
				}
			});
		}else if($("#EntregaMResponsable").val() == ""){
			swal({
				type: 'warning',
				title: 'Debes seleccionar un responsable',
			}).then((result) => {
				if (result.value) {
					$("#EntregaMBuscarResponsable").click();
				}
			});
		}else if($("#EntregaMdetalles").children('tr').index() < 0){
			swal({
				type: 'warning',
				title: 'Debes ingresar productos a la entrega',
			});
		}else{
			var insertar = new Array();
			var actualizar = new Array();
			var x=0, y=0, error=0, contador=0;
			$("#EntregaMdetalles").children('tr').each(function(index) {
				if(parseFloat($(this).children('td:eq(3)').children('input').val()) > parseFloat($(this).children('td:eq(3)').children('input').attr('max')) || parseFloat($(this).children('td:eq(3)').children('input').val()) < parseFloat($(this).children('td:eq(3)').children('input').attr('min'))){
					error=1;
					contador=index;
					return false;
				}

				if($(this).children('td:eq(1)').children('span').text() == ""){
					insertar[x] = [$(this).children('td:eq(0)').children('span').text(),$(this).children('td:eq(3)').children('input').val(),$(this).children('td:eq(4)').text(),$(this).children('td:eq(5)').text(),$(this).children('td:eq(6)').text(),$(this).children('td:eq(7)').text()];
					x++;				
				}else{
					actualizar[y] = [$(this).children('td:eq(0)').children('span').text(),$(this).children('td:eq(3)').children('input').val(),$(this).children('td:eq(4)').text(),$(this).children('td:eq(5)').text(),$(this).children('td:eq(6)').text(),$(this).children('td:eq(7)').text()];
					y++;
				}
			});

			if(error==0){

				var data="metodo=8&id="+$("#GuardarMEntrega").attr('attrID')+"&folio="+$("#EntregaMNombreF").attr('attrFolio')+"&responsable="+$("#EntregaMResponsable").attr("attrID")+"&total="+$("#EntregaMCostoTotal").val()+"&fecha="+$("#EntregaMFecha").val()+"&insertar="+JSON.stringify(insertar)+"&actualizar="+JSON.stringify(actualizar)+"&eliminar="+JSON.stringify(eliminarDE);
				
				$.ajax({
					url: 'php/entregas.php',
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
							title: 'La entrega ha sido modificada',
						}); 
			 			verEntregas();
			 			verProductos();
			 			setTimeout(function() {
							$("#ContenidoEntregas").children('tr').eq(fila).show();
						},1500);
					}else{
						swal({
							type: 'error',
							title: 'Error:',
							text: 'La entrega no ha podido ser guardada',
						});
						console.log(res);
					}
					$("#carga").hide();	
				})
				.fail(function() {
					console.log("Error");
				});
			}else{
				swal({
					type: 'warning',
					text: 'La cantidad de un producto en la lista es incorrecta o no hay suficientes productos en existencia',
				}).then((result) => {
					if (result.value) {
						setTimeout(function() {
							$("#EntregaMdetalles").children('tr').eq(contador).children('td:eq(3)').children('input').focus();
						},500);
					}
				});
			}
		}
	});*/

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	function verVentas() {
		var data = "metodo=4&buscar="+$("#BuscarVentas").val()+"&desde="+$("#fechaDesdeV").val()+"&hasta="+$("#fechaHastaV").val()+"&tipo="+tipo;
		
		$.ajax({
			url: 'php/ventas.php',
			type: 'POST',
			data: data
		})
		.done(function(res) {
			$("#ContenidoVentas").html(res);
		})
		.fail(function() {
			console.log("Error");
		});
	}

	function valorFolio(tabla,folio) {
		var data = "metodo=5&folio="+folio+"&tabla="+tabla; 

		$.ajax({
			url: 'php/OrdenCompra.php',
			type: 'POST',
			data: data
		})
		.done(function(res) {
			if(res == ""){
				$("#VentaFolio").val(folio+'1');
			}else if(!isNaN(res)){	
				$("#VentaFolio").val(folio+(parseInt(res)+1));
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

	function clientes() {
		$.ajax({
			url: 'php/ventas.php',
			type: 'POST',
			data: 'metodo=1'
		})
		.done(function(res) {
			$("#verVentaCliente").html(res);
			$("#tablaVerClientes").DataTable({
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
			url: 'php/ventas.php',
			type: 'POST',
			data: 'metodo=2'
		})
		.done(function(res) {
			$("#verVentaProductos").html(res);
			$("#tablaVProductos").DataTable({
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

	$.fn.dataTable.ext.errMode = 'none';
	function productos1(catego,tabla) {
		tabla.dataTable({
			"destroy": true,
			"ajax":{
				"url": 'php/productos.php',
				"method": 'POST',
				"data": {
			        "metodo": '2',
			        "categoria": catego
			    }
			},
			"columns": [
				{ "data": "Codigo" },
	            { "data": "Nombre" },
	            { "data": "UME" },
	            { "data": "Existencia" },
	            { "data": "Min" },
	            { "data": "Max" },
	            { "data": "IVA" },
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
	            	filename: catego,
	            	title: catego
	            },
	            {
	            	extend: 'pdfHtml5',
	            	text: "<i class='fas fa-file-pdf'></i>",
	            	titleAttr: 'PDF',
	            	filename: catego,
	            	title: catego,
	            	customize: function(doc) {
					    doc.defaultStyle.alignment = 'center';
					}
	            }
	        ]
		});
	}

	function verProductos() {
		productos1('Materia Prima',$("#tablaProductos2"));
		productos1('Producto Terminado',$("#tablaProductos1"));
	}
});