<?php
	session_start(); 
	print_r($_GET); 
	include "config/cred_bd.php";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}
	$delete_usuario = "DELETE FROM usuario WHERE cpUsuario=?"; 
	$delete_persona = "DELETE FROM persona WHERE cpPersona=?"; 

	$stmt = $conn->prepare($delete_usuario); 
	$stmt->bind_param("i", $_GET["cpUsuario"]); 
	$stmt->execute() ; 

	$stmt = $conn->prepare($delete_persona); 
	$stmt->bind_param("i", $_GET["cpPersona"]); 
	$stmt->execute() ; 

	$_SESSION["login"] = False ; 
	
	$stmt->close() ; 
	$conn->close() ; 

?>