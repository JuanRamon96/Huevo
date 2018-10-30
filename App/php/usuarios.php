<?php  
	require("../../conexion.php");
	session_start();
	$id = $_SESSION['user']['ID_Usuario'];
	$acCorreo = $_SESSION['user']['Email'];
	$opciones = [
			'cost' => 12,
		];

	if($_POST["metodo"]=="1"){
		$contrasena=password_hash($_POST["contrasena"], PASSWORD_BCRYPT, $opciones);

		$sql = "INSERT INTO usuarios VALUES(null,'$_POST[nombre]','$contrasena','$_POST[email]','$_POST[tipo]')";

        if($con->query($sql)){
            echo "1";
        }else{
            echo "Error: ".mysqli_error($con);
        }

        email($_POST["email"], 'Nueva cuenta en Sistema Planta de huevo liquido', "Se te ha creado una nueva cuenta con los siguientes datos: Usuario-> $_POST[nombre] Contraseña-> $_POST[contrasena]");
	}

	if($_POST["metodo"]=="2"){
		$sql = "SELECT * FROM usuarios WHERE ID_Usuario != '$id'";
		
		if($res=$con->query($sql)){
		    if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()) {
					if($row["Tipo"]=="1"){
						$tipo="Administrador";
					}else{
						$tipo="Normal";
					}
					echo "<tr><td>$row[Nombre]</td><td>$tipo</td><td>$row[Email]</td><td><button class='EditarUsuario btn btn-warning' attrID='$row[ID_Usuario]' data-toggle='modal' data-target='#ModalUsuario'><i class='fas fa-pencil-alt'></i></button><button class='BorrarUsuario btn btn-danger' attrID='$row[ID_Usuario]'><i class='fas fa-trash-alt'></i></button></td></tr>";
				}
			} else {
				echo "No se encontraron resultados";
			}
		}else{
		    echo "Error: ".mysqli_error($con);
		}
		$con->close();
	}

	if($_POST["metodo"]=="3"){
		$sql = "DELETE FROM usuarios WHERE ID_Usuario='$_POST[id]'";

        if($con->query($sql)){
            echo "1";
        }else{
            echo "Error: ".mysqli_error($con);
        }
	}

	if($_POST["metodo"]=="4"){
		if(isset($_POST["contrasena"]) && $_POST["contrasena"] != ""){
			$contrasena=password_hash($_POST["contrasena"], PASSWORD_BCRYPT, $opciones);
			$sql = "UPDATE usuarios SET Nombre='$_POST[nombre]', Contrasena='$contrasena', Email='$_POST[email]', Tipo='$_POST[tipo]' WHERE ID_Usuario='$_POST[id]'";
		}else{
			$sql = "UPDATE usuarios SET Nombre='$_POST[nombre]', Tipo='$_POST[tipo]' WHERE ID_Usuario='$_POST[id]'";
		}

        if($con->query($sql)){
            echo "1";
             email($_POST["email"], 'Sistema Planta de huevo liquido', "Se han modificado tus datos de tu cuenta, para ver las modificaciones accede a tu cuenta: Usuario-> $_POST[nombre] Contraseña-> $_POST[contrasena]");
        }else{
            echo "Error: ".mysqli_error($con);
        }
	}

	if($_POST["metodo"]=="5"){
		$sql = "UPDATE usuarios SET Nombre='$_POST[nombre]' WHERE ID_Usuario='$id'";

        if($con->query($sql)){
            echo "1";
            $_SESSION['user']['Nombre']=$_POST["nombre"];
            email($acCorreo, 'Sistema Planta de huevo liquido', "Has modificado tu nombre de usuario en tu cuenta: Usuario-> $_POST[nombre]");
        }else{
            echo "Error: ".mysqli_error($con);
        }
	}

	if($_POST["metodo"]=="6"){
		if(password_verify($_POST["contraA"], $_SESSION['user']['Contrasena'])) {
			$contrasena=password_hash($_POST["contraN"], PASSWORD_BCRYPT, $opciones);

			$sql = "UPDATE usuarios SET Contrasena='$contrasena' WHERE ID_Usuario='$id'";

	        if($con->query($sql)){
	            echo "1";
	            $_SESSION['user']['Contrasena']=$contrasena;
	            email($acCorreo, 'Sistema Planta de huevo liquido', "Has modificado tu Contraseña en tu cuenta: Contraseña-> $_POST[contraN]");
	        }else{
	            echo "Error: ".mysqli_error($con);
	        }	
		}else{
			echo "2";
		}
	}

	if($_POST["metodo"]=="7"){
		$sql = "SELECT * FROM usuarios WHERE ID_Usuario != '$id' AND Tipo='2'";
		
		if($res=$con->query($sql)){
		    if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()) {
					$permitir= array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
					$sql1 = "SELECT * FROM permisos WHERE FK_Usuario = '$row[ID_Usuario]'";
					
					if($res1=$con->query($sql1)){
					    if ($res1->num_rows > 0) {
							$row1 = $res1->fetch_assoc();
							
							$separa=explode("*", $row1["Productos"].$row1["Clientes"].$row1["Ventas"].$row1["Proveedores"].$row1["Compras"].$row1["Empleados"].$row1["Entregas"].$row1["Produccion"].$row1["Reportes"].$row1["Etiquetas"]);

							for ($i=0; $i < sizeof($separa); $i++) { 
								if($separa[$i]=="1"){
									$permitir[$i]="checked";
								}else{
									$permitir[$i]="";
								}
							}	
						}
						echo "hola";
					}else{
					    echo "Error: ".mysqli_error($con);
					}

					echo "<tr>
						<td attrID=$row[ID_Usuario]>$row[Nombre]</td>
						<td attrModulo='Productos'>
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[0]> Ver
		                    </label><br>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[1]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[2]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[3]> Eliminar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='5' $permitir[4]> Ver Precios
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='6' $permitir[5]> Modificar Precios
		                    </label>
		                </td>		                	
						<td attrModulo='Clientes'>
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[6]> Ver
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[7]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[8]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[9]> Eliminar
		                    </label>
						</td>
						<td attrModulo='Ventas'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[10]> Ver
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[11]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[12]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[13]> Eliminar
		                    </label>
						</td>
						<td attrModulo='Proveedores'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[14]> Ver
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[15]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[16]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[17]> Eliminar
		                    </label>
						</td>
						<td attrModulo='Compras'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[18]> Ver
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[19]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[20]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[21]> Eliminar
		                    </label>
						</td>
						<td attrModulo='Empleados'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[22]> Ver
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[23]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[24]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[25]> Eliminar
		                    </label>
						</td>
						<td attrModulo='Entregas'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[26]> Ver
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[27]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[28]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[29]> Eliminar
		                    </label>
						</td>
						<td attrModulo='Produccion'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[30]> Ver
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[31]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[32]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[33]> Eliminar
		                    </label>
						</td>
						<td attrModulo='Reportes'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[34]> Ver
		                    </label>
						</td>
						<td attrModulo='Etiquetas'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[36]> Ver
		                    </label>
						</td>
					</tr>";
				}
			} else {
				echo "No se encontraron resultados";
			}
		}else{
		    echo "Error: ".mysqli_error($con);
		}
		$con->close();
	}

	if($_POST["metodo"]=="8"){
		$sql = "UPDATE permisos SET $_POST[columna]='$_POST[permiso]' WHERE FK_Usuario='$_POST[id]'";

	    if($con->query($sql)){
	        echo "1";
	    }else{
	        echo "Error: ".mysqli_error($con);
	    }	
	}
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>email>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	function email($destino, $asunto, $mensaje)
	{
		require("PHPMailer/PHPMailerAutoload.php");

		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
		    //Server settings
		    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'sistemahuevoliquido@gmail.com';                 // SMTP username
		    $mail->Password = 'Gigantes.2018';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('sistemahuevoliquido@gmail.com', 'Sistema Huevo Liquido');
		    $mail->addAddress($destino);     // Add a recipient

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $asunto;
		    $mail->Body    = $mensaje;
		    $mail->AltBody = $mensaje;

		    $mail->send();
		    //echo 'Message has been sent';
		} catch (Exception $e) {
		    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}
?>