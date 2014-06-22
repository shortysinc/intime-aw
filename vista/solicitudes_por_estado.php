<?php
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../controlador/op_base_datos_servicio.php';
	require_once '../controlador/op_base_datos_respuesta.php';
	require_once '../modelo/respuesta.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/solicitud.php';
	session_start();
	
	//Comprobamos si el usuario ha hecho login
	require_once '../controlador/comprobar_login.php';
	
	$BDDUsuario = new MysqlUsuario();
	$BDDServicio = new MysqlServicio();
	

	if(!isset($_GET['tipo']) || !isset($_GET['estado'])  || ($_GET['estado'] < 0  && $_GET['estado'] > 3) ){
		//Si ocurre esto no se muestra nada
		
	//Solicitudes recibidas
	}else if($_GET['tipo'] == 0){
		$solicitudes = $BDDUsuario->conseguirSolicitudesRecibidas($_SESSION['usuario']->getId());
		$estado = Solicitud::parsearEstado($_GET['estado']);
		$estado = $estado != NULL ? $estado.="s" : $estado="Todas";
		echo "<h3>".$estado."</h3>";
		$i = 0;
		if(isset($solicitudes))
			foreach ($solicitudes as $solicitud) {
				if($solicitud->getEstado() == $_GET['estado'] || $_GET['estado'] == 3){
					$i++;
					$servicio = $BDDServicio->conseguirServicio($solicitud->getIdServicio());
					$usuario = $BDDUsuario->conseguirUsuarioById($solicitud->getIdUsuario());
?>		
					<div class="solicitud">
						<p><a class="nombre-servicio" href="servicio.php?id_servicio=<?php echo $servicio->getIdServicio(); ?>">
							<?php echo $servicio->getNombre() ?>
						</a></p>
						<a href="perfil.php?id_usuario=<?php echo $usuario->getId() ?>"><?php echo $usuario->getNombre() ?></a>
						<p><?php echo $usuario->getCorreo() ?></p>
						<p><?php echo $solicitud->getComentario() ?></p>
						<p><span class='verde'>Inicio: <?php echo $solicitud->getInicioFormateada() ?></span>  - <span class='rojo'>Fin: <?php echo $solicitud->getFinFormateada() ?></span></p>
						<p><?php echo "Enviada: ".$solicitud->getFechaFormateada() ?></p>
						
<?php
						if($solicitud->getEstado() == 1){
							echo "<p class='solicitud-aceptada'>Aceptada</p>";
						}else if($solicitud->getEstado() == 2){
							echo "<p class='solicitud-rechazada'>Rechazada</p>";
						}else{
?>
							<form action="../controlador/aceptar_rechazar_solicitud.php" method="post" accept-charset="utf-8">
								<button type="submit" name="aceptar" value="<?php echo $solicitud->getIdSolicitud() ?>">
									Aceptar
								</button>
								<button type="submit" name="rechazar" value="<?php echo $solicitud->getIdSolicitud() ?>">
									Rechazar
								</button>
							</form>
<?php
						}			
						$BDDRespuesta = new MysqlRespuesta();
						$respuestas = $BDDRespuesta->conseguirRespuestasASolicitud($solicitud->getIdSolicitud());
						if(isset($respuestas)){
?>
							<div id="dialogo">
								<a id="mov<?php echo $solicitud->getIdSolicitud() ?>" class="mostrar-ocultar" onclick="mostrarDialogo(0, <?php echo $solicitud->getIdSolicitud() ?>)">Mostrar diálogo</a>
								<ul id="lista-respuestas<?php echo $solicitud->getIdSolicitud() ?>" class="lista-respuestas">
								</ul>
							</div>
<?php
						}else{
?>
							<form method="post" onclick="enviarRespuesta()" action="../controlador/enviar_respuesta.php" accept-charset="UTF-8">
								<textarea name="respuesta" cols="25" rows="4" placeholder="Escribe tu respuesta"></textarea><br />
								<button type="submit">Enviar</button>
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
		if(isset($solicitudes))
			foreach ($solicitudes as $solicitud) {
				if($solicitud->getEstado() == $_GET['estado'] || $_GET['estado'] == 3){
					$i++;
					$servicio = $BDDServicio->conseguirServicio($solicitud->getIdServicio());
?>
					<div class="solicitud">
						<p><a class="nombre-servicio" href="servicio.php?id_servicio=<?php echo $servicio->getIdServicio(); ?>">
							<?php echo $servicio->getNombre() ?>
						</a></p>
						<p><?php echo $solicitud->getComentario() ?></p>
						<p><span class='verde'>Inicio: <?php echo $solicitud->getInicioFormateada() ?></span>  - <span class='rojo'>Fin: <?php echo $solicitud->getFinFormateada() ?></span></p>
						<p><?php echo "Enviada: ".$solicitud->getFechaFormateada() ?></p>
<?php
						if($solicitud->getEstado() == 0){
							echo "<p>Pendiente</p>";
						}else if($solicitud->getEstado()== 1){
							echo "<p class='solicitud-aceptada'>Aceptada</p>";
						}else{
							echo "<p class='solicitud-rechazada'>Rechazada</p>";
						}
						
						$BDDRespuesta = new MysqlRespuesta();
						$respuestas = $BDDRespuesta->conseguirRespuestasASolicitud($solicitud->getIdSolicitud());
						if(isset($respuestas)){
?>
							<div id="dialogo">
								<a id="mov<?php echo $solicitud->getIdSolicitud()?>" class="mostrar-ocultar" onclick="mostrarDialogo(1,<?php echo $solicitud->getIdSolicitud() ?>)">Mostrar diálogo</a>
								<ul id="lista-respuestas<?php echo $solicitud->getIdSolicitud() ?>" class="lista-respuestas">
								</ul>
							</div>
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
?>
<?php
	}
?>
<script>
	function mostrarDialogo(tipo, num) {
		if($("#mov"+num).text()=='Mostrar diálogo'){
			$("#lista-respuestas"+num).load("mostrar_respuestas.php?id_solicitud="+num+"&tipo="+tipo);	
			$("#mov"+num).text("Ocultar diálogo");
		}else {
			$("#lista-respuestas"+num).html("");
			$("#mov"+num).text("Mostrar diálogo");
		}
	}
</script>