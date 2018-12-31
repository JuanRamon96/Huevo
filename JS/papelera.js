$(document).ready(function() {
	registros(1,$("#productos"));
	registros(4,$("#clientes"));
	registros(5,$("#proveedores"));

	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});

	$(document).on('click', '.restaurar', function(event) {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres restaurar el registro?',
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=2&id="+$(this).attr('attrID')+"&tabla="+$(this).parent().parent().parent().attr('id')+"&tipo="+$(this).parent().parent().parent().attr('attrTipo')+"&campo="+$(this).parent().parent().parent().attr('attrCampo');

				$.ajax({
					url: 'php/papelera.php',
					type: 'POST',
					data: datos,
					beforeSend: function() {
			            $("#carga").show();
			        }
				})
				.done(function(res) {
					var separa= res.split("*");
					if(separa[0]=="Correcto"){
						swal({
						  	type: 'success',
						  	title: 'El registro ha sido restaurado',
						}); 

						if(separa[1] == "productos"){
							verProductos();
							registros(1,$("#productos"));
						}else if(separa[1] == "clientes"){
							clientes();
							registros(4,$("#clientes"));
						}else if(separa[1] == "proveedores"){
							proveedores();
							registros(5,$("#proveedores"));
						}
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'El registro no ha podido ser restaurado',
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

	$(document).on('click', '.eliminar', function(event) {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres eliminar permanentemente el registro?',
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=3&id="+$(this).attr('attrID')+"&tabla="+$(this).parent().parent().parent().attr('id')+"&campo="+$(this).parent().parent().parent().attr('attrCampo');

				$.ajax({
					url: 'php/papelera.php',
					type: 'POST',
					data: datos,
					beforeSend: function() {
			            $("#carga").show();
			        }
				})
				.done(function(res) {
					var separa= res.split("*");
					if(separa[0]=="Correcto"){
						swal({
						  	type: 'success',
						  	title: 'El registro ha sido eliminado',
						});  

						if(separa[1] == "productos"){
							registros(1,$("#productos"));
						}else if(separa[1] == "clientes"){
							registros(4,$("#clientes"));
						}else if(separa[1] == "proveedores"){
							registros(5,$("#proveedores"));
						}
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'El registro no ha podido ser eliminado',
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
	
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

	function registros(metodo,tabla) {
		$.ajax({
			url: 'php/papelera.php',
			type: 'POST',
			data: 'metodo='+metodo
		})
		.done(function(res) {
			tabla.html(res);
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
		productos1('Producto Terminado',$("#tablaProductos1"));
		productos1('Materia Prima',$("#tablaProductos2"));
		productos1('Insumo',$("#tablaProductos3"));
	}

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
});