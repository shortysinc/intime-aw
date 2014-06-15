<?php 
	require_once '../modelo/usuario.php';
	require_once '../modelo/respuesta.php';
	require_once '../modelo/solicitud.php';
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../controlador/op_base_datos_respuesta.php';
	session_start();
	
	require_once '../controlador/comprobar_login.php';
	
	$usuario = $_SESSION['usuario'];
	
?>
	<script src="jquery/jquery-2.1.0.min.js" type="text/javascript"></script>
<?php
	if( isset($_GET['id_solicitud'], $_GET['tipo']) ){
		$BDDUsuario = new MysqlUsuario();
		$solicitudes = NULL;
		//solicitudes recibidas
		if($_GET['tipo'] == 0){
			$solicitudes = $BDDUsuario->conseguirSolicitudesRecibidas($usuario->getId());
		}else if($_GET['tipo'] == 1){
			$solicitudes = $BDDUsuario->conseguirSolicitudesEnviadas($usuario->getId());
		}
		//Comprobar si las respuestas que quiere ver el usuario son para él de verdad. Es decir, si el usuario tiene permisos para
		//ver esas respuestas
		if(Solicitud::estaDentro($_GET['id_solicitud'], $solicitudes)){
			//si es así obtener las respuestas y mostrarlas
			$BDDRespuesta = new MysqlRespuesta();
			$respuestas = $BDDRespuesta->conseguirRespuestasASolicitud($_GET['id_solicitud']);
			if(isset($respuestas)){
				foreach ($respuestas as $respuesta) {
					$usuarioResponde = $BDDUsuario->conseguirUsuarioById($respuesta->getIdUsuario());		
					echo "<li>";
						if($usuario->getId() == $respuesta->getIdUsuario())	{
							echo "<h4>Tú</h4>";
						}else{
							echo "<h4>".$usuarioResponde->getNombre()."</h4>";
						}				
						echo "<p>".$respuesta->getComentario()."</p>";
						echo "<p>".$respuesta->getFechaFormateada()."</p>";
					echo "</li>";

				}
?>
				<script>
					function enviarRespuesta(){
						<?php 
							$_SESSION['id_solicitud'] = $_GET['id_solicitud'];
						?>
					}
				</script>
				<form method="post" onclick="enviarRespuesta()" action="../controlador/enviar_respuesta.php" accept-charset="UTF-8">
					<textarea name="respuesta" cols="25" rows="4" placeholder="Escribe tu respuesta"></textarea><br />
					<button type="submit">Enviar</button>
				</form>
<?php
			}
		}
	}
