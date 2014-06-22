<!DOCTYPE html>
<html lang="es">
<?php 
require_once '../modelo/usuario.php';
session_start();
?>
	<?php include "head.php"?>
	<?php
	require_once '../controlador/op_base_datos_servicio.php';

	$BDD = new MysqlServicio();
	$resultadoCategorias = $BDD -> conseguirTodasLasCategorias();
	?>
	<script src="jquery/jquery-2.1.0.min.js" type="text/javascript"></script>
	<body>
		<?php include "sidebar.php"
		?>
		<div id="main-content">
			<div id="templatemo">
				<div id="services" class="section-content">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">

								<h2>Servicios</h2>
								<div class="buscador">
									<form method="post" action="busqueda.php" accept-charset="utf-8">
										<label>Buscar</label>
										<input type="text" name="nombrebusq" size="50">
										<button type="submit" name="submit" value="Enviar">
											Enviar
										</button>
										<a href="busqueda.php">Búsqueda avanzada</a>
									</form>
								</div>

							</div>
							<script>
								function mostrarServicios(categoria){
									$("#lista-servicios").load("cargar_servicios.php?id_categoria="+categoria);
								}
							</script>
							<div class="cuerpo" id="servicios">
								<ul class = "lista-categorias">
									<?php 
										if(isset($resultadoCategorias)){
											foreach($resultadoCategorias as $row){
									?>	
											<li id="elem-categoria">
												<a href="#" onclick="mostrarServicios(<?php echo "'".$row['id_categoria']."'"?>)"><?php echo $row['categoria'] ?></a>
											</li>		
									<?php	
											}
										}else{
											echo "<h3>Aún no tenemos ninguna categoría disponible<h3>";
										}
									?>
								</ul>
								<div id="lista-servicios"></div>
							</div>
						</div>
					</div>
					<!-- /#services -->
				</div>
				<!-- /#templatemo"-->
				<?php include 'footer.php'
				?>
			</div>
			<!-- /#main-content-->
		</div>
	</body>
</html>