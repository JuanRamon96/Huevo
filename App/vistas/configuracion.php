<div class="oculto" id="VistaConfiguracion">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<form id="FormConfiUsu" class="row">
					<div class="form-group col-4 offset-3">
						<label for="CNombreUsu">Nombre de Usuario:</label>
						<?php echo "<input type='text' class='form-control' id='CNombreUsu' maxlength='15' value='$nombre' required>" ?>
					</div>
					<div class="form-group col-2">
						<br>
						<button type="submit" class="btn btn-success btn-lg btn-block" id="GuardarConUsu" disabled>Guardar <i class="fas fa-save"></i></button>
					</div>
				</form>

				<br><br><a id="CambiarContra" href="javascript:void(0)" class="text-center"><i class="fas fa-key"></i> Cambiar Contraseña</a><hr>

				<form id="FormConfiContra">
					<div class="form-group">
						<label for="CContraA">Contraseña Actual:</label>
						<input type="password" class="form-control" id="CContraA" maxlength="15" required>
						<div class="invalid-feedback">
        					La contraseña actual es incorrecta
      					</div>
					</div>
					<div class="form-group">
						<label for="CContraN">Contraseña Nueva:</label>
						<input type="password" class="ConfiContra form-control" id="CContraN" maxlength="15" required>
						<div class="invalid-feedback">
        					Las contraseñas deben ser iguales
      					</div>
					</div>
					<div class="form-group">
						<label for="CContraR">Repite Contraseña:</label>
						<input type="password" class="ConfiContra form-control" id="CContraR" maxlength="15" required>
						<div class="invalid-feedback">
        					Las contraseñas deben ser iguales
      					</div>
					</div>
					<div class="form-group">
						<br>
						<button type="submit" class="btn btn-info btn-lg btn-block" id="GuardarConfiguracion" disabled>Guardar <i class="fas fa-save"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>		
</div>