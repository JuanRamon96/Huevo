$(document).ready(function() {
	precios();

	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});

	$(document).on('click', '.ModificarPrecio', function() {
		var padre = $(this).parent().parent();
		$("#CostoActual").val(padre.children('td:eq(2)').text());
		$("#CostoPromedio").val(padre.children('td:eq(3)').text());
		$("#Precio1").val(padre.children('td:eq(4)').text());
		$("#Precio2").val(padre.children('td:eq(5)').text());
		$("#bMprecios").attr('attrID', $(this).attr('attrID'));
		$("#bMprecios").attr('disabled', true);
	});

	$("#FormMPrecios").children().on('change keyup', function(event) {
		$("#bMprecios").attr('disabled', false);
	});

	$("#FormMPrecios").submit(function(e) {
		e.preventDefault();

		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres modificar los precios y/o costos?',
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
				var data = "metodo=2&id="+$("#bMprecios").attr('attrID')+"&costoA="+$("#CostoActual").val()+"&costoP="+$("#CostoPromedio").val()+"&precio1="+$("#Precio1").val()+"&precio2="+$("#Precio2").val();
				$.ajax({
					url: 'php/precios.php',
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
						  	title: 'Los precios se han modificado',
						}); 
						$(".IntClientes").val("");
						precios();	
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'Los precios se han modificado',
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
	$.fn.dataTable.ext.errMode = 'none';
	function precios() {
		$("#tablaPrecios").dataTable({
			"destroy": true,
			"ajax":{
				"url": 'php/precios.php',
				"method": 'POST',
				"data": {
			        "metodo": '1'
			    }
			},
			"columns": [
	            { "data": "Codigo" },
	            { "data": "Nombre" },
	            { "data": "CostoA" },
	            { "data": "CostoP" },
	            { "data": "Precio1" },
	            { "data": "Precio2" },
	            { "data": "Boton" }
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
	            	filename: 'Precios',
	            	title: 'Precios'
	            },
	            {
	            	extend: 'pdfHtml5',
	            	text: "<i class='fas fa-file-pdf'></i>",
	            	titleAttr: 'PDF',
	            	filename: 'Precios',
	            	title: 'Precios',
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