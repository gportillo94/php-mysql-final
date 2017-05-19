<?php
	print_r($_POST); 
	include 'config/cred_bd.php';

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
    	die("Connection failed: " . $conn->connect_error);
	}
	
	$insert_tabla_persona = "INSERT INTO persona (apPaterno, apMaterno, nombre, fechaNacimiento) VALUES (?,?,?,DATE(?))" ;  
	$stmt = $conn->prepare($insert_tabla_persona);
	$stmt->bind_param("ssss", $apPaterno, $apMaterno, $nombre , $fechaNacimiento) ; 
	$apPaterno = $_POST["apPaterno"];
	$apMaterno = $_POST["apMaterno"];
	$nombre = $_POST["nombre"];
	$fechaNacimiento = $_POST["fechaNacimiento"];
	$stmt->execute() ; 
	$stmt->close() ;

	$insert_tabla_usuario = "INSERT INTO usuario (correo, password, cpPersona)  VALUES (?,?,?)";
	$stmt = $conn->prepare($insert_tabla_usuario);
	$stmt->bind_param("ssi", $correo, $password, $cpPersona) ; 
	$correo = $_POST["correo"]; 
	$password = $_POST["password1"]; 
	$cpPersona = $conn->insert_id; 
	$stmt->execute() ; 
	$stmt->close() ;

	$conn->close() ; 
?>