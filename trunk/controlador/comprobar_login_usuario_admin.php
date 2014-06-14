<?php
if( (!isset($_SESSION["login_usuario"]) || !$_SESSION["login_usuario"]) 
	&& (!isset($_SESSION["login_admin"]) || !$_SESSION['login_admin']) ){
		
	$_SESSION["mensaje"] = "Tienes que iniciar sesión";
	header('Location: ../index.php');
}
