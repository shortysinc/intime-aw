<?php 
	require_once '../modelo/usuario.php';
	require_once '../modelo/respuesta.php';
	require_once '../modelo/solicitud.php';
	require_once '../controlador/op_base_datos_usuario.php';
	session_start();
	
	require_once '../controlador/comprobar_login.php';
	
	$usuario = $_SESSION['usuario'];
	
	if( isset($_GET['id_solicitud']) ){
		$BDD = new MysqlUsuario();
		$solicitudes = $BDD->conseguirSolicitudesEnviadas($usuario->getId());
		//Comprobar si las respuestas que quiere ver el usuario son para él de verdad. Es decir, si el usuario tiene permisos para
		//ver esas respuestas
		if(Solicitud::estaDentro($_GET['id_solicitud'], $solicitudes)){
			//si es así obtener las respuestas y mostrarlas
			$respuestas = $BDD->conseguirRespuestasASolicitud($_GET['id_solicitud']);
			if(isset($respuestas)){
				foreach ($respuestas as $respuesta) {
					$usuarioResponde = $BDD->conseguirUsuarioById($respuesta->getIdUsuario());
	?>				
					<li>
						<h4><?php echo $usuarioResponde->getNombre() ?></h4>
						<p><?php echo $respuesta->getComentario() ?></p>
						<p><?php echo $respuesta->getFechaFormateada() ?></p>
					</li>
<?php
				}
			}
		}
	}
?>