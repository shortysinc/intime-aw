<?php 
	require_once 'op_base_datos_usuario.php';
	require_once 'op_base_datos_servicio.php';
	require_once 'op_base_datos_usuario.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/servicio.php';
	require_once '../modelo/solicitud.php';
	session_start();
	
	require_once 'comprobar_login.php';
	
	if(isset($_GET['id_servicio'], $_POST['solicitud'], $_POST['hora_inicio'])){
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
				//Si la fecha que me pasan tiene un formato correcto
				if (strtotime ($_POST['hora_inicio'])){
					$fecha_ini = strtotime($_POST['hora_inicio']);
					$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
					
					//Si la fecha que me pasan  es mayor que la fecha actual
					if($fecha_ini > $fecha_actual){
						$fecha_inicio = $_POST['hora_inicio'];
						$horas = $servicio->getHoras();
						$fecha_inicio = $_POST['hora_inicio'];
						$fecha_fin = date('Y-m-d H:i:s', strtotime($fecha_inicio." + ".$horas." hours"));
						$fecha_inicio = date('Y-m-d H:i:s', strtotime($fecha_inicio));
						
						$usuario = $BDD->conseguirUsuarioById($_SESSION['usuario']->getId());
						//Si el usuario dispone de suficientes horas para solicitar el servicio
						if($usuario->getHoras() >= $servicio->getHoras()){
							//Inserto la solicitud
							$id_solicitud = $BDD->insertarSolicitud($login->getId(),$id_servicio, $fecha_inicio, $fecha_fin, $peticion);
							header ("location: ../vista/solicitudes.php?tipo=1&estado=0");
						}else {
							$_SESSION['error'] = "No dispones de suficientes horas";
							header("location: ../vista/servicio.php?id_servicio=$id_servicio");
						}
					}else{
						$_SESSION['error'] = "Fecha no válida";
						header("location: ../vista/servicio.php?id_servicio=$id_servicio");
					}
				} else{
					$_SESSION['error'] = "Fecha no válida";
				}
			}else {
				$_SESSION['error'] = "Ya has solicitado este servicio y está pendiente";
				header("location: ../vista/servicio.php?id_servicio=$id_servicio");
			}
		}
		unset($_SESSION['id_servicio']);
	}
