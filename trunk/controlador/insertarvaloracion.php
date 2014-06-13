<?php 
	require_once 'op_base_datos_usuario.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/servicio.php';
	require_once '../modelo/solicitud.php';
	require_once 'op_base_datos_servicio.php';
	require_once 'op_base_datos_usuario.php';
	require_once 'op_base_datos_valoracion.php';
	session_start();
	
	require_once 'comprobar_login.php';
	
	if(isset($_SESSION['id_servicio'], $_POST['comentario'],$_POST['valoracion'])){
		$id_servicio = $_SESSION['id_servicio'];
		$login = $_SESSION['usuario'];
		$BDDValoracion = new MysqlValoracion();
		$BDDUsuario = new MysqlUsuario();
		$encontrado=false;
		$solicitudes = $BDDUsuario->conseguirSolicitudesEnviadas($_SESSION['usuario']->getId());
		
		for ($i=0;$i<count($solicitudes);$i++){
			if($solicitudes[$i]->getIdServicio() == $id_servicio){
				$encontrado = TRUE;
			}
		}
		if ($encontrado){
			$BDDValoracion->insertarvaloracion($_POST['comentario'],$_POST['valoracion'],$id_servicio,$_SESSION['usuario']->getId());
			
		}else{
			$_SESSION['error'] = "No has solicitado el servicio, no puedes valorar";
		}

		unset($_SESSION['id_servicio']);
	}
	header("location: ../vista/servicio.php?id_servicio=$id_servicio");
		