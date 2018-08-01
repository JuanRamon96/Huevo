$(document).ready(function() {
	$tipo=1;
	$tipo1=0;
	Usuarios();

	const swalWithBootstrapButtons = swal.mixin({
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: false,
	});

	$("input[name=Tipo]").click(function () {    
        if($(this).attr('id')=="r1"){
        	$tipo=1;
        }else{
        	$tipo=2;
        }
    });

    $("input[name=TipoM]").click(function () {    
        if($(this).attr('id')=="r1M"){
        	$tipo1=1;
        }else{
        	$tipo1=2;
        }
    });

	$("#CrearUsuario").submit(function(e) {
		e.preventDefault();
		
		if($("#ContraUsuario").val() != $("#ContraRUsuario").val()){
			$("#NombreUsuario").attr('class', 'form-control reUsu');
			$("#ContraUsuario").attr('class', 'form-control is-invalid');
			$("#ContraRUsuario").attr('class', 'form-control is-invalid');
		}else{
			var datos = "metodo=1&nombre="+$.trim($("#NombreUsuario").val())+"&contrasena="+$("#ContraUsuario").val()+"&tipo="+$tipo+"&email="+$("#emailUsuario").val();
			$.ajax({
				url: 'php/usuarios.php',
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
					  	title: 'El usuario se ha creado',
					}); 
					$("#NombreUsuario").attr('class', 'form-control reUsu');
					$(".reUsu").val('');
					$("#r1").prop('checked', true);
					Usuarios();
				}else{
					swal({
					  	type: 'error',
					  	title: 'Error:',
					  	text: 'El usuario no se ha podido crear. Es posible que el nombre de usuario ya exista',
					});
					$("#NombreUsuario").attr('class', 'form-control is-invalid');
					console.log(res);
				}
				$("#carga").hide();
				$("#ContraUsuario").attr('class', 'form-control reUsu');
				$("#ContraRUsuario").attr('class', 'form-control reUsu');
			})
			.fail(function() {
				console.log("Error");
			});
		}
	});

	$(document).on('click', '.BorrarUsuario', function() {
		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres eliminar el usuario?',
		  	text: "¡Una vez eliminado no podrá ser recuperados jamás!",
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=3&id="+$(this).attr('attrID');

				$.ajax({
					url: 'php/usuarios.php',
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
						  	title: 'El usuario ha sido borrado',
						});  
						Usuarios();
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'El usuario no ha podido ser borrado',
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

	$(document).on('click', '.EditarUsuario', function() {
		var padre = $(this).parent().parent(); 
		$("#NombreUsuarioM").val(padre.children('td:eq(0)').text());
		$("#emailUsuarioM").val(padre.children('td:eq(2)').text());
		if(padre.children('td:eq(1)').text()=="Normal"){
			$("#r2M").prop('checked', true);
			$tipo1=2;
		}else{
			$("#r1M").prop('checked', true);
			$tipo1=1;
		}
		$(".reUsuM").val('');
		$("#CheckContra").prop('checked', false);
		$("#ModiContra").hide();
		$("#GuardarMUsu").attr("attrID", $(this).attr('attrID'));
	});

	$("#CheckContra").click(function() {
		if($(this).prop('checked')){
			$("#ModiContra").show('fast');
			$("#ContraUsuarioM").attr('required', true);
			$("#ContraRUsuarioM").attr('required', true);
		}else{
			$("#ModiContra").hide('fast');
			$("#ContraUsuarioM").attr('required', false);
			$("#ContraRUsuarioM").attr('required', false);
		}
		$("#ContraUsuarioM").val("");
		$("#ContraRUsuarioM").val("");
	});

	$("#ModificarUsuario").submit(function(e) {
		e.preventDefault();

		if($("#ContraUsuarioM").val() != $("#ContraRUsuarioM").val() && $("#CheckContra").prop('checked')){
			$("#NombreUsuarioM").attr('class', 'form-control');
			$("#ContraUsuarioM").attr('class', 'form-control is-invalid');
			$("#ContraRUsuarioM").attr('class', 'form-control is-invalid');
		}else{
			swalWithBootstrapButtons({
			  	title: '¿Estas seguro que quieres modificar los datos del usuario?',
			  	text: "¡Una vez modificados no podrán ser recuperados jamás!",
			  	type: 'warning',
			  	showCancelButton: true,
			 	confirmButtonText: 'Aceptar',
			  	cancelButtonText: 'Cancelar',
			  	reverseButtons: true
			}).then((result) => {
			  	if (result.value) {
			    	var datos = "metodo=4&id="+$("#GuardarMUsu").attr("attrID")+"&nombre="+$.trim($("#NombreUsuarioM").val())+"&contrasena="+$("#ContraUsuarioM").val()+"&tipo="+$tipo1+"&email="+$("#emailUsuarioM").val();
					
					$.ajax({
						url: 'php/usuarios.php',
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
							  	title: 'El usuario ha sido modificado',
							});
							$("#NombreUsuarioM").attr('class', 'form-control');
							$(".reUsuM").val('');
							$("#CheckContra").prop('checked', false);
							$("#ModiContra").hide();
							Usuarios();
						}else{
							swal({
							  	type: 'error',
							  	title: 'Error:',
							  	text: 'El usuario no se ha podido crear. Es posible que el nombre de usuario ya exista',
							});
							$("#NombreUsuarioM").attr('class', 'form-control is-invalid');
							console.log(res);
						}
						$("#carga").hide();
						$("#ContraUsuarioM").attr('class', 'form-control reUsuM');
						$("#ContraRUsuarioM").attr('class', 'form-control reUsuM');
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

	$("#CambiarContra").click(function() {
		$("#FormConfiContra").toggle();
	});

	$("#CNombreUsu").on('keyup change',function() {
		$("#GuardarConUsu").attr('disabled', false);
	});

	$("#FormConfiUsu").submit(function(e) {
		e.preventDefault();

		swalWithBootstrapButtons({
		  	title: '¿Estas seguro que quieres cambiar tu nombre de usuario?',
		  	type: 'warning',
		  	showCancelButton: true,
		 	confirmButtonText: 'Aceptar',
		  	cancelButtonText: 'Cancelar',
		  	reverseButtons: true
		}).then((result) => {
		  	if (result.value) {
		    	var datos = "metodo=5&nombre="+$("#CNombreUsu").val();
				
				$.ajax({
					url: 'php/usuarios.php',
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
						  	title: 'Tu nombre de usuario ha sido cambiado',
						}); 
						location.reload();
					}else{
						swal({
						  	type: 'error',
						  	title: 'Error:',
						  	text: 'Tu nombre de usuario no se ha podido cambiar. Es posible que el nombre de usuario ya exista',
						});
						$("#CNombreUsu").focus();
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

	$(".ConfiContra").on('keyup change', function() {
		$("#GuardarConfiguracion").attr('disabled', false);
	});

	$("#FormConfiContra").submit(function(e) {
		e.preventDefault();
		
		if($("#CContraN").val() != $("#CContraR").val()){
			$("#CContraA").attr('class', 'form-control');
			$("#CContraN").attr('class', 'form-control is-invalid');
			$("#CContraR").attr('class', 'form-control is-invalid');
		}else{
			swalWithBootstrapButtons({
			  	title: '¿Estas seguro que quieres cambiar tu contraseña?',
			  	type: 'warning',
			  	showCancelButton: true,
			 	confirmButtonText: 'Aceptar',
			  	cancelButtonText: 'Cancelar',
			  	reverseButtons: true
			}).then((result) => {
			  	if (result.value) {
			    	var datos = "metodo=6&contraA="+$("#CContraA").val()+"&contraN="+$("#CContraN").val();
					$.ajax({
						url: 'php/usuarios.php',
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
							  	title: 'Tu contraseña ha sido cambiada',
							});
							$("#CContraA").attr('class', 'form-control');
							$(".ConfiContra").val("");
							$("#CContraA").val("");
							$("#GuardarConfiguracion").attr('disabled', true);
							$("#FormConfiContra").hide();
						}else if(res=="2"){
							swal({
							  	type: 'success',
							  	title: 'Tu contraseña no se ha podido cambiar. Verifica que la contraseña actual este correcta',
							});
							$("#CContraA").attr('class', 'form-control is-invalid');
						}else{
							swal({
							  	type: 'error',
							  	title: 'Error:',
							  	text: 'Tu contraseña no se ha podido cambiar',
							});
							$("#CContraA").attr('class', 'form-control');
							console.log(res);
						}
						$("#carga").hide();	
						$("#CContraN").attr('class', 'ConfiContra form-control');
						$("#CContraR").attr('class', 'ConfiContra form-control');
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

	$(document).on('click', '.checkPermiso', function() {
		if(($(this).val()=="2" || $(this).val()=="3" || $(this).val()=="4" || $(this).val()=="5") && $(this).prop('checked')){
        	$(this).parent().parent().children('label:eq(0)').children('input').prop('checked', true);
        }else if($(this).val()=="1" && !$(this).prop('checked')){
        	$(this).parent().parent().children('label').each(function(){ 
				$(this).children('input').prop('checked', false);
			});
        }

        var permiso="";
        $(this).parent().parent().children('label').each(function(){ 
			if($(this).children('input').prop('checked')){
				permiso += "1*";
			}else{
				permiso += "0*";
			} 
		});
        console.log(permiso);
        var datos = "metodo=8&id="+$(this).parent().parent().parent().children('td:eq(0)').attr('attrID')+"&permiso="+permiso+"&columna="+$(this).parent().parent().attr('attrModulo');
		$.ajax({
			url: 'php/usuarios.php',
			type: 'POST',
			data: datos,
			beforeSend: function() {
		        $("#carga").show();
		    }
		})
		.done(function(res) {
			if(res != "1"){
				swal({
					type: 'error',
					title: 'Error:',
					text: 'No se pudieron modificar los permisos',
				});
				console.log(res);
			}
			setTimeout(function() {
				permisos();
				$("#carga").hide();	
			}, 1000);
		})
		.fail(function() {
			console.log("Error");
		});
	});

	function Usuarios() {
		var datos = "metodo=2";
		$.ajax({
			url: 'php/usuarios.php',
			type: 'POST',
			data: datos
		})
		.done(function(res) {
			$("#MostrarUsuarios").html(res);
		})
		.fail(function() {
			console.log("Error");
		});

		permisos();
	}

	function permisos() {
		var datos = "metodo=7";
		$.ajax({
			url: 'php/usuarios.php',
			type: 'POST',
			data: datos
		})
		.done(function(res) {
			$("#Permisos").html(res);
		})
		.fail(function() {
			console.log("Error");
		});
	}
});