<?php
	session_start();
	if(isset($_SESSION['login_usuario']) || isset($_SESSION['login_admin'])) {
		session_destroy();
	}
	header("Location: ../index.php");
?>