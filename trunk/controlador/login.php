<?php
	session_start();
	if(isset($_SESSION["login"]) && $_SESSION["login"] == true){
		header('Location: ../vista/perfil_usuario.php');
	}else {
		$_SESSION["error"] = "Usuario o contraseña incorrectos";
		header('Location: ../index.php');
	}
?>