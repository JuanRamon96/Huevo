<div class="oculto" id="VistaVerEntregas">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<div class="col-12">
						<h2>Entregas</h2>
					</div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-6">
						<div class="input-group input-group-lg">
						  	<div class="input-group-prepend">
						    	<span class="input-group-text"><i class="fas fa-search"></i></span>
						  	</div>
						  	<input type="text" class="form-control busEntregas" id="BuscarEntregas" placeholder="Buscar Entregas">
						</div>
					</div>
					<div class="col-3">
						<div class="input-group">
						  	<div class="input-group-prepend">
						    	<span class="input-group-text">Desde</span>
						  	</div>
						  	<input type="date" class="form-control busEntregas" id="fechaDesdeE">
						</div>
					</div>
					<div class="col-3">
						<div class="input-group">
						  <div class="input-group-prepend">
						    <span class="input-group-text">Hasta</span>
						  </div>
						  <input type="date" class="form-control busEntregas" id="fechaHastaE">
						</div>
					</div>	
				</div>
				<br>
				<div class="row">
					<div class="col-12">
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="REntrega" value="0" checked>
						  	<label class="form-check-label" for="inlineRadio1">Todas</label>
						</div>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="REntrega" value="1">
						  	<label class="form-check-label" for="inlineRadio2">Activas</label>
						</div>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="REntrega" value="2">
						  	<label class="form-check-label" for="inlineRadio3">Cancelaldas</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-hover" id="tablaOrdenesEntrega">
							<thead>
								<th>Folio</th>
								<th>Empleado</th>
								<th>Total</th>
								<th>Fecha</th>
								<th></th>
								<th></th>
							</thead>
							<tbody id="ContenidoEntregas">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>			
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalMEntrega" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Modificar Entrega</h5>
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
						  	<input type="text" class="form-control" id="EntregaMFolio" disabled required>
						  	<div class="input-group-append">
						    	<button type="button" class="btn btn-outline-secondary" id="EntregaMBuscarFolio" data-toggle="modal" data-target="#ModalOrdenFolio"><i class="fas fa-search"></i></button>
							</div>
						</div>
					</div>
					<div class="form-group col-5">
						<input type="text" class="form-control form-control-sm" id="EntregaMNombreF" disabled required>
					</div>
					<div class="form-group col-5 offset-7">
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
						    	<span class="input-group-text">Fecha</span>
						  	</div>
							<input type="datetime-local" class="form-control" id="EntregaMFecha" required>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="form-group col-5">
						<label for="EntregaMResponsable">Responsable:</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" id="EntregaMResponsable" required disabled>
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#ModalSeleResponsable" id="EntregaMBuscarResponsable"><i class="fas fa-search"></i></button>
							</div>
						</div>
					</div>
					<div class="col-6" id="EntregaMDatosResponsable">
								
					</div>
				</div>
				<hr>
				<form id="FormMGuardarEntrega">
					<div class="row">
						<div class="form-group col-4">
							<label for="EntregaMProducto">Producto:</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control IntMENPro" id="EntregaMProducto" required disabled>
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#ModalSeleEntregaProducto" id="EntregaMBuscarProducto"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</div>
						<div class="form-group col-3">
							<label for="EntregaMCodigoP">Código:</label>
							<input type="text" id="EntregaMCodigoP" class="form-control form-control-sm IntMENPro" required disabled>
						</div>
						<div class="form-group col-2">
							<label for="EntregaMUMEP">UME:</label>
							<input type="text" id="EntregaMUMEP" class="form-control form-control-sm IntMENPro" required disabled>
						</div>
						<div class="form-group col-3">
							<label for="EntregaMEX">Existencia:</label>
							<input type="text" id="EntregaMEX" class="form-control form-control-sm IntMENPro" required disabled>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-2">
							<label for="EntregaMCantidad">Cantidad:</label>
							<input type="number" id="EntregaMCantidad" class="form-control form-control-sm IntMENDetalle" min="0" step="any" value="0" required>
						</div>
						<div class="form-group col-2">
							<label for="EntregaMCosto">Costo:</label>
							<input type="number" id="EntregaMCosto" class="form-control form-control-sm IntMENDetalle" min="0" step="any" value="0" required disabled>
						</div>
						<div class="form-group col-3">
							<label for="EntregaMSubtotal">Subtotal:</label>
							<input type="number" id="EntregaMSubtotal" class="form-control form-control-sm IntMENDetalle" min="0" step="any" value="0" disabled required>
						</div>
						<div class="form-group col-2">
							<label for="EntregaMIVA">IVA %:</label>
							<input type="number" id="EntregaMIVA" class="form-control form-control-sm IntMENDetalle" min="0" step="any" value="0" required disabled>
						</div>
						<div class="form-group col-3">
							<label for="EntregaMTotal">Total:</label>
							<input type="number" id="EntregaMTotal" class="form-control form-control-sm IntMENDetalle" min="0" step="any" value="0" disabled required>
						</div>
						<div class="form-group col-3 offset-9">
							<button type="submit" class="btn btn-success btn-block">Agregar <i class="fas fa-plus"></i></button>
						</div>
					</div>
				</form>
				<div class="row table-responsive" id="TablaMEntrega">
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
						<tbody id="EntregaMdetalles">
									
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
							<input type="number" class="form-control" step="any" min="0" value="0" id="EntregaMCostoTotal" required disabled>
						</div>
					</div>
				</div>		
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        		<button type="submit" class="btn btn-success" id="GuardarMEntrega">Guardar</button>
      		</div>
    	</div>
  	</div>
</div>