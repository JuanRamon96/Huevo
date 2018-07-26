<?php  
	require("../../conexion.php");

	if($_POST['metodo'] == '1'){
		$sql = "INSERT INTO productos VALUES(null,'$_POST[nombre]','$_POST[ume]','$_POST[categoria]','$_POST[existencia]','$_POST[maximo]','$_POST[minimo]','1')";

		if($con->query($sql)){
			echo "1";
		}else{
			echo "Error: ".mysqli_error($con);
		}
	}

	if($_POST['metodo'] == '2'){
		$sql = "SELECT * FROM productos WHERE Categoria='Producto Terminado'";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){
					
					/*if($precios[2]=="1" || $_SESSION['user']['Tipo']=="1"){
						$bModificar="<button class='btn btn-warning ModificarPrecio' attrID='$row[ID_Tratamiento]' data-toggle='modal' data-target='#ModalTratamiento'><i class='fas fa-pencil-alt'></i></button>";
					}else{
						$bModificar='';
					}	
					if($precios[3]=="1" || $_SESSION['user']['Tipo']=="1"){
						$bBorrar="<button class='btn btn-danger borrarPrecio' attrID='$row[ID_Tratamiento]'><i class='fas fa-trash-alt'></i></button>";
					}else{
						$bBorrar='';
					}*/

					//$arreglo['data'][] = array('Nombre'=> $row['Nombre'], 'UME'=> $row['UME'], 'Categoria'=> $bModificar.$bBorrar);

					$arreglo['data'][] = array('Nombre'=> $row['Nombre'], 'UME'=> $row['UME'], 'Existencia'=> $row['Existencia'], 'Max'=> $row['Max'], 'Min'=> $row['Min']);	
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
?>