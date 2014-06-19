<?php
	require_once '../modelo/servicio.php';
	require_once '../modelo/usuario.php';
	require_once 'op_base_datos_servicio.php';
	session_start();
	require_once '../controlador/comprobar_login_usuario_admin.php';
	
	$nombre = $_POST["nombreserv"];
	$descripcion = $_POST["descrpserv"];
	$categoria = $_POST["categoria"]; 
	$horas = $_POST["horaserv"];
	$loginuser=$_SESSION['usuario'];
	
	$BDDservice = new MysqlServicio();
	$idcategoria=$BDDservice->conseguirIdCategoria($categoria);
	if ($idcategoria==null)
		$idcategoria=$BDDservice->insertarCategoria($categoria);

	$id_servicio=$BDDservice->crearservicio($loginuser->getId(),$idcategoria,$nombre,$descripcion,$horas);
	
	if(isset($_FILES['foto'])&& !empty($_FILES['foto']["name"])){	
		move_uploaded_file($_FILES['foto']['tmp_name'],"../vista/images/servicio/".$id_servicio.".png");
		$foto=$id_servicio.".png";
		$BDDservice->editarServicio($id_servicio,NULL,NULL,$foto);
	}
	
	header("location: ../vista/servicio.php?id_servicio=".$id_servicio);