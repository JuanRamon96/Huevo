<?php  
    session_start();
    require("../conexion.php");

    if(!isset($_SESSION['user'])){
        header('Location: ../');
    }else{
    	$nombre = $_SESSION["user"]["Nombre"];
    	$id = $_SESSION['user']['ID_Usuario'];
    	$productos = array('0','0','0','0','0','0');
		$clientes = array('0','0','0','0');
		$ventas = array('0','0','0','0');
		$proveedores = array('0','0','0','0');
		$compras = array('0','0','0','0');
		$produccion = array('0','0','0','0');
		$entregas = array('0','0','0','0');
		$reportes = '0';
		$etiquetas = '0';
		$empleados = array('0','0','0','0');
    	
    	if($_SESSION['user']['Tipo']=="2"){
    		$sql = "SELECT * FROM permisos WHERE FK_Usuario = '$id'";

			if($res=$con->query($sql)){
			    if ($res->num_rows > 0) {
					$row = $res->fetch_assoc();

					$productos = explode("*", $row["Productos"]);
					$clientes = explode("*", $row["Clientes"]);
					$ventas = explode("*", $row["Ventas"]);
					$proveedores = explode("*", $row["Proveedores"]);
					$compras = explode("*", $row["Compras"]);
					$produccion = explode("*", $row["Produccion"]);
					$entregas = explode("*", $row["Entregas"]);
					$reportes = $row["Reportes"];
					$etiquetas = $row["Etiquetas"];
					$empleados = explode("*", $row["Empleados"]);
				}
			}else{
			    echo "Error: ".mysqli_error($con);
			}
			$con->close();
    	}
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Huevo</title>
	<link rel="icon" href="../Imagenes/egg.png">
	<link rel="stylesheet" href="../CSS/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../CSS/buttons.dataTables.min.css">
	<link rel="stylesheet" href="../CSS/bootstrap.min.css">
	<link rel="stylesheet" href="../CSS/bootstrap.css">
	<link rel="stylesheet" href="../CSS/menu.css">
</head>
<body>
	<div class="carga" id="carga">
        <p><img class="carIma" src="../Imagenes/carga.svg"></p>
        <p><img class="logo" src="../Imagenes/logo.png"></p>
    </div>

	<div id="mySidenav" tabindex="0" class="sidenav">
	 	<a href="javascript:void(0)" class="closebtn" id="closeBtn">&times;</a>	  	
	  	<?php
	  		if ($productos[0]=='1' || $_SESSION['user']['Tipo']=='1') {
	  			echo "<ul><span><i class='fas fa-boxes'></i> Productos</span>";
	  			
	  			if($productos[1]=='1' || $_SESSION['user']['Tipo']=='1'){
	  				echo "<li id='verNuevoProducto'>Nuevo Producto <i class='fas fa-plus'></i></li>";
	  			}
	  			echo "<li style='font-size:13px;' id='verProductos1'>Inventario Producto Terminado <i class='fas fa-pallet'></i></li>
	  					<li style='font-size:16px;' id='verProductos2'>Inventario Materia Prima <i class='fas fa-box-open'></i></li>
	  					<li id='verProductos3'>Inventario Insumos <i class='fas fa-archive'></i></li>";
	  			
	  			if($productos[4]=='1' || $_SESSION['user']['Tipo']=='1'){
	  				echo "<li id='verPrecios'>Precios <i class='fas fa-dollar-sign'></i></li>";
	  			}
	  			echo "</ul>";
	  				
	  		}
	  		if ($clientes[0]=='1' || $_SESSION['user']['Tipo']=='1') {
	  			echo "<ul><span><i class='fas fa-address-card'></i> Clientes</span>";

	  			if($clientes[1]=='1' || $_SESSION['user']['Tipo']=='1'){
	  				echo "<li id='verNuevoCliente'>Nuevo Cliente <i class='fas fa-plus'></i></li>";
	  			}
	  			echo "<li id='verClientes'>Consultar Clientes <i class='fas fa-search'></i></li>
	  				</ul>";
	  				
	  		}
	  		if ($ventas[0]=='1' || $_SESSION['user']['Tipo']=='1') {
	  			echo "<ul><span><i class='fas fa-dollar-sign'></i> Ventas</span>";

	  			if($ventas[1]=='1' || $_SESSION['user']['Tipo']=='1'){
	  				echo "<li id='verNuevaVenta'>Nueva Venta <i class='fas fa-plus'></i></li>";
	  			}
	  			echo "<li id='verVentas'>Consultar Ventas <i class='fas fa-search'></i></li>
	  				</ul>";
	  				
	  		}
	  		if ($proveedores[0] =='1' || $_SESSION['user']['Tipo']=='1') {
	  			echo "<ul><span><i class='fas fa-shipping-fast'></i> Proveedores</span>";

	  			if($proveedores[1] =='1' || $_SESSION['user']['Tipo']=='1'){
	  				echo "<li id='verNuevoProveedor'>Nuevo Proveedor <i class='fas fa-plus'></i></li>";
	  			}
	  			echo "<li id='verProveedores'>Consultar Proveedores <i class='fas fa-search'></i></li>
	  				</ul>";
	  				
	  		}
	  		if ($compras[0] =='1' || $_SESSION['user']['Tipo']=='1') {
	  			echo "<ul><span><i class='fas fa-shopping-cart'></i> Compras</span>";

	  			if($compras[1] =='1' || $_SESSION['user']['Tipo']=='1'){
	  				echo "<li id='verNuevaOrden'>Nueva Orden Compra <i class='fas fa-plus'></i></li>";
	  			}
	  			echo "<li style='font-size:13px;' id='verOrdenesCompra'>Consultar Ordenes de Compra <i class='fas fa-search'></i></li>
	  					<li id='verCompras'>Consultar Compras <i class='fas fa-search'></i></li>
	  				</ul>";
	  				
	  		}
	  		if ($empleados[0] =='1' || $_SESSION['user']['Tipo']=='1') {
	  			echo "<ul><span><i class='fas fa-people-carry'></i> Empleados</span>";

	  			if($empleados[1]=='1' || $_SESSION['user']['Tipo']=='1'){
	  				echo "<li id='verNuevoEmpleado'>Nuevo Empleado <i class='fas fa-plus'></i></li>";
	  			}
	  			echo "<li id='verEmpleados'>Consultar Empleados <i class='fas fa-search'></i></li>
	  					<li id='verAyP'>Áreas y Puestos <i class='fas fa-sitemap'></i></li>
	  				</ul>";
	  				
	  		}
	  		if ($entregas[0] =='1' || $_SESSION['user']['Tipo']=='1') {
	  			echo "<ul><span><i class='fas fa-handshake'></i> Entregas</span>";

	  			if($entregas[1]=='1' || $_SESSION['user']['Tipo']=='1'){
	  				echo "<li id='verNuevaEntrega'>Nueva Entrega <i class='fas fa-plus'></i></li>";
	  			}
	  			echo "<li id='verEntregas'>Consultar Entregas <i class='fas fa-search'></i></li>
	  				</ul>";
	  				
	  		}
	  		if ($produccion[0] =='1' || $_SESSION['user']['Tipo']=='1') {
	  			echo "<ul><span><i class='fas fa-cogs'></i> Producción</span>";

	  			/*if($produccion[1]=='1' || $_SESSION['user']['Tipo']=='1'){
	  				echo "<li>Nueva Entrega <i class='fas fa-plus'></i></li>";
	  			}*/
	  			echo "<li>Quebrado <i class='fas fa-compress'></i></li>
	  					<li>Pasteurizado <i class='fas fa-thermometer-full'></i></li>
	  					<li>Envasado <i class='fas fa-dolly'></i></li>
	  				</ul>";
	  				
	  		}
	  		if ($reportes =='1' || $_SESSION['user']['Tipo']=='1') {
	  			echo "<ul><span><i class='fas fa-chart-line'></i> Reportes</span></ul>";	
	  		}

	  		if ($etiquetas =='1' || $_SESSION['user']['Tipo']=='1') {
	  			echo "<ul><span><i class='fas fa-barcode'></i> Etiquetas</span></ul>";	
	  		}

	  		if($_SESSION['user']['Tipo']=='1'){ 
	  			
	  			echo "<ul id='VerUsuarios'><span><i class='fas fa-users'></i> Usuarios</span></ul>
	  				<ul id='DatosGenerales'><span><i class='fas fa-tasks'></i> Generales</span></ul>
	  				<ul id='VerUsuarios'><span><i class='fas fa-trash-alt'></i> Papelera</span></ul>";
	  		}
	  	?>
	</div>
	
	<nav class="navbar navbar-expand-lg navbar-light">
		<a class="navbar-brand openBtn" id="openBtn">&#9776; MENU</a>
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>
	  	<div class="collapse navbar-collapse" id="navbarNavDropdown">
	    	<ul class="navbar-nav ml-auto">
	      		<li class="nav-item dropdown dropleft">
	        		<a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          			<?php echo "<b id='UserName'>$nombre <i class='fas fa-user-tie'></i></b>"; ?>
	        		</a>
	        		<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	          			<a class="dropdown-item" href="#"><i class="fas fa-info-circle"></i> Ayuda</a>
	          			<div class="dropdown-divider"></div>
	          			<?php if($_SESSION['user']['Tipo'] == "1"){ echo "<a class='dropdown-item' href='javascript:void(0)' id='ConfiguracionUsu'><i class='fas fa-cog'></i> Configuración</a>"; } ?> 
	          			<a class="dropdown-item" href="salir.php"><i class="fas fa-power-off"></i> Cerrar sesión</a>
	        		</div>
	      		</li>
	    	</ul>
	  	</div>
	</nav>

	<div class="main">
		<?php 
			if($_SESSION['user']['Tipo'] == "1"){ 
				require("vistas/usuarios.php"); 
				require("vistas/configuracion.php");
				require("vistas/generales.php"); 
			} 

			if($_SESSION['user']['Tipo'] == "1" || $productos[1]=='1'){ 
				require("vistas/NuevoProducto.php"); 
			}

			if($_SESSION['user']['Tipo'] == "1" || $productos[0]=='1'){ 
				require("vistas/productos1.php"); 
				require("vistas/productos2.php"); 
				require("vistas/productos3.php"); 
			}

			if($_SESSION['user']['Tipo'] == "1" || $clientes[1]=='1'){ 
				require("vistas/NuevoCliente.php"); 
			}

			if ($_SESSION['user']['Tipo']=='1' || $clientes[0]=='1'){
				require("vistas/verClientes.php");
			}

			if($_SESSION['user']['Tipo'] == "1" || $proveedores[1]=='1'){ 
				require("vistas/NuevoProveedor.php"); 
			}

			if ($_SESSION['user']['Tipo']=='1' || $proveedores[0]=='1'){
				require("vistas/verProveedores.php");
			}

			if ($_SESSION['user']['Tipo']=='1' || $empleados[0] =='1') {
				require("vistas/AreasyPuestos.php");
			}

			if($_SESSION['user']['Tipo']=='1' || $empleados[1]=='1'){
	  			require("vistas/NuevoEmpleado.php");
	  		}

	  		if($_SESSION['user']['Tipo']=='1' || $empleados[0]=='1'){
	  			require("vistas/verEmpleados.php");
	  		}

	  		if($_SESSION['user']['Tipo'] == "1" || $compras[1]=='1'){ 
				require("vistas/OrdendeCompra.php"); 
			}

			if($_SESSION['user']['Tipo']=='1' || $compras[0] =='1') {
				require("vistas/verOrdenCompra.php"); 
				require("vistas/compras.php"); 
			}

			if($_SESSION['user']['Tipo']=='1' || $productos[4]=='1'){
				require("vistas/precios.php");
			}

			if($_SESSION['user']['Tipo']=='1' || $entregas[1]=='1'){
				require("vistas/NuevaEntrega.php");
			}

			if($_SESSION['user']['Tipo']=='1' || $entregas[0]=='1'){
				require("vistas/verEntregas.php");
			}

			if($_SESSION['user']['Tipo']=='1' || $ventas[1]=='1'){
				require("vistas/NuevaVenta.php");
			}

			if($_SESSION['user']['Tipo']=='1' || $ventas[0]=='1'){
				require("vistas/verVentas.php");
			}
		?>
	</div>

<script src="../JS/jquery-3.3.1.min.js"></script>
<script src="../JS/bootstrap.min.js"></script>	
<script src="../JS/fontawesome-all.min.js"></script>	
<script src="../JS/jquery.dataTables.min.js"></script>
<script src="../JS/dataTables.bootstrap4.min.js"></script>	
<script src="../JS/dataTables.buttons.min.js"></script>	
<script src="../JS/buttons.flash.min.js"></script>
<script src="../JS/jszip.min.js"></script>
<script src="../JS/pdfmake.min.js"></script>
<script src="../JS/vfs_fonts.js"></script>
<script src="../JS/buttons.html5.min.js"></script>
<script src="../JS/sweetalert2.all.min.js"></script>	
<script src="../JS/menu.js"></script>	
<script src="../JS/usuarios.js"></script>
<script src="../JS/productos.js"></script>	
<script src="../JS/clientes.js"></script>
<script src="../JS/proveedores.js"></script>
<script src="../JS/AreasyPuestos.js"></script>	
<script src="../JS/empleados.js"></script>	
<script src="../JS/OrdenCompra.js"></script>
<script src="../JS/precios.js"></script>	
<script src="../JS/entregas.js"></script>
</body>
</html>