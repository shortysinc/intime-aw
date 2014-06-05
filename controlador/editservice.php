<?php
	require_once '../modelo/servicio.php';
	require_once '../controlador/op_base_datos_servicio.php';
	session_start();
	//$usuario=$_SESSION['usuario'];
	
	$id = $_GET['id_servicio'];
	$BDDservice=new MysqlServicio();
	$servicio = $BDDservice->conseguirServicio($_GET['id_servicio']);
	if	(($servicio->getIdServicio()==$id)||((isset($_SESSION['login_admin']))&& ($_SESSION['login_admin']==true))){
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
			move_uploaded_file($_FILES['foto']['tmp_name'],"../vista/images/servicio/".$servicio->getIdServicio().".png");
			$foto=$servicio->getIdServicio().".png";
		}
		else{
			$foto=null;
		}
		
		$BDDservice->editarServicio($id,$nombreserv,$descrpserv,$foto);
	}
	header("Location: ../vista/servicio.php?id_servicio=".$id);