<div class="oculto" id="VistaProductos1">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<h2>Producto Terminado</h2>
				</div>
				<br><br>
				<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-hover table-striped" id="tablaProductos1" width="100%">
							<thead>
								<th>Código</th>
								<th>Nombre</th>
								<th>UME</th>
								<th>Existencia</th>
								<th>Stock Mínimo</th>
								<th>Stock Máximo</th>
								<th>Estatus</th>
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
<div class="modal fade" id="ModalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Modificar Producto</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<form id="FormModiProducto">
      		<div class="modal-body row">
      			<div class="col-12 text-right">
					<label>Activo</label>
					<input type="checkbox" class="ModiProductos" id="ProductoMActivo" value="1" checked>
					<br>
				</div>
				<div class="form-group col-4">
					<label for="ProductoMCodigo">Código:</label>
					<input type="text" id="ProductoMCodigo" class="form-control form-control-lg ModiProductos" maxlength="30" required>
				</div>
				<div class="form-group col-8">
					<label for="ProductoMNombre">Nombre:</label>
					<input type="text" id="ProductoMNombre" class="form-control ModiProductos" maxlength="100" required>
				</div>
				<div class="form-group col-4">
					<label for="ProductoMUME">UME:</label>
					<select id="ProductoMUME" class="form-control ModiProductos" required>
						<option value="">--Selecciona una unidad de medida--</option>
						<option value="Kg">Kg</option>
						<option value="Pieza">Pieza</option>
						<option value="Litro">Litro</option>
					</select>
				</div>
				<div class="form-group col-4">
					<label for="ProductoMExistencia">Existencia:</label>
					<input type="number" id="ProductoMExistencia" class="form-control ModiProductos" min="0" required>
				</div>
				<div class="form-group col-4">
					<label for="ProductoMMinimo">Stock Mínimo:</label>
						<input type="number" id="ProductoMMinimo" class="form-control ModiProductos" min="0" required>
				</div>
				<div class="form-group col-4">
					<label for="ProductoMMaximo">Stock Máximo:</label>
					<input type="number" id="ProductoMMaximo" class="form-control ModiProductos" min="0" required>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        		<button type="submit" class="btn btn-success" id="GuardarMProducto">Guardar</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>