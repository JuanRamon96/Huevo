<?php  
    session_start();
    if(isset($_SESSION['user'])){
            header('Location: App/');
    }else{
        header('Location: ');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Login</title>
	<link rel="icon" href="Imagenes/egg.png">
	<link rel="stylesheet" href="CSS/bootstrap.min.css">
	<link rel="stylesheet" href="CSS/login.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3 login">
				<img src="Imagenes/users.svg" width="40%" id="logo">
				<form id="login">
					<div class="form-group">
						<div class="input-group">
  							<div class="input-group-prepend">
    							<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
  							</div>
  							<input type="text" class="form-control form-control-lg" placeholder="Usuario" name="Usuario" id="Usuario" required>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
  							<div class="input-group-prepend">
    							<span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
  							</div>
  							<input type="password" class="form-control form-control-lg" placeholder="Contraseña" name="Contrasena" id="Contrasena" required>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-lg btn-block" id="btnIni">Iniciar sesión</button>
					</div>
				</form>
				<div class="alert alert-danger text-center" id="alerta">
 	 			 	<b>Usuario o Contraseña incorrectos!</b>
				</div>
			</div>
		</div>
	</div>

<script src="JS/jquery-3.3.1.min.js"></script>
<script src="JS/bootstrap.min.js"></script>	
<script src="JS/fontawesome-all.min.js"></script>
<script src="JS/login.js"></script>
</body>
</html>