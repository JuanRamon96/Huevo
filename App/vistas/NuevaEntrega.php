<div class="oculto" id="VistaNuevaEntrega">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<div class="col-12">
						<h3>Nueva Entrega</h3>
					</div>
					<br><br>
					<div class="col-12">
						<div class="row">
							<div class="form-group col-3 offset-5">
								<div class="input-group input-group-sm">
								  	<div class="input-group-prepend">
								    	<span class="input-group-text">Folio</span>
								  	</div>
								  	<input type="text" class="form-control" id="EntregaFolio" disabled required>
								  	<div class="input-group-append">
								    	<button type="button" class="btn btn-outline-secondary" id="EntregaBuscarFolio" data-toggle="modal" data-target="#ModalOrdenFolio"><i class="fas fa-search"></i></button>
								  	</div>
								</div>
							</div>
							<div class="form-group col-4">
								<input type="text" class="form-control form-control-sm" id="EntregaNombreF" disabled required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group col-6">
								<label for="EntregaResponsable">Responsable:</label>
								<div class="input-group">
								  	<input type="text" class="form-control" id="EntregaResponsable" required disabled>
								  	<div class="input-group-append">
								    	<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#ModalSeleResponsable" id="EntregaBuscarResponsable"><i class="fas fa-search"></i></button>
								  	</div>
								</div>
							</div>
							<div class="col-6" id="EntregaDatosResponsable">
								
							</div>
						</div>
						<hr>
						<form id="FormGuardarEntrega">
							<div class="row">
								<div class="form-group col-4">
									<label for="EntregaProducto">Producto:</label>
									<div class="input-group input-group-sm">
									  	<input type="text" class="form-control IntENPro" id="EntregaProducto" required disabled>
									  	<div class="input-group-append">
									    	<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#ModalSeleEntregaProducto" id="EntregaBuscarProducto"><i class="fas fa-search"></i></button>
									  	</div>
									</div>
								</div>
								<div class="form-group col-3">
									<label for="EntregaCodigoP">Código:</label>
									<input type="text" id="EntregaCodigoP" class="form-control form-control-sm IntENPro" required disabled>
								</div>
								<div class="form-group col-2">
									<label for="EntregaUMEP">UME:</label>
									<input type="text" id="EntregaUMEP" class="form-control form-control-sm IntENPro" required disabled>
								</div>
								<div class="form-group col-2">
									<label for="EntregaUMEP">Existencia:</label>
									<input type="text" id="EntregaEX" class="form-control form-control-sm IntENPro" required disabled>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-2">
									<label for="EntregaCantidad">Cantidad:</label>
									<input type="number" id="EntregaCantidad" class="form-control form-control-sm IntENDetalle" min="0" step="any" value="0" required>
								</div>
								<div class="form-group col-2">
									<label for="EntregaPrecio">Costo:</label>
									<input type="number" id="EntregaCosto" class="form-control form-control-sm IntENDetalle" min="0" step="any" value="0" required disabled>
								</div>
								<div class="form-group col-3">
									<label for="EntregaSubtotal">Subtotal:</label>
									<input type="number" id="EntregaSubtotal" class="form-control form-control-sm IntENDetalle" min="0" step="any" value="0" disabled required>
								</div>
								<div class="form-group col-2">
									<label for="EntregaIVA">IVA %:</label>
									<input type="number" id="EntregaIVA" class="form-control form-control-sm IntENDetalle" min="0" step="any" value="0" required disabled>
								</div>
								<div class="form-group col-3">
									<label for="EntregaTotal">Total:</label>
									<input type="number" id="EntregaTotal" class="form-control form-control-sm IntENDetalle" min="0" step="any" value="0" disabled required>
								</div>
								<div class="form-group col-3 offset-9">
									<button type="submit" class="btn btn-success btn-block">Agregar <i class="fas fa-plus"></i></button>
								</div>
							</div>
						</form>
						<div class="row table-responsive" id="TablaEntrega">
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
								<tbody id="Entregadetalles">
									
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
								 	<input type="number" class="form-control" step="any" min="0" value="0" id="EntregaCostoTotal" required disabled>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-8 offset-2">
								<button class="btn btn-success btn-block btn-lg" id="GuardarEntrega">Guardar <i class="fas fa-save"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalSeleResponsable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Seleccionar Responsable</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body" id="verOrdenResponsable">
      			
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      		</div>
    	</div>
  	</div>
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalSeleEntregaProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Seleccionar Producto</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body" id="verEntregaProductos">
      			
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      		</div>
    	</div>
  	</div>
</div>