<div class="oculto" id="VistaNuevoProducto">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<h1>Nuevo Producto</h1>
				</div>
				<br>
				<div class="row">
					<div class="col-12">
						<form id="FormGuardarProducto" class="row">
							<div class="form-group col-4">
								<label for="ProductoCodigo">Código:</label>
								<input type="text" id="ProductoCodigo" class="form-control form-control-lg IntProductos" maxlength="30" required>
							</div>
							<div class="form-group col-8">
								<label for="ProductoNombre">Nombre:</label>
								<input type="text" id="ProductoNombre" class="form-control form-control-lg IntProductos" maxlength="100" required>
							</div>
							<div class="form-group col-4">
								<label for="ProductoUME">UME:</label>
								<select id="ProductoUME" class="form-control form-control-lg IntProductos" required>
									<option value="">--Selecciona una unidad de medida--</option>
									<option value="Kg">Kg</option>
									<option value="Pieza">Pieza</option>
									<option value="Litro">Litro</option>
								</select>
							</div>
							<div class="form-group col-4">
								<label for="ProductoCategoria">Categoria:</label>
								<select id="ProductoCategoria" class="form-control form-control-lg IntProductos" required>
									<option value="">--Selecciona una categoria--</option>
									<option value="Producto Terminado">Producto Terminado</option>
									<option value="Materia Prima">Materia Prima</option>
									<option value="Insumo">Insumo</option>
								</select>
							</div>
							<div class="form-group col-4">
								<label for="ProductoExistencia">Existencia:</label>
								<input type="number" id="ProductoExistencia" class="form-control form-control-lg IntProductos" min="0" required>
							</div>
							<div class="form-group col-4">
								<label for="ProductoMinimo">Stock Mínimo:</label>
								<input type="number" id="ProductoMinimo" class="form-control form-control-lg IntProductos" min="0" required>
							</div>
							<div class="form-group col-4">
								<label for="ProductoMaximo">Stock Máximo:</label>
								<input type="number" id="ProductoMaximo" class="form-control form-control-lg IntProductos" min="0" required>
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