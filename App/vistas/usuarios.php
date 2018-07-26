<div class="oculto" id="VistaUsuarios">
	<div class="row">
		<div class="col-5" style="padding: 5px 10px;">
			<div class="card">
				<h4 class="text-center">Crear Usuario</h4><br>
				<form id="CrearUsuario">
					<div class="form-group">
						<label for="NombreUsuario">Nombre de Usuario</label>
						<input type="text" id="NombreUsuario" class="form-control reUsu" maxlength="15" required>
						<div class="invalid-feedback">
        					Ingresa otro nombre de usuario
      					</div>
					</div>
					<div class="form-group">
						<label for="emailUsuario">Email</label>
						<input type="email" id="emailUsuario" class="form-control reUsu" maxlength="100" required>
					</div>
					<div class="form-group">
						<label for="ContraUsuario">Contraseña</label>
						<input type="password" id="ContraUsuario" class="form-control reUsu" maxlength="15" required>
						<div class="invalid-feedback">
        					Las contraseñas deben ser iguales
      					</div>
					</div>
					<div class="form-group">
						<label for="ContraRUsuario">Repite Contraseña</label>
						<input type="password" id="ContraRUsuario" class="form-control reUsu" maxlength="15" required>
						<div class="invalid-feedback">
        					Las contraseñas deben ser iguales
      					</div>
					</div>
					<div class="form-check">
					  	<input class="form-check-input" type="radio" name="Tipo" id="r1" checked>
					  	<label class="form-check-label" for="exampleRadios1">
					    	Administrador
					  	</label>
					</div>
					<div class="form-check">
					  	<input class="form-check-input" type="radio" name="Tipo" id="r2">
					  	<label class="form-check-label" for="exampleRadios2">
					    	Normal
					  	</label>
					</div>
					<div class="form-group">
						<br>
						<button type="sibmit" id="GuardarUsuario" class="btn btn-success btn-block">Guardar <i class="fas fa-save"></i></button>
					</div>
				</form>
			</div>
		</div>
		<div class="col-7" style="padding: 5px 10px;">
			<div class="card table-responsive" style="height: 555px;">
				<h3 class="text-center">Modificar Usuarios</h3><br>
				<table class="table table-hover table-striped table-sm">
				  <thead>
				    <tr class="table-info">
				      <th>Nombre</th>
				      <th>Tipo</th>
				      <th>Email</th>
				      <th></th>
				    </tr>
				  </thead>
				  <tbody id="MostrarUsuarios">
				    
				  </tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 10px;">
		<div class="col-12">
			<div class="card table-responsive">
				<h2 class="text-center">Modificar Permisos</h2><br>
				<table class="table table-hover table-striped table-bordered">
				  <thead>
				    <tr class="">
				      <th><i class="fas fa-user-md"></i> Nombre</th>
				      <th><i class="fas fa-boxes"></i> Productos</th>
				      <th><i class="fas fa-address-card"></i> Clientes</th>
				      <th><i class="fas fa-dollar-sign"></i> Ventas</th>
				      <th><i class="fas fa-shipping-fast"></i> Proveedores</th>
				      <th><i class="fas fa-shopping-cart"></i> Compras</th>
				      <th><i class="fas fa-people-carry"></i> Empleados</th>
				      <th><i class="fas fa-handshake"></i> Entregas</th>
				      <th><i class="fas fa-cogs"></i>  Producción</th>
				      <th><i class="fas fa-chart-line"></i>  Reportes</th>
				      <th><i class="fas fa-barcode"></i>  Etiquetas</th>
				    </tr>
				  </thead>
				  <tbody id="Permisos">
				  		  
				  </tbody>
				</table>
			</div>
		</div>	
	</div>
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Modificar Usuario</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<form id="ModificarUsuario">
      		<div class="modal-body">
				<div class="form-group">
					<label for="NombreUsuarioM">Nombre de Usuario</label>
					<input type="text" id="NombreUsuarioM" class="form-control" maxlength="15" required>
					<div class="invalid-feedback">
        				Ingresa otro nombre de usuario
      				</div>
				</div>
				<div class="form-group">
					<label for="emailUsuarioM">Email</label>
					<input type="text" id="emailUsuarioM" class="form-control" maxlength="200" required>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="TipoM" id="r1M">
					<label class="form-check-label">
					    Administrador
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="TipoM" id="r2M">
					<label class="form-check-label">
					    Normal
					</label>
				</div>
				
				<br>
				<div class="form-check">
				  	<input class="form-check-input" type="checkbox" id="CheckContra">
				  	<label class="form-check-label">
				    	Modificar Contraseña
				  	</label>
				</div>

				<div class="ModiContra" id="ModiContra">
					<div class="form-group">
						<label for="ContraUsuarioM">Contraseña</label>
						<input type="password" id="ContraUsuarioM" class="form-control reUsuM" maxlength="15">
						<div class="invalid-feedback">
	        				Las contraseñas deben ser iguales
	      				</div>
					</div>
					<div class="form-group">
						<label for="ContraRUsuario">Repite Contraseña</label>
						<input type="password" id="ContraRUsuarioM" class="form-control reUsuM" maxlength="15">
						<div class="invalid-feedback">
	        				Las contraseñas deben ser iguales
	      				</div>
					</div>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        		<button type="submit" class="btn btn-success" id="GuardarMUsu">Guardar</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>