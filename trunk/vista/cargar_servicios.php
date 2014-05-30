<?php
	require_once '../controlador/op_base_datos_servicio.php';
	require_once '../modelo/servicio.php';
	if(isset($_GET['id_categoria'])){
		$id_categoria = $_GET['id_categoria'];
		$BDD = new MysqlServicio();
		$servicios = $BDD->conseguirServiciosPorCategoria($id_categoria);
?>
		<table id = "tabla-servicios">
<?php
		foreach($servicios as $row){
			$servicio = $row;
?>	
			<tr class "fila-servicios">
			 	<td class="columna-foto">
					<a class="descripcion-servicios" href="trabajo.php"><img src="images/slide3.jpg" alt="Aqui iria una imagen"/></a>
				</td>
				<td class="columna-servicios">
					<h3><a href="<?php echo "servicio.php?id_servicio=".$servicio->getIdServicio() ?>">
							<?php echo $servicio->getNombre()?>
						</a>
					</h3>
					<p><?php echo $servicio->getDescripcion()?></p>
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
	