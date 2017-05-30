<?php

	function hacerCadenaSelect()
	{
		$select = ""; 
		if($_POST["tipoBusqueda"] == "Especialidad")
		{
			$select .="select * from persona, domicilio, medico where domicilio.cpDomicilio = medico.cpMedico and persona.cpPersona=medico.cpPersona and medico.especialidad=";
			$select.="'".$_POST['textoBusqueda']."'"; 
		}
		elseif ($_POST["tipoBusqueda"] == "Estado") 
		{
			$select .= "select * from persona, domicilio, medico where domicilio.cpDomicilio = medico.cpMedico and persona.cpPersona=medico.cpPersona and domicilio.estado="; 
			$select.="'".$_POST['estado']."'"; 

		}
		return $select ; 
	}

	include 'config/cred_bd.php';
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
    	die("Connection failed: " . $conn->connect_error);
	}

	$select = hacerCadenaSelect($_POST); 
	$result = $conn->query($select);  

	if($result->num_rows > 0)
	{
		while ($ren = $result->fetch_assoc()) 
		{
			echo "<div><ul>";
			echo "<li>".$ren["apPaterno"]."</li>";
			echo "<li>".$ren["apMaterno"]."</li>";
			echo "<li>".$ren["nombre"]."</li>";
			echo "<li>".$ren["calle"]."</li>";
			echo "<li>".$ren["noInt"]."</li>";
			echo "<li>".$ren["noExt"]."</li>";
			echo "<li>".$ren["colonia"]."</li>";
			echo "<li>".$ren["municipio"]."</li>";
			echo "<li>".$ren["estado"]."</li>";
			echo "</ul></div>";
		}
	}
	else
	{
		echo "Sin resultados"; 
	}


?>