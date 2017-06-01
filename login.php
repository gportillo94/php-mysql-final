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
		<a href="reg_usuario.php">Registro Nuevos Usuarios</a>
		<a href="reg_medico.html">Registro de Médicos</a>
		<a href="login.php">Login</a>
	</nav>

	<?php
		session_start(); 
		if(isset($_SESSION["login"]) && $_SESSION["login"] == True)
		{
			echo "<h4>Listo, ya puedes buscar a tu médico asdas</h4>";
			echo "<a href='eliminar_cuenta.php?cpUsuario=".$_SESSION["cpUsuario"]."&cpPersona=".$_SESSION["cpPersona"]."'>Eliminar mi cuenta</a>"; 
		

		}
		else if(!isset ($_SESSION["login"]) && isset($_POST["password"]))
		{
			include "config/cred_bd.php";	
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) 
			{
				die("Connection failed: " . $conn->connect_error);
			}
			$select_tabla_usuario = "SELECT cpUsuario,cpPersona,password FROM usuario WHERE correo=?"; 
			$stmt = $conn->prepare($select_tabla_usuario); 
			$stmt->bind_param("s", $_POST["correo"]); 
			$stmt->execute();
			$stmt->bind_result($cpUsuario,$cpPersona,$pass); 
			$stmt->fetch(); 
			if ($pass === $_POST["password"])
			{
				$_SESSION["login"] = True ; 
				$_SESSION["cpUsuario"] = $cpUsuario; 
				$_SESSION["cpPersona"] = $cpPersona; 
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