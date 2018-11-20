<?php  
	require("../../conexion.php");
	session_start();
	$id = $_SESSION['user']['ID_Usuario'];
	$entregas = array('0','0','0','0');

	/*if($_SESSION['user']['Tipo']=="2" && $_POST["metodo"]=="1"){
    	$sql1 = "SELECT * FROM permisos WHERE FK_Usuario = '$id'";

		if($res1=$con->query($sql1)){
			if ($res1->num_rows > 0) {
				$row1 = $res1->fetch_assoc();
				$entregas = explode("*", $row1["Entregas"]);		
			}
		}else{
			echo "Error: ".mysqli_error($con);
		}
    }*/

    if($_POST['metodo']=='1'){
        $sql = "SELECT ID_Empleado, empleados.Codigo AS Codigo, empleados.Nombre AS Nombre, Ap_Pat, Ap_Mat, areas.Nombre AS Area, puestos.Nombre AS Puesto FROM empleados INNER JOIN puestos ON FK_Puesto=ID_Puesto INNER JOIN areas ON FK_Area=ID_Area WHERE Estatus='0' AND empleados.Eliminado='0'";

        $filas="";
        if($res=$con->query($sql)){
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    $filas .= "<tr>
                        <td>$row[Codigo]</td>
                        <td>$row[Nombre]</td>
                        <td>$row[Ap_Pat]</td>
                        <td>$row[Ap_Mat]</td>
                        <td>$row[Area]</td>
                        <td>$row[Puesto]</td>
                        <td><button type='button' class='btn btn-outline-info seleccionarResponsable' attrID='$row[ID_Empleado]'>Seleccionar</button></td>
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
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Área</th>
                                <th>Puesto</th>
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
        $sql = "SELECT empleados.Codigo AS Codigo, empleados.Nombre AS Nombre, Ap_Pat, Ap_Mat, Domicilio, Colonia, Ciudad, Estado, Pais, CP, Telefono, Email, areas.Nombre AS Area, puestos.Nombre AS Puesto FROM empleados INNER JOIN puestos ON FK_Puesto=ID_Puesto INNER JOIN areas ON FK_Area=ID_Area WHERE ID_Empleado='$_POST[id]' AND Estatus='0' AND empleados.Eliminado='0'";

        if($res=$con->query($sql)){
            if($res->num_rows > 0){
                $row = $res->fetch_assoc();
                echo "<div style='font-size:13px; padding:10px 0px;'>
                <p>Código: $row[Codigo]</p>
                <p>Nombre: $row[Nombre] $row[Ap_Pat] $row[Ap_Mat]</p>
                <p>Domicilio: $row[Domicilio]</p>
                <p>Colonia: $row[Colonia]</p>
                <p>Ciudad: $row[Ciudad]</p>
                <p>Estado: $row[Estado]</p>
                <p>País: $row[Pais]</p>
                <p>Código Postal: $row[CP]</p>
                <p>Teléfono: $row[Telefono]</p>
                <p>Email: $row[Email]</p>
                <p>Área: $row[Area]</p>
                <p>Puesto: $row[Puesto]</p>";
            }else{
                $echo = "No se encontraron resultados";
            }
        }else{
            echo "Error: ".mysqli_error($con);
        }
        $con->close();
    }


    if($_POST['metodo']=='3'){
        $sql = "SELECT ID_Producto, Codigo, Nombre, UME, Categoria, Existencia, IVA,  ROUND(Costo_Promedio, 2) AS CostoP FROM productos INNER JOIN precios ON ID_Producto=FK_Producto WHERE Activo='1' AND Categoria!='Producto Terminado' AND Eliminado='0' AND Existencia > 0";

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
                        <td><button type='button' class='btn btn-outline-info seleccionarENProducto' attrID='$row[ID_Producto]'>Seleccionar</button></td>
                    </tr>";
                }
            }else{
                $filas = "No se encontraron resultados";
            }

            echo "<div class='row'>
                <div class='col-12 table-responsive'>
                    <table class='table table-hover table-stripped table-sm' id='tablaEProductos'>
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

    if($_POST['metodo']=='4'){
        $compro=0;
        $numero = strlen($_POST['folio']);
        $sql = "SELECT SUBSTR(MAX(Folio) FROM $numero+1) AS Numero FROM entregas WHERE SUBSTR(Folio,1,$numero)='$_POST[folio]'";

        if($res=$con->query($sql)){
            $row = $res->fetch_assoc();
            if($row['Numero'] == ""){
                $folio= $_POST['folio'].'1';
            }else{
               $folio= $_POST['folio'].($row['Numero']+1); 
            }

            $sql1 = "INSERT INTO entregas VALUES(null,'$folio','$_POST[responsable]','$_POST[total]',NOW(),'0','0')";

            if($con->query($sql1)){
                $id=mysqli_insert_id($con);
                $detalles=json_decode($_POST["detalles"]);

                foreach($detalles as $deta){
                    $sql2 = "INSERT INTO entregas_detalles VALUES(null,'$id','$deta[0]','$deta[1]','$deta[2]','$deta[3]','$deta[4]','$deta[5]')";

                    if(!$con->query($sql2)){
                        $compro=1;
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
        }else{
            echo "Error: ".mysqli_error($con);
        }
        $con->close();
    }
?>