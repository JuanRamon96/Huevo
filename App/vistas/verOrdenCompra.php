<div class="oculto" id="VistaVerOrdenCompra">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<h2>Ordenes de Compra</h2>
				</div>
				<br><br>
				<div class="row">
					<div class="col-6">
						<div class="input-group input-group-lg">
						  	<div class="input-group-prepend">
						    	<span class="input-group-text"><i class="fas fa-search"></i></span>
						  	</div>
						  	<input type="text" class="form-control busOrden" id="BuscarOC" placeholder="Buscar Orden de Compra">
						</div>
					</div>
					<div class="col-3">
						<div class="input-group">
						  	<div class="input-group-prepend">
						    	<span class="input-group-text">Desde</span>
						  	</div>
						  	<input type="date" class="form-control busOrden" id="fechaDesde">
						</div>
					</div>
					<div class="col-3">
						<div class="input-group">
						  <div class="input-group-prepend">
						    <span class="input-group-text">Hasta</span>
						  </div>
						  <input type="date" class="form-control busOrden" id="fechaHasta">
						</div>
					</div>	
				</div>
				<br>
				<div class="row">
					<div class="col-12">
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="ROrdenC" value="0" checked>
						  	<label class="form-check-label" for="inlineRadio1">Todas</label>
						</div>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="ROrdenC" value="1">
						  	<label class="form-check-label" for="inlineRadio2">No Convertidas</label>
						</div>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="ROrdenC" value="2">
						  	<label class="form-check-label" for="inlineRadio3">Convertidas</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-hover" id="tablaOrdenesCompra">
							<thead>
								<th>Folio</th>
								<th>Proveedor</th>
								<th>Total</th>
								<th>Fecha</th>
								<th></th>
								<th></th>
							</thead>
							<tbody id="ContenidoOrden">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalOrdenCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Modificar Orden de Compra</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
      			<div class="row">
					<div class="form-group col-5 offset-2">
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text">Folio</span>
							</div>
							<input type="text" class="form-control" id="OrdenMFolio" disabled required>
							<div class="input-group-append">
								<button type="button" class="btn btn-outline-secondary" id="OrdenMBuscarFolio" data-toggle="modal" data-target="#ModalOrdenFolio"><i class="fas fa-search"></i></button>
							</div>
						</div>
					</div>
					<div class="form-group col-5">
						<input type="text" class="form-control form-control-sm" id="OrdenMNombreF" disabled required>
					</div>
					<div class="form-group col-5 offset-7">
      					<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text">Fecha</span>
							</div>
							<input type="datetime-local" class="form-control" id="OrdenMFecha" required>
						</div>
      				</div>
				</div>
				<br>
				<div class="row">
					<div class="form-group col-5">
						<label for="OrdenMProveedor">Proveedor:</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" id="OrdenMProveedor" required disabled>
							<div class="input-group-append">
							    <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#ModalSeleProveedor" id="OrdenMBuscarProveedor"><i class="fas fa-search"></i></button>
							</div>
						</div>
					</div>
					<div class="col-6" id="OrdenMDatosProveedor">
								
					</div>
				</div>
				<hr>
				<form id="FormMGuardarOrden">
					<div class="row">
						<div class="form-group col-5">
							<label for="OrdenMProducto">Producto:</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control IntMOrPro" id="OrdenMProducto" required disabled>
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#ModalSeleProducto" id="OrdenMBuscarProducto"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</div>
						<div class="form-group col-4">
							<label for="OrdenMCodigoP">Código:</label>
							<input type="text" id="OrdenMCodigoP" class="form-control form-control-sm IntMOrPro" required disabled>
						</div>
						<div class="form-group col-3">
							<label for="OrdenMUMEP">UME:</label>
							<input type="text" id="OrdenMUMEP" class="form-control form-control-sm IntMOrPro" required disabled>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-2">
							<label for="OrdenMCantidad">Cantidad:</label>
							<input type="number" id="OrdenMCantidad" class="form-control form-control-sm IntMOrDetalle" min="0" step="any" value="0" required>
						</div>
						<div class="form-group col-2">
							<label for="OrdenMPrecio">Precio:</label>
							<input type="number" id="OrdenMPrecio" class="form-control form-control-sm IntMOrDetalle" min="0" step="any" value="0" required>
						</div>
						<div class="form-group col-2">
							<label for="OrdenMSubtotal">Subtotal:</label>
							<input type="number" id="OrdenMSubtotal" class="form-control form-control-sm IntMOrDetalle" min="0" step="any" value="0" disabled required>
						</div>
						<div class="form-group col-2">
							<label for="OrdenMDescuento">Desct. %:</label>
							<input type="number" id="OrdenMDescuento" class="form-control form-control-sm IntMOrDetalle" min="0" max="100" step="any" value="0" required>
						</div>
						<div class="form-group col-2">
							<label for="OrdenMIVA">IVA %:</label>
							<input type="number" id="OrdenMIVA" class="form-control form-control-sm IntMOrDetalle" min="0" step="any" value="0" required>
						</div>
						<div class="form-group col-2">
							<label for="OrdenMTotal">Total:</label>
							<input type="number" id="OrdenMTotal" class="form-control form-control-sm IntMOrDetalle" min="0" step="any" value="0" disabled required>
						</div>
						<div class="form-group col-3 offset-9">
							<button type="submit" class="btn btn-success btn-block">Agregar <i class="fas fa-plus"></i></button>
						</div>
					</div>
				</form>
				<div class="row" id="TablaMOrden">
					<div class="col-12 table-responsive">
						<table class="table table-hover table-stripped table-sm" width="100%">
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
							<tbody id="OrdenMdetalles">
									
							</tbody>
						</table>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-4 offset-8">
						<div class="input-group">
							<div class="input-group-prepend">
							    <span class="input-group-text">Costo Total</span>
							</div>
							<input type="number" class="form-control" step="any" min="0" value="0" id="OrdenMCostoTotal" required disabled>
						</div>
					</div>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        		<button type="submit" class="btn btn-success" id="GuardarMOrdenCompra">Guardar</button>
      		</div>
    	</div>
  	</div>
</div>

