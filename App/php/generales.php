<?php  
	require("../../conexion.php");

	if(isset($_POST["metodo"])){
		$sql = "SELECT * FROM generales WHERE ID_General='1'";
		
		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				$row = $res->fetch_assoc();
				
				echo "$row[Dentista]*$row[Nombre]*$row[Domicilio]*$row[Colonia]*$row[Ciudad]*$row[Estado]*$row[CP]*$row[Telefono]*$row[Email]";
			} else {
				echo "No se encontraron resultados";
			}
		}else{
		    echo "Error: ".mysqli_error($con);
		}
		$con->close();	
	}else{
		$sql = "UPDATE generales SET Dentista='$_POST[GDentista]', Nombre='$_POST[GClinica]', Domicilio='$_POST[GDomicilio]', Colonia='$_POST[GColonia]', Ciudad='$_POST[GCiudad]', Estado='$_POST[GEstado]', CP='$_POST[GCP]', Telefono='$_POST[GTelefono]', Email='$_POST[GEmail]' WHERE ID_General='1'";

        if($con->query($sql)){
            echo "1";
        }else{
            echo "Error: ".mysqli_error($con);
        }
	}	
?>