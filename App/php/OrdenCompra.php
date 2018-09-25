<?php  
	require("../../conexion.php");
	session_start();
	$id = $_SESSION['user']['ID_Usuario'];
	$compras = array('0','0','0','0');

	if($_SESSION['user']['Tipo']=="2" && $_POST["metodo"]=="1"){
    	$sql1 = "SELECT * FROM permisos WHERE FK_Usuario = '$id'";

		if($res1=$con->query($sql1)){
			if ($res1->num_rows > 0) {
				$row1 = $res1->fetch_assoc();
				$compras = explode("*", $row1["Compras"]);		
			}
		}else{
			echo "Error: ".mysqli_error($con);
		}
    }

    if($_POST['metodo']=='1'){
    	$sql = "SELECT * FROM folios WHERE Tipo='1'";

    	if($compras[1] == '1' || $_SESSION['user']['Tipo']=="1"){
    		$nuevo="<div class='row'>
				<div class='col-3 offset-9'>
					<button type='button' class='btn btn-success btn-block' id='agregarFolio' data-toggle='modal' data-target='#ModalAgregarFolio'>Agregar Folio <i class='fas fa-plus'></i></button>
				</div>
    		</div><br>";
    	}else{
    		$nuevo="";
    	}

    	$filas="";
    	if($res=$con->query($sql)){
    		if($res->num_rows > 0){
    			while($row = $res->fetch_assoc()){

    				if($compras[2] == '1' || $_SESSION['user']['Tipo']=="1"){
    					$boton1="<button type='button' class='btn btn-warning ModificarOrdenFolio' attrID='$row[ID_Folio]' data-toggle='modal' data-target='#ModalModificarFolio'><i class='fas fa-pencil-alt'></i></button>";
	    			}else{
	    				$boton1="";
	    			}

	    			if($compras[3] == '1' || $_SESSION['user']['Tipo']=="1"){
	    				$boton2="<button type='button' class='btn btn-danger BorrarOrdenFolio' attrID='$row[ID_Folio]'><i class='fas fa-trash-alt'></i></button>";
	    			}else{
	    				$boton2="";
	    			}

    				$filas .= "<tr>
						<td>$row[Serie]</td>
						<td>$row[Nombre]</td>
						<td><button type='button' class='btn btn-outline-info seleccionarFolio'>Seleccionar</button></td>
						<td>$boton1$boton2</td>
    				</tr>";
    			}
    		}else{
    			$filas = "No se encontraron resultados";
    		}

    		echo "$nuevo
    		<div class='row'>
    			<div class='col-12 table-responsive'>
    				<table class='table table-hover table-stripped table-sm' id='tablaOrdenFolios'>
    					<thead>
    						<tr>
    							<th>Serie</th>
    							<th>Nombre</th>
    							<th></th>
    							<th></th>
    						</tr>
    					</thead>
    					<tbody>
							$filas
    					</tbody>
    				</table>
    			</div>
    		</div>";	
    	}else{
    		echo "Error: ".mysqli_error($con);
    	}
    }

    if($_POST['metodo']=='2'){
     	$sql = "INSERT INTO folios VALUES(null,'$_POST[nombre]','$_POST[serie]','1')";

     	if($con->query($sql)){
     		echo "1";
     	}else{
     		echo "Error: ".mysqli_error();
     	}
    }

    if($_POST['metodo']=='3'){
     	$sql = "DELETE FROM folios WHERE ID_Folio='$_POST[id]'";

     	if($con->query($sql)){
     		echo "1";
     	}else{
     		echo "Error: ".mysqli_error();
     	}
    }

    if($_POST['metodo']=='4'){
     	$sql = "UPDATE folios SET Serie='$_POST[serie]', Nombre='$_POST[nombre]' WHERE ID_Folio='$_POST[id]'";

     	if($con->query($sql)){
     		echo "1";
     	}else{
     		echo "Error: ".mysqli_error();
     	}
    }

    if($_POST['metodo']=='5'){
    	$numero = strlen($_POST['folio']);
        $sql = "SELECT SUBSTR(MAX(Folio) FROM $numero+1) AS Numero FROM orden_compra WHERE SUBSTR(Folio,1,$numero)='$_POST[folio]'";

        if($res=$con->query($sql)){
            if ($res->num_rows > 0) {
                $row = $res->fetch_assoc();
                echo $row['Numero'];     
            }
        }else{
            echo "Error: ".mysqli_error($con);
        }
	}

     if($_POST['metodo']=='6'){
        $sql = "SELECT * FROM proveedores WHERE Activo='1' AND Eliminado='0'";

        $filas="";
        if($res=$con->query($sql)){
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    $filas .= "<tr>
                        <td>$row[Codigo]</td>
                        <td>$row[Nombre]</td>
                        <td><button type='button' class='btn btn-outline-info seleccionarProveedor' attrID='$row[ID_Proveedor]'>Seleccionar</button></td>
                    </tr>";
                }
            }else{
                $filas = "No se encontraron resultados";
            }

            echo "<div class='row'>
                <div class='col-12 table-responsive'>
                    <table class='table table-hover table-stripped table-sm' id='tablaOrdenProveedores'>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            $filas
                        </tbody>
                    </table>
                </div>
            </div>";    
        }else{
            echo "Error: ".mysqli_error($con);
        }
    }

    if($_POST['metodo']=='7'){
        $sql = "SELECT * FROM proveedores WHERE ID_Proveedor='$_POST[id]' AND Activo='1' AND Eliminado='0'";

        $filas="";
        if($res=$con->query($sql)){
            if($res->num_rows > 0){
                $row = $res->fetch_assoc();
                echo "<div style='font-size:13px; padding:10px 0px;'>
                <p>Código: $row[Codigo]</p>
                <p>Nombre: $row[Nombre]</p>
                <p>Domicilio: $row[Domicilio]</p>
                <p>Ciudad: $row[Ciudad]</p>
                <p>Estado: $row[Estado]</p>
                <p>País: $row[Pais]</p>
                <p>Código Postal: $row[CP]</p>
                <p>Razón social: $row[RazonSocial]</p>
                <p>RFC: $row[RFC]</p>
                <p>Teléfono: $row[Telefono]</p>
                <p>Email: $row[Email]</p>
                <p>Contacto: $row[Contacto]</p>
                <p>Contacto Teléfono: $row[TelContacto]</p></div>";
            }else{
                $echo = "No se encontraron resultados";
            }
        }else{
            echo "Error: ".mysqli_error($con);
        }
    }

    if($_POST['metodo']=='8'){
        $sql = "SELECT * FROM productos WHERE Activo='1' AND Categoria!='Producto Terminado' AND Eliminado='0'";

        $filas="";
        if($res=$con->query($sql)){
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    $filas .= "<tr>
                        <td>$row[Codigo]</td>
                        <td>$row[Nombre]</td>
                        <td>$row[UME]</td>
                        <td>$row[Categoria]</td>
                        <td><button type='button' class='btn btn-outline-info seleccionarProducto' attrID='$row[ID_Producto]'>Seleccionar</button></td>
                    </tr>";
                }
            }else{
                $filas = "No se encontraron resultados";
            }

            echo "<div class='row'>
                <div class='col-12 table-responsive'>
                    <table class='table table-hover table-stripped table-sm' id='tablaOrdenProductos'>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>UME</th>
                                <th>Categoría</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            $filas
                        </tbody>
                    </table>
                </div>
            </div>";    
        }else{
            echo "Error: ".mysqli_error($con);
        }
    }

    if($_POST['metodo']=='9'){
        $compro=0;
        $numero = strlen($_POST['folio']);
        $sql = "SELECT SUBSTR(MAX(Folio) FROM $numero+1) AS Numero FROM orden_compra WHERE SUBSTR(Folio,1,$numero)='$_POST[folio]'";

        if($res=$con->query($sql)){
            $row = $res->fetch_assoc();
            if($row['Numero'] == ""){
                $folio= $_POST['folio'].'1';
            }else{
               $folio= $_POST['folio'].($row['Numero']+1); 
            }

            $sql1 = "INSERT INTO orden_compra VALUES(null,'$folio','$_POST[proveedor]','$_POST[total]',NOW(),'0','0','0')";

            if($con->query($sql1)){
                $id=mysqli_insert_id($con);
                $detalles=json_decode($_POST["detalles"]);

                foreach($detalles as $deta){
                    $sql2 = "INSERT INTO orden_compra_detalle VALUES(null,'$id','$deta[0]','$deta[1]','$deta[2]','$deta[3]','$deta[4]','$deta[5]','$deta[6]')";

                    if(!$con->query($sql2)){
                        $compro=1;
                    }
                }

                if($compro == 1){
                    echo "Error: ".mysqli_error();
                }else{
                    echo "Correcto";
                }
            }else{
                echo "Error: ".mysqli_error();
            } 
        }else{
            echo "Error: ".mysqli_error($con);
        }
    }
?>