
<?php
	function hacerCadenaSelect()
	{
		$select = ""; 
		if($_POST["tipoBusqueda"] == "Especialidad")
		{
			$select .="SELECT * FROM persona, domicilio, medico WHERE domicilio.cpDomicilio = medico.cpMedico AND persona.cpPersona=medico.cpPersona AND medico.especialidad=";
			$select.="'".$_POST['textoBusqueda']."'"; 
		}
		elseif ($_POST["tipoBusqueda"] == "Estado") 
		{
			$select .= "SELECT * FROM persona, domicilio, medico WHERE domicilio.cpDomicilio = medico.cpMedico AND persona.cpPersona=medico.cpPersona AND domicilio.estado="; 
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
			
			echo "<li> <a href='infoMed.php?cpMedico=".$ren["cpMedico"]."''>"; 
			echo $ren["apPaterno"]." ".$ren["apMaterno"]." ".$ren["nombre"];
			echo "</a></li>";
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
	echo "<br /><a href='index.php'>Regresar</a>";
?>