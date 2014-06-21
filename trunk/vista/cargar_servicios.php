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
		if(isset($servicios)){
			foreach($servicios as $servicio){
				$nota = $BDD->notamedia($servicio->getIdServicio());
?>	
				<tr class "fila-servicios">
				 	<td class="columna-foto">
						<a class="descripcion-servicios" href="<?php echo "servicio.php?id_servicio=".$servicio->getIdServicio() ?>">
							<?php 
							if ($servicio->getFoto()!=NULL)	{
								echo "<img src='images/servicio/".$servicio->getFoto()."'";
							}
							ELSE{
								echo '<img src="images/servicio/service_defect.png">';	
							}
					?>
						</a>
					</td>
					<td class="columna-servicios">
						<h3><a href="<?php echo "servicio.php?id_servicio=".$servicio->getIdServicio() ?>">
								<?php echo $servicio->getNombre()?>
							</a>
						</h3>
						<p><?php echo $servicio->getDescripcion()?></p>
						<span id="nota-servicio">Nota: <span class="negrita"><?php echo $nota ?></span></span>
						<span id="horas-servicio"><span class="negrita"><?php echo $servicio->getHoras()?> h</span></span>
					</td>
				</tr>	
<?php
			}
		}else{
			echo "<h3>Actualmente no hay servicios para ésta categoría</h3>";
		}
?>
		</table>
<?php
	}
?>
	