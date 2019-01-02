<?php  
	require("../../conexion.php");
	session_start();
	$id = $_SESSION['user']['ID_Usuario'];


	if($_POST['metodo'] == '1'){
		$sql = "SELECT * FROM productos WHERE Eliminado = '1' ORDER BY Codigo";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){
					echo "<tr>
						<td>$row[Codigo]</td>
						<td>$row[Nombre]</td>
						<td>$row[UME]</td>
						<td>$row[Existencia]</td>
						<td>$row[Min]</td>
						<td>$row[Max]</td>
						<td>$row[IVA]</td>
						<td>$row[Categoria]</td>
						<td><button type='button' class='btn btn-info restaurar' attrID='$row[ID_Producto]'><i class='fas fa-redo'></i></button></td>
						<td><button type='button' class='btn btn-danger eliminar' attrID='$row[ID_Producto]'><i class='fas fa-trash-alt'></i></button></td>
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

	if($_POST['metodo'] == '2'){
		$sql="UPDATE $_POST[tabla] SET $_POST[tipo]='0' WHERE $_POST[campo]='$_POST[id]'";

		if ($con->query($sql)) {
			echo "Correcto*$_POST[tabla]";
		} else {
			echo "Error: ".mysqli_error($con);
		}
	}

	if($_POST['metodo'] == '3'){
		$sql="DELETE FROM $_POST[tabla] WHERE $_POST[campo]='$_POST[id]'";

		if ($con->query($sql)) {
			echo "Correcto*$_POST[tabla]";
		} else {
			echo "Error: ".mysqli_error($con);
		}
	}

	if($_POST['metodo'] == '4'){
		$sql = "SELECT * FROM clientes WHERE Eliminado = '1' ORDER BY Codigo";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){
					echo "<tr>
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
						<td><button type='button' class='btn btn-info restaurar' attrID='$row[ID_Cliente]'><i class='fas fa-redo'></i></button></td>
						<td><button type='button' class='btn btn-danger eliminar' attrID='$row[ID_Cliente]'><i class='fas fa-trash-alt'></i></button></td>
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

	if($_POST['metodo'] == '5'){
		$sql = "SELECT * FROM proveedores WHERE Eliminado = '1' ORDER BY Codigo";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){
					echo "<tr>
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
						<td><button type='button' class='btn btn-info restaurar' attrID='$row[ID_Proveedor]'><i class='fas fa-redo'></i></button></td>
						<td><button type='button' class='btn btn-danger eliminar' attrID='$row[ID_Proveedor]'><i class='fas fa-trash-alt'></i></button></td>
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

	if($_POST['metodo'] == '6'){
		$sql = "SELECT empleados.*, puestos.Nombre AS Puesto, areas.Nombre AS Area FROM empleados INNER JOIN puestos ON FK_Puesto=ID_Puesto INNER JOIN areas ON FK_Area=ID_Area WHERE empleados.Eliminado = '1' ORDER BY Codigo";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){
					echo "<tr>
						<td>$row[Codigo]</td>
						<td>$row[Nombre]</td>
						<td>$row[Ap_Pat]</td>
						<td>$row[Ap_Mat]</td>
						<td>$row[Domicilio]</td>
						<td>$row[Colonia]</td>
						<td>$row[Ciudad]</td>
						<td>$row[Estado]</td>
						<td>$row[Pais]</td>
						<td>$row[CP]</td>
						<td>$row[Telefono]</td>
						<td>$row[Email]</td>
						<td>$row[Area]</td>
						<td>$row[Puesto]</td>
						<td>$row[SDI]</td>
						<td>$row[Alergias]</td>
						<td>$row[TipoSangre]</td>
						<td>$row[Emergencia]</td>
						<td>$row[TelEmergencia]</td>
						<td>$row[FechaIngreso]</td>
						<td>$row[FechaReingreso]</td>
						<td>$row[FechaBaja]</td>
						<td><button type='button' class='btn btn-info restaurar' attrID='$row[ID_Empleado]'><i class='fas fa-redo'></i></button></td>
						<td><button type='button' class='btn btn-danger eliminar' attrID='$row[ID_Empleado]'><i class='fas fa-trash-alt'></i></button></td>
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

	if($_POST['metodo'] == '7'){
		$sql = "SELECT puestos.*, areas.Nombre AS Area FROM puestos INNER JOIN areas ON FK_Area=ID_Area WHERE puestos.Eliminado = '1' ORDER BY Codigo";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){
					echo "<tr>
						<td>$row[Codigo]</td>
						<td>$row[Nombre]</td>
						<td>$row[Area]</td>
						<td><button type='button' class='btn btn-info restaurar' attrID='$row[ID_Puesto]'><i class='fas fa-redo'></i></button></td>
						<td><button type='button' class='btn btn-danger eliminar' attrID='$row[ID_Puesto]'><i class='fas fa-trash-alt'></i></button></td>
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

	if($_POST['metodo'] == '8'){
		$sql = "SELECT * FROM areas WHERE Eliminado = '1' ORDER BY Codigo";

		if($res=$con->query($sql)){
			if ($res->num_rows > 0) {
				while($row = $res->fetch_assoc()){
					echo "<tr>
						<td>$row[Codigo]</td>
						<td>$row[Nombre]</td>
						<td><button type='button' class='btn btn-info restaurar' attrID='$row[ID_Area]'><i class='fas fa-redo'></i></button></td>
						<td><button type='button' class='btn btn-danger eliminar' attrID='$row[ID_Area]'><i class='fas fa-trash-alt'></i></button></td>
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

	if($_POST['metodo']=='9'){
        $sql = "SELECT ID_Venta, Folio, clientes.Nombre AS Nombre, DATE_FORMAT(Fecha, '%d-%m-%Y %h:%i %p') AS FechaE, Total, Cancelada, Eliminada FROM ventas INNER JOIN clientes ON FK_Cliente=ID_Cliente WHERE Eliminada='1' ORDER BY ID_Venta DESC";

        if($res=$con->query($sql)){
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    
                    $sql1 = "SELECT ID_Venta_Detalle, FK_Venta, FK_Producto,  Codigo, Nombre, UME, Cantidad, Precio, Descuento, Subtotal, ventas_detalle.IVA AS IVA, Total, Existencia FROM ventas_detalle INNER JOIN productos ON FK_Producto=ID_Producto WHERE FK_Venta='$row[ID_Venta]' ORDER BY Codigo";

                    if($res1=$con->query($sql1)){
                        if($res1->num_rows > 0){
                            $orden="";
                            while($row1 = $res1->fetch_assoc()){
                                $orden .= "<tr>
                                    <td>$row1[Codigo]</td>
                                    <td>$row1[Nombre]</td>
                                    <td>$row1[UME]</td>
                                    <td>$row1[Cantidad]</td>
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

                    echo "<tr>
                        <td>$row[Folio]</td>
                        <td>$row[Nombre]</td>
                        <td>$row[Total]</td>
                        <td>$row[FechaE]</td>
                        <td><button type='button' class='btn btn-danger eliminar' attrID='$row[ID_Venta]'><i class='fas fa-trash-alt'></i></button></td>
                    </tr>
                    <tr style='background: #F7F7F7;'>
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

    if($_POST['metodo']=='10'){
        $sql = "SELECT ID_Orden, Folio, Nombre, Total, DATE_FORMAT(Fecha, '%d-%m-%Y %h:%i %p') AS FechaE, Convertida, Eliminada FROM orden_compra INNER JOIN proveedores ON FK_Proveedor=ID_Proveedor WHERE Eliminada='1' ORDER BY ID_Orden DESC";

        if($res=$con->query($sql)){
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    
                    $sql1 = "SELECT ID_Orden_Detalle, FK_Orden_Compra, FK_Producto,  Codigo, Nombre, UME, Cantidad, Precio_Unitario, Subtotal, Descuento, orden_compra_detalle.IVA AS IVA, Total FROM orden_compra_detalle INNER JOIN productos ON FK_Producto=ID_Producto WHERE FK_Orden_Compra='$row[ID_Orden]' ORDER BY Codigo";

                    if($res1=$con->query($sql1)){
                        if($res1->num_rows > 0){
                            $orden="";
                            while($row1 = $res1->fetch_assoc()){
                                $orden .= "<tr>
                                    <td>$row1[Codigo]</td>
                                    <td>$row1[Nombre]</td>
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

                    echo "<tr>
                        <td>$row[Folio]</td>
                        <td>$row[Nombre]</td>
                        <td>$row[Total]</td>
                        <td>$row[FechaE]</td>
                        <td><button type='button' class='btn btn-danger eliminar' attrID='$row[ID_Orden]'><i class='fas fa-trash-alt'></i></button></td>
                    </tr>
                    <tr style='background: #F7F7F7;'>
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

    if($_POST['metodo']=='11'){
        $sql = "SELECT ID_Compra, compras.Folio AS Folio, orden_compra.Folio AS Folio1, compras.FK_Proveedor, proveedores.Nombre AS Nombre,compras.Total, compras.Fecha, DATE_FORMAT(compras.Fecha, '%d-%m-%Y %h:%i %p') AS FechaE, Cancelada, compras.Eliminada FROM compras INNER JOIN proveedores ON FK_Proveedor=ID_Proveedor INNER JOIN orden_compra ON FK_Orden=ID_Orden WHERE compras.Eliminada='1' ORDER BY ID_Compra DESC";

        if($res=$con->query($sql)){
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    
                    $sql1 = "SELECT ID_Compras_Detalle, FK_Compra, FK_Producto,  Codigo, Nombre, UME, Cantidad, Precio_Unitario, Subtotal, Descuento, compras_detalle.IVA AS IVA, Total FROM compras_detalle INNER JOIN productos ON FK_Producto=ID_Producto WHERE FK_Compra='$row[ID_Compra]' ORDER BY Codigo";

                    if($res1=$con->query($sql1)){
                        if($res1->num_rows > 0){
                            $orden="";
                            while($row1 = $res1->fetch_assoc()){
                                $orden .= "<tr>
                                    <td>$row1[Codigo]</td>
                                    <td>$row1[Nombre]</td>
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

                    echo "<tr>
                        <td>$row[Folio]</td>
                        <td>$row[Nombre]</td>
                        <td>$row[Total]</td>
                        <td>$row[FechaE]</td>
                        <td>$row[Folio1]</td>
                        <td><button type='button' class='btn btn-danger eliminar' attrID='$row[ID_Compra]'><i class='fas fa-trash-alt'></i></button></td>
                    </tr>
                    <tr style='background: #F7F7F7;'>
                        <td colspan='7'>
                            <div class='row'>
                                <div class='col-12'>
                                    <div class='row'>
                                        <div class='col-12 table-responsive'>
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

    if($_POST['metodo']=='12'){
        $sql = "SELECT ID_Entrega, Folio, CONCAT(empleados.Nombre,' ',empleados.Ap_Pat,' ',empleados.Ap_Mat) AS Nombre, Total, Fecha, DATE_FORMAT(Fecha, '%d-%m-%Y %h:%i %p') AS FechaE, Cancelada, Eliminada FROM entregas INNER JOIN empleados ON FK_Empleado=ID_Empleado INNER JOIN puestos ON FK_Puesto=ID_Puesto INNER JOIN areas ON FK_Area=ID_Area WHERE Eliminada='1' ORDER BY ID_Entrega DESC";

        if($res=$con->query($sql)){
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    
                    $sql1 = "SELECT ID_Entrega_Detalle, FK_Entrega, FK_Producto,  Codigo, Nombre, UME, Cantidad, Costo, Subtotal, entregas_detalles.IVA AS IVA, Total, Existencia FROM entregas_detalles INNER JOIN productos ON FK_Producto=ID_Producto WHERE FK_Entrega='$row[ID_Entrega]' ORDER BY Codigo";

                    if($res1=$con->query($sql1)){
                        if($res1->num_rows > 0){
                            $orden="";
                            while($row1 = $res1->fetch_assoc()){
                                $orden .= "<tr>
                                    <td>$row1[Codigo]</td>
                                    <td>$row1[Nombre]</td>
                                    <td>$row1[UME]</td>
                                    <td>$row1[Cantidad]</td>
                                    <td>$row1[Costo]</td>
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

                    echo "<tr>
                        <td>$row[Folio]</td>
                        <td>$row[Nombre]</td>
                        <td>$row[Total]</td>
                        <td>$row[FechaE]</td>
                        <td><button type='button' class='btn btn-danger eliminar' attrID='$row[ID_Entrega]'><i class='fas fa-trash-alt'></i></button></td>
                    </tr>
                    <tr style='background: #F7F7F7;'>
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
                                                        <th>Costo</th>
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
                                                        <th colspan='7' class='text-right'>Total:</th>
                                                        <th>$row[Total]</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
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
?>