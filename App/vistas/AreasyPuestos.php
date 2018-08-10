<div class="oculto" id="VistaAreasyPuestos">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
					    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Áreas</a>
					    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Puestos</a>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
					  	<div class="row">
					  		<div class="col-12" id="nuevaArea">
					  			
					  		</div>	
					  	</div>
					  	<br>
					  	<div class="row">
					  		<div class="col-12 table-responsive">
					  			<table class="table table-striped table-hover" width="100%" id="tablaAreas">
						  			<thead>
						  				<th>Nombre</th>
						  				<th>Estatus</th>
						  				<th></th>
						  			</thead>
					  			</table>
					  		</div>	
					  	</div>
					</div>
					<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
					  	<div class="row">
					  		<div class="col-12" id="nuevoPuesto">
					  			
					  		</div>		
					  	</div>
					  	<br>
					  	<div class="row">
					  		<div class="col-12 table-responsive">
					  			<table class="table table-striped table-hover" width="100%" id="tablaPuestos">
						  			<thead>
						  				<th>Nombre</th>
						  				<th>Área</th>
						  				<th>Estatus</th>
						  				<th></th>
						  			</thead>
						  		</table>
					  		</div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalAreas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Modificar Área</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<form id="FormModiArea">
      		<div class="modal-body row">
      			<div class="col-12 text-right">
					<label>Activa</label>
					<input type="checkbox" class="ModiAreas" id="AreaMActivo" value="1" checked>
					<br>
				</div>
				<div class="form-group col-12">
					<label for="areaMNombre">Nombre:</label>
					<input type="text" id="areaMNombre" class="form-control ModiAreas" maxlength="60" required>
				</div>	
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        		<button type="submit" class="btn btn-success" id="GuardarMAreas">Guardar</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="ModalPuestos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Modificar Puesto</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<form id="FormModiPuestos">
      		<div class="modal-body row">
      			<div class="col-12 text-right">
					<label>Activo</label>
					<input type="checkbox" class="ModiPuestos" id="PuestoMActivo" value="1" checked>
					<br>
				</div>
				<div class="form-group col-12">
					<label for="puestoMNombre">Nombre:</label>
					<input type="text" id="puestoMNombre" class="form-control ModiPuestos" maxlength="60" required>
				</div>	
				<div class="form-group col-12">
					<select class="form-control ModiPuestos" id="puestoMArea" required>
					
					</select>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        		<button type="submit" class="btn btn-success" id="GuardarMPuestos">Guardar</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>