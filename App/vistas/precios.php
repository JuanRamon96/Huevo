<div class="oculto" id="VistaPrecios">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<div class="col-12">
						<h2>Precios</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-hover table-striped" id="tablaPrecios" width="100%">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>
									<th>Costo Actual</th>
									<th>Costo Promedio</th>
									<th>Precio 1</th>
									<th>Pecio 2</th>
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

<!--/////////////////////////////////////////////////////////////-->

<div class="modal fade" id="ModalMPrecios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Modificar Precio</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<form id="FormMPrecios">
      		<div class="modal-body row">
      			<div class="form-group col-6">
      				<label for="CostoActual">Costo Actual:</label>
      				<input type="number" step="any" class="form-control" id="CostoActual" required>
      			</div>
				<div class="form-group col-6">
      				<label for="CostoPromedio">Costo Promedio:</label>
      				<input type="number" step="any" class="form-control" id="CostoPromedio" required>
      			</div>
      			<div class="form-group col-6">
      				<label for="Precio1">Precio 1:</label>
      				<input type="number" step="any" class="form-control" id="Precio1" required>
      			</div>
      			<div class="form-group col-6">
      				<label for="Precio2">Precio 2:</label>
      				<input type="number" step="any" class="form-control" id="Precio2" required>
      			</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        		<button type="submit" class="btn btn-success" id="bMprecios">Guardar</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>
