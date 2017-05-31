<?php

	include 'config/cred_bd.php';
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
    	die("Connection failed: " . $conn->connect_error);
	}

	$select_nombre = "SELECT * FROM persona WHERE cpPersona = (SELECT cpPersona FROM medico WHERE cpMedico=".$_GET["cpMedico"].")"; 

	$select_disponibilidad = "SELECT * FROM medico, disponibilidad WHERE medico.cpMedico=disponibilidad.cpMedico AND medico.cpMedico=".$_GET["cpMedico"]; 
	$result = $conn->query($select_nombre); 
	while ($ren = $result->fetch_assoc()) 
	{
		echo "<h3>";
		echo $ren["apPaterno"]." ".$ren["apMaterno"]." ".$ren[nombre];
		echo "</h3>";
	}

	$result = $conn->query($select_disponibilidad); 
	while ($ren = $result->fetch_assoc()) 
	{
		echo "<div><ui>";
		echo $ren["dia"]." ".$ren["horaInicio"]." ".$ren["horaFin"]; 
		echo "</ui></div>";
	}

?>