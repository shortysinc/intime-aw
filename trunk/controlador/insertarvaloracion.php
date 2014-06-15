<?php 
	require_once 'op_base_datos_usuario.php';
	require_once 'op_base_datos_servicio_realizado.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/servicio.php';
	require_once '../modelo/solicitud.php';
	require_once '../modelo/servicio_realizado.php';
	require_once 'op_base_datos_servicio.php';
	require_once 'op_base_datos_usuario.php';
	require_once 'op_base_datos_valoracion.php';
	session_start();
	
	require_once 'comprobar_login.php';
	
	if(isset($_GET['id_solicitud'], $_POST['comentario'],$_POST['valoracion']) && $_POST['valoracion']>=0 && $_POST['valoracion']<=10){
		$id_solicitud = $_GET['id_solicitud'];
		$BDDUsuario = new MysqlUsuario();
		$encontrado=false;
		$solicitudes = $BDDUsuario->conseguirSolicitudesEnviadas($_SESSION['usuario']->getId());
		//Obtenemos las solicitudes que le han sido realizadas al usuario registrado
		$solicitudesRealizadas = $BDDUsuario->conseguirSolRealizadas($_SESSION['usuario']->getId());
		//Si la solicitud pertenece a las solicitudes que le han sido realizadas 
		if(Solicitud::estaDentro($id_solicitud, $solicitudesRealizadas)){
			$BDDServicioRealizado = new  MysqlServicioRealizado();
			//Si el servicio está valorado
			if(!$BDDServicioRealizado->estaValorado($id_solicitud)){
				$BDDValoracion = new MysqlValoracion();
				$servicio_realizado = $BDDServicioRealizado->conseguirServicioRealizadoPorIdSol($id_solicitud);
				$BDDValoracion->insertarvaloracion($servicio_realizado->getIdSerRealizado(), $_SESSION['usuario']->getId(), 
					$_POST['valoracion'], $_POST['comentario']);
					$_SESSION['mensaje'] = "Servicio valorado con éxito";
			}else{
				$_SESSION['error'] = "Error al valorar el servicio";
			}
		}
	}
	header("location: ../vista/perfil_usuario.php");
		