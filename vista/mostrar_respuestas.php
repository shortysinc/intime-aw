<?php 
	require_once '../modelo/usuario.php';
	require_once '../modelo/respuesta.php';
	require_once '../modelo/solicitud.php';
	require_once '../controlador/op_base_datos_usuario.php';
	session_start();
	
	require_once '../controlador/comprobar_login.php';
	
	$usuario = $_SESSION['usuario'];
	
	if( isset($_GET['id_solicitud'], $_GET['tipo']) ){
		$BDD = new MysqlUsuario();
		$solicitudes = NULL;
		//solicitudes recibidas
		if($_GET['tipo'] == 0){
			$solicitudes = $BDD->conseguirSolicitudesRecibidas($usuario->getId());
		}else if($_GET['tipo'] == 1){
			$solicitudes = $BDD->conseguirSolicitudesEnviadas($usuario->getId());
		}
		//Comprobar si las respuestas que quiere ver el usuario son para él de verdad. Es decir, si el usuario tiene permisos para
		//ver esas respuestas
		if(Solicitud::estaDentro($_GET['id_solicitud'], $solicitudes)){
			//si es así obtener las respuestas y mostrarlas
			$respuestas = $BDD->conseguirRespuestasASolicitud($_GET['id_solicitud']);
			if(isset($respuestas)){
				foreach ($respuestas as $respuesta) {
					$usuarioResponde = $BDD->conseguirUsuarioById($respuesta->getIdUsuario());				
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
			}
		}
	}
