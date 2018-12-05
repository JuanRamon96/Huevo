$(document).ready(function() {
	var tipo="0", fila=0;
	verEntregas();

	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});

	$("#EntregaBuscarResponsable").click(function() {
		responsables();
	});

	$(document).on('click','.seleccionarResponsable',function() {
		var padre=$(this).parent().parent();
		$("#EntregaResponsable").val(padre.children('td:eq(0)').text());
		$("#EntregaResponsable").attr("attrID",$(this).attr('attrID'));

		var data="metodo=2&id="+$(this).attr('attrID');
		$.ajax({
			url: 'php/entregas.php',
			type: 'POST',
			data: data
		})
		.done(function(res) {
			$("#EntregaDatosResponsable").html(res);
			$("#ModalSeleResponsable").modal("hide");
		})
		.fail(function() {
			console.log("Error");
		});
	});

	$("#EntregaBuscarProducto").click(function() {
		productos();
	});

	$(document).on('click', '.seleccionarENProducto', function() {
		var padre= $(this).parent().parent();
		$("#EntregaProducto").val(padre.children('td:eq(1)').text());
		$("#EntregaProducto").attr('attrID', $(this).attr('attrID'));
		$("#EntregaCodigoP").val(padre.children('td:eq(0)').text());
		$("#EntregaUMEP").val(padre.children('td:eq(2)').text());
		$("#EntregaEX").val(padre.children('td:eq(4)').text());
		$("#EntregaCosto").val(padre.children('td:eq(6)').text());
		$("#EntregaIVA").val(padre.children('td:eq(5)').text());
		$("#EntregaCantidad").attr('max', padre.children('td:eq(4)').text());
		calcular();
		$("#ModalSeleEntregaProducto").modal("hide");
	});

	$("#EntregaCantidad").on('change keyup', function() {
		calcular();
	});

	function calcular() {
		if(parseFloat($("#EntregaCantidad").val()) >= 0){
			var num = parseFloat($("#EntregaCantidad").val())*parseFloat($("#EntregaCosto").val());
			var total = num+(num * 0.16);
			$("#EntregaSubtotal").val(num.toFixed(2));
			$("#EntregaTotal").val(total.toFixed(2));
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

	$(document).on('change keyup', '.CantidadM', function() {
		if(parseFloat($(this).val()) >= 0){
			var padre = $(this).parent().parent();
			var num = parseFloat($(this).val())*parseFloat(padre.children('td:eq(4)').text());
			var total = num+(num * 0.16);
			padre.children('td:eq(5)').text(num.toFixed(2));
			padre.children('td:eq(7)').text(total.toFixed(2));
			calTotal($("#Entregadetalles"),$("#EntregaCostoTotal"));
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
		campo.val(suma);
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
			$("#Entregadetalles").children('tr').each(function(index) {
				detalles[index] = [$(this).children('td:eq(0)').children('span').text(),$(this).children('td:eq(3)').children('input').val(),$(this).children('td:eq(4)').text(),$(this).children('td:eq(5)').text(),$(this).children('td:eq(6)').text(),$(this).children('td:eq(7)').text()];
			});

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
				if(res=="Correcto"){
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
		 			//window.open("OrdenCompra.php?id="+separa[0]+"&proveedor="+separa[1]);
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
		alert("lmk");
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
});