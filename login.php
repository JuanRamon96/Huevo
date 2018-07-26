<?php  
	require("conexion.php");
	session_start();

	if(isset($_POST)){
		$usuario = $con->real_escape_string($_POST['Usuario']);
		$contrasena = $con->real_escape_string($_POST['Contrasena']);
		
		$sql = "SELECT * FROM usuarios WHERE Nombre='$usuario'";

		if($res=$con->query($sql)){
		    if ($res->num_rows > 0) {
				$row = $res->fetch_assoc();
				if(password_verify($contrasena, $row['Contrasena'])) {
					$_SESSION['user'] = $row;
				   	echo "1";
				}else{
				  	echo "0";
				}	
			}else {
				echo "0";
			}
		}else{
		    echo "Error: ".mysqli_error($con);
		}
		$con->close();
	}	
?>