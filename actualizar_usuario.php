<?php
	include 'config/cred_bd.php';
	$conn = new mysqli($servername, $username, $password, $dbname);

	$update_persona = "UPDATE persona SET apPaterno=?, apMaterno=?, nombre=?,fechaNacimiento=? WHERE cpPersona=?"; 
	$update_usuario = "UPDATE usuario SET correo=?, password=? WHERE cpUsuario=?"; 
	$stmt = $conn->prepare($update_persona);
	$stmt->bind_param("ssssi", $_POST["apPaterno"],$_POST["apMaterno"] ,$_POST["nombre"] ,$_POST["fechaNacimiento"],$_POST["cpPersona"]); 
	$stmt->execute(); 
	$stmt->close() ; 

	$stmt = $conn->prepare($update_usuario);
	$stmt->bind_param("ssi", $_POST["correo"], $_POST["password1"], $_POST["cpUsuario"]);
	$stmt->execute(); 
	$stmt->close() ; 	 

	$conn->close(); 
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<nav>
		<a href="index.php">Inicio</a>
		<a href="mision.html">Mision</a>
		<a href="vision.html">Vision</a>
		<a href="reg_usuario.php">Registro Nuevos Usuarios</a>
		<a href="reg_medico.html">Registro de Médicos</a>
		<a href="login.php">Login</a>
		</nav>
		<h3>Listo, tu informacion ha sido actualizada</h3>
	</body>
</html>