<?php
	session_start();
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../controlador/op_base_datos_admin.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/admin.php';
	
	$correo = $_POST["correo"];
	$pass = $_POST["pass"];
	$BDD = new MysqlUsuario();
	$usuario = $BDD->loginuser($correo,$pass);
	
	if(isset($usuario)){
		$_SESSION['login_usuario'] = true;
		$_SESSION['usuario'] = $usuario;
		
		//echo $_SESSION['usuario']->getNombre();
		header('Location: ../vista/perfil_usuario.php');
		
 	}else{
 		$BDD = new MysqlAdmin();
 		$admin = $BDD->loginAdmin($correo, $pass);
		if(isset($admin)){
			$_SESSION['login_admin'] = true;
			$_SESSION['admin'] = $admin;
			header('Location: ../vista/perfil_admin.php');
		}else {
			$_SESSION['error'] = "Usuario o contraseña incorrectos";
 			header('Location: ../index.php');
		}
	}
?>