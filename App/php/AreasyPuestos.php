<?php  
	require("../../conexion.php");
	session_start();
	$id = $_SESSION['user']['ID_Usuario'];
	$empleados = array('0','0','0','0');

	if($_SESSION['user']['Tipo']=="2" && ($_POST["metodo"]=="1" || $_POST["metodo"]=="3" || $_POST["metodo"]=="6" || $_POST["metodo"]=="9")){
    	$sql1 = "SELECT * FROM permisos WHERE FK_Usuario = '$id'";

		if($res1=$con->query($sql1)){
			if ($res1->num_rows > 0) {
				$row1 = $res1->fetch_assoc();
				$empleados = explode("*", $row1["Empleados"]);		
			}
		}else{
			echo "Error: ".mysqli_error($con);
		}
    }

    if($_POST['metodo'] == '1'){
    	if($_SESSION['user']['Tipo']=="1" || $empleados[1] == '1'){
    		echo "<form class='row' id='FormArea'>
    			<div class='form-group col-5'>
					<div class='input-group'>
						<div class='input-group-prepend'>
							<span class='input-group-text'>Código</span>
						</div>
						<input type='text' class='form-control intArea' id='codigoArea' maxlength='30' required>
					</div>
				</div>
				<div class='form-group col-5'>
					<div class='input-group'>
						<div class='input-group-prepend'>
							<span class='input-group-text'>Nombre</span>
						</div>
						<input type='text' class='form-control intArea' id='nombreArea' maxlength='60' required>
					</div>
				</div>
				<div class='form-group col-2'>
					<button type='submit' class='btn btn-success btn-block'>Guardar <i class='fas fa-save'></i></button>
				</div>
    		</form>";
    	}	
    }

    if($_POST['metodo'] == '2'){
    	$sql = "INSERT INTO areas VALUES(null,'$_POST[codigo]','$_POST[nombre]','1','0')";

    	if($con->query($sql)){
    		echo "1";
    	}else{
    		echo "Error: ".mysqli_error();
    	}
    }

    if($_POST['metodo'] == '3'){
		$sql = "SELECT * FROM areas WHERE Eliminado = '0'";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){

					if($row['Activo'] == '1'){
						$activo = "<p style='background:#89E97C'>Activa</p>";
					}else{
						$activo = "<p style='background:#FF6767'>Inactiva<p>";
					}
					
					if($empleados[2]=="1" || $_SESSION['user']['Tipo']=="1"){
						$bModificar="<button class='btn btn-warning ModificarAreas' attrID='$row[ID_Area]' data-toggle='modal' data-target='#ModalAreas'><i class='fas fa-pencil-alt'></i></button>";
					}else{
						$bModificar='';
					}	
					if($empleados[3]=="1" || $_SESSION['user']['Tipo']=="1"){
						$bBorrar="<button class='btn btn-danger BorrarAreas' attrID='$row[ID_Area]'><i class='fas fa-trash-alt'></i></button>";
					}else{
						$bBorrar='';
					}

					$arreglo['data'][] = array('Codigo'=> $row['Codigo'],'Nombre'=> $row['Nombre'], 'Activo'=> $activo, 'Botones'=> $bModificar.$bBorrar);	
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
    	$sql = "UPDATE areas SET Eliminado='1' WHERE ID_Area='$_POST[id]'";

    	if($con->query($sql)){
    		echo "1";
    	}else{
    		echo "Error: ".mysqli_error();
    	}
    }

    if($_POST['metodo'] == '5'){
    	$sql = "UPDATE areas SET Codigo= '$_POST[codigo]', Nombre='$_POST[nombre]', Activo='$_POST[activo]' WHERE ID_Area='$_POST[id]'";

    	if($con->query($sql)){
    		echo "1";
    	}else{
    		echo "Error: ".mysqli_error();
    	}
    }

    if($_POST['metodo'] == '6'){
    	if($_SESSION['user']['Tipo']=="1" || $empleados[1] == '1'){
    		echo "<form class='row' id='FormPuesto'>
    			<div class='form-group col-3'>
					<div class='input-group'>
						<div class='input-group-prepend'>
							<span class='input-group-text'>Código</span>
						</div>
						<input type='text' class='form-control intPuesto' id='codigoPuesto' maxlength='60' required>
					</div>
				</div>
				<div class='form-group col-4'>
					<div class='input-group'>
						<div class='input-group-prepend'>
							<span class='input-group-text'>Nombre</span>
						</div>
						<input type='text' class='form-control intPuesto' id='nombrePuesto' maxlength='60' required>
					</div>
				</div>
				<div class='form-group col-3'>
					<select class='form-control intPuesto' id='areaPuesto' required>

					</select>
				</div>
				<div class='form-group col-2'>
					<button type='submit' class='btn btn-success btn-block'>Guardar <i class='fas fa-save'></i></button>
				</div>
    		</form>";
    	}	
    }

    if($_POST['metodo'] == '7'){
		$sql = "SELECT * FROM areas WHERE Eliminado = '0' AND Activo='1'";
		$areas="<option value=''>--Selecciona el área--</option>";
		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){
					$areas .= "<option value='$row[ID_Area]'>$row[Nombre]</option>";
				}
			}
			echo $areas;
		}else{
			echo "Error: ".mysqli_error($con);
		}	
		$con->close();
	}

	if($_POST['metodo'] == '8'){
    	$sql = "INSERT INTO puestos VALUES(null,'$_POST[codigo]','$_POST[nombre]','$_POST[area]','1','0')";

    	if($con->query($sql)){
    		echo "1";
    	}else{
    		echo "Error: ".mysqli_error();
    	}
    }

    if($_POST['metodo'] == '9'){
		$sql = "SELECT ID_Puesto, puestos.Codigo AS Codigo, puestos.Nombre AS Nombre, FK_Area, puestos.Activo AS Activo, areas.Nombre AS Area FROM puestos INNER JOIN areas ON FK_Area=ID_Area WHERE puestos.Eliminado = '0'";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){

					if($row['Activo'] == '1'){
						$activo = "<p style='background:#89E97C'>Activo</p>";
					}else{
						$activo = "<p style='background:#FF6767'>Inactivo<p>";
					}
					
					if($empleados[2]=="1" || $_SESSION['user']['Tipo']=="1"){
						$bModificar="<button class='btn btn-warning ModificarPuestos' attrID='$row[ID_Puesto]' attrArea='$row[FK_Area]' data-toggle='modal' data-target='#ModalPuestos'><i class='fas fa-pencil-alt'></i></button>";
					}else{
						$bModificar='';
					}	
					if($empleados[3]=="1" || $_SESSION['user']['Tipo']=="1"){
						$bBorrar="<button class='btn btn-danger BorrarPuestos' attrID='$row[ID_Puesto]'><i class='fas fa-trash-alt'></i></button>";
					}else{
						$bBorrar='';
					}

					$arreglo['data'][] = array('Codigo'=> $row['Codigo'], 'Nombre'=> $row['Nombre'], 'Area'=> $row['Area'], 'Activo'=> $activo, 'Botones'=> $bModificar.$bBorrar);	
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

	if($_POST['metodo'] == '10'){
    	$sql = "UPDATE puestos SET Eliminado='1' WHERE ID_Puesto='$_POST[id]'";

    	if($con->query($sql)){
    		echo "1";
    	}else{
    		echo "Error: ".mysqli_error();
    	}
    }

    if($_POST['metodo'] == '11'){
    	$sql = "UPDATE puestos SET Codigo='$_POST[codigo]', Nombre='$_POST[nombre]', FK_Area='$_POST[area]', Activo='$_POST[activo]' WHERE ID_Puesto='$_POST[id]'";

    	if($con->query($sql)){
    		echo "1";
    	}else{
    		echo "Error: ".mysqli_error();
    	}
    }
?>