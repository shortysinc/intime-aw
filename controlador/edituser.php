<?php
	require_once '../modelo/usuario.php';
	require_once '../controlador/op_base_datos_usuario.php';
	session_start();
	$usuario=$_SESSION['usuario'];
	$id = $_GET['id_usuario'];
	$BDDuser=new MysqlUsuario();
	if	(($usuario->getId()==$id)||((isset($_SESSION['login_admin']))&& ($_SESSION['login_admin']==true))){
		if (isset($_REQUEST['email'])){
			$email=$_REQUEST['email'];	
		}else{
			$email=null;
		}
		if(isset($_FILES['foto'])){
			move_uploaded_file($_FILES['foto']['tmp_name'],"../vista/images/usuario/".$usuario->getId().".png");
			$foto=$usuario->getId().".png";
		}
		else{
			$foto=null;
		}
		if (isset($_REQUEST['nombre'])){
			$nombre=$_REQUEST['nombre'];	
		}else{
			$nombre=null;
		}
		if (isset($_REQUEST['apellidos'])){
			$apellidos=$_REQUEST['apellidos'];	
		}else{
			$apellidos=null;
		}
		if (isset($_REQUEST['direccion'])){
			$direccion=$_REQUEST['direccion'];	
		}else{
			$direccion=null;
		}
		if (isset($_REQUEST['pass'])){
			$pass=$_REQUEST['pass'];
			$salt=$usuario->getSalt();
		}else{
			$pass=null;
			$salt=null;
		}
		$BDDuser->editarUsuario($id,$email,$foto,$nombre,$apellidos,$direccion,$pass,$salt);
	}
	header("Location: ../vista/perfil.php?id_usuario=".$id);