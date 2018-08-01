$(document).ready(function() {
	verProductos();

	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});

	$("#FormGuardarProducto").submit(function(e) {
		e.preventDefault();

		var datos = "metodo=1&nombre="+$.trim($("#ProductoNombre").val())+"&ume="+$("#ProductoUME").val()+"&categoria="+$("#ProductoCategoria").val()+"&existencia="+$("#ProductoExistencia").val()+"&minimo="+$("#ProductoMinimo").val()+"&maximo="+$("#ProductoMaximo").val();
			
		$.ajax({
			url: 'php/productos.php',
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
			  	title: 'El producto se ha guardado',
			}); 
			$(".IntProductos").val("");
			verProductos();	
		}else{
			swal({
			  	type: 'error',
			  	title: 'Error:',
			  	text: 'El producto no se ha podido guardar',
			});
			console.log(res);
		}
		$("#carga").hide();
		})
		.fail(function() {
			console.log("Error");
		});
	});

	$(document).on('click', '.BorrarProducto', function() {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres eliminar el producto del inventario?',
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
					url: 'php/productos.php',
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
						  	title: 'El producto ha sido borrado',
						});  
						verProductos();	
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'El producto no ha podido ser borrado',
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

	$(document).on('click', '.ModificarProducto', function() {
		var padre = $(this).parent().parent();
		$("#ProductoMNombre").val(padre.children('td:eq(0)').text());
		$("#ProductoMUME").val(padre.children('td:eq(1)').text());
		$("#ProductoMExistencia").val(padre.children('td:eq(2)').text());
		$("#ProductoMMinimo").val(padre.children('td:eq(3)').text());
		$("#ProductoMMaximo").val(padre.children('td:eq(4)').text());
		
		if(padre.children('td:eq(5)').text() == 'Activo'){
			$("#ProductoMActivo").attr('checked', true);
		}else{
			$("#ProductoMActivo").attr('checked', false);
		}
		$("#GuardarMProducto").attr('attrID', $(this).attr('attrID'));
		$("#GuardarMProducto").attr('disabled', true);
	});

	$(".ModiProductos").on('keyup change', function() {
		$("#GuardarMProducto").attr('disabled', false);
	});

	$("#FormModiProducto").submit(function(e) {
		e.preventDefault();
		var activo=0;
		if($("#ProductoMActivo").is(':checked')){
			activo=1;
		}else{
			activo=0;
		}
		
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres modificar los datos del producto?',
		  	text: "¡Una vez modificados no podrán ser recuperados jamás!",
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=4&id="+$("#GuardarMProducto").attr('attrID')+"&nombre="+$("#ProductoMNombre").val()+"&ume="+$("#ProductoMUME").val()+"&existencia="+$("#ProductoMExistencia").val()+"&minimo="+$("#ProductoMMinimo").val()+"&maximo="+$("#ProductoMMaximo").val()+"&activo="+activo;

				$.ajax({
					url: 'php/productos.php',
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
						  	title: 'Los datos del producto han sido modificados',
						});  
						verProductos();	
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'Los datos del producto no han podido ser modificados',
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

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	
	$.fn.dataTable.ext.errMode = 'none';
	function productos(catego,tabla) {
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
	            { "data": "Nombre" },
	            { "data": "UME" },
	            { "data": "Existencia" },
	            { "data": "Max" },
	            {"data": "Min"},
	            {"data": "Activo"},
	            {"data": "Botones"}
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
	            	titleAttr: 'Excel'
	            },
	            {
	            	extend: 'pdfHtml5',
	            	text: "<i class='fas fa-file-pdf'></i>",
	            	titleAttr: 'PDF'
	            }
	        ]
		});
	}

	function verProductos() {
		productos('Producto Terminado',$("#tablaProductos1"));
		productos('Materia Prima',$("#tablaProductos2"));
		productos('Materia Prima',$("#tablaProductos2"));
		productos('Insumo',$("#tablaProductos3"));
	}
});