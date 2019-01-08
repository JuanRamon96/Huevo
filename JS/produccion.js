$(document).ready(function() {
	produccion1();	
	productos();

	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});

	$("#qpProd").change(function() {
		$("#qpCodi").val($("#qpProd option:selected").attr('attrCodigo'));
		$("#qpUME").val($("#qpProd option:selected").attr('attrUME'));	
	});

	$("#FormQP").submit(function(e) {
		e.preventDefault();
		var data = "metodo=2&producto="+$("#qpProd").val()+"&cantidad="+$("#qpCantidad").val();

		$.ajax({
			url: 'php/produccion.php',
			type: 'POST',
			data: data,
		})
		.done(function(res) {
			if(res=="Correcto"){
				swal({
				  	type: 'success',
				  	title: 'La materia prima se ha guardado',
				}); 
				document.getElementById("FormQP").reset();
				produccion1();	
			}else{
				swal({
				  	type: 'error',
				  	title: 'Error:',
				  	text: 'La materia prima no se ha guardado',
				});
				console.log(res);
			}
		})
		.fail(function() {
			console.log("Error");
		});	
	});

	$(document).on('click', '.borrarEMP', function() {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres eliminar la entrada?',
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {

				var data = "metodo=4&id="+$(this).attr('attrID');

				$.ajax({
					url: 'php/produccion.php',
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
							title: 'La entrada ha sido eliminada',
						}); 
						produccion1();
					}else{
						swal({
							type: 'error',
							title: 'Error:',
							text: 'La entrada no ha podido ser eliminada',
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

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	
	$.fn.dataTable.ext.errMode = 'none';
	function produccion1() {
		$("#tablaPro1").dataTable({
			"destroy": true,
			"ajax":{
				"url": 'php/produccion.php',
				"method": 'POST',
				"data": {
			        "metodo": '3'
			    }
			},
			"columns": [
	            { "data": "Nombre" },
	            { "data": "Codigo" },
	            { "data": "UME" },
	            { "data": "Cantidad" },
	            { "data": "Fecha" },
	            { "data": "Boton" },
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

	function productos() {
		$.ajax({
			url: 'php/produccion.php',
			type: 'POST',
			data: 'metodo=1',
		})
		.done(function(res) {
			$("#qpProd").html(res);
		})
		.fail(function() {
			console.log("Error");
		});		
	}	
});