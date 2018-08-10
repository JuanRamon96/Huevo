<?php  
	require("../../conexion.php");
	session_start();
	$id = $_SESSION['user']['ID_Usuario'];
	$productos = array('0','0','0','0');

	if($_SESSION['user']['Tipo']=="2" && $_POST["metodo"]=="2"){
    	$sql1 = "SELECT * FROM permisos WHERE FK_Usuario = '$id'";

		if($res1=$con->query($sql1)){
			if ($res1->num_rows > 0) {
				$row1 = $res1->fetch_assoc();
				$productos = explode("*", $row1["Productos"]);		
			}
		}else{
			echo "Error: ".mysqli_error($con);
		}
    }

	if($_POST['metodo'] == '1'){
		$sql = "INSERT INTO productos VALUES(null, '$_POST[codigo]','$_POST[nombre]','$_POST[ume]','$_POST[categoria]','$_POST[existencia]','$_POST[maximo]','$_POST[minimo]','1','0')";

		if($con->query($sql)){
			echo "1";
		}else{
			echo "Error: ".mysqli_error($con);
		}
	}

	if($_POST['metodo'] == '2'){
		$sql = "SELECT * FROM productos WHERE Categoria='$_POST[categoria]' AND Eliminado = '0' ORDER BY Nombre";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){

					if($row['Activo'] == '1'){
						$activo = "<p style='background:#89E97C'>Activo</p>";
					}else{
						$activo = "<p style='background:#FF6767'>Inactivo<p>";
					}
					
					if($productos[2]=="1" || $_SESSION['user']['Tipo']=="1"){
						$bModificar="<button class='btn btn-warning ModificarProducto' attrID='$row[ID_Producto]' data-toggle='modal' data-target='#ModalProductos'><i class='fas fa-pencil-alt'></i></button>";
					}else{
						$bModificar='';
					}	
					if($productos[3]=="1" || $_SESSION['user']['Tipo']=="1"){
						$bBorrar="<button class='btn btn-danger BorrarProducto' attrID='$row[ID_Producto]'><i class='fas fa-trash-alt'></i></button>";
					}else{
						$bBorrar='';
					}

					$arreglo['data'][] = array('Codigo'=> $row['Codigo'], 'Nombre'=> $row['Nombre'], 'UME'=> $row['UME'], 'Existencia'=> $row['Existencia'], 'Max'=> $row['Max'], 'Min'=> $row['Min'], 'Activo'=> $activo, 'Botones'=> $bModificar.$bBorrar);	
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

	if($_POST['metodo'] == '3'){
		$sql = "UPDATE productos SET Eliminado='1' WHERE ID_Producto='$_POST[id]'";

		if($con->query($sql)){
			echo "1";
		}else{
			echo "Error: ".mysqli_error($con);
		}
	}

	if($_POST['metodo'] == '4'){
		$sql = "UPDATE productos SET Codigo='$_POST[codigo]', Nombre='$_POST[nombre]',UME='$_POST[ume]',Existencia='$_POST[existencia]',Max='$_POST[maximo]',Min='$_POST[minimo]',Activo='$_POST[activo]' WHERE ID_Producto='$_POST[id]'";

		if($con->query($sql)){
			echo "1";
		}else{
			echo "Error: ".mysqli_error($con);
		}
	}
?>