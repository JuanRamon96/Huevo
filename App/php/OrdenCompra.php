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
    	$sql = "SELECT * FROM folios WHERE Tipo='$_POST[tipod]'";

    	if($_SESSION['user']['Tipo']=="1"){
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
    			$filas = "";
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
        $con->close();
    }

    if($_POST['metodo']=='2'){
     	$sql = "INSERT INTO folios VALUES(null,'$_POST[nombre]','$_POST[serie]','$_POST[tipo]')";

     	if($con->query($sql)){
     		echo "1";
     	}else{
     		echo "Error: ".mysqli_error($con);
     	}
    }

    if($_POST['metodo']=='3'){
     	$sql = "DELETE FROM folios WHERE ID_Folio='$_POST[id]'";

     	if($con->query($sql)){
     		echo "1";
     	}else{
     		echo "Error: ".mysqli_error($con);
     	}
    }

    if($_POST['metodo']=='4'){
     	$sql = "UPDATE folios SET Serie='$_POST[serie]', Nombre='$_POST[nombre]' WHERE ID_Folio='$_POST[id]'";

     	if($con->query($sql)){
     		echo "1";
     	}else{
     		echo "Error: ".mysqli_error($con);
     	}
    }

    if($_POST['metodo']=='5'){
    	$numero = strlen($_POST['folio']);
        $sql = "SELECT SUBSTR(MAX(Folio) FROM $numero+1) AS Numero FROM $_POST[tabla] WHERE SUBSTR(Folio,1,$numero)='$_POST[folio]'";

        if($res=$con->query($sql)){
            if ($res->num_rows > 0) {
                $row = $res->fetch_assoc();
                echo $row['Numero'];     
            }
        }else{
            echo "Error: ".mysqli_error($con);
        }
        $con->close();
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
        $con->close();
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
                <p>Colonia: $row[Colonia]</p>
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
        $con->close();
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
                        <td>$row[IVA]</td>
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
                                <th>IVA%</th>
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
        $con->close();
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

            $sql1 = "INSERT INTO orden_compra VALUES(null,'$folio','$_POST[proveedor]','$_POST[total]',NOW(),'0','0')";

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
                    echo "Error: ".mysqli_error($con);
                }else{
                    echo "$id*$_POST[proveedor]*Correcto";
                }
            }else{
                echo "Error: ".mysqli_error($con);
            } 
        }else{
            echo "Error: ".mysqli_error($con);
        }
        $con->close();
    }

    if($_POST['metodo']=='10'){
        if($_POST['tipo'] == '0'){
            $tipo="";
        }else if($_POST['tipo'] == '1'){
            $tipo="AND Convertida = '0'";
        }else{
            $tipo="AND Convertida = '1'";
        }

        if($_POST['desde'] == "" && $_POST['hasta'] == ""){
            $fechas="";
        }else if($_POST['desde'] == ""){
            $fechas="AND Fecha <= '$_POST[hasta]'";
        }else if($_POST['hasta'] == ""){
            $fechas="AND Fecha >= '$_POST[desde]'";
        }else{
            $fechas="AND Fecha BETWEEN '$_POST[desde]' AND '$_POST[hasta]'";
        }
        $sql = "SELECT ID_Orden, Folio, (SELECT Nombre FROM folios WHERE Folio LIKE CONCAT(Serie,'%') LIMIT 1) AS NFolio, FK_Proveedor, proveedores.Nombre AS Nombre, CONCAT('<p>Código: ',proveedores.Codigo,'</p><p>Nombre: ',proveedores.Nombre,'</p><p>Domicilio: ',proveedores.Domicilio,'</p><p>Ciudad: ',proveedores.Ciudad,'</p><p>Estado: ',proveedores.Estado,'</p><p>País: ',proveedores.Pais,'</p><p>Código Postal: ',proveedores.CP,'</p><p>Razón social: ',proveedores.RazonSocial,'</p><p>RFC: ',proveedores.RFC,'</p><p>Teléfono: ',proveedores.Telefono,'</p><p>Email: ',proveedores.Email,'</p><p>Contacto: ',proveedores.Contacto,'</p><p>Contacto Teléfono: ',proveedores.TelContacto,'</p>') AS DatosPro,Total, Fecha, DATE_FORMAT(Fecha, '%d-%m-%Y %h:%i %p') AS FechaE, Convertida, Eliminada FROM orden_compra INNER JOIN proveedores ON FK_Proveedor=ID_Proveedor WHERE Folio LIKE '%$_POST[buscar]%' AND Eliminada='0' $tipo $fechas ORDER BY ID_Orden DESC";

        if($res=$con->query($sql)){
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    
                    $sql1 = "SELECT ID_Orden_Detalle, FK_Orden_Compra, FK_Producto,  Codigo, Nombre, UME, Cantidad, Precio_Unitario, Subtotal, Descuento, orden_compra_detalle.IVA AS IVA, Total FROM orden_compra_detalle INNER JOIN productos ON FK_Producto=ID_Producto WHERE FK_Orden_Compra='$row[ID_Orden]' ORDER BY Codigo";

                    if($res1=$con->query($sql1)){
                        if($res1->num_rows > 0){
                            $orden="";
                            while($row1 = $res1->fetch_assoc()){
                                $orden .= "<tr>
                                    <td><span hidden>$row1[ID_Orden_Detalle]</span><p>$row1[Codigo]</p></td>
                                    <td><span hidden>$row1[FK_Producto]</span><p>$row1[Nombre]</p></td>
                                    <td>$row1[UME]</td>
                                    <td>$row1[Cantidad]</td>
                                    <td>$row1[Precio_Unitario]</td>
                                    <td>$row1[Subtotal]</td>
                                    <td>$row1[Descuento]</td>
                                    <td>$row1[IVA]</td>
                                    <td>$row1[Total]</td>
                                </tr>";       
                            }
                        }else{
                            $orden = "<tr><td colspan='9'>No se encontraron detalles</td></tr>";
                        }
                    }else{
                        echo "Error: ".mysqli_error($con);
                    }

                    if(($_SESSION['user']['Tipo'] == "1" || $compras[3] == "1") && $row['Convertida'] == "0"){
                        $bEliminar="<button type='button' class='btn btn-danger btn-sm bBorrarOrden' attrID='$row[ID_Orden]'><i class='fas fa-trash-alt'></i></button>";
                    }else{
                        $bEliminar="";
                    } 

                    if(($_SESSION['user']['Tipo'] == "1" || $compras[2] == "1") && $row['Convertida'] == "0"){
                        $bModificar="<button type='button' class='btn btn-warning btn-sm bModificarOrden' attrID='$row[ID_Orden]' data-toggle='modal' data-target='#ModalOrdenCompra'><i class='fas fa-pencil-alt'></i></button>";
                    }else{
                        $bModificar="";
                    } 

                    if(($_SESSION['user']['Tipo'] == "1" || $compras[1] == "1") && $row['Convertida'] == "0"){
                        $bConvertir="<button type='button' class='btn btn-success btn-sm bConvertir' attrID='$row[ID_Orden]' data-toggle='modal' data-target='#ModalOrdenFolio'>Convertir a Compra <i class='fas fa-plus'></i></button>";
                    }else{
                        $bConvertir="<h5>Convertida</h5>";
                    } 

                    echo "<tr>
                        <td><span hidden>$row[NFolio]</span><p>$row[Folio]</p></td>
                        <td><span hidden>$row[FK_Proveedor]</span><p>$row[Nombre]</p><span hidden>$row[DatosPro]</span></td>
                        <td>$row[Total]</td>
                        <td><span hidden>$row[Fecha]</span><p>$row[FechaE]</p></td>
                        <td><span hidden>$row[ID_Orden]</span><a href='OrdenCompra.php?id=$row[ID_Orden]&proveedor=$row[FK_Proveedor]' target='_blank' class='btn btn-light'><i class='fas fa-print'></i></a></td>
                        <td><button type='button' class='btn btn-outline-info vermasOrden'><i class='fas fa-eye'></i></button></td>
                    </tr>
                    <tr class='oculto' style='background: #F7F7F7;'>
                        <td colspan='6'>
                            <div class='row'>
                                <div class='col-12'>
                                    <div class='row'>
                                        <div class='col-12 table-responsive masOrdenDetalle'>
                                            <table class='table table-hover table-sm table-bordered'>
                                                <thead>
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Producto</th>
                                                        <th>UME</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio</th>
                                                        <th>Subtotal</th>
                                                        <th>Descuento %</th>
                                                        <th>IVA %</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    $orden
                                                </tbody>
                                                <tfoot>
                                                    <tr class='table-active'>
                                                        <th colspan='8' class='text-right'>Total:</th>
                                                        <th>$row[Total]</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <br>
                                        <div class='col-6 text-left'>
                                            $bEliminar
                                            $bModificar
                                        </div>
                                        <div class='col-6 text-right'>
                                           $bConvertir
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>";
                }
            }else{
                echo "No se encontraron resultados";
            }
        }else{
            echo "Error: ".mysqli_error($con).$sql;
        }
        $con->close();
    }

    if($_POST['metodo']=='11'){
        $sql = "UPDATE orden_compra SET Eliminada='1' WHERE ID_Orden='$_POST[id]'";

        if($con->query($sql)){
            echo "1";
        }else{
            echo "Error: ".mysqli_error($con);
        }
    }

    if($_POST['metodo']=='12'){
        $compro=0;
        $folio="";
        if($_POST['folio'] != ""){
            $numero = strlen($_POST['folio']);
            $sql = "SELECT SUBSTR(MAX(Folio) FROM $numero+1) AS Numero FROM orden_compra WHERE SUBSTR(Folio,1,$numero)='$_POST[folio]'";

            if($res=$con->query($sql)){
                $row = $res->fetch_assoc();
                if($row['Numero'] == ""){
                    $folio= $_POST['folio'].'1';
                }else{
                   $folio= $_POST['folio'].($row['Numero']+1); 
                }
            }else{
                echo "Error: ".mysqli_error($con);
            }
        }

        $Mfolio=""; $Mproveedor="";
        if($folio != ""){
            $Mfolio=",Folio='$folio'";
        }

        if($_POST['proveedor'] != ""){
            $Mproveedor=",FK_Proveedor='$_POST[proveedor]'";
        }

        $sql = "UPDATE orden_compra SET Total='$_POST[total]', Fecha='$_POST[fecha]' $Mproveedor $Mfolio WHERE ID_Orden='$_POST[id]'";


        if($con->query($sql)){
            $insertar=json_decode($_POST["insertar"]);
            $actualizar=json_decode($_POST["actualizar"]);
            $eliminar=json_decode($_POST["eliminar"]);

            if(isset($insertar)){
                foreach($insertar as $inse){
                    $sql1 = "INSERT INTO orden_compra_detalle VALUES(null,'$_POST[id]','$inse[0]','$inse[1]','$inse[2]','$inse[3]','$inse[4]','$inse[5]','$inse[6]')";

                    if(!$con->query($sql1)){
                        $compro=1;
                    }
                }
            }

            if(isset($actualizar)){
                foreach($actualizar as $actu){
                    $sql2 = "UPDATE orden_compra_detalle SET Cantidad='$actu[1]',Precio_Unitario='$actu[2]',Subtotal='$actu[3]',Descuento='$actu[4]',IVA='$actu[5]',Total='$actu[6]' WHERE ID_Orden_Detalle='$actu[0]'";

                    if(!$con->query($sql2)){
                        $compro=1;
                    }
                }
            }

            if(isset($eliminar)){
                foreach($eliminar as $eli){
                    $sql2 = "DELETE FROM orden_compra_detalle WHERE ID_Orden_Detalle='$eli'";

                    if(!$con->query($sql2)){
                        $compro=1;
                    }
                }
            }

            if($compro == 1){
                echo "Error: ".mysqli_error($con);
            }else{
                echo "Correcto";
            }
        }else{
            echo "Error: ".mysqli_error($con);
        }
        $con->close();
    }

    if($_POST['metodo']=='13'){
        $compro=0;
        $folio="";
        if($_POST['folio'] != ""){
            $numero = strlen($_POST['folio']);
            $sql = "SELECT SUBSTR(MAX(Folio) FROM $numero+1) AS Numero FROM compras WHERE SUBSTR(Folio,1,$numero)='$_POST[folio]'";

            if($res=$con->query($sql)){
                $row = $res->fetch_assoc();
                if($row['Numero'] == ""){
                    $folio= $_POST['folio'].'1';
                }else{
                   $folio= $_POST['folio'].($row['Numero']+1); 
                }
            }else{
                echo "Error 1: ".mysqli_error($con);
            }
        }


        $sql = "INSERT INTO compras VALUES(null,'$_POST[id]','$folio','$_POST[proveedor]','$_POST[total]',NOW(),0,0)";


        if($con->query($sql)){
            $id=mysqli_insert_id($con);
            $insertar=json_decode($_POST["detalles"]);

            if(isset($insertar)){
                foreach($insertar as $inse){
                    $sql1 = "INSERT INTO compras_detalle VALUES(null,'$id','$inse[0]','$inse[1]','$inse[2]','$inse[3]','$inse[4]','$inse[5]','$inse[6]')";

                    if(!$con->query($sql1)){
                        $compro=1;
                    }
                }
            }

            if($compro == 1){
                echo "Error 2: ".mysqli_error($con);
            }else{
                $sql2 = "UPDATE orden_compra SET Convertida='1' WHERE ID_Orden='$_POST[id]'";

                if($con->query($sql2)){
                    echo "Correcto";
                }else{
                   echo "Error 3: ".mysqli_error($con); 
                }
            }
        }else{
            echo "Error 4: ".mysqli_error($con);
        }
        $con->close();
    }
?>