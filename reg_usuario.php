<?php
	session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro Nuevos Usuarios</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
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
	if(!isset($_SESSION["login"]))
	{
	?>
		<form action="insert_usuario.php" method="POST">
			Apellido Paterno<input type="text" name="apPaterno"><br/>
			Apellido Materno<input type="text" name="apMaterno"><br/>
			Nombre(s)<input type="text" name="nombre"><br/>
			Fecha de Nacimiento <input type="date" name="fechaNacimiento"><br />
			Email<input type="email" name="correo"><br/>
			Contraseña<input type="password" name="password1"><br/>
			Repite tu contraseña<input type="password" name="password2"><br/>
			<p id="msj"></p>
			<input type="submit" name="Enviar" value="Enviar" id="formulario">
		</form>

	<?php
	}
	else
	{
		$cadena = "<a href='modificar_usuario.php?cpPersona="; 
		$cadena.= $_SESSION["cpPersona"]."&cpUsuario=";
		$cadena.= $_SESSION["cpUsuario"]."'>Modicar informacion</a>"; 
		echo $cadena;
	}
	?>

	<script>
		$("#formulario").on('click',function(event) {
			if($("input[name=password1]").val() !== $("input[name=password2]").val() ){
				$("#msj").text("Las contraseñas deben ser iguales"); 
				event.preventDefault();
			}
			else{
				$("#msj").text(""); 
			}
		});
	</script>
</body>
</html>