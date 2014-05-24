<?php
	require_once "../controlador/opbasededatos.php";
	$categoria = $_GET['categoria'];
	
	if(isset($categoria)){
		$BDD = new Mysql();
		$servicios = $BDD->conseguirServiciosCategoria($categoria);
		
		while($row = $servicios->fetch_assoc()){
			echo "entro en el bucle";
?>			
			<tr class "tabla-servicios">
			 	<td class="columna-foto">
					<a class="descripcion-servicios" href="trabajo.php"><img src="images/slide3.jpg" alt="Aqui iria una imagen"/></a>
				</td>
				<td class="columna-servicios">
					<h3><?php echo $row['nombre_servicio'] ?></h3>
					<p><?php echo $row['descripcion'] ?></p>
					<span id="nota-servicio">9.8</span>
					<span id="horas-servicio">Horas: </span>
				</td>
			</tr>
<?php
		}
	}
?>
	