<?php 
	require_once 'op_base_datos_usuario.php';
	require_once 'op_base_datos_servicio.php';
	require_once 'op_base_datos_usuario.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/servicio.php';
	require_once '../modelo/solicitud.php';
	session_start();
	
	require_once 'comprobar_login.php';
	
	if(isset($_GET['id_servicio'], $_POST['solicitud'])){
		$id_servicio = $_GET['id_servicio'];
		$login = $_SESSION['usuario'];
		$peticion = $_POST['solicitud'];
		$BDD = new MysqlUsuario();
		
		$BDDServicio = new MysqlServicio();
		$servicio = $BDDServicio->conseguirServicio($id_servicio);
		
		//para que no pueda solicitar su propio servicio
		if(isset($servicio) && $servicio->getIdUsuario() != $_SESSION['usuario']->getId()){
			//comprobar si el usuario ya ha enviado una solicitud  para ese serivicio y está pendiente aún.
			$solicitudes = $BDD->conseguirSolicitudesEnviadasPendientes($_SESSION['usuario']->getId());
			$len = count($solicitudes);
			$i=0;
			$encontrado = FALSE;
			while($i < $len & !$encontrado){
				if($solicitudes[$i]->getIdServicio() == $id_servicio){
					$encontrado = TRUE;
				}
				$i++;
			}
			//Si no hay ninguna solicitud pendiente para ese servicio del usuario
			if(!$encontrado){
				$id_solicitud = $BDD->insertarSolicitud($login->getId(),$id_servicio,$peticion);
				unset($_SESSION['id_servicio']);
				
				header ("location: ../vista/solicitudes.php");	
			}else {
				$_SESSION['error'] = "Ya has solicitado este servicio y está pendiente";
				header("location: ../vista/servicio.php?id_servicio=$id_servicio");
			}
		
		}
	}
