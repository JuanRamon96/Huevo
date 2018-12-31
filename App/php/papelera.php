<?php  
	require("../../conexion.php");
	session_start();
	$id = $_SESSION['user']['ID_Usuario'];


	if($_POST['metodo'] == '1'){
		$sql = "SELECT * FROM productos WHERE Eliminado = '1' ORDER BY Codigo";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){
					echo "<tr>
						<td>$row[Codigo]</td>
						<td>$row[Nombre]</td>
						<td>$row[UME]</td>
						<td>$row[Existencia]</td>
						<td>$row[Min]</td>
						<td>$row[Max]</td>
						<td>$row[IVA]</td>
						<td>$row[Categoria]</td>
						<td><button type='button' class='btn btn-info restaurar' attrID='$row[ID_Producto]'><i class='fas fa-redo'></i></button></td>
						<td><button type='button' class='btn btn-danger eliminar' attrID='$row[ID_Producto]'><i class='fas fa-trash-alt'></i></button></td>
					</tr>";
				}	
			}else{
				echo "No se encontraron resultados";
			}
		}else{
			echo "Error: ".mysqli_error($con);
		}	
		$con->close();
	}

	if($_POST['metodo'] == '2'){
		$sql="UPDATE $_POST[tabla] SET $_POST[tipo]='0' WHERE $_POST[campo]='$_POST[id]'";

		if ($con->query($sql)) {
			echo "Correcto*$_POST[tabla]";
		} else {
			echo "Error: ".mysqli_error($con);
		}
	}

	if($_POST['metodo'] == '3'){
		$sql="DELETE FROM $_POST[tabla] WHERE $_POST[campo]='$_POST[id]'";

		if ($con->query($sql)) {
			echo "Correcto*$_POST[tabla]";
		} else {
			echo "Error: ".mysqli_error($con);
		}
	}

	if($_POST['metodo'] == '4'){
		$sql = "SELECT * FROM clientes WHERE Eliminado = '1' ORDER BY Codigo";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){
					echo "<tr>
						<td>$row[Codigo]</td>
						<td>$row[Nombre]</td>
						<td>$row[Domicilio]</td>
						<td>$row[Colonia]</td>
						<td>$row[Ciudad]</td>
						<td>$row[Estado]</td>
						<td>$row[Pais]</td>
						<td>$row[CP]</td>
						<td>$row[RazonSocial]</td>
						<td>$row[RFC]</td>
						<td>$row[Telefono]</td>
						<td>$row[Email]</td>
						<td>$row[Contacto]</td>
						<td>$row[TelContacto]</td>
						<td><button type='button' class='btn btn-info restaurar' attrID='$row[ID_Cliente]'><i class='fas fa-redo'></i></button></td>
						<td><button type='button' class='btn btn-danger eliminar' attrID='$row[ID_Cliente]'><i class='fas fa-trash-alt'></i></button></td>
					</tr>";
				}	
			}else{
				echo "No se encontraron resultados";
			}
		}else{
			echo "Error: ".mysqli_error($con);
		}	
		$con->close();
	}

	if($_POST['metodo'] == '5'){
		$sql = "SELECT * FROM proveedores WHERE Eliminado = '1' ORDER BY Codigo";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){
					echo "<tr>
						<td>$row[Codigo]</td>
						<td>$row[Nombre]</td>
						<td>$row[Domicilio]</td>
						<td>$row[Colonia]</td>
						<td>$row[Ciudad]</td>
						<td>$row[Estado]</td>
						<td>$row[Pais]</td>
						<td>$row[CP]</td>
						<td>$row[RazonSocial]</td>
						<td>$row[RFC]</td>
						<td>$row[Telefono]</td>
						<td>$row[Email]</td>
						<td>$row[Contacto]</td>
						<td>$row[TelContacto]</td>
						<td><button type='button' class='btn btn-info restaurar' attrID='$row[ID_Proveedor]'><i class='fas fa-redo'></i></button></td>
						<td><button type='button' class='btn btn-danger eliminar' attrID='$row[ID_Proveedor]'><i class='fas fa-trash-alt'></i></button></td>
					</tr>";
				}	
			}else{
				echo "No se encontraron resultados";
			}
		}else{
			echo "Error: ".mysqli_error($con);
		}	
		$con->close();
	}
?>