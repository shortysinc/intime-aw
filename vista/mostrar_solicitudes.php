<?php
	require_once '../controlador/op_base_datos_servicio.php';
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/servicio.php';
	require_once '../modelo/solicitud.php';
	session_start();
	//Comprobamos si el usuario ha hecho login
	require_once '../controlador/comprobar_login.php';
	
	$BDDUsuario = new MysqlUsuario();
	$BDDServicio = new MysqlServicio();
	
	if(isset($_GET['tipo']) && $_GET['tipo'] == 0){ 
	?>
	<h2>Recibidas</h2>
	<?php
		$solicitudes = $BDDUsuario->conseguirSolicitudesRecibidas($_SESSION['usuario']->getId());
		if(isset($solicitudes)){
			foreach ($solicitudes as $solicitud) {
				$servicio = $BDDServicio->conseguirServicio($solicitud->getIdServicio());
				$usuario = $BDDUsuario->conseguirUsuarioById($solicitud->getIdUsuario());
	?>
			<div class="solicitud">
				<a href="servicio.php?id_servicio=<?php echo $servicio->getIdServicio(); ?>">
					<h5><?php echo $servicio->getNombre() ?></h5>
				</a>
				<a href="perfil.php?id_usuario=<?php echo $usuario->getId() ?>"><?php echo $usuario->getNombre() ?></a>
				<p><?php echo $usuario->getCorreo() ?></p>
				<p><?php echo $solicitud->getComentario() ?></p>
				<p><?php echo $solicitud->getFechaFormateada() ?></p>
				<form action="solicitudes.php" method="post" accept-charset="utf-8">
					<button type="submit" name="solicitud" value="aceptar">
						Aceptar
					</button>
					<button type="submit" name="solicitud" value="denegar">
						Denegar
					</button>
				</form>
			</div>
	<?php }
				}else{
					echo "<div class='solicitud'>";
					echo "<h4>Ninguna solicitud recibida<h4>";
					echo "</div>";
				}
	}else if(isset($_GET['tipo']) && $_GET['tipo'] == 1){
		$solicitudes = $BDDUsuario->conseguirSolicitudesEnviadas($_SESSION['usuario']->getId());
		if(isset($solicitudes)){
			foreach ($solicitudes as $solicitud) {
				$servicio = $BDDServicio->conseguirServicio($solicitud->getIdServicio());
				$usuario = $BDDUsuario->conseguirUsuarioById($servicio->getIdUsuario());
	?>
				<h2>Enviadas</h2>
				<div class="solicitud">
					<a href="servicio.php?id_servicio=<?php echo $servicio->getIdServicio(); ?>">
						<h5><?php echo $servicio->getNombre() ?></h5>
					</a>
					<a href="perfil.php?id_usuario=<?php echo $usuario->getId() ?>">
						<?php echo $usuario->getNombre() ?>
					</a>
					<p><?php echo $usuario->getCorreo() ?></p>
					<p><?php echo $solicitud->getComentario() ?></p>
					<p> Enviado: <?php echo $solicitud->getFechaFormateada() ?> </p>
					<p>Estado: Pendiente</p>
				</div>
<?php 
			}
		}else{
			echo "<div class='solicitud'>";
			echo "<h4>Ninguna solicitud enviada<h4>";
			echo "</div>";
		}
	} 
?>