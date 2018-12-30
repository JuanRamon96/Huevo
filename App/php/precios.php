<?php  
	require("../../conexion.php");
	session_start();
	$id = $_SESSION['user']['ID_Usuario'];
	$precios = array('0','0','0','0','0','0');

	if($_SESSION['user']['Tipo']=="2" && $_POST["metodo"]=="1"){
    	$sql1 = "SELECT * FROM permisos WHERE FK_Usuario = '$id'";

		if($res1=$con->query($sql1)){
			if ($res1->num_rows > 0) {
				$row1 = $res1->fetch_assoc();
				$precios = explode("*", $row1["Productos"]);		
			}
		}else{
			echo "Error: ".mysqli_error($con);
		}
    }

    if($_POST['metodo'] == '1'){
		$sql = "SELECT ID_Precio, Costo_Actual, ROUND(Costo_Promedio, 2) AS CostoP, Precio1, Precio2, Codigo, Nombre FROM precios INNER JOIN productos ON FK_Producto=ID_Producto AND Eliminado='0'";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){

					if($precios[5]=="1" || $_SESSION['user']['Tipo']=="1"){
						$bModificar="<button class='btn btn-warning ModificarPrecio' attrID='$row[ID_Precio]' data-toggle='modal' data-target='#ModalMPrecios'><i class='fas fa-pencil-alt'></i></button>";
					}else{
						$bModificar='';
					}	

					$arreglo['data'][] = array('Codigo'=> $row['Codigo'], 'Nombre'=> $row['Nombre'], 'CostoA'=> $row['Costo_Actual'], 'CostoP'=> $row['CostoP'], 'Precio1'=> $row['Precio1'], 'Precio2'=> $row['Precio2'], 'Boton'=> $bModificar);	
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

	if($_POST['metodo'] == '2'){
		$sql="UPDATE precios SET Costo_Actual='$_POST[costoA]', Costo_Promedio='$_POST[costoP]', Precio1='$_POST[precio1]', Precio2='$_POST[precio2]' WHERE ID_Precio='$_POST[id]'";

		if($con->query($sql)){
			echo "Correcto";
		}else{
			echo "Error: ".mysqli_error($con);
		}
	}
?>