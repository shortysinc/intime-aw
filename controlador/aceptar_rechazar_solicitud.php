<?php
	require_once 'op_base_datos_usuario.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/solicitud.php';
	session_start();
	
	require_once 'comprobar_login.php';
	
	$usuario_log = $_SESSION['usuario'];
	
	if(isset($_POST['aceptar']) || isset($_POST['rechazar'])){
		$BDD = new MysqlUsuario();
		
		if(isset($_POST['aceptar'])){
			$id_solicitud = $_POST['aceptar'];
			//Comprobar si la solicitud que se quiere aceptar esta, de verdad, pendiente de aceptar por el usuario logueado
			//Es decir, si el usuario tiene permisos para aceptar o rechazar esa solicitud
			$solicitudes = $BDD->conseguirSolicitudesRecibidasPendientes($usuario_log->getId());
			if(Solicitud::estaDentro($id_solicitud, $solicitudes)){
				$solicitud = $BDD->conseguirSolicitudPorId($id_solicitud);
				$fecha_ini = strtotime($solicitud->getInicio());
				$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
				
				//Si la fecha de inicio es mayor que la fecha actual
				if($fecha_ini > $fecha_actual){
					$BDD->actualizarSolicitud($solicitud->getIdSolicitud(), $solicitud->getIdUsuario(), $solicitud->getIdServicio(),
					 1, $solicitud->getFecha(), $solicitud->getInicio(), $solicitud->getFin(), $solicitud->getComentario());
				}else{
					$_SESSION['mensaje'] = "Ya no puedes aceptar la solicitud, la fecha ha pasado";
				}
			}else {
				$_SESSION['mensaje'] = "No puedes aceptar la solicitud";
			}
		}else if($_POST['rechazar']){
			$id_solicitud = $_POST['rechazar'];
			//Comprobar si la solicitud que se quiere rechazar esta, de verdad, pendiente de rechazar por el usuario logueado
			$solicitudes = $BDD->conseguirSolicitudesRecibidasPendientes($usuario_log->getId());
			if(Solicitud::estaDentro($id_solicitud, $solicitudes)){
				$solicitud = $BDD->conseguirSolicitudPorId($id_solicitud);
				$BDD->actualizarSolicitud($solicitud->getIdSolicitud(), $solicitud->getIdUsuario(), $solicitud->getIdServicio(),
					 2, $solicitud->getFecha(), $solicitud->getInicio(), $solicitud->getFin(), $solicitud->getComentario());
			}
		}
	}
	header('Location: ../vista/solicitudes.php');
?>