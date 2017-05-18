<?php
	print_r($_POST); 
	include 'config/cred_bd.php';

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
    	die("Connection failed: " . $conn->connect_error);
	}

	$insert_tabla_persona = "INSERT INTO persona (apPaterno, apMaterno, nombre) VALUES (?,?,?)" ;  
	$stmt = $conn->prepare($insert_tabla_persona);
	$stmt->bind_param("sss", $apPaterno, $apMaterno, $nombre) ; 
	$apPaterno = $_POST["apPaterno"];
	$apMaterno = $_POST["apMaterno"];
	$nombre = $_POST["nombre"]; 
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
	
	$insert_tabla_medico = "INSERT INTO medico (costo, cpPersona, cpDomicilio) VALUES (?,?,?)"; 
	$stmt = $conn->prepare($insert_tabla_medico); 
	$stmt->bind_param("iii", $costo, $cpPersona, $cpDomicilio); 
	$costo = $_POST["costo"]; 
	$stmt->execute(); 




	$stmt->close() ;
	$conn->close() ; 
?>