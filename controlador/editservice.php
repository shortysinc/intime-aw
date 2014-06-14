<?php
	require_once '../modelo/servicio.php';
	require_once '../modelo/usuario.php';
	require_once 'op_base_datos_servicio.php';
	session_start();
	
	require_once 'comprobar_login.php';
	
	if(isset($_SESSION['id_servicio'])){
		$BDDservice=new MysqlServicio();
		$id_servicio = $_SESSION['id_servicio'];
		$servicio = $BDDservice->conseguirServicio($id_servicio);
		
		//Si el campo id_usuario del servicio es el mismo que el id del usuario que esta logueado entonces puede editar
		if( isset($servicio) && $servicio->getIdUsuario() == $_SESSION['usuario']->getId()){
			
			if (isset($_REQUEST['nombreserv'])){
				$nombreserv=$_REQUEST['nombreserv'];	
			}else{
				$nombreserv=null;
			}
			if (isset($_REQUEST['descrpserv'])){
				$descrpserv=$_REQUEST['descrpserv'];	
			}else{
				$descrpserv=null;
			}
			if(isset($_FILES['foto'])){
				move_uploaded_file($_FILES['foto']['tmp_name'],"../vista/images/servicio/".$id_servicio.".png");
				$foto=$id_servicio.".png";
			}
			else{
				$foto=null;
			}
			$BDDservice->editarServicio($id_servicio,$nombreserv,$descrpserv,$foto);
			
			unset($_SESSION['id_servicio']);
			
			header("Location: ../vista/servicio.php?id_servicio=".$id_servicio);
		}
	}
	