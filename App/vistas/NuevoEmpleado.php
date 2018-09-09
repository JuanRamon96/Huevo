<div class="oculto" id="VistaNuevoEmpleado">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<h1>Nuevo Empleado</h1>
				</div>
				<br>
				<div class="row">
					<div class="col-12">
						<form id="FormGuardarEmpleado" class="row">
							<div class="form-group col-3">
								<label for="empleadoCodigo">Código:</label>
								<input type="text" id="empleadoCodigo" class="form-control IntEmpleado" maxlength="30" required>
							</div>
							<div class="form-group col-3">
								<label for="empleadoNombre">Nombre:</label>
								<input type="text" id="empleadoNombre" class="form-control IntEmpleado" maxlength="40" required>
							</div>
							<div class="form-group col-3">
								<label for="empleadoApPat">Apellido Paterno:</label>
								<input type="text" id="empleadoApPat" class="form-control IntEmpleado" maxlength="30" required>
							</div>
							<div class="form-group col-3">
								<label for="empleadoApMat">Apellido Materno:</label>
								<input type="text" id="empleadoApMat" class="form-control IntEmpleado" maxlength="30" required>
							</div>
							<div class="form-group col-6">
								<label for="empleadoDomicilio">Domicilio:</label>
								<input type="text" id="empleadoDomicilio" class="form-control IntEmpleado" maxlength="150" required>
							</div>
							<div class="form-group col-3">
								<label for="empleadoCiudad">Ciudad:</label>
								<input type="text" id="empleadoCiudad" class="form-control IntEmpleado" maxlength="40" required>
							</div>
							<div class="form-group col-3">
								<label for="empleadoEstado">Estado:</label>
								<input type="text" id="empleadoEstado" class="form-control IntEmpleado" maxlength="40" required>
							</div>
							<div class="form-group col-4">
								<label for="empleadoPais">País:</label>
								<input type="text" id="empleadoPais" class="form-control IntEmpleado" maxlength="40" required>
							</div>
							<div class="form-group col-4">
								<label for="empleadoeCP">Código Postal:</label>
								<input type="number" id="empleadoCP" class="form-control IntEmpleado" required>
							</div>
							<div class="form-group col-4">
								<label for="empleadoTelefono">Teléfono:</label>
								<input type="text" id="empleadoTelefono" class="form-control IntEmpleado" maxlength="30" required>
							</div>
							<div class="form-group col-6">
								<label for="empleadoEmail">Email:</label>
								<input type="email" id="empleadoEmail" class="form-control IntEmpleado" maxlength="150" required>
							</div>
							<div class="form-group col-3">
								<label for="empleadoArea">Área:</label>
								<select id="empleadoArea" class="form-control IntEmpleado">
									
								</select>
							</div>
							<div class="form-group col-3">
								<label for="empleadoPuesto">Puesto:</label>
								<select id="empleadoPuesto" class="form-control IntEmpleado">
									
								</select>
							</div>
							<div class="form-group col-4">
								<label for="empleadoSDI">Salario Diario Integrado:</label>
								<input type="number" id="empleadoSDI" class="form-control IntEmpleado" min="0" step="any" required>
							</div>
							<div class="form-group col-2">
								<label for="empleadoTS">Tipo de Sangre:</label>
								<input type="text" id="empleadoTS" class="form-control IntEmpleado" maxlength="5" required>
							</div>
							<div class="form-group col-6">
								<label for="empleadoAlergias">Alergias:</label>
								<textarea id="empleadoAlergias" class="form-control IntEmpleado" maxlength="200" cols="30" rows="5"></textarea>
							</div>
							<div class="form-group col-7">
								<label for="empleadoEmergencia">Llamar en caso de emergencia a:</label>
								<input type="text" id="empleadoEmergencia" class="form-control IntEmpleado" maxlength="100" required>
							</div>
							<div class="form-group col-5">
								<label for="empleadoTelEmergencia">Teléfono en caso de emergencia:</label>
								<input type="text" id="empleadoTelEmergencia" class="form-control IntEmpleado" maxlength="30" required>
							</div>
							<div class="form-group col-3">
								<label for="empleadoFechaIn">Fecha de Ingreso:</label>
								<input type="date" id="empleadoFechaIn" class="form-control IntEmpleado" required>
							</div>
							<div class="form-group col-12">
								<br>
								<button class="btn btn-success btn-block btn-lg">Guardar <i class="fas fa-save"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>