<?php  
	include("../../conexion.php");
	session_start();
	$id = $_SESSION['user']['ID_Usuario'];
	$empleados = array('0','0','0','0');

	if($_SESSION['user']['Tipo']=="2" && $_POST["metodo"]=="3"){
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

    if($_POST["metodo"]=='1'){
    	$sql = "SELECT * FROM puestos WHERE FK_Area='$_POST[area]' AND Eliminado='0' AND Activo='1'";
    	$puestos = "<option value=''>--Selecciona el puesto--</option>";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){
					$puestos .= "<option value='$row[ID_Puesto]'>$row[Nombre]</option>";	
				}
				echo $puestos;
			}
		}else{
			echo "Error: ".mysqli_error($con);
		}
    }

    if($_POST["metodo"]=='2'){
    	$sql = "INSERT INTO empleados VALUES(null,'$_POST[codigo]','$_POST[nombre]','$_POST[apPat]','$_POST[apMat]','$_POST[domicilio]', '$_POST[colonia]','$_POST[ciudad]','$_POST[estado]','$_POST[pais]','$_POST[cp]','$_POST[telefono]','$_POST[email]','$_POST[puesto]','$_POST[sdi]','$_POST[alergias]','$_POST[ts]','$_POST[pEmergen]','$_POST[telEmergen]','$_POST[fechaIn]','','','0','0')";
    	
    	if($con->query($sql)){
    		echo "1";
    	}else{
    		echo "Error: ".mysqli_error($con);
    	}
    }

    if($_POST['metodo'] == '3'){
		$sql = "SELECT ID_Empleado, empleados.Codigo AS Codigo, empleados.Nombre AS Nombre, Ap_Pat, Ap_Mat, Domicilio, Colonia, Ciudad, Estado, Pais, CP, Telefono, Email, puestos.Nombre AS Puesto, FK_Puesto, areas.Nombre AS Area, ID_Area, SDI, Alergias, TipoSangre, Emergencia, TelEmergencia, DATE_FORMAT(FechaIngreso, '%d-%m-%Y') AS Fecha_In, FechaIngreso, DATE_FORMAT(FechaBaja, '%d-%m-%Y') AS Fecha_Ba, FechaBaja, DATE_FORMAT(FechaReingreso, '%d-%m-%Y') AS Fecha_Re, FechaReingreso, Estatus FROM Empleados INNER JOIN puestos ON FK_Puesto=ID_Puesto INNER JOIN areas ON FK_Area=ID_Area WHERE empleados.Eliminado = '0' ORDER BY empleados.Codigo";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){

					$estatus="";
					if($row['Estatus'] == '0'){
						$estatus = "<p style='background:#89E97C'>Activo</p>";
					}else if($row['Estatus'] == '1'){
						$estatus = "<p style='background:#FF6767'>Baja<p>";
					}else if($row['Estatus'] == '2'){
						$estatus = "<p style='background:#89E97C'>Reingreso<p>";
					}
					
					if($empleados[2]=="1" || $_SESSION['user']['Tipo']=="1"){
						$bModificar="<button class='btn btn-warning ModificarEmpleado' attrID='$row[ID_Empleado]' data-toggle='modal' data-target='#ModalEmpleados'><i class='fas fa-pencil-alt'></i></button>";
					}else{
						$bModificar='';
					}	
					if($empleados[3]=="1" || $_SESSION['user']['Tipo']=="1"){
						$bBorrar="<button class='btn btn-danger BorrarEmpleado' attrID='$row[ID_Empleado]'><i class='fas fa-trash-alt'></i></button>";
					}else{
						$bBorrar='';
					}

					$arreglo['data'][] = array('Codigo'=> $row['Codigo'], 'Nombre'=> $row['Nombre'], 'ApPat'=> $row['Ap_Pat'], 'ApMat'=> $row['Ap_Mat'], 'Domicilio'=> $row['Domicilio'], 'Colonia'=> $row['Colonia'], 'Ciudad'=> $row['Ciudad'], 'Estado'=> $row['Estado'], 'Pais'=> $row['Pais'], 'CP'=> $row['CP'], 'Telefono'=> $row['Telefono'], 'Email'=> $row['Email'], 'Area'=> "<span hidden>$row[ID_Area]</span><p>$row[Area]</p>", 'Puesto'=> "<span hidden>$row[FK_Puesto]</span><p>$row[Puesto]</p>", 'SDI'=> $row['SDI'], 'Alergias'=> $row['Alergias'], 'TI'=> $row['TipoSangre'], 'Emergencia'=> $row['Emergencia'], 'TelEmergencia'=> $row['TelEmergencia'], 'FechaIn'=> "<span hidden>$row[FechaIngreso]</span><p>$row[Fecha_In]</p>", 'FechaBa'=> "<span hidden>$row[FechaBaja]</span><p>$row[Fecha_Ba]</p>", 'FechaRe'=> "<span hidden>$row[FechaReingreso]</span><p>$row[Fecha_Re]</p>", 'Estatus'=> $estatus, 'Boton1'=> $bModificar, 'Boton2'=> $bBorrar);	
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
		$sql = "UPDATE empleados SET Eliminado='1' WHERE ID_Empleado='$_POST[id]'";

		if($con->query($sql)){
			echo "1";
		}else{
			echo "Error: ".mysqli_error($con);
		}
	}

	if($_POST['metodo'] == '5'){
		$sql = "UPDATE empleados SET Codigo='$_POST[codigo]',Nombre='$_POST[nombre]',Ap_Pat='$_POST[apPat]',Ap_Mat='$_POST[apMat]',Domicilio='$_POST[domicilio]',Colonia='$_POST[colonia]',Ciudad='$_POST[ciudad]',Estado='$_POST[estado]',Pais='$_POST[pais]',CP='$_POST[cp]',Telefono='$_POST[telefono]',Email='$_POST[email]',FK_Puesto='$_POST[puesto]',SDI='$_POST[sdi]',Alergias='$_POST[alergias]',TipoSangre='$_POST[ts]',Emergencia='$_POST[pEmergen]',TelEmergencia='$_POST[telEmergen]',FechaIngreso='$_POST[fechaIn]',FechaBaja='$_POST[fechaBa]',FechaReingreso='$_POST[fechaRe]',Estatus='$_POST[activo]' WHERE ID_Empleado='$_POST[id]'";

		if($con->query($sql)){
			echo "1";
		}else{
			echo "Error: ".mysqli_error($con);
		}	
	}
?>