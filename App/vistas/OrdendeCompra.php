<div class="oculto" id="VistaOrdendeCompra">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<div class="col-12">
						<h3>Nueva Orden de Compra</h3>
					</div>
					<br><br>
					<div class="col-12">
						<div class="row">
							<div class="form-group col-3 offset-5">
								<div class="input-group input-group-sm">
								  	<div class="input-group-prepend">
								    	<span class="input-group-text">Folio</span>
								  	</div>
								  	<input type="text" class="form-control" id="OrdenFolio" disabled required>
								  	<div class="input-group-append">
								    	<button type="button" class="btn btn-outline-secondary" id="OrdenBuscarFolio" data-toggle="modal" data-target="#ModalOrdenFolio"><i class="fas fa-search"></i></button>
								  	</div>
								</div>
							</div>
							<div class="form-group col-4">
								<input type="text" class="form-control form-control-sm" id="OrdenNombreF" disabled required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group col-6">
								<label for="OrdenProveedor">Proveedor:</label>
								<div class="input-group">
								  	<input type="text" class="form-control" id="OrdenProveedor" required disabled>
								  	<div class="input-group-append">
								    	<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#ModalSeleProveedor" id="OrdenBuscarProveedor"><i class="fas fa-search"></i></button>
								  	</div>
								</div>
							</div>
							<div class="col-6" id="OrdenDatosProveedor">
								
							</div>
						</div>
						<hr>
						<form id="FormGuardarOrden">
							<div class="row">
								<div class="form-group col-4">
									<label for="OrdenProducto">Producto:</label>
									<div class="input-group input-group-sm">
									  	<input type="text" class="form-control IntOrPro" id="OrdenProducto" required disabled>
									  	<div class="input-group-append">
									    	<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#ModalSeleProducto" id="OrdenBuscarProducto"><i class="fas fa-search"></i></button>
									  	</div>
									</div>
								</div>
								<div class="form-group col-3">
									<label for="OrdenCodigoP">Código:</label>
									<input type="text" id="OrdenCodigoP" class="form-control form-control-sm IntOrPro" required disabled>
								</div>
								<div class="form-group col-2">
									<label for="OrdenUMEP">UME:</label>
									<input type="text" id="OrdenUMEP" class="form-control form-control-sm IntOrPro" required disabled>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-2">
									<label for="OrdenCantidad">Cantidad:</label>
									<input type="number" id="OrdenCantidad" class="form-control form-control-sm IntOrDetalle" min="0" step="any" value="0" required>
								</div>
								<div class="form-group col-2">
									<label for="OrdenPrecio">Precio:</label>
									<input type="number" id="OrdenPrecio" class="form-control form-control-sm IntOrDetalle" min="0" step="any" value="0" required>
								</div>
								<div class="form-group col-3">
									<label for="OrdenSubtotal">Subtotal:</label>
									<input type="number" id="OrdenSubtotal" class="form-control form-control-sm IntOrDetalle" min="0" step="any" value="0" disabled required>
								</div>
								<div class="form-group col-1">
									<label for="OrdenDescuento">Desct. %:</label>
									<input type="number" id="OrdenDescuento" class="form-control form-control-sm IntOrDetalle" min="0" max="100" step="any" value="0" required>
								</div>
								<div class="form-group col-1">
									<label for="OrdenIVA">IVA %:</label>
									<input type="number" id="OrdenIVA" class="form-control form-control-sm IntOrDetalle" min="0" step="any" value="0" required>
								</div>
								<div class="form-group col-3">
									<label for="OrdenTotal">Total:</label>
									<input type="number" id="OrdenTotal" class="form-control form-control-sm IntOrDetalle" min="0" step="any" value="0" disabled required>
								</div>
								<div class="form-group col-3 offset-9">
									<button type="submit" class="btn btn-success btn-block">Agregar <i class="fas fa-plus"></i></button>
								</div>
							</div>
						</form>
						<div class="row table-responsive" id="TablaOrden">
							<table class="table table-hover table-stripped table-sm">
								<thead>
									<tr>
										<th>Código</th>
										<th>Producto</th>
										<th>UME</th>
										<th>Cantidad</th>
										<th>Precio</th>
										<th>Subtotal</th>
										<th>Descuento %</th>
										<th>IVA %</th>
										<th>Total</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="Ordendetalles">
									
								</tbody>
							</table>
						</div>
						<hr>
						<div class="row">
							<div class="col-4 offset-8">
								<div class="input-group">
								  	<div class="input-group-prepend">
								    	<span class="input-group-text">Costo Total</span>
								  	</div>
								 	<input type="number" class="form-control" step="any" min="0" value="0" id="OrdenCostoTotal" required disabled>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-8 offset-2">
								<button class="btn btn-success btn-block btn-lg">Guardar <i class="fas fa-save"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalOrdenFolio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Folios Orden de Compra</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body" id="verOrdenFolios">
      			
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      		</div>
    	</div>
  	</div>
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalAgregarFolio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Nuevo Folio</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<form id="formGuardarFolio">
      		<div class="modal-body">
      			<div class="form-group">
      				<label for="folioSerie">Serie:</label>
      				<input type="text" id="folioSerie" class="form-control intFolio" maxlength="4" required>
      			</div>
      			<div class="form-group">
      				<label for="folioNombre">Nombre:</label>
      				<input type="text" id="folioNombre" class="form-control intFolio" maxlength="50" required>
      			</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        		<button type="submit" class="btn btn-success">Guardar</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalModificarFolio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Modificar Folio</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<form id="formGuardarMFolio">
      		<div class="modal-body">
      			<div class="form-group">
      				<label for="folioMSerie">Serie:</label>
      				<input type="text" id="folioMSerie" class="form-control intMfolio" maxlength="4" required>
      			</div>
      			<div class="form-group">
      				<label for="folioMNombre">Nombre:</label>
      				<input type="text" id="folioMNombre" class="form-control intMfolio" maxlength="50" required>
      			</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        		<button type="submit" class="btn btn-success" id="bModificarFolio">Guardar</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalSeleProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Seleccionar Proveedor</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body" id="verOrdenProveedores">
      			
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalSeleProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Seleccionar Producto</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body" id="verOrdenProductos">
      			
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>