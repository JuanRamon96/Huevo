<div class="oculto" id="VistaMP">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<div class="col-12">
						<h2>Quebrado y Pasteurizado</h2>
					</div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-12">
						<form id="FormQP" class="row">
							<div class="form-group col-3">
								<label for="qpProd">Producto:</label>
								<select class="form-control" id="qpProd" required>
									
								</select>
							</div>
							<div class="form-group col-3">
								<label for="qpCodi">Código:</label>
								<input type="text" class="form-control" id="qpCodi" disabled>
							</div>
							<div class="form-group col-2">
								<label for="qpUME">UME:</label>
								<input type="text" class="form-control" id="qpUME" disabled>
							</div>
							<div class="form-group col-2">
								<label for="qpCantidad">Cantidad:</label>
								<input type="number" step="any" class="form-control" id="qpCantidad" required>
							</div>
							<div class="form-group col-2" style="padding-top: 30px;">
								<button type="submit" class="btn btn-success btn-block"><i class="fas fa-plus"></i></button>
							</div>
						</form>
					</div>	
				</div>
				<br>
				<hr>
				<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-striped table-hover" id="tablaPro1" width="100%">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Código</th>
									<th>UME</th>
									<th>Cantidad</th>
									<th>Fecha</th>
									<th></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>