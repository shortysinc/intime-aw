<?php
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../controlador/op_base_datos_servicio.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/solicitud.php';
	session_start();
	
	//Comprobamos si el usuario ha hecho login
	require_once '../controlador/comprobar_login.php';
	
	$BDDUsuario = new MysqlUsuario();
	$BDDServicio = new MysqlServicio();
	
	if(!isset($_GET['tipo'], $_GET['estado'])  || ($_GET['estado'] < 0  && $_GET['estado'] > 3) ){
		//Si ocurre esto no se muestra nada
		
	//Solicitudes recibidas
	}else if($_GET['tipo'] == 0){
		$solicitudes = $BDDUsuario->conseguirSolicitudesRecibidas($_SESSION['usuario']->getId());
		$estado = Solicitud::parsearEstado($_GET['estado']);
		$estado = $estado != NULL ? $estado.="s" : $estado="Todas";
		echo "<h3>".$estado."</h3>";
		$i = 0;
		if($solicitudes != NULL)
			foreach ($solicitudes as $solicitud) {
				if($solicitud->getEstado() == $_GET['estado'] || $_GET['estado'] == 3){
					$i++;
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
<?php
						if($solicitud->getEstado() == 1){
							echo "<p class='solicitud-aceptada'>Aceptada</p>";
						}else if($solicitud->getEstado() == 2){
							echo "<p class='solicitud-rechazada'>Rechazada</p>";
						}else{
?>
							<form action="solicitudes.php" method="post" accept-charset="utf-8">
								<button type="submit" name="solicitud" value="aceptar">
									Aceptar
								</button>
								<button type="submit" name="solicitud" value="denegar">
									Denegar
								</button>
							</form>
<?php
						}
?>
					</div>
<?php
				}
			}
		if($i==0){
			echo "<div class='solicitud'>";
			echo "<h4>Ninguna solicitud enviada ".Solicitud::parsearEstado($_GET['estado'])."<h4>";
			echo "</div>";
		}
	//Solicitudes enviadas
	}else if($_GET['tipo'] == 1){
		$solicitudes = $BDDUsuario->conseguirSolicitudesEnviadas($_SESSION['usuario']->getId());
		$estado = Solicitud::parsearEstado($_GET['estado']);
		$estado = $estado != NULL ? $estado.="s" : $estado="Todas";
		echo "<h3>".$estado."</h3>";
		$i = 0;
		if($solicitudes != NULL)
			foreach ($solicitudes as $solicitud) {
				if($solicitud->getEstado() == $_GET['estado'] || $_GET['estado'] == 3){
					$i++;
					$servicio = $BDDServicio->conseguirServicio($solicitud->getIdServicio());
?>
					<div class="solicitud">
						<a href="servicio.php?id_servicio=<?php echo $servicio->getIdServicio(); ?>">
							<h5><?php echo $servicio->getNombre() ?></h5>
						</a>
						<p><?php echo $solicitud->getComentario() ?></p>
						<p><?php echo $solicitud->getFechaFormateada() ?></p>
<?php
						if($solicitud->getEstado() == 0){
							echo "<p>Pendiente</p>";
						}else if($solicitud->getEstado()== 1){
							echo "<p class='solicitud-aceptada'>Aceptada</p>";
						}else{
							echo "<p class='solicitud-rechazada'>Rechazada</p>";
						}
?>
					</div>
<?php
				}
			}
		if($i==0){
			echo "<div class='solicitud'>";
			echo "<h4>Ninguna solicitud enviada ".Solicitud::parsearEstado($_GET['estado'])."<h4>";
			echo "</div>";
		}
	}
?>