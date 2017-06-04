<?php
	include 'config/cred_bd.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) 
	{
    	die("Connection failed: " . $conn->connect_error);
	}
	$select_persona = "SELECT apPaterno, apMaterno, nombre, fechaNacimiento FROM persona WHERE cpPersona = ?"; 
	$select_usuario = "SELECT correo FROM usuario WHERE cpUsuario=?";

	$stmt = $conn->prepare($select_persona);
	$stmt->bind_param("i", $_GET["cpPersona"]); 
	$stmt->execute(); 
	$stmt->bind_result($apPaterno, $apMaterno, $nombre, $fechaNacimiento); 
	$stmt->fetch() ; 

	$stmt->close(); 

	$stmt = $conn->prepare($select_usuario);
	$stmt->bind_param("i", $_GET["cpUsuario"]); 
	$stmt->execute(); 
	$stmt->bind_result($correo); 
	$stmt->fetch() ; 

	$stmt->close(); 
	$conn->close(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
	<form action="actualizar_usuario.php" method="POST">
		Apellido Paterno<input type="text" name="apPaterno" value=<?php echo $apPaterno;?>><br/>
		Apellido Materno<input type="text" name="apMaterno" value=<?php echo $apMaterno;?>><br/>
		Nombre(s)<input type="text" name="nombre" value=<?php echo $nombre;?>><br/>
		Fecha de Nacimiento <input type="date" name="fechaNacimiento" value=<?php echo $fechaNacimiento;?>><br />
		Email<input type="email" name="correo" value=<?php echo $correo;?>><br/>
		Nueva Contraseña<input type="password" name="password1"><br/>
		Repite tu nueva contraseña<input type="password" name="password2"><br/>
		<p id="msj"></p>
		<input type="number" name="cpUsuario" value=<?php echo $_GET["cpUsuario"];?> style="display: none">
		<input type="number" name="cpPersona" value=<?php echo $_GET["cpPersona"];?> style="display: none">
		<input type="submit" name="Enviar" value="Enviar" id="formulario">
	</form>
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