<?php
	session_start(); 
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Inicio</title>
		<meta charset="utf-8">
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	</head>
	<body>
		<nav>
			<a href="index.php">Inicio</a>
			<a href="mision.html">Mision</a>
			<a href="vision.html">Vision</a>
			<a href="reg_usuario.html">Registro Nuevos Usuarios</a>
			<a href="reg_medico.html">Registro de Médicos</a>
			<a href="login.php">Login</a>
		</nav>
		<h3>Busca a tu Médico</h3>
		<form>
			<select name="tipoBusqueda">
				<option>Especialidad</option>
				<option>Estado</option>		
			</select>
			<input type="text" name="textoBusqueda">
			<select name="estado" style="display: none;">
				<option>Aguascalientes</option>
				<option>Baja California</option>
				<option>Baja California Sur</option>
				<option>Campeche</option>
				<option>Chiapas</option>
				<option>Chihuahua</option>
				<option>Coahuila</option>
				<option>Colima</option>
				<option>Mexico City</option>
				<option>Durango</option>
				<option>Guanajuato</option>
				<option>Guerrero</option>
				<option>Hidalgo</option>
				<option>Jalisco</option>
				<option>México</option>
				<option>Michoacán</option>
				<option>Morelos</option>
				<option>Nayarit</option>
				<option>Nuevo León</option>
				<option>Oaxaca</option>
				<option>Puebla</option>
				<option>Querétaro</option>
				<option>Quintana Roo</option>
				<option>San Luis Potosí</option>
				<option>Sinaloa</option>
				<option>Sonora</option>
				<option>Tabasco</option>
				<option>Tamaulipas</option>
				<option>Tlaxcala</option>
				<option>Veracruz</option>
				<option>Yucatán</option>
				<option>Zacatecas</option>
			</select>
			<br />
			<input type="submit" name="enviar" value="Busca" <?php if(!$_SESSION["login"]) echo "id='buscar'";?>  >
			<p id="msjLogin"></p>
		</form>
		<script>

			function main(){
				$("select[name=tipoBusqueda]").val("Especialidad"); 
					$("select[name=tipoBusqueda]").change(function(event) {
						if($("select[name=tipoBusqueda]").val() === "Estado"){
							$("input[name=textoBusqueda]").hide();
							$("select[name=estado]").show();
						}
						else if ($("select[name=tipoBusqueda]").val() === "Especialidad"){
							$("select[name=estado]").hide();
							$("input[name=textoBusqueda]").show();
					}
				});
				$("#buscar").on('click', function(event) {
					$("#msjLogin").text("Para buscar a tu médico registrate o inicia sesión");
					event.preventDefault();

				});
			}
			$(document).ready(main);
		</script>
	</body>
	</html>