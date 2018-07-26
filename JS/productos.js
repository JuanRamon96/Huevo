$(document).ready(function() {
	productos1();

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
			alert("El producto se ha guardado"); 
			$(".IntProductos").val("");
			productos1();	
		}else{
			alert("Error: El producto no se ha podido guardar");
			console.log(res);
		}
		$("#carga").hide();
		})
		.fail(function() {
			console.log("Error");
		});
	});

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	
	//$.fn.dataTable.ext.errMode = 'none';
	function productos1() {
		$('#tablaProductos1').dataTable({
			"destroy": true,
			"ajax":{
				"url": 'php/productos.php',
				"method": 'POST',
				"data": {
			        "metodo": '2'
			    }
			},
			"columns": [
	            { "data": "Nombre" },
	            { "data": "UME" },
	            { "data": "Existencia" },
	            { "data": "Max" },
	            {"data": "Min"}
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
			    }
			}
		});
	}
});