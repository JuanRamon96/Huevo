<?php  
	require("../../conexion.php");
	session_start();
	$id = $_SESSION['user']['ID_Usuario'];
	$ventas = array('0','0','0','0');

	if($_SESSION['user']['Tipo']=="2" && $_POST["metodo"]=="5"){
    	$sql1 = "SELECT * FROM permisos WHERE FK_Usuario = '$id'";

		if($res1=$con->query($sql1)){
			if ($res1->num_rows > 0) {
				$row1 = $res1->fetch_assoc();
				$ventas = explode("*", $row1["Ventas"]);		
			}
		}else{
			echo "Error: ".mysqli_error($con);
		}
    }

    if($_POST['metodo']=='1'){
        $sql = "SELECT ID_Cliente, Codigo, Nombre, Domicilio, Colonia, Ciudad, Estado, Pais, CP, RazonSocial, RFC, Telefono, Email, Contacto, TelContacto FROM clientes WHERE Activo='1' AND Eliminado='0'";

        $filas="";
        if($res=$con->query($sql)){
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    $filas .= "<tr>
                        <td>$row[Codigo]</td>
                        <td>$row[Nombre]</td>
                        <td>$row[Domicilio]</td>
                        <td>$row[Colonia]</td>
                        <td>$row[Ciudad]</td>
                        <td>$row[Estado]</td>
                        <td>$row[Pais]</td>
                        <td>$row[CP]</td>
                        <td>$row[RazonSocial]</td>
                        <td>$row[RFC]</td>
                        <td>$row[Telefono]</td>
                        <td>$row[Email]</td>
                        <td>$row[Contacto]</td>
                        <td>$row[TelContacto]</td>
                        <td><button type='button' class='btn btn-outline-info seleccionarCliente' attrID='$row[ID_Cliente]'>Seleccionar</button></td>
                    </tr>";
                }
            }else{
                $filas = "No se encontraron resultados";
            }

            echo "<div class='row'>
                <div class='col-12 table-responsive'>
                    <table class='table table-hover table-stripped table-sm' id='tablaVerClientes'>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Domicilio</th>
                                <th>Colonia</th>
                                <th>Ciudad</th>
                                <th>Estado</th>
                                <th>País</th>
                                <th>CP</th>
                                <th>Razón social</th>
                                <th>RFC</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Contacto</th>
                                <th>Teléfono Contacto</th>
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
        $sql = "SELECT ID_Producto, Codigo, Nombre, UME, Categoria, Existencia, IVA,  ROUND(Costo_Promedio, 2) AS CostoP FROM productos INNER JOIN precios ON ID_Producto=FK_Producto WHERE Activo='1' AND Categoria!='Insumo' AND Eliminado='0' AND Existencia > 0";

        $filas="";
        if($res=$con->query($sql)){
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    $filas .= "<tr>
                        <td>$row[Codigo]</td>
                        <td>$row[Nombre]</td>
                        <td>$row[UME]</td>
                        <td>$row[Categoria]</td>
                        <td>$row[Existencia]</td>
                        <td>$row[IVA]</td>
                        <td>$row[CostoP]</td>
                        <td><button type='button' class='btn btn-outline-info seleccionarVProducto' attrID='$row[ID_Producto]'>Seleccionar</button></td>
                    </tr>";
                }
            }else{
                $filas = "No se encontraron resultados";
            }

            echo "<div class='row'>
                <div class='col-12 table-responsive'>
                    <table class='table table-hover table-stripped table-sm' id='tablaVProductos'>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>UME</th>
                                <th>Categoría</th>
                                <th>Existencia</th>
                                <th>IVA%</th>
                                <th>Costo</th>
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

    if($_POST['metodo']=='3'){
        $compro=0;
        $numero = strlen($_POST['folio']);
        $sql = "SELECT SUBSTR(MAX(Folio) FROM $numero+1) AS Numero FROM ventas WHERE SUBSTR(Folio,1,$numero)='$_POST[folio]'";

        if($res=$con->query($sql)){
            $row = $res->fetch_assoc();
            if($row['Numero'] == ""){
                $folio= $_POST['folio'].'1';
            }else{
               $folio= $_POST['folio'].($row['Numero']+1); 
            }

            $sql1 = "INSERT INTO ventas VALUES(null,'$folio','$_POST[cliente]','$_POST[total]',NOW(),'0','0')";

            if($con->query($sql1)){
                $id=mysqli_insert_id($con);
                $detalles=json_decode($_POST["detalles"]);

                foreach($detalles as $deta){
                    $sql2 = "INSERT INTO ventas_detalle VALUES(null,'$id','$deta[0]','$deta[1]','$deta[2]','$deta[3]','$deta[4]','$deta[5]','$deta[6]')";

                    if(!$con->query($sql2)){
                        $compro=1;
                    }
                }

                if($compro == 1){
                    echo "Error: ".mysqli_error($con);
                }else{
                    echo "$id*$_POST[cliente]*Correcto";
                }
            }else{
                echo "Error: ".mysqli_error($con);
            } 
        }else{
            echo "Error: ".mysqli_error($con);
        }
        $con->close();
    }

    if($_POST['metodo']=='4'){
        if($_POST['tipo'] == '0'){
            $tipo="";
        }else if($_POST['tipo'] == '1'){
            $tipo="AND Cancelada = '0'";
        }else{
            $tipo="AND Cancelada = '1'";
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
        $sql = "SELECT ID_Venta, Folio, (SELECT Nombre FROM folios WHERE Folio LIKE CONCAT(Serie,'%') LIMIT 1) AS NFolio, FK_Cliente, clientes.Nombre AS Nombre, CONCAT('<p>Código: ',clientes.Codigo,'</p><p>Nombre: ',clientes.Nombre,'</p><p>Domicilio: ',clientes.Domicilio,'</p><p>Colonia: ',clientes.Colonia,'</p><p>Ciudad: ',clientes.Ciudad,'</p><p>Estado: ',clientes.Estado,'</p><p>País: ',clientes.Pais,'</p><p>CP: ',clientes.CP,'</p><p>Razón social: ',clientes.RazonSocial,'</p><p>RFC: ',clientes.RFC,'</p><p>Teléfono: ',clientes.Telefono,'</p><p>Email: ',clientes.Email,'</p><p>Contacto: ',clientes.Contacto,'</p><p>Teléfono Contacto: ',clientes.TelContacto,'</p>') AS DatosCli,Total, Fecha, DATE_FORMAT(Fecha, '%d-%m-%Y %h:%i %p') AS FechaE, Cancelada, Eliminada FROM ventas INNER JOIN clientes ON FK_Cliente=ID_Cliente WHERE Folio LIKE '%$_POST[buscar]%' AND Eliminada='0' $tipo $fechas ORDER BY ID_Venta DESC";

        if($res=$con->query($sql)){
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    
                    $sql1 = "SELECT ID_Venta_Detalle, FK_Venta, FK_Producto,  Codigo, Nombre, UME, Cantidad, Precio, Descuento, Subtotal, ventas_detalle.IVA AS IVA, Total, Existencia FROM ventas_detalle INNER JOIN productos ON FK_Producto=ID_Producto WHERE FK_Venta='$row[ID_Venta]' ORDER BY Codigo";

                    if($res1=$con->query($sql1)){
                        if($res1->num_rows > 0){
                            $orden="";
                            while($row1 = $res1->fetch_assoc()){
                                $orden .= "<tr>
                                    <td><span hidden>$row1[ID_Venta_Detalle]</span><p>$row1[Codigo]</p></td>
                                    <td><span hidden>$row1[FK_Producto]</span><p>$row1[Nombre]</p></td>
                                    <td>$row1[UME]</td>
                                    <td attrMax='$row1[Existencia]'>$row1[Cantidad]</td>
                                    <td>$row1[Precio]</td>
                                    <td>$row1[Descuento]</td>
                                    <td>$row1[Subtotal]</td>
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

                    if($_SESSION['user']['Tipo'] == "1" || $entregas[3] == "1"){
                        $bEliminar="<button type='button' class='btn btn-danger btn-sm bBorrarEntre' attrCan='$row[Cancelada]' attrID='$row[ID_Venta]'><i class='fas fa-trash-alt'></i></button>";
                    }else{
                        $bEliminar="";
                    } 

                    if(($_SESSION['user']['Tipo'] == "1" || $compras[2] == "1") && $row['Cancelada'] == "0"){
                        $bModificar="<button type='button' class='btn btn-warning btn-sm bModificarVenta' attrID='$row[ID_Venta]' data-toggle='modal' data-target='#ModalMVenta'><i class='fas fa-pencil-alt'></i></button>";
                        $bCancelar="<button type='button' class='btn btn-warning btn-sm bCancelarVenta' attrID='$row[ID_Venta]'>Cancelar Venta <i class='fas fa-ban'></i></button>";
                    }else{
                        $bModificar="";
                        $bCancelar="";
                    }  

                    if($row['Cancelada'] == 1){
                        $clase="table-danger";
                    }else{
                        $clase="";
                    }

                    echo "<tr class='$clase'>
                        <td><span hidden>$row[NFolio]</span><p>$row[Folio]</p></td>
                        <td><span hidden>$row[FK_Cliente]</span><p>$row[Nombre]</p><span hidden>$row[DatosCli]</span></td>
                        <td>$row[Total]</td>
                        <td><span hidden>$row[Fecha]</span><p>$row[FechaE]</p></td>
                        <td><span hidden>$row[ID_Venta]</span><a href='Venta.php?id=$row[ID_Venta]&empleado=$row[FK_Cliente]' target='_blank' class='btn btn-light'><i class='fas fa-print'></i></a></td>
                        <td><button type='button' class='btn btn-outline-info vermasVenta'><i class='fas fa-eye'></i></button></td>
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
                                                        <th>Descuento %</th>
                                                        <th>Subtotal</th>
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
                                           $bCancelar
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
            echo "Error: ".mysqli_error($con);
        }
        $con->close();
    }

    if($_POST['metodo']=='5'){
        $sql="UPDATE ventas SET Cancelada=1 WHERE ID_Venta='$_POST[id]'";

        if ($con->query($sql)) {
            $compro=0;
            $regre=json_decode($_POST["regre"]);

            foreach($regre as $re){
                $sql1 = "UPDATE productos SET Existencia=Existencia+$re[1] WHERE ID_Producto='$re[0]'";

                if(!$con->query($sql1)){
                    $compro=1;
                }
            }

            if ($compro == 0) {
                echo "Correcto";
            }
        } else {
            echo "Error: ".mysqli_error($con);
        }
        
    }

    if($_POST['metodo']=='6'){
        $sql="UPDATE entregas SET Eliminada=1 WHERE ID_Entrega='$_POST[id]'";

        if ($con->query($sql)) {
            if($_POST['cancela'] == '0'){
                $compro=0;
                $regre=json_decode($_POST["regre"]);

                foreach($regre as $re){
                    $sql1 = "UPDATE productos SET Existencia=Existencia+$re[1] WHERE ID_Producto='$re[0]'";

                    if(!$con->query($sql1)){
                        $compro=1;
                    }
                }

                if ($compro == 0) {
                    echo "Correcto";
                }
            }else{
                echo "Correcto";
            }
        } else {
            echo "Error: ".mysqli_error($con);
        }
        
    }

    if($_POST['metodo']=='8'){
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

        $Mfolio=""; $Mresponsable="";
        if($folio != ""){
            $Mfolio=",Folio='$folio'";
        }

        if($_POST['responsable'] != ""){
            $Mresponsable=",FK_Empleado='$_POST[responsable]'";
        }

        $sql = "UPDATE entregas SET Total='$_POST[total]', Fecha='$_POST[fecha]' $Mresponsable $Mfolio WHERE ID_Entrega='$_POST[id]'";


        if($con->query($sql)){
            $insertar=json_decode($_POST["insertar"]);
            $actualizar=json_decode($_POST["actualizar"]);
            $eliminar=json_decode($_POST["eliminar"]);

            if(isset($insertar)){
                foreach($insertar as $inse){
                    $sql1 = "INSERT INTO entregas_detalles VALUES(null,'$_POST[id]','$inse[0]','$inse[1]','$inse[2]','$inse[3]','$inse[4]','$inse[5]')";

                    if(!$con->query($sql1)){
                        $compro=1;
                    }
                }
            }

            if(isset($actualizar)){
                foreach($actualizar as $actu){
                    $sql2 = "UPDATE entregas_detalles SET Cantidad='$actu[1]',Costo='$actu[2]',Subtotal='$actu[3]',IVA='$actu[4]',Total='$actu[5]' WHERE ID_Entrega_Detalle='$actu[0]'";

                    if(!$con->query($sql2)){
                        $compro=1;
                    }
                }
            }

            if(isset($eliminar)){
                foreach($eliminar as $eli){
                    $sql2 = "DELETE FROM entregas_detalles WHERE ID_Entrega_Detalle='$eli'";

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
?>