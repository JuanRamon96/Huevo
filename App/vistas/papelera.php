<div class="oculto" id="VistaPapelera">
	<div class="row">
		<div class="col-12" style="padding: 5px 10px;">
			<div class="card">
				<div class="row">
					<div class="col-12">
						<h1>Papelera</h1>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-12">
						<h5>Productos</h5>
					</div>
					<div class="col-12 table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>
									<th>UME</th>
									<th>Existencia</th>
									<th>Stock Mínimo</th>
									<th>Stock Máximo</th>
									<th>IVA</th>
									<th>Categoría</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody id="productos" attrTipo="Eliminado" attrCampo="ID_Producto">
								
							</tbody>
						</table>
					</div>
				</div>	
				<br>
				<hr>
				<div class="row">
					<div class="col-12">
						<h5>Clientes</h5>
					</div>
					<div class="col-12 table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>
									<th>Domicilio</th>
									<th>Colonia</th>
									<th>Ciudad</th>
									<th>Estado</th>
									<th>País</th>
									<th>Código Postal</th>
									<th>Razón Social</th>
									<th>RFC</th>
									<th>Teléfono</th>
									<th>Email</th>
									<th>Contacto</th>
									<th>Teléfono Contacto</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody id="clientes" attrTipo="Eliminado" attrCampo="ID_Cliente">
								
							</tbody>
						</table>
					</div>
				</div>
				<br>
				<hr>
				<div class="row">
					<div class="col-12">
						<h5>Proveedores</h5>
					</div>
					<div class="col-12 table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>
									<th>Domicilio</th>
									<th>Colonia</th>
									<th>Ciudad</th>
									<th>Estado</th>
									<th>País</th>
									<th>Código Postal</th>
									<th>Razón Social</th>
									<th>RFC</th>
									<th>Teléfono</th>
									<th>Email</th>
									<th>Contacto</th>
									<th>Teléfono Contacto</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody id="proveedores" attrTipo="Eliminado" attrCampo="ID_Proveedor">
								
							</tbody>
						</table>
					</div>
				</div>
				<br>
				<hr>
				<div class="row">
					<div class="col-12">
						<h5>Empleados</h5>
					</div>
					<div class="col-12 table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>
									<th>Apellido Paterno</th>
									<th>Apellido Materno</th>
									<th>Domicilio</th>
									<th>Colonia</th>
									<th>Ciudad</th>
									<th>Estado</th>
									<th>País</th>
									<th>Código Postal</th>
									<th>Teléfono</th>
									<th>Email</th>
									<th>Área</th>
									<th>Puesto</th>
									<th>SDI</th>
									<th>Tipo de sangre</th>
									<th>Alergias</th>
									<th>Llamar en caso de emergencia a</th>
									<th>Teléfono en caso de emregencia</th>
									<th>Fecha de Ingreso</th>
									<th>Fecha de Reingreso</th>
									<th>Fecha de baja</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody id="empleados" attrTipo="Eliminado" attrCampo="ID_Empleado">
								
							</tbody>
						</table>
					</div>
				</div>
				<br>
				<hr>
				<div class="row">
					<div class="col-12">
						<h5>Puestos y Áreas</h5>
					</div>
					<div class="col-6 table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>
									<th>Área</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody id="puestos" attrTipo="Eliminado" attrCampo="ID_Puesto">
								
							</tbody>
						</table>
					</div>
					<div class="col-6 table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody id="areas" attrTipo="Eliminado" attrCampo="ID_Area">
								
							</tbody>
						</table>
					</div>
				</div>
				<br>
				<hr>
				<div class="row">
					<div class="col-12">
						<h5>Ventas</h5>
					</div>
					<div class="col-12 table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Folio</th>
									<th>Cliente</th>
									<th>Total</th>
									<th>Fecha</th>
									<th></th>
								</tr>
							</thead>
							<tbody id="ventas" attrTipo="Eliminada" attrCampo="ID_Venta">
								
							</tbody>
						</table>
					</div>
				</div>
				<br>
				<hr>
				<div class="row">
					<div class="col-12">
						<h5>Ordenes de Compra</h5>
					</div>
					<div class="col-12 table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Folio</th>
									<th>Proveedor</th>
									<th>Total</th>
									<th>Fecha</th>
									<th></th>
								</tr>
							</thead>
							<tbody id="orden_compra" attrTipo="Eliminada" attrCampo="ID_Orden">
								
							</tbody>
						</table>
					</div>
				</div>
				<br>
				<hr>
				<div class="row">
					<div class="col-12">
						<h5>Compras</h5>
					</div>
					<div class="col-12 table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Folio</th>
									<th>Proveedor</th>
									<th>Total</th>
									<th>Fecha</th>
									<th>Orden de compra</th>
									<th></th>
								</tr>
							</thead>
							<tbody id="compras" attrTipo="Eliminada" attrCampo="ID_Compra">
								
							</tbody>
						</table>
					</div>
				</div>
				<br>
				<hr>
				<div class="row">
					<div class="col-12">
						<h5>Entregas</h5>
					</div>
					<div class="col-12 table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Folio</th>
									<th>Empleado</th>
									<th>Total</th>
									<th>Fecha</th>
									<th></th>
								</tr>
							</thead>
							<tbody id="entregas" attrTipo="Eliminada" attrCampo="ID_Entrega">
								
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>		
</div>