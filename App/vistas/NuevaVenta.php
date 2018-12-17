<div class="oculto" id="VistaNuevaVenta">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<div class="col-12">
						<h3>Nueva Venta</h3>
					</div>
					<br><br>
					<div class="col-12">
						<div class="row">
							<div class="form-group col-3 offset-5">
								<div class="input-group input-group-sm">
								  	<div class="input-group-prepend">
								    	<span class="input-group-text">Folio</span>
								  	</div>
								  	<input type="text" class="form-control" id="VentaFolio" disabled required>
								  	<div class="input-group-append">
								    	<button type="button" class="btn btn-outline-secondary" id="VentaBuscarFolio" data-toggle="modal" data-target="#ModalOrdenFolio"><i class="fas fa-search"></i></button>
								  	</div>
								</div>
							</div>
							<div class="form-group col-4">
								<input type="text" class="form-control form-control-sm" id="VentaNombreF" disabled required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group col-6">
								<label for="VentaResponsable">Cliente:</label>
								<div class="input-group">
								  	<input type="text" class="form-control" id="VentaResponsable" required disabled>
								  	<div class="input-group-append">
								    	<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#ModalSeleCliente" id="VentaBuscarResponsable"><i class="fas fa-search"></i></button>
								  	</div>
								</div>
							</div>
							<div class="col-6" id="VentaDatosCliente">
								
							</div>
						</div>
						<hr>
						<form id="FormGuardarVenta">
							<div class="row">
								<div class="form-group col-4">
									<label for="VentaProducto">Producto:</label>
									<div class="input-group input-group-sm">
									  	<input type="text" class="form-control IntVenPro" id="VentaProducto" required disabled>
									  	<div class="input-group-append">
									    	<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#ModalSeleVentaProducto" id="VentaBuscarProducto"><i class="fas fa-search"></i></button>
									  	</div>
									</div>
								</div>
								<div class="form-group col-3">
									<label for="VentaCodigoP">Código:</label>
									<input type="text" id="VentaCodigoP" class="form-control form-control-sm IntVenPro" required disabled>
								</div>
								<div class="form-group col-2">
									<label for="VentaUMEP">UME:</label>
									<input type="text" id="VentaUMEP" class="form-control form-control-sm IntVenPro" required disabled>
								</div>
								<div class="form-group col-2">
									<label for="VentaUMEP">Existencia:</label>
									<input type="text" id="VentaEX" class="form-control form-control-sm IntVenPro" required disabled>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-2">
									<label for="VentaCantidad">Cantidad:</label>
									<input type="number" id="VentaCantidad" class="form-control form-control-sm IntVenDetalle" min="0" step="any" value="0" required>
								</div>
								<div class="form-group col-2">
									<label for="VentaPrecio">Costo:</label>
									<input type="number" id="VentaCosto" class="form-control form-control-sm IntVenDetalle" min="0" step="any" value="0" required disabled>
								</div>
								<div class="form-group col-3">
									<label for="VentaSubtotal">Subtotal:</label>
									<input type="number" id="VentaSubtotal" class="form-control form-control-sm IntVenDetalle" min="0" step="any" value="0" disabled required>
								</div>
								<div class="form-group col-2">
									<label for="VentaIVA">IVA %:</label>
									<input type="number" id="VentaIVA" class="form-control form-control-sm IntVenDetalle" min="0" step="any" value="0" required disabled>
								</div>
								<div class="form-group col-3">
									<label for="VentaTotal">Total:</label>
									<input type="number" id="VentaTotal" class="form-control form-control-sm IntVenDetalle" min="0" step="any" value="0" disabled required>
								</div>
								<div class="form-group col-3 offset-9">
									<button type="submit" class="btn btn-success btn-block">Agregar <i class="fas fa-plus"></i></button>
								</div>
							</div>
						</form>
						<div class="row table-responsive" id="TablaVenta">
							<table class="table table-hover table-stripped table-sm">
								<thead>
									<tr>
										<th>Código</th>
										<th>Producto</th>
										<th>UME</th>
										<th>Cantidad</th>
										<th>Costo</th>
										<th>Subtotal</th>
										<th>IVA %</th>
										<th>Total</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="Ventadetalles">
									
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
								 	<input type="number" class="form-control" step="any" min="0" value="0" id="VentaCostoTotal" required disabled>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-8 offset-2">
								<button class="btn btn-success btn-block btn-lg" id="GuardarVenta">Guardar <i class="fas fa-save"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalSeleCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Seleccionar Cliente</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body" id="verVentaCliente">
      			
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalSeleVentaProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Seleccionar Producto</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body" id="verVentaProductos">
      			
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>