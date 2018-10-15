<?php  
	require('fpdf/fpdf.php');
	
	class PDF extends FPDF
	{
		// Cabecera de página
		function Header()
		{
			require('../conexion.php');
		    // Logo
		    $this->Image('../Imagenes/tooth.png',15,15,20);
		    // Arial bold 15
		    $this->SetFont('Arial','I',30);

		    $sql = "SELECT * FROM generales";
			
			if($res=$con->query($sql)){
				if ($res->num_rows > 0) {
					$row = $res->fetch_assoc();
					$this->Cell(120,40,utf8_decode($row['Nombre']),0,0,'C');
					$this->SetFont('Courier','I',10);
					$this->Cell(65,20,utf8_decode("Dr. $row[Dentista]"),0,0,'R');
					$this->Ln(5);	
					$this->Cell(185,20,utf8_decode("$row[Domicilio] $row[Colonia]"),0,0,'R');
					$this->Ln(5);
					$this->Cell(185,20,utf8_decode("$row[Ciudad] $row[Estado]"),0,0,'R');
					$this->Ln(5);
					$this->Cell(185,20,utf8_decode("Tel. $row[Telefono]"),0,0,'R');
					$this->Ln(5);
					$this->Cell(185,20,utf8_decode("$row[Email]"),0,0,'R');
					$this->Ln(5);
					$this->Cell(185,20,utf8_decode("Cédula Profesional: $row[Cedula]"),0,0,'R');
				} else {
					echo "No se encontraron resultados";
				}
			}else{
				echo "Error: ".mysqli_error($con);
			}
			$con->close();

		    $this->Line(12, 50, 196, 50);
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

			$sql = "SELECT Descuento, Total, DATE_FORMAT(Fecha, '%d-%m-%Y') AS Fecha, Status, Nombre, Ap_Pat, Ap_Mat, Ortodoncia FROM adeudos INNER JOIN pacientes ON ID_Paciente=FK_Paciente WHERE ID_Adeudo=(SELECT FK_Adeudo FROM pagos WHERE ID_Pago='$_GET[id]')";
					
			if($res=$con->query($sql)){
				if ($res->num_rows > 0) {
					$row = $res->fetch_assoc();
				} else {
					echo "No se encontraron resultados";
				}
			}else{
				echo "Error: ".mysqli_error($con);
			}

			$sql1 = "SELECT LPAD(ID_Pago, 8, '0') AS Folio, Concepto, Persona, Tipo_Pago, DATE_FORMAT(Fecha, '%d-%m-%Y %r') AS Fecha, Total, (SELECT SUM(Total) FROM pagos WHERE FK_Adeudo=(SELECT FK_Adeudo FROM pagos WHERE ID_Pago='$_GET[id]') AND Cancelado='0' AND ID_Pago<'$_GET[id]') AS suma FROM pagos WHERE ID_Pago='$_GET[id]' AND Cancelado='0'";
			
			if($res1=$con->query($sql1)){
				if ($res1->num_rows > 0) {
					$row1 = $res1->fetch_assoc();
				} else {
					echo "No se encontraron resultados";
				}
			}else{
				echo "Error: ".mysqli_error($con);
			}

			$this->SetFont('Arial','',20);
			$this->Cell(180,10,utf8_decode('Comprobante de Pago'),0,0,'C');
			$this->Ln(10);
			$this->SetFont('Arial','',12);
			$this->SetFillColor(250, 250, 250);
			$this->Cell(185,10,utf8_decode("Fecha de Pago: $row1[Fecha]   Folio: $row1[Folio]"),0,1,'R');
			if($row["Ortodoncia"]=='1'){
				$this->Cell(185,10,utf8_decode("Método de Pago: $row1[Tipo_Pago]   Concepto: $row1[Concepto]"),0,1,'R');
			}else{
				$this->Cell(185,10,utf8_decode("Método de Pago: $row1[Tipo_Pago]"),0,1,'R');
			}
			$this->Ln(5);
			$this->SetX(15);
			$this->Cell(180,6,utf8_decode("Recibí de: $row1[Persona]"),0,1,'L');
			$this->Ln(3);
			$this->SetX(15);	
			$this->Cell(180,6,utf8_decode("Paciente: $row[Nombre] $row[Ap_Pat] $row[Ap_Mat]"),0,1,'L');
			$this->Ln(8);

			$sql2 = "SELECT Costo, Descuento, Pza, Total, Nombre FROM adeudos_detalle INNER JOIN tratamientos ON FK_Tratamiento=ID_Tratamiento WHERE FK_Adeudo=(SELECT FK_Adeudo FROM pagos WHERE ID_Pago='$_GET[id]')";
			$subtotal=0;

			if($res2=$con->query($sql2)){
				if ($res2->num_rows > 0) {
					$this->SetX(15);
					$this->SetFillColor(225, 225, 225);
					$this->Cell(50,6,utf8_decode("Tratamiento"),1,0,'C',true);
					$this->Cell(15,6,utf8_decode("Pza"),1,0,'C',true);
					$this->Cell(35,6,utf8_decode("Costo"),1,0,'C',true);
					$this->Cell(35,6,utf8_decode("Descuento"),1,0,'C',true);
					$this->Cell(40,6,utf8_decode("Total"),1,1,'C',true);

					while($row2 = $res2->fetch_assoc()){
						$this->SetX(15);
						$this->Cell(50,6,utf8_decode($row2['Nombre']),1,0,'C');
						$this->Cell(15,6,$row2['Pza'],1,0,'C');
						$this->Cell(35,6,'$'.$row2['Costo'],1,0,'C');
						$this->Cell(35,6,"$row2[Descuento]%",1,0,'C');
						$this->Cell(40,6,'$'.$row2['Total'],1,1,'C');
						$subtotal += $row2['Total'];
					}
					$this->SetX(80);
					$this->Cell(70,6,"Subtotal:",1,0,'R');
					$this->Cell(40,6,'$'.$subtotal,1,1,'C');
					$this->SetX(80);
					$this->Cell(70,6,"Descuento: $row[Descuento]% Total:",1,0,'R');
					$this->Cell(40,6,'$'.$row['Total'],1,1,'C');
					$this->SetX(80);
					$this->Cell(70,6,"Total pagos Anteriores:",1,0,'R');
					if($row1['suma']>0){
						$this->Cell(40,6,'$'.$row1['suma'],1,1,'C');	
					}else{
						$this->Cell(40,6,'$0',1,1,'C');
					}
					$this->SetX(80);
					$this->Cell(70,6,"Pago Actual:",1,0,'R');
					$this->Cell(40,6,'$'.$row1['Total'],1,1,'C');
					$this->SetX(80);
					$this->Cell(70,6,"Total Pagado:",1,0,'R');
					$this->Cell(40,6,'$'.($row1['Total']+$row1['suma']),1,1,'C');
					$this->SetX(80);
					$this->Cell(70,6,"Adeudo Restante:",1,0,'R');
					$this->Cell(40,6,'$'.($row['Total']-($row1['Total']+$row1['suma'])),1,1,'C');
					$this->SetX(80);
					$this->Cell(70,6,"Saldo a Favor:",1,0,'R');
					if($row['Total']-($row1['Total']+$row1['suma'])<0){
						$this->Cell(40,6,'$'.(($row['Total']-($row1['Total']+$row1['suma']))*-1),1,1,'C');
					}else{
						$this->Cell(40,6,'$0',1,1,'C');
					}
					$this->Ln(8);
					$this->Cell(180,6,'Pago Actual Con Letra:',0,1,'L');
					$this->Cell(180,6,'***('.trim(valorEnLetras($row1['Total'])).')***',1,1,'C');
					$this->SetFont('Arial','',14);
					$this->Ln(30);
					$this->Cell(190,6,utf8_decode("__________________________"),0,1,'C');
					$this->Cell(190,6,utf8_decode("Firma"),0,1,'C');
				} else {
					echo "No se encontraron resultados";
				}
			}else{
				echo "Error: ".mysqli_error($con);
			}
			$con->close();
		}
	}

	// Creación del objeto de la clase heredada
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->cuerpo();
	$pdf->Output();
?>