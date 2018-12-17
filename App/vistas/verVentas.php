<div class="oculto" id="VistaVerVentas">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<div class="col-12">
						<h2>Ventas</h2>
					</div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-6">
						<div class="input-group input-group-lg">
						  	<div class="input-group-prepend">
						    	<span class="input-group-text"><i class="fas fa-search"></i></span>
						  	</div>
						  	<input type="text" class="form-control busVentas" id="BuscarVentas" placeholder="Buscar Ventas">
						</div>
					</div>
					<div class="col-3">
						<div class="input-group">
						  	<div class="input-group-prepend">
						    	<span class="input-group-text">Desde</span>
						  	</div>
						  	<input type="date" class="form-control busVentas" id="fechaDesdeV">
						</div>
					</div>
					<div class="col-3">
						<div class="input-group">
						  <div class="input-group-prepend">
						    <span class="input-group-text">Hasta</span>
						  </div>
						  <input type="date" class="form-control busVentas" id="fechaHastaV">
						</div>
					</div>	
				</div>
				<br>
				<div class="row">
					<div class="col-12">
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="RVenta" value="0" checked>
						  	<label class="form-check-label" for="inlineRadio1">Todas</label>
						</div>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="RVenta" value="1">
						  	<label class="form-check-label" for="inlineRadio2">Activas</label>
						</div>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="RVenta" value="2">
						  	<label class="form-check-label" for="inlineRadio3">Cancelaldas</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-hover" id="tablaVerVenta">
							<thead>
								<th>Folio</th>
								<th>Empleado</th>
								<th>Total</th>
								<th>Fecha</th>
								<th></th>
								<th></th>
							</thead>
							<tbody id="ContenidoVentas">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>			
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalMVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Modificar Venta</h5>
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
						  	<input type="text" class="form-control" id="VentaMFolio" disabled required>
						  	<div class="input-group-append">
						    	<button type="button" class="btn btn-outline-secondary" id="VentaMBuscarFolio" data-toggle="modal" data-target="#ModalOrdenFolio"><i class="fas fa-search"></i></button>
							</div>
						</div>
					</div>
					<div class="form-group col-5">
						<input type="text" class="form-control form-control-sm" id="VentaMNombreF" disabled required>
					</div>
					<div class="form-group col-5 offset-7">
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
						    	<span class="input-group-text">Fecha</span>
						  	</div>
							<input type="datetime-local" class="form-control" id="VentaMFecha" required>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="form-group col-5">
						<label for="VentaMResponsable">Responsable:</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" id="VentaMResponsable" required disabled>
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#ModalSeleCliente" id="VentaMBuscarCliente"><i class="fas fa-search"></i></button>
							</div>
						</div>
					</div>
					<div class="col-6" id="VentaMDatosCliente">
								
					</div>
				</div>
				<hr>
				<form id="FormMGuardarVenta">
					<div class="row">
						<div class="form-group col-4">
							<label for="VentaMProducto">Producto:</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control IntMVenPro" id="VentaMProducto" required disabled>
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#ModalSeleVentaProducto" id="VentaMBuscarProducto"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</div>
						<div class="form-group col-3">
							<label for="VentaMCodigoP">Código:</label>
							<input type="text" id="VentaMCodigoP" class="form-control form-control-sm IntMVenPro" required disabled>
						</div>
						<div class="form-group col-2">
							<label for="VentaMUMEP">UME:</label>
							<input type="text" id="VentaMUMEP" class="form-control form-control-sm IntMVenPro" required disabled>
						</div>
						<div class="form-group col-3">
							<label for="VentaMEX">Existencia:</label>
							<input type="text" id="VentaMEX" class="form-control form-control-sm IntMVenPro" required disabled>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-2">
							<label for="VentaMCantidad">Cantidad:</label>
							<input type="number" id="VentaMCantidad" class="form-control form-control-sm IntMVenDetalle" min="0" step="any" value="0" required>
						</div>
						<div class="form-group col-2">
							<label for="VentaMCosto">Costo:</label>
							<input type="number" id="VentaMCosto" class="form-control form-control-sm IntMVenDetalle" min="0" step="any" value="0" required disabled>
						</div>
						<div class="form-group col-3">
							<label for="VentaMSubtotal">Subtotal:</label>
							<input type="number" id="VentaMSubtotal" class="form-control form-control-sm IntMVenDetalle" min="0" step="any" value="0" disabled required>
						</div>
						<div class="form-group col-2">
							<label for="VentaMIVA">IVA %:</label>
							<input type="number" id="VentaMIVA" class="form-control form-control-sm IntMVenDetalle" min="0" step="any" value="0" required disabled>
						</div>
						<div class="form-group col-3">
							<label for="VentaMTotal">Total:</label>
							<input type="number" id="VentaMTotal" class="form-control form-control-sm IntMVenDetalle" min="0" step="any" value="0" disabled required>
						</div>
						<div class="form-group col-3 offset-9">
							<button type="submit" class="btn btn-success btn-block">Agregar <i class="fas fa-plus"></i></button>
						</div>
					</div>
				</form>
				<div class="row table-responsive" id="TablaMVenta">
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
						<tbody id="VentaMdetalles">
									
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
							<input type="number" class="form-control" step="any" min="0" value="0" id="VentaMCostoTotal" required disabled>
						</div>
					</div>
				</div>		
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        		<button type="submit" class="btn btn-success" id="GuardarMVenta">Guardar</button>
      		</div>
    	</div>
  	</div>
</div>