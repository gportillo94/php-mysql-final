<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
	<meta charset="utf-8">
</head>
<body>
	<nav>
		<a href="index.php">Inicio</a>
		<a href="mision.html">Mision</a>
		<a href="vision.html">Vision</a>
		<a href="reg_usuario.html">Registro Nuevos Usuarios</a>
		<a href="reg_medico.html">Registro de Médicos</a>
		<a href="login.php">Login</a>
	</nav>


	<?php
		session_start(); 
		if(isset($_SESSION["login"]))
		{
			echo "<h4>Listo, ya puedes buscar a tu médico</h4>";
		}
		else if( ! isset ($_SESSION["login"]) && $_POST["password"])
		{
			include "config/cred_bd.php";
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) 
			{
				die("Connection failed: " . $conn->connect_error);
			}
			$select_tabla_usuario = "SELECT password FROM usuario WHERE correo=?"; 
			$stmt = $conn->prepare($select_tabla_usuario); 
			$stmt->bind_param("s", $_POST["correo"]); 
			$stmt->execute();
			$stmt->bind_result($password); 
			$stmt->fetch(); 
			if ($password === $_POST["password"])
			{
				$_SESSION["login"] = True ; 
				echo "<h4>Listo, ya puedes buscar a tu médico</h4>";
			}
			else
			{
				echo "<h4>Oh, usuario no encontrado</h4>";
				include 'login_form.php';
			}
		}
		else
		{
			include 'login_form.php';
		}
	?>

</body>
</html>