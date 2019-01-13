<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>QR</title>
</head>
<style>
	.hggh{
		text-align: center;
	}
</style>
<body>
	<form>
		<?php  
			echo "<input type='text' name='msg' value='$_GET[lote]' hidden>";
		?> 
	</form>
	<div id="qr" style="text-align: center;"></div>
	<div style="text-align: center;">
		<?php  
			echo "<h2>LOTE: $_GET[lote]</h2>";
		?> 
	</div>
	<script type="text/javascript" src="../JS/qrcode.js"></script>
</body>
</html>