<?php
	require_once "../controlador/opbasededatos.php";
	$categoria = $_GET['categoria'];
	
	if(isset($categoria)){
		echo $categoria;
		$BDD = new Mysql();
		$servicios = $BDD->conseguirServiciosCategoria($categoria);
		while($row = $servicios->fetch_assoc()){
?>			<ul>
				<li id="lista-servicios">
					<h3><?php echo $row['nombre_servicio'] ?></h3>
				</li>
			</ul>
<?php
		}
	}
?>
	