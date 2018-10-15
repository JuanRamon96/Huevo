<?php  
	require("../../conexion.php");

	if($_POST["metodo"] == '1'){
		$sql = "SELECT * FROM generales WHERE ID_General='1'";
		
		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				$row = $res->fetch_assoc();
				
				echo "$row[Nombre]*$row[Domicilio]*$row[Colonia]*$row[Ciudad]*$row[Estado]*$row[Pais]*$row[CP]*$row[RazonSocial]*$row[RFC]*$row[Telefono]*$row[Email]";
			} else {
				echo "No se encontraron resultados";
			}
		}else{
		    echo "Error: ".mysqli_error($con);
		}
		$con->close();	
	}
	if($_POST["metodo"] == '2'){
		$sql = "UPDATE generales SET Nombre='$_POST[nombre]', Domicilio='$_POST[domicilio]', Colonia='$_POST[colonia]', Ciudad='$_POST[ciudad]', Estado='$_POST[estado]', Pais='$_POST[pais]', CP='$_POST[CP]', RazonSocial='$_POST[RZ]', RFC='$_POST[RFC]', Telefono='$_POST[telefono]', Email='$_POST[email]' WHERE ID_General='1'";

        if($con->query($sql)){
            echo "1";
        }else{
            echo "Error: ".mysqli_error($con);
        }
	}	
?>