<?php  
	require('fpdf/fpdf.php');
	
	class PDF extends FPDF
	{
		// Cabecera de página
		function Header()
		{
			require('../conexion.php');
		    $this->Image('../Imagenes/gigantes.jpg',7,7,35);
		    $this->SetFont('Arial','I',30);
		    $this->Cell(120,25,utf8_decode("Venta"),0,0,'C');

		    $sql = "SELECT Folio, DATE_FORMAT(Fecha, '%d-%m-%Y %h:%i %p') AS Fecha FROM ventas WHERE ID_Venta='$_GET[id]'";
			
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

			$sql = "SELECT Codigo, Nombre, Domicilio, Colonia, Ciudad, Estado, Pais, CP, Telefono, Email, RazonSocial AS RZ, RFC, Contacto, TelContacto AS TelConta FROM clientes WHERE ID_Cliente='$_GET[cliente]'";
			
			if($res=$con->query($sql)){
				if ($res->num_rows > 0) {
					$row = $res->fetch_assoc();
				} else {
					echo "No se encontraron resultados";
				}
			}else{
				echo "Error: ".mysqli_error($con);
			}

			$this->SetFont('Arial','',10);
			$this->SetFillColor(225, 225, 225);
			$this->Cell(90,6,utf8_decode('Cliente'),1,1,'C',true);
			$this->Rect(10, 39, 90, 60);
			$this->SetFont('Arial','',9);
			$this->Cell(90,4,utf8_decode("Código: $row[Codigo]"),0,1,'C');
			$this->Cell(90,4,utf8_decode("Nombre: $row[Nombre]"),0,1,'C');
			$this->Cell(90,4,utf8_decode("Domicilio: $row[Domicilio]"),0,1,'C');
			$this->Cell(90,4,utf8_decode("Colonia: $row[Colonia]"),0,1,'C');
			$this->Cell(90,4,utf8_decode("Ciudad: $row[Ciudad]"),0,1,'C');
			$this->Cell(90,4,utf8_decode("Estado: $row[Estado]"),0,1,'C');
			$this->Cell(90,4,utf8_decode("Pais: $row[Pais]"),0,1,'C');
			$this->Cell(90,4,utf8_decode("CP: $row[CP]"),0,1,'C');
			$this->Cell(90,4,utf8_decode("Razón social: $row[RZ]"),0,1,'C');
			$this->Cell(90,4,utf8_decode("RFC: $row[RFC]"),0,1,'C');
			$this->Cell(90,4,utf8_decode("Teléfono: $row[Telefono]"),0,1,'C');
			$this->Cell(90,4,utf8_decode("Email: $row[Email]"),0,1,'C');
			$this->Cell(90,4,utf8_decode("Contacto: $row[Contacto]"),0,1,'C');
			$this->Cell(90,4,utf8_decode("Teléfono Contacto: $row[TelConta]"),0,1,'C');
			$this->Ln(18);
			$this->SetFont('Arial','',9);
			$this->Cell(20,6,utf8_decode("Código"),1,0,'C',true);
			$this->Cell(40,6,utf8_decode("Producto"),1,0,'C',true);
			$this->Cell(13,6,utf8_decode("UME"),1,0,'C',true);
			$this->Cell(20,6,utf8_decode("Cantidad"),1,0,'C',true);
			$this->Cell(20,6,utf8_decode("Precio"),1,0,'C',true);
			$this->Cell(20,6,utf8_decode("Descuento %"),1,0,'C',true);
			$this->Cell(25,6,utf8_decode("Subtotal"),1,0,'C',true);
			$this->Cell(10,6,utf8_decode("IVA %"),1,0,'C',true);
			$this->Cell(22,6,utf8_decode("Total"),1,1,'C',true);
			$this->SetFont('Arial','',8);

			$sql1 = "SELECT Codigo, Nombre, UME, Cantidad, Precio, Descuento, Subtotal, ventas_detalle.IVA AS IVA, Total FROM ventas_detalle INNER JOIN productos ON FK_Producto=ID_Producto WHERE FK_Venta='$_GET[id]' ORDER BY Codigo";
			$subtotal=0;

			if($res1=$con->query($sql1)){
				if ($res1->num_rows > 0) {
					while($row1 = $res1->fetch_assoc()){
						$this->Cell(20,6,utf8_decode("$row1[Codigo]"),1,0,'C');
						$this->Cell(40,6,utf8_decode("$row1[Nombre]"),1,0,'C');
						$this->Cell(13,6,utf8_decode("$row1[UME]"),1,0,'C');
						$this->Cell(20,6,utf8_decode("$row1[Cantidad]"),1,0,'C');
						$this->Cell(20,6,utf8_decode("$row1[Precio]"),1,0,'C');
						$this->Cell(20,6,utf8_decode("$row1[Descuento]"),1,0,'C');
						$this->Cell(25,6,utf8_decode("$row1[Subtotal]"),1,0,'C');
						$this->Cell(10,6,utf8_decode("$row1[IVA]"),1,0,'C');
						$this->Cell(22,6,utf8_decode("$row1[Total]"),1,1,'C');
						$subtotal += $row1['Total'];
					}
					$this->SetX(168);
					$this->Cell(10,6,"Total:",1,0,'R');
					$this->Cell(22,6,'$'.$subtotal,1,1,'C');
				} else {
					echo "No se encontraron resultados";
				}
			}else{
				echo "Error: ".mysqli_error($con);
			}
			$con->close();

			$this->Ln(30);
			$this->SetX(97);
			$this->SetFont('Arial','',10);
			$this->SetX(97);
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