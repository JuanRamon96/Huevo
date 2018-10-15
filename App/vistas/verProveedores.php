<div class="oculto" id="VistaProveedores">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<h2>Proveedores</h2>
				</div>
				<br><br>
				<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-hover table-striped" id="tablaProveedores">
							<thead>
								<th>Código</th>
								<th>Nombre</th>
								<th>Domicilio</th>
								<th>Colonia</th>
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
<div class="modal fade" id="ModalProveedores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Modificar Proveedor</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<form id="FormModiProveedor">
      		<div class="modal-body row">
      			<div class="col-12 text-right">
					<label>Activo</label>
					<input type="checkbox" class="ModiProveedores" id="ProveedorMActivo" value="1" checked>
					<br>
				</div>
      			<div class="form-group col-4">
					<label for="proveedorMCodigo">Código:</label>
					<input type="text" id="proveedorMCodigo" class="form-control ModiProveedores" maxlength="30" required>
				</div>
				<div class="form-group col-8">
					<label for="proveedorMNombre">Nombre:</label>
					<input type="text" id="proveedorMNombre" class="form-control ModiProveedores" maxlength="100" required>
				</div>
				<div class="form-group col-6">
					<label for="proveedorMDomicilio">Domicilio:</label>
					<input type="text" id="proveedorMDomicilio" class="form-control ModiProveedores" maxlength="150" required>
				</div>
				<div class="form-group col-6">
					<label for="proveedorMColonia">Colonia:</label>
					<input type="text" id="proveedorMColonia" class="form-control ModiProveedores" maxlength="150" required>
				</div>
				<div class="form-group col-4">
					<label for="proveedorMCiudad">Ciudad:</label>
					<input type="text" id="proveedorMCiudad" class="form-control ModiProveedores" maxlength="40" required>
				</div>
				<div class="form-group col-4">
					<label for="proveedorMEstado">Estado:</label>
					<input type="text" id="proveedorMEstado" class="form-control ModiProveedores" maxlength="40" required>
				</div>
				<div class="form-group col-4">
					<label for="proveedorMPais">País:</label>
					<input type="text" id="proveedorMPais" class="form-control ModiProveedores" maxlength="40" required>
				</div>
				<div class="form-group col-3">
					<label for="proveedorMCP">Código Postal:</label>
					<input type="number" id="proveedorMCP" class="form-control ModiProveedores" required>
				</div>
				<div class="form-group col-4">
					<label for="proveedorMRZ">Razón social:</label>
					<input type="text" id="proveedorMRZ" class="form-control ModiProveedores" maxlength="60" required>
				</div>
				<div class="form-group col-5">
					<label for="proveedorMRFC">RFC:</label>
					<input type="text" id="proveedorMRFC" class="form-control ModiProveedores" maxlength="60" required>
				</div>
				<div class="form-group col-6">
					<label for="proveedorMTelefono">Teléfono:</label>
					<input type="text" id="proveedorMTelefono" class="form-control ModiProveedores" maxlength="30" required>
				</div>
				<div class="form-group col-6">
					<label for="proveedorMEmail">Email:</label>
					<input type="email" id="proveedorMEmail" class="form-control ModiProveedores" maxlength="150" required>
				</div>
				<div class="form-group col-6">
					<label for="proveedorMContacto">Contacto:</label>
					<input type="text" id="proveedorMContacto" class="form-control ModiProveedores" maxlength="150" required>
				</div>
				<div class="form-group col-6">
					<label for="proveedorMContactoTel">Contacto Teléfono:</label>
					<input type="text" id="proveedorMContactoTel" class="form-control ModiProveedores" maxlength="30" required>
				</div>	
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        		<button type="submit" class="btn btn-success" id="GuardarMProveedor">Guardar</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>