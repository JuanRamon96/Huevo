<div class="oculto" id="VistaClientes">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<h2>Clientes</h2>
				</div>
				<br><br>
				<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-hover table-striped" id="tablaClientes">
							<thead>
								<th>Código</th>
								<th>Nombre</th>
								<th>Domicilio</th>
								<th>Ciudad</th>
								<th>Estado</th>
								<th>País</th>
								<th>Código Postal</th>
								<th>Razón social</th>
								<th>RFC</th>
								<th>Teléfono</th>
								<th>Email</th>
								<th>Contacto</th>
								<th>Contacto Teléfono</th>
								<th>Estatus</th>
								<th></th>
								<th></th>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalClientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Modificar Cliente</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<form id="FormModiCliente">
      		<div class="modal-body row">
      			<div class="col-12 text-right">
					<label>Activo</label>
					<input type="checkbox" class="ModiClientes" id="ClienteMActivo" value="1" checked>
					<br>
				</div>
      			<div class="form-group col-4">
					<label for="clienteMCodigo">Código:</label>
					<input type="text" id="clienteMCodigo" class="form-control ModiClientes" maxlength="30" required>
				</div>
				<div class="form-group col-8">
					<label for="clienteMNombre">Nombre:</label>
					<input type="text" id="clienteMNombre" class="form-control ModiClientes" maxlength="100" required>
				</div>
				<div class="form-group col-6">
					<label for="clienteMDomicilio">Domicilio:</label>
					<input type="text" id="clienteMDomicilio" class="form-control ModiClientes" maxlength="150" required>
				</div>
				<div class="form-group col-3">
					<label for="clienteMCiudad">Ciudad:</label>
					<input type="text" id="clienteMCiudad" class="form-control ModiClientes" maxlength="40" required>
				</div>
				<div class="form-group col-3">
					<label for="clienteMEstado">Estado:</label>
					<input type="text" id="clienteMEstado" class="form-control ModiClientes" maxlength="40" required>
				</div>
				<div class="form-group col-4">
					<label for="clienteMPais">País:</label>
					<input type="text" id="clienteMPais" class="form-control ModiClientes" maxlength="40" required>
				</div>
				<div class="form-group col-4">
					<label for="clienteMCP">Código Postal:</label>
					<input type="number" id="clienteMCP" class="form-control ModiClientes" required>
				</div>
				<div class="form-group col-4">
					<label for="clienteMRZ">Razón social:</label>
					<input type="text" id="clienteMRZ" class="form-control ModiClientes" maxlength="60" required>
				</div>
				<div class="form-group col-6">
					<label for="clienteMRFC">RFC:</label>
					<input type="text" id="clienteMRFC" class="form-control ModiClientes" maxlength="60" required>
				</div>
				<div class="form-group col-6">
					<label for="clienteMTelefono">Teléfono:</label>
					<input type="text" id="clienteMTelefono" class="form-control ModiClientes" maxlength="30" required>
				</div>
				<div class="form-group col-6">
					<label for="clienteMEmail">Email:</label>
					<input type="email" id="clienteMEmail" class="form-control ModiClientes" maxlength="150" required>
				</div>
				<div class="form-group col-6">
					<label for="clienteMContacto">Contacto:</label>
					<input type="text" id="clienteMContacto" class="form-control ModiClientes" maxlength="150" required>
				</div>
				<div class="form-group col-6">
					<label for="clienteMContactoTel">Contacto Teléfono:</label>
					<input type="text" id="clienteMContactoTel" class="form-control ModiClientes" maxlength="30" required>
				</div>	
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        		<button type="submit" class="btn btn-success" id="GuardarMCliente">Guardar</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>