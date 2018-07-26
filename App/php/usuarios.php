<?php  
	require("../../conexion.php");
	session_start();
	$id = $_SESSION['user']['ID_Usuario'];
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

        mail($_POST["email"], 'Nueva cuenta en Sistema Planta de huevo liquido', "Se te ha creado una nueva cuenta con los siguientes datos: Usuario:$_POST[nombre] Contraseña: $_POST[contrasena]");
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
		if(isset($_POST["contrasena"])){
			$contrasena=password_hash($_POST["contrasena"], PASSWORD_BCRYPT, $opciones);
			$sql = "UPDATE usuarios SET Nombre='$_POST[nombre]', Contrasena='$contrasena', Email='$_POST[email]', Tipo='$_POST[tipo]' WHERE ID_Usuario='$_POST[id]'";
		}else{
			$sql = "UPDATE usuarios SET Nombre='$_POST[nombre]', Tipo='$_POST[tipo]' WHERE ID_Usuario='$_POST[id]'";
		}

        if($con->query($sql)){
            echo "1";
        }else{
            echo "Error: ".mysqli_error($con);
        }
	}

	if($_POST["metodo"]=="5"){
		$sql = "UPDATE usuarios SET Nombre='$_POST[nombre]' WHERE ID_Usuario='$id'";

        if($con->query($sql)){
            echo "1";
            $_SESSION['user']['Nombre']=$_POST["nombre"];
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
					$permitir= array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
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
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[1]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[2]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[3]> Eliminar
		                    </label>
		                </td>		                	
						<td attrModulo='Clientes'>
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[4]> Ver
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[5]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[6]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[7]> Eliminar
		                    </label>
						</td>
						<td attrModulo='Ventas'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[8]> Ver
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[9]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[10]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[11]> Eliminar
		                    </label>
						</td>
						<td attrModulo='Proveedores'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[12]> Ver
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[13]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[14]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[15]> Eliminar
		                    </label>
						</td>
						<td attrModulo='Compras'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[16]> Ver
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[17]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[18]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[19]> Eliminar
		                    </label>
						</td>
						<td attrModulo='Empleados'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[20]> Ver
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[21]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[22]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[23]> Eliminar
		                    </label>
						</td>
						<td attrModulo='Entregas'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[24]> Ver
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[25]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[26]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[27]> Eliminar
		                    </label>
						</td>
						<td attrModulo='Produccion'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[28]> Ver
		                    </label>
		                    <label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='2' $permitir[29]> Agregar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='3' $permitir[30]> Modificar
		                    </label>
		                    <label class='check-inline'>
		                      	<input type='checkbox' class='checkPermiso' value='4' $permitir[31]> Eliminar
		                    </label>
						</td>
						<td attrModulo='Reportes'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[32]> Ver
		                    </label>
						</td>
						<td attrModulo='Etiquetas'> 
							<label class='check-inline'>
		                    	<input type='checkbox' class='checkPermiso' value='1' $permitir[33]> Ver
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
?>