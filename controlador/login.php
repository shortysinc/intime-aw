<?php
	session_start();
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../controlador/op_base_datos_admin.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/admin.php';
	
	$correo = $_POST["correo"];
	$pass = $_POST["pass"];
	$BDD = new MysqlUsuario();
	$resultado = $BDD->loginuser($correo,$pass);
	
	if(isset($resultado)){
		$_SESSION['login_usuario'] = true;
		
		$usuario = new Usuario($resultado['id_usuario'] ,$resultado['correo'], $resultado['nombre'], $resultado['apellidos'],
				$resultado['direccion'], $resultado['horas_usuario'], $resultado['foto'], $resultado['pass'], $resultado['salt']);
		$_SESSION['usuario'] = $usuario;
		
		//echo $_SESSION['usuario']->getNombre();
		header('Location: ../vista/perfil_usuario.php');
		
 	}else{
 		$BDD = new MysqlAdmin();
 		$resultado = $BDD->loginAdmin($correo, $pass);
		if(isset($resultado)){
			$_SESSION['login_admin'] = true;
			$admin = new Admin($resultado['id'], $resultado['correo'], $resultado['pass'], $resultado['salt']);
			$_SESSION['admin'] = $admin;
			header('Location: ../vista/perfil_admin.php');
		}else {
			$_SESSION['error'] = "Usuario o contraseña incorrectos";
 			header('Location: ../index.php');
		}
	}
?>