<?php  
	require('fpdf/fpdf.php');
	
	class PDF extends FPDF
	{
		// Cabecera de página
		function Header()
		{
			require('../conexion.php');
		    // Logo
		    //$this->Image('../Imagenes/tooth.png',15,15,20);
		    // Arial bold 15
		    $this->SetFont('Arial','I',30);
		    $this->Cell(120,25,utf8_decode("Compra"),0,0,'C');

		    $sql = "SELECT Folio, DATE_FORMAT(Fecha, '%d-%m-%Y %h:%i %p') AS Fecha FROM compras WHERE ID_Compra='$_GET[id]'";
			
			if($res=$con->query($sql)){
				if ($res->num_rows > 0) {
					$row = $res->fetch_assoc();
					$this->SetFont('Arial','I',10);
					$this->Cell(65,20,utf8_decode("Folio: $row[Folio]"),0,0,'R');
					$this->Ln(5);	
					$this->Cell(185,20,utf8_decode("Fecha: $row[Fecha]"),0,0,'R');
				} else {
					echo "No se encontraron resultados";
				}
			}else{
				echo "Error: ".mysqli_error($con);
			}
			$con->close();

		    $this->Line(12, 30, 196, 30);
		    $this->Ln(18);
		}

		// Pie de página
		function Footer()
		{
		    // Posición: a 1,5 cm del final
		    $this->SetY(-15);
		    // Arial italic 8
		    $this->SetFont('Arial','I',8);
		    // Número de página
		    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
		}

		function cuerpo()
		{
			require('../conexion.php');

			$sql1 = "SELECT * FROM proveedores WHERE ID_Proveedor='$_GET[proveedor]'";
			
			if($res=$con->query($sql1)){
				if ($res->num_rows > 0) {
					$row = $res->fetch_assoc();
				} else {
					echo "No se encontraron resultados";
				}
			}else{
				echo "Error: ".mysqli_error($con);
			}

			$this->SetFont('Arial','',12);
			$this->SetFillColor(225, 225, 225);
			$this->Cell(90,6,utf8_decode('Proveedor'),1,1,'C',true);
			$this->Rect(10, 39, 90, 32);
			$this->SetFont('Arial','',10);
			$this->Cell(90,6,utf8_decode("$row[Nombre]"),0,1,'C');
			$this->Cell(90,6,utf8_decode("$row[Domicilio]"),0,1,'C');
			$this->Cell(90,6,utf8_decode("$row[Ciudad], $row[Estado], $row[CP]"),0,1,'C');
			$this->Cell(90,6,utf8_decode("$row[Telefono]"),0,1,'C');
			$this->Cell(90,6,utf8_decode("$row[Email]"),0,1,'C');
			$this->Ln(18);
			$this->SetFont('Arial','',9);
			$this->Cell(20,6,utf8_decode("Código"),1,0,'C',true);
			$this->Cell(45,6,utf8_decode("Producto"),1,0,'C',true);
			$this->Cell(13,6,utf8_decode("UME"),1,0,'C',true);
			$this->Cell(25,6,utf8_decode("Cantidad"),1,0,'C',true);
			$this->Cell(20,6,utf8_decode("Precio"),1,0,'C',true);
			$this->Cell(25,6,utf8_decode("Subtotal"),1,0,'C',true);
			$this->Cell(10,6,utf8_decode("Dto. %"),1,0,'C',true);
			$this->Cell(10,6,utf8_decode("IVA %"),1,0,'C',true);
			$this->Cell(20,6,utf8_decode("Total"),1,1,'C',true);
			$this->SetFont('Arial','',8);

			$sql2 = "SELECT Codigo, Nombre, UME, Cantidad, Precio_Unitario, Subtotal, Descuento, productos.IVA, Total FROM compras_detalle INNER JOIN productos ON FK_Producto=ID_Producto WHERE FK_Compra='$_GET[id]' ORDER BY Codigo";
			$subtotal=0;

			if($res2=$con->query($sql2)){
				if ($res2->num_rows > 0) {
					while($row2 = $res2->fetch_assoc()){
						$this->Cell(20,6,utf8_decode("$row2[Codigo]"),1,0,'C');
						$this->Cell(45,6,utf8_decode("$row2[Nombre]"),1,0,'C');
						$this->Cell(13,6,utf8_decode("$row2[UME]"),1,0,'C');
						$this->Cell(25,6,utf8_decode("$row2[Cantidad]"),1,0,'C');
						$this->Cell(20,6,utf8_decode("$row2[Precio_Unitario]"),1,0,'C');
						$this->Cell(25,6,utf8_decode("$row2[Subtotal]"),1,0,'C');
						$this->Cell(10,6,utf8_decode("$row2[Descuento]"),1,0,'C');
						$this->Cell(10,6,utf8_decode("$row2[IVA]"),1,0,'C');
						$this->Cell(20,6,utf8_decode("$row2[Total]"),1,1,'C');
						$subtotal += $row2['Total'];
					}
					$this->SetX(168);
					$this->Cell(10,6,"Total:",1,0,'R');
					$this->Cell(20,6,'$'.$subtotal,1,1,'C');
				} else {
					echo "No se encontraron resultados";
				}
			}else{
				echo "Error: ".mysqli_error($con);
			}
			$con->close();
			/*
			
					$this->SetFillColor(225, 225, 225);
					$this->Cell(50,6,utf8_decode("Tratamiento"),1,0,'C',true);
					
			*/		
		}
	}

	// Creación del objeto de la clase heredada
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->cuerpo();
	$pdf->Output();
?>