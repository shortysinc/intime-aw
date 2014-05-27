<?php
	require_once "../controlador/opbasededatos.php";
	$categoria = $_GET['categoria'];
	
	if(isset($categoria)){
		$BDD = new Mysql();
		$servicios = $BDD->conseguirServiciosCategoria($categoria);
?>
		<table id = "tabla-servicios">
<?php
		while($row = $servicios->fetch_assoc()){
?>	
			<tr class "fila-servicios">
			 	<td class="columna-foto">
					<a class="descripcion-servicios" href="trabajo.php"><img src="images/slide3.jpg" alt="Aqui iria una imagen"/></a>
				</td>
				<td class="columna-servicios">
					<h3><?php echo $row['nombre_servicio'] ?></h3>
					<p><?php echo $row['descripcion'] ?></p>
					<span id="nota-servicio">Nota: <span id="negrita">9.8</span></span>
					<span id="horas-servicio"><span id="negrita">1 h</span></span>
				</td>
			</tr>
				
<?php
		}
?>
		</table>
<?php
	}
?>
	