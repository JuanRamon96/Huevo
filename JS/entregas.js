$(document).ready(function() {
	var tipo="0", fila=0, respo=0, produ=0;
	var eliminarDE = new Array();
	verEntregas();

	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});

	$("#EntregaBuscarResponsable").click(function() {
		respo=1;
		responsables();
	});

	$(document).on('click','.seleccionarResponsable',function() {
		var padre=$(this).parent().parent();
		var id = $(this).attr('attrID');

		var data="metodo=2&id="+$(this).attr('attrID');
		$.ajax({
			url: 'php/entregas.php',
			type: 'POST',
			data: data
		})
		.done(function(res) {
			if(respo == 1){
				$("#EntregaDatosResponsable").html(res);
				$("#EntregaResponsable").val(padre.children('td:eq(1)').text()+" "+padre.children('td:eq(2)').text()+" "+padre.children('td:eq(3)').text());
				$("#EntregaResponsable").attr("attrID", id);	
			}else{
				$("#EntregaMResponsable").attr("attrID", id);
				$("#EntregaMDatosResponsable").html(res);
				$("#EntregaMResponsable").val(padre.children('td:eq(1)').text()+" "+padre.children('td:eq(2)').text()+" "+padre.children('td:eq(3)').text());
			}
			$("#ModalSeleResponsable").modal("hide");
		})
		.fail(function() {
			console.log("Error");
		});
	});

	$("#EntregaBuscarProducto").click(function() {
		produ=1;
		productos();
	});

	$(document).on('click', '.seleccionarENProducto', function() {
		var padre= $(this).parent().parent();
		if(produ==1){
			$("#EntregaProducto").val(padre.children('td:eq(1)').text());
			$("#EntregaProducto").attr('attrID', $(this).attr('attrID'));
			$("#EntregaCodigoP").val(padre.children('td:eq(0)').text());
			$("#EntregaUMEP").val(padre.children('td:eq(2)').text());
			$("#EntregaEX").val(padre.children('td:eq(4)').text());
			$("#EntregaCosto").val(padre.children('td:eq(6)').text());
			$("#EntregaIVA").val(padre.children('td:eq(5)').text());
			$("#EntregaCantidad").attr('max', padre.children('td:eq(4)').text());
			calcular();
		}else{
			$("#EntregaMProducto").val(padre.children('td:eq(1)').text());
			$("#EntregaMProducto").attr('attrID', $(this).attr('attrID'));
			$("#EntregaMCodigoP").val(padre.children('td:eq(0)').text());
			$("#EntregaMUMEP").val(padre.children('td:eq(2)').text());
			$("#EntregaMEX").val(padre.children('td:eq(4)').text());
			$("#EntregaMCosto").val(padre.children('td:eq(6)').text());
			$("#EntregaMIVA").val(padre.children('td:eq(5)').text());
			$("#EntregaMCantidad").attr('max', padre.children('td:eq(4)').text());
			calcular1();
		}
		$("#ModalSeleEntregaProducto").modal("hide");
	});

	$("#EntregaCantidad").on('change keyup', function() {
		calcular();
	});

	$("#EntregaMCantidad").on('change keyup', function() {
		calcular1();
	});

	$(document).on('change keyup','.busEntregas', function() {
		verEntregas();
	});

	function calcular() {
		if(parseFloat($("#EntregaCantidad").val()) >= 0){
			var num = parseFloat($("#EntregaCantidad").val())*parseFloat($("#EntregaCosto").val());
			var total = num+(num * (parseFloat($("#EntregaIVA").val())/100));
			$("#EntregaSubtotal").val(num.toFixed(2));
			$("#EntregaTotal").val(total.toFixed(2));
		}
	}

	function calcular1() {
		if(parseFloat($("#EntregaMCantidad").val()) >= 0){
			var num = parseFloat($("#EntregaMCantidad").val())*parseFloat($("#EntregaMCosto").val());
			var total = num+(num * (parseFloat($("#EntregaMIVA").val())/100));
			$("#EntregaMSubtotal").val(num.toFixed(2));
			$("#EntregaMTotal").val(total.toFixed(2));
		}
	}

	$("#FormGuardarEntrega").submit(function(e) {
		e.preventDefault();
		if(parseFloat($("#EntregaProducto").val()) != ""){
			$("#Entregadetalles").append("<tr><td><span hidden>"+$("#EntregaProducto").attr('attrID')+"</span>"+$("#EntregaCodigoP").val()+"</td><td>"+$("#EntregaProducto").val()+"</td><td>"+$("#EntregaUMEP").val()+"</td><td><input type='number' min='0' class='CantidadM' max='"+$("#EntregaEX").val()+"' value='"+$("#EntregaCantidad").val()+"'></td><td>"+$("#EntregaCosto").val()+"</td><td>"+$("#EntregaSubtotal").val()+"</td><td>"+$("#EntregaIVA").val()+"</td><td>"+$("#EntregaTotal").val()+"</td><td><button type='button' class='btn btn-danger btn-sm borrarDeEn'><i class='fas fa-times'></i></button></td></tr>");
			calTotal($("#Entregadetalles"),$("#EntregaCostoTotal"));
			$(".IntENDetalle").val("0");
			$(".IntENPro").val("");
		}else{
			swal({
				type: 'warning',
				title: 'Debes seleccionar un producto',
			}).then((result) => {
				if (result.value) {
					$("#EntregaBuscarProducto").click();
				}
			}); 
		}
	});

	$("#FormMGuardarEntrega").submit(function(e) {
		e.preventDefault();
		if(parseFloat($("#EntregaMProducto").val()) != ""){
			$("#EntregaMdetalles").append("<tr><td><span hidden>"+$("#EntregaMProducto").attr('attrID')+"</span>"+$("#EntregaMCodigoP").val()+"</td><td>"+$("#EntregaMProducto").val()+"</td><td>"+$("#EntregaMUMEP").val()+"</td><td><input type='number' min='0' class='CantidadMM' max='"+$("#EntregaMEX").val()+"' value='"+$("#EntregaMCantidad").val()+"'></td><td>"+$("#EntregaMCosto").val()+"</td><td>"+$("#EntregaMSubtotal").val()+"</td><td>"+$("#EntregaMIVA").val()+"</td><td>"+$("#EntregaMTotal").val()+"</td><td><button type='button' class='btn btn-danger btn-sm borrarMDeEn'><i class='fas fa-times'></i></button></td></tr>");
			calTotal($("#EntregaMdetalles"),$("#EntregaMCostoTotal"));
			$(".IntMENDetalle").val("0");
			$(".IntMENPro").val("");
		}else{
			swal({
				type: 'warning',
				title: 'Debes seleccionar un producto',
			}).then((result) => {
				if (result.value) {
					$("#EntregaMBuscarProducto").click();
				}
			}); 
		}
	});

	$(document).on('change keyup', '.CantidadM', function() {
		if(parseFloat($(this).val()) >= 0){
			var padre = $(this).parent().parent();
			var num = parseFloat($(this).val())*parseFloat(padre.children('td:eq(4)').text());
			var total = num+(num * (parseFloat(padre.children('td:eq(6)').text())/100));
			padre.children('td:eq(5)').text(num.toFixed(2));
			padre.children('td:eq(7)').text(total.toFixed(2));
			calTotal($("#Entregadetalles"),$("#EntregaCostoTotal"));
		}
	});

	$(document).on('change keyup', '.CantidadMM', function() {
		if(parseFloat($(this).val()) >= 0){
			var padre = $(this).parent().parent();
			var num = parseFloat($(this).val())*parseFloat(padre.children('td:eq(4)').text());
			var total = num+(num * (parseFloat(padre.children('td:eq(6)').text())/100));
			padre.children('td:eq(5)').text(num.toFixed(2));
			padre.children('td:eq(7)').text(total.toFixed(2));
			calTotal($("#EntregaMdetalles"),$("#EntregaMCostoTotal"));
		}
	});

	$(document).on('click', '.borrarDeEn', function() {
		$(this).parent().parent().remove();
		calTotal($("#Entregadetalles"),$("#EntregaCostoTotal"));
	});

	function calTotal(tabla,campo) {
		var suma=0;
		tabla.children('tr').each(function() {
			suma += parseFloat($(this).children('td:eq(7)').text());
		});
		campo.val(suma.toFixed(2));
	}

	$("#GuardarEntrega").click(function() {
		if($("#EntregaFolio").val() == ""){
			swal({
				type: 'warning',
				title: 'Debes seleccionar un folio',
			}).then((result) => {
				if (result.value) {
					$("#EntregaBuscarFolio").click();
				}
			});	
		}else if($("#EntregaResponsable").val() == ""){
			swal({
				type: 'warning',
				title: 'Debes seleccionar un responsable',
			}).then((result) => {
				if (result.value) {
					$("#EntregaBuscarResponsable").click();
				}
			});
		}else if($("#Entregadetalles").children('tr').index() < 0){
			swal({
				type: 'warning',
				title: 'Debes ingresar productos a la entrega',
			});
		}else{
			var detalles = new Array();
			var error=0, contador=0;
			$("#Entregadetalles").children('tr').each(function(index) {
				if(parseFloat($(this).children('td:eq(3)').children('input').val()) > parseFloat($(this).children('td:eq(3)').children('input').attr('max')) || parseFloat($(this).children('td:eq(3)').children('input').val()) < parseFloat($(this).children('td:eq(3)').children('input').attr('min'))){
					error=1;
					contador=index;
					return false;
				}
				detalles[index] = [$(this).children('td:eq(0)').children('span').text(),$(this).children('td:eq(3)').children('input').val(),$(this).children('td:eq(4)').text(),$(this).children('td:eq(5)').text(),$(this).children('td:eq(6)').text(),$(this).children('td:eq(7)').text()];
			});

			if(error==0){

				var data="metodo=4&folio="+$("#EntregaNombreF").attr('attrFolio')+"&responsable="+$("#EntregaResponsable").attr("attrID")+"&total="+$("#EntregaCostoTotal").val()+"&detalles="+JSON.stringify(detalles);
				
				$.ajax({
					url: 'php/entregas.php',
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
							title: 'La entrega ha sido guardada',
						}); 
						$("#Entregadetalles tr").remove();
						$(".IntENDetalle").val("0");
						$(".IntENPro").val("");
			 			$("#EntregaResponsable").val("");
			 			$("#EntregaDatosResponsable").html("");
			 			calTotal($("#Entregadetalles"),$("#EntregaCostoTotal"));
			 			valorFolio('entregas',$("#EntregaNombreF").attr('attrFolio'));
			 			verEntregas();
			 			verProductos();
			 			window.open("Entrega.php?id="+separa[0]+"&empleado="+separa[1]);
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
							$("#Entregadetalles").children('tr').eq(contador).children('td:eq(3)').children('input').focus();
						},500);
					}
				});
			}
		}
	});

	$("input[name=REntrega]").click(function() {
		tipo=$(this).val();
		verEntregas();
	});

	$(document).on('click', '.vermasEntrega', function() {
		var fila= $(this).parent().parent().index();
		$(this).parent().parent().parent().children('tr').eq(fila+1).toggle('fast');
	});

	$(document).on('click', '.bCancelarEntre', function() {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres cancelar la entrega?',
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

				var data = "metodo=6&id="+$(this).attr('attrID')+"&regre="+JSON.stringify(regre);

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
							title: 'La entrega ha sido cancelada',
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
							text: 'La entrega no ha podido ser cancelada',
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

	$(document).on('click', '.bBorrarEntre', function() {
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
	});

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	function verEntregas() {
		var data = "metodo=5&buscar="+$("#BuscarEntregas").val()+"&desde="+$("#fechaDesdeE").val()+"&hasta="+$("#fechaHastaE").val()+"&tipo="+tipo;
		
		$.ajax({
			url: 'php/entregas.php',
			type: 'POST',
			data: data
		})
		.done(function(res) {
			$("#ContenidoEntregas").html(res);
		})
		.fail(function() {
			console.log("Error");
		});
	}

	function responsables() {
		$.ajax({
			url: 'php/entregas.php',
			type: 'POST',
			data: 'metodo=1'
		})
		.done(function(res) {
			$("#verOrdenResponsable").html(res);
			$("#tablaResponsables").DataTable({
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
			url: 'php/entregas.php',
			type: 'POST',
			data: 'metodo=3'
		})
		.done(function(res) {
			$("#verEntregaProductos").html(res);
			$("#tablaEProductos").DataTable({
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

	function valorFolio(tabla,folio) {
		var data = "metodo=5&folio="+folio+"&tabla="+tabla; 

		$.ajax({
			url: 'php/OrdenCompra.php',
			type: 'POST',
			data: data
		})
		.done(function(res) {
			if(res == ""){
				$("#EntregaFolio").val(folio+'1');
			}else if(!isNaN(res)){	
				$("#EntregaFolio").val(folio+(parseInt(res)+1));
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
		productos1('Insumo',$("#tablaProductos3"));
	}
});