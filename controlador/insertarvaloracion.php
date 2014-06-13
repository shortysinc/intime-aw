<?php 
	require_once 'op_base_datos_usuario.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/servicio.php';
	require_once '../modelo/solicitud.php';
	require_once '../controlador/op_base_datos_servicio.php';
	require_once '../controlador/op_base_datos_usuario.php';
	session_start();
	
	require_once 'comprobar_login.php';
	if(isset($_SESSION['id_servicio'], $_POST['comentario'],$_POST['valoracion'])){
		$id_servicio = $_SESSION['id_servicio'];
		$login = $_SESSION['usuario'];
		$BDD = new MysqlUsuario();
		$encontrado=false;
		$solicitudes = $BDD->conseguirSolicitudesEnviadas($_SESSION['usuario']->getId());
		
		for ($i=0;$i<count($solicitudes);$i++){
			if($solicitudes[$i]->getIdServicio() == $id_servicio){
				$encontrado = TRUE;
			}
		}
		if ($encontrado){
			$BDD->insertarvaloracion($_POST['comentario'],$_POST['valoracion'],$id_servicio,$_SESSION['usuario']->getId());
			
		}else{
			$_SESSION['error'] = "No has solicitado el servicio, no puedes valorar";
		}
	}
	header("location: ../vista/servicio.php?id_servicio=$id_servicio");
		