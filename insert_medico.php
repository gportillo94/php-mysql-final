<?php
	include 'config/cred_bd.php';

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
    	die("Connection failed: " . $conn->connect_error);
	}

	$insert_tabla_persona = "INSERT INTO persona (apPaterno, apMaterno, nombre, fechaNacimiento) VALUES (?,?,?,?)" ;  
	$stmt = $conn->prepare($insert_tabla_persona);
	$stmt->bind_param("ssss", $apPaterno, $apMaterno, $nombre, $fechaNacimiento) ; 
	$apPaterno = $_POST["apPaterno"];
	$apMaterno = $_POST["apMaterno"];
	$nombre = $_POST["nombre"]; 
	$fechaNacimiento = $_POST["fechaNacimiento"]; 
	$stmt->execute(); 

	$cpPersona = $conn->insert_id;


	$insert_tabla_domicilio = "INSERT INTO domicilio (calle, noInt, noExt, colonia, municipio, estado)  VALUES (?,?,?,?,?,?)";
	$stmt = $conn->prepare($insert_tabla_domicilio);
	$stmt->bind_param("siisss", $calle, $noInt, $noExt, $colonia, $municipio, $estado) ; 
	$calle = $_POST["calle"]; 
	$noInt = $_POST["noInt"]; 
	$noExt = $_POST["noExt"]; 
	$colonia = $_POST["colonia"]; 
	$municipio = $_POST["municipio"]; 
	$estado = $_POST["estado"]; 
	$stmt->execute(); 

	$cpDomicilio = $conn->insert_id; 
	
	$insert_tabla_medico = "INSERT INTO medico (costo, especialidad,cpPersona, cpDomicilio) VALUES (?,?,?,?)"; 
	$stmt = $conn->prepare($insert_tabla_medico); 
	$stmt->bind_param("isii", $costo, $especialidad, $cpPersona, $cpDomicilio); 
	$especialidad = $_POST["especialidad"]; 
	$costo = $_POST["costo"]; 
	$stmt->execute(); 

	$cpMedico = $conn->insert_id; 

	$dias = ["lunes", "martes", "miercoles", "jueves", "viernes"]; 

	$insert_tabla_disponibilidad = "INSERT INTO disponibilidad (dia, horaInicio, horaFin, cpMedico)  VALUES (?,TIME(?),TIME(?),?)"; 

	for ($i=0; $i <5 ; $i++) 
	{ 
		$stmt = $conn->prepare($insert_tabla_disponibilidad); 
		$stmt->bind_param("sssi", $dia, $horaInicio, $horaFin, $cpMed); 
		$dia = $dias[$i]; 
		$horaInicio = $_POST[$dias[$i]."Ini"];
		$horaFin = $_POST[$dias[$i]."Fin"];
		$cpMed = $cpMedico;  
		$stmt->execute(); 
	}
	
	$stmt->close() ;
	$conn->close() ; 
?>
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
	<h3>Listo, medico agregado a la base de datos</h3>
	</body>
</html>