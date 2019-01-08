<?php  
	require("../../conexion.php");
	session_start();
	$id = $_SESSION['user']['ID_Usuario'];
	$produccion = array('0','0','0','0');

	if($_POST['metodo'] == '1'){
		$sql = "SELECT * FROM productos WHERE Categoria='Materia Prima' AND Eliminado = '0' ORDER BY Nombre";

		if($res=$con->query($sql)){
			$productos = "<option value=''>--Selecciona un producto--</option>";
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){
					$productos .= "<option value='$row[ID_Producto]' attrCodigo='$row[Codigo]' attrUME='$row[UME]'>$row[Nombre]</option>";
				}
			}
			echo $productos;
		}else{
			echo "Error: ".mysqli_error($con);
		}	
		$con->close();
	}

	if($_POST['metodo'] == '2'){
		$sql = "INSERT INTO produccion1 VALUES(null,'$_POST[producto]','$_POST[cantidad]',NOW())";

		if($con->query($sql)){
			echo "Correcto";
		}else{
			echo "Error: ".mysqli_error($con);
		}
	}

	if($_POST['metodo'] == '3'){
		$sql = "SELECT ID_Pro1, Nombre, Codigo, UME, Cantidad, DATE_FORMAT(Fecha, '%d-%m-%Y %h:%i %p') AS Fecha FROM produccion1 INNER JOIN productos ON FK_Producto=ID_Producto";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){

					$arreglo['data'][] = array('Codigo'=> $row['Codigo'], 'Nombre'=> $row['Nombre'], 'Cantidad'=> $row['Cantidad'], 'Fecha'=> $row['Fecha'], 'UME'=> $row['UME'], 'Boton'=> "<button type='button' class='btn btn-danger borrarEMP' attrID='$row[ID_Pro1]'><i class='fas fa-trash-alt'></i></button>");	
				}
				echo json_encode($arreglo);
			}else{
				echo "No se encontraron resultados";
			}
		}else{
			echo "Error: ".mysqli_error($con);
		}	
		$con->close();
	}

	if($_POST['metodo'] == '4'){
		$sql = "DELETE FROM produccion1 WHERE ID_Pro1='$_POST[id]'";

		if($con->query($sql)){
			echo "Correcto";
		}else{
			echo "Error: ".mysqli_error($con);
		}
	}
?>