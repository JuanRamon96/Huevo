<div class="oculto" id="VistaCompras">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<div class="col-12">
						<h2>Compras</h2>
					</div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-6">
						<div class="input-group input-group-lg">
						  	<div class="input-group-prepend">
						    	<span class="input-group-text"><i class="fas fa-search"></i></span>
						  	</div>
						  	<input type="text" class="form-control busCompra" id="BuscarCompra" placeholder="Buscar Compra">
						</div>
					</div>
					<div class="col-3">
						<div class="input-group">
						  	<div class="input-group-prepend">
						    	<span class="input-group-text">Desde</span>
						  	</div>
						  	<input type="date" class="form-control busCompra" id="fechaDesdeC">
						</div>
					</div>
					<div class="col-3">
						<div class="input-group">
						  <div class="input-group-prepend">
						    <span class="input-group-text">Hasta</span>
						  </div>
						  <input type="date" class="form-control busCompra" id="fechaHastaC">
						</div>
					</div>	
				</div>
				<br>
				<div class="row">
					<div class="col-12">
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="RCompra" value="0" checked>
						  	<label class="form-check-label" for="inlineRadio1">Todas</label>
						</div>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="RCompra" value="1">
						  	<label class="form-check-label" for="inlineRadio2">Activas</label>
						</div>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="RCompra" value="2">
						  	<label class="form-check-label" for="inlineRadio3">Cancelaldas</label>
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
								<th>Orden de Compra</th>
								<th></th>
								<th></th>
							</thead>
							<tbody id="ContenidoCompras">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>