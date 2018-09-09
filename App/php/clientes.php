<?php  
	require("../../conexion.php");
	session_start();
	$id = $_SESSION['user']['ID_Usuario'];
	$clientes = array('0','0','0','0');

	if($_SESSION['user']['Tipo']=="2" && $_POST["metodo"]=="2"){
    	$sql1 = "SELECT * FROM permisos WHERE FK_Usuario = '$id'";

		if($res1=$con->query($sql1)){
			if ($res1->num_rows > 0) {
				$row1 = $res1->fetch_assoc();
				$clientes = explode("*", $row1["Clientes"]);		
			}
		}else{
			echo "Error: ".mysqli_error($con);
		}
    }

	if($_POST['metodo'] == '1'){
		$sql = "INSERT INTO clientes VALUES(null,'$_POST[codigo]','$_POST[nombre]','$_POST[domicilio]','$_POST[ciudad]','$_POST[estado]','$_POST[pais]','$_POST[cp]','$_POST[rz]','$_POST[rfc]','$_POST[telefono]','$_POST[email]','$_POST[contacto]','$_POST[telconta]','1','0')";

		if($con->query($sql)){
			echo "1";
		}else{
			echo "Error: ".mysqli_error($con);
		}
	}

	if($_POST['metodo'] == '2'){
		$sql = "SELECT * FROM clientes WHERE Eliminado = '0' ORDER BY Codigo";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){

					if($row['Activo'] == '1'){
						$activo = "<p style='background:#89E97C'>Activo</p>";
					}else{
						$activo = "<p style='background:#FF6767'>Inactivo<p>";
					}
					
					if($clientes[2]=="1" || $_SESSION['user']['Tipo']=="1"){
						$bModificar="<button class='btn btn-warning ModificarCliente' attrID='$row[ID_Cliente]' data-toggle='modal' data-target='#ModalClientes'><i class='fas fa-pencil-alt'></i></button>";
					}else{
						$bModificar='';
					}	
					if($clientes[3]=="1" || $_SESSION['user']['Tipo']=="1"){
						$bBorrar="<button class='btn btn-danger BorrarCliente' attrID='$row[ID_Cliente]'><i class='fas fa-trash-alt'></i></button>";
					}else{
						$bBorrar='';
					}

					$arreglo['data'][] = array('Codigo'=> $row['Codigo'], 'Nombre'=> $row['Nombre'], 'Domicilio'=> $row['Domicilio'], 'Ciudad'=> $row['Ciudad'], 'Estado'=> $row['Estado'], 'Pais'=> $row['Pais'], 'CP'=> $row['CP'], 'RazonSocial'=> $row['RazonSocial'], 'RFC'=> $row['RFC'], 'Telefono'=> $row['Telefono'], 'Email'=> $row['Email'], 'Contacto'=> $row['Contacto'], 'TelContacto'=> $row['TelContacto'], 'Activo'=> $activo, 'Botones1'=> $bModificar, 'Botones2'=> $bBorrar);	
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
		$sql = "UPDATE clientes SET Eliminado='1' WHERE ID_Cliente='$_POST[id]'";

		if($con->query($sql)){
			echo "1";
		}else{
			echo "Error: ".mysqli_error($con);
		}
	}

	if($_POST['metodo'] == '4'){
		$sql = "UPDATE clientes SET Codigo='$_POST[codigo]', Nombre='$_POST[nombre]', Domicilio='$_POST[domicilio]', Ciudad='$_POST[ciudad]', Estado='$_POST[estado]', Pais='$_POST[pais]', CP='$_POST[cp]', RazonSocial='$_POST[rz]', RFC='$_POST[rfc]', Telefono='$_POST[telefono]', Email='$_POST[email]', Contacto='$_POST[contacto]', TelContacto='$_POST[telconta]', Activo='$_POST[activo]' WHERE ID_Cliente='$_POST[id]'";

		if($con->query($sql)){
			echo "1";
		}else{
			echo "Error: ".mysqli_error($con);
		}
	}
?>