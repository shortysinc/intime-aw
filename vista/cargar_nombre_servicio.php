<?php
	require_once "../controlador/opbasededatos.php";
	$servicio = $_GET['servicio'];
	
	if(isset($servicio)){
		echo $servicio;
		$BDD = new Mysql();
		$servicios = $BDD->conseguirServicio($servicio);
		while($row = $servicios->fetch_assoc()){
?>			<ul>
				<!--<li id="lista-servicios">
					<h3><?php echo $row['nombre_servicio'] ?></h3>
				</li>-->
					<h3><?php echo $row['nombre_servicio'] ?></h3>
			</ul>
<?php
		}
	}
?>
	