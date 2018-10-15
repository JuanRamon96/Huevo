<div class="oculto" id="VistaEmpleados">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<h2>Empleados</h2>
				</div>
				<br><br>
				<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-hover table-striped" id="tablaEmpleados">
							<thead>
								<th>Código</th>
								<th>Nombre</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Domicilio</th>
								<th>Colonia</th>
								<th>Ciudad</th>
								<th>Estado</th>
								<th>País</th>
								<th>Código Postal</th>
								<th>Teléfono</th>
								<th>Email</th>
								<th>Área</th>
								<th>Puesto</th>
								<th>SDI</th>
								<th>Tipo de sangre</th>
								<th>Alergias</th>
								<th>Llamar en caso de emergencia a</th>
								<th>Teléfono en caso de emergencia</th>
								<th>Fecha de Ingreso</th>
								<th>Fecha de Reingreso</th>
								<th>Fecha de Baja</th>
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
<div class="modal fade" id="ModalEmpleados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Modificar Proveedor</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<form id="FormModiEmpleado">
      		<div class="modal-body row">
      			<div class="col-12 text-right">
					<label>Activo</label>
					<input type="checkbox" class="ModiEmpleados" id="EmpleadoMActivo" value="1" checked>
					<br>
				</div>
      			<div class="form-group col-3">
					<label for="empleadoMCodigo">Código:</label>
					<input type="text" id="empleadoMCodigo" class="form-control ModiEmpleados" maxlength="30" required>
				</div>
				<div class="form-group col-3">
					<label for="empleadoMNombre">Nombre:</label>
					<input type="text" id="empleadoMNombre" class="form-control ModiEmpleados" maxlength="40" required>
				</div>
				<div class="form-group col-3">
					<label for="empleadoMApPat">Apellido Paterno:</label>
						<input type="text" id="empleadoMApPat" class="form-control ModiEmpleados" maxlength="30" required>
				</div>
				<div class="form-group col-3">
					<label for="empleadoMApMat">Apellido Materno:</label>
					<input type="text" id="empleadoMApMat" class="form-control ModiEmpleados" maxlength="30" required>
				</div>
				<div class="form-group col-6">
					<label for="empleadoMDomicilio">Domicilio:</label>
					<input type="text" id="empleadoMDomicilio" class="form-control ModiEmpleados" maxlength="150" required>
				</div>
				<div class="form-group col-6">
					<label for="empleadoMColonia">Colonia:</label>
					<input type="text" id="empleadoMColonia" class="form-control ModiEmpleados" maxlength="50" required>
				</div>
				<div class="form-group col-4">
					<label for="empleadoMCiudad">Ciudad:</label>
					<input type="text" id="empleadoMCiudad" class="form-control ModiEmpleados" maxlength="40" required>
				</div>
				<div class="form-group col-4">
					<label for="empleadoMEstado">Estado:</label>
					<input type="text" id="empleadoMEstado" class="form-control ModiEmpleados" maxlength="40" required>
				</div>
				<div class="form-group col-4">
					<label for="empleadoMPais">País:</label>
					<input type="text" id="empleadoMPais" class="form-control ModiEmpleados" maxlength="40" required>
				</div>
				<div class="form-group col-3">
					<label for="empleadoMCP">Código Postal:</label>
					<input type="number" id="empleadoMCP" class="form-control ModiEmpleados" required>
				</div>
				<div class="form-group col-4">
					<label for="empleadoMTelefono">Teléfono:</label>
					<input type="text" id="empleadoMTelefono" class="form-control ModiEmpleados" maxlength="30" required>
				</div>
				<div class="form-group col-5">
					<label for="empleadoMEmail">Email:</label>
					<input type="email" id="empleadoMEmail" class="form-control ModiEmpleados" maxlength="150" required>
				</div>
				<div class="form-group col-4">
					<label for="empleadoMArea">Área:</label>
					<select id="empleadoMArea" class="form-control ModiEmpleados" required>
									
					</select>
				</div>
				<div class="form-group col-4">
					<label for="empleadoMPuesto">Puesto:</label>
					<select id="empleadoMPuesto" class="form-control ModiEmpleados" required>
									
					</select>
				</div>
				<div class="form-group col-4">
					<label for="empleadoMSDI">Salario Diario Integrado:</label>
					<input type="number" id="empleadoMSDI" class="form-control ModiEmpleados" min="0" step="any" required>
				</div>
				<div class="form-group col-6">
					<label for="empleadoMAlergias">Alergias:</label>
					<textarea id="empleadoMAlergias" class="form-control ModiEmpleados" maxlength="200" cols="30" rows="5"></textarea>
				</div>
				<div class="form-group col-4">
					<label for="empleadoMTS">Tipo de Sangre:</label>
					<input type="text" id="empleadoMTS" class="form-control ModiEmpleados" maxlength="5" required>
				</div>
				<div class="form-group col-7">
					<label for="empleadoMEmergencia">Llamar en caso de emergencia a:</label>
					<input type="text" id="empleadoMEmergencia" class="form-control ModiEmpleados" maxlength="100" required>
				</div>
				<div class="form-group col-5">
					<label for="empleadoMTelEmergencia">Teléfono en caso de emergencia:</label>
					<input type="text" id="empleadoMTelEmergencia" class="form-control ModiEmpleados" maxlength="30" required>
				</div>
				<div class="form-group col-4">
					<label for="empleadoMFechaIn">Fecha de Ingreso:</label>
					<input type="date" id="empleadoMFechaIn" class="form-control ModiEmpleados" required>
				</div>
				<div class="form-group col-4">
					<label for="empleadoMFechaBa">Fecha de Baja:</label>
					<input type="date" id="empleadoMFechaBa" class="form-control ModiEmpleados">
				</div>
				<div class="form-group col-4">
					<label for="empleadoMFechaRe">Fecha de Reingreso:</label>
					<input type="date" id="empleadoMFechaRe" class="form-control ModiEmpleados">
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        		<button type="submit" class="btn btn-success" id="GuardarMEmpleado">Guardar</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>