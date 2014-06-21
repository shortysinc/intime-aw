<?php
require_once '../controlador/op_base_datos_servicio.php';
require_once '../controlador/op_base_datos_servicio.php';
require_once '../modelo/usuario.php';
require_once '../modelo/servicio.php';
session_start();

require_once '../controlador/comprobar_login.php';

$BDD = new MysqlServicio();
$BDDserv = new MysqlServicio();
$id_usuario = $_SESSION['usuario']->getId();

$favoritos = $BDD->conseguirServiciosFavoritos($id_usuario);
?>
<!DOCTYPE html>
<html lang="es">
	<?php
	include "head.php";
	?>
	<body>
		<?php include "sidebar.php";
		?>
		<div id="main-content">
			<div id="templatemo">
				<div class="section-content">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">
								<div class="buscador">
									<form method="post" action="busqueda.php" accept-charset="utf-8">
										<label>Buscar</label>
										<input type="text" name="nombrebusq" size="50">
										<button type="submit" name="submit">
											Enviar
										</button>
										<a href="busqueda.php">Búsqueda avanzada</a>
									</form>
								</div>
							</div>
						</div>
						<h1>Favoritos</h1>
						<h1></h1>
						<?php
							if(isset($favoritos)){
							foreach ($favoritos as $servicio) {
						?>
								<div class="servicio-ej">
										<?php 
											echo '<a href="servicio.php?id_servicio='.$servicio->getIdServicio().'"><h4>'.$servicio->getNombre().'</h4></a>';
										?>
										<div class="serv-nota">
										<?php
											$nota=$BDDserv->notamedia($servicio->getIdServicio());
											if (!empty($nota))
												echo"<p>Nota: ".$nota."</p>";
											else
												echo"<p>No valorado</p>";
										?>
										</div>
										<div class="serv-desc">
										<?php
											echo"<p>".$servicio->getDescripcion()."</p>";
										?>
										</div>
									</div>
						<?php
							}
							}
						?>
					</div>
					<div class="cuerpo">
						
					</div>
				</div>
				<!-- /#services -->
			</div>
			<!-- /#templatemo"-->
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content-->
		
	</body>
</html>