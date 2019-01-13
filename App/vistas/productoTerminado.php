<div class="oculto" id="VistaPT">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<div class="col-12">
						<h2>Producto Terminado</h2>
					</div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-12">
						<form id="FormENVA" class="row">
							<div class="form-group col-2">
								<label for="enLote">Lote:</label>
								<input type="text" step="any" class="form-control" id="enLote" maxlength="30" required>
							</div>
							<div class="form-group col-3">
								<label for="enProd">Producto:</label>
								<select class="form-control" id="enProd" required>
									
								</select>
							</div>
							<div class="form-group col-2">
								<label for="enCodi">Código:</label>
								<input type="text" class="form-control" id="enCodi" disabled>
							</div>
							<div class="form-group col-2">
								<label for="enUME">UME:</label>
								<input type="text" class="form-control" id="enUME" disabled>
							</div>
							<div class="form-group col-2">
								<label for="enCantidad">Cantidad:</label>
								<input type="number" step="any" class="form-control" id="enCantidad" required>
							</div>
							<div class="form-group col-1" style="padding-top: 30px;">
								<button type="submit" class="btn btn-success btn-block"><i class="fas fa-plus"></i></button>
							</div>
						</form>
					</div>	
				</div>
				<br>
				<hr>
				<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-striped table-hover" id="tablaPro2" width="100%">
							<thead>
								<tr>
									<th>Lote</th>
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