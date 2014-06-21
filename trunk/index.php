<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>inTime</title>
		<meta name="keywords" content="sonic, responsive, free template, fluid layout, bootstrap, templatemo" />
		<meta name="description" content="Sonic is one-page responsive free template using Bootstrap. This layout is suitable for creative portfolio showcase." />
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1">

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="vista/css/bootstrap.min.css">
		<link rel="stylesheet" href="vista/css/font-awesome.min.css">
		<link rel="stylesheet" href="vista/css/templatemo_misc.css">
		<link rel="stylesheet" href="vista/css/templatemo_style.css">
		
		<link href="/vista/images/logo.png" rel="icon" type="image/x-icon" />
	</head>
	<body>
		<?php include "vista/sidebar.php";
		?>
		<div id="main-content">
			<div id="templatemo">
				<div class="main-slider">
					<div class="flexslider">
						<div class="bienvenida">
							<div class="box-login">
								<form method="post" action="controlador/login.php" accept-charset="utf-8">
									<div class="u-login">
										<label>Usuario</label>
										<input type="email" name="correo"/>
										<a id="crear-cuenta" href="vista/crear_cuenta.php">Crear cuenta</a>
									</div>
									<div class="p-login">
										<label>Contraseña</label>
										<input type="password" name="pass"/>
										<a id="olvidada" href="">¿Contraseña olvidada?</a>
									</div>
									<div>
										<button type="submit" name="entrar">
											Entrar
										</button>
									</div>
								</form>
								<div class="main-buscador">
									<form method="post" action="vista/busqueda.php" accept-charset="utf-8">
										<label>Buscar</label>
										<input type="text" name="nombrebusq" size="50">
										<button type="submit" name="submit" value="Enviar">
											Enviar
										</button>
										<a href="vista/busqueda.php">Búsqueda avanzada</a>
									</form>
								</div>
							</div>

							<!--<form class="buscador-form" method="get" accept-charset="utf-8">
							<label>Buscar</label>
							<input type="text" size="50">
							<button type="submit" name="submit" value="Enviar">Enviar</button>
							<a href="">Búsqueda avanzada</a>
							</form>
							<button id="registrarse">Registrarse</button>-->
							<div class="container-fluid" id="welcome">
								<div class="row">
									<div class="col-md-12"></div>
								</div>
							</div>
							<img src="vista/images/slide1.jpg" alt="Slide1">
						</div>
						<!-- /.busqueda -->
					</div>
					<!-- /.flexslider -->
				</div
				<!-- /.WELCOME -->
				<div class="welcome-text">
					<h2>Bienvenido a inTime</h2>
					<p>
						Tu Banco de Tiempo
					</p>
				</div>
				<!-- /.WELCOME -->
				<!-- /.main-slider -->
			</div>
			<!-- /.templatemo -->
			<?php include 'vista/footer.php'
			?>
		</div>
		<!-- /#main-content -->
		<?php
		if(isset($_SESSION["mensaje"])){
		?>
			<script>
				alert("<?php echo $_SESSION['mensaje'] ?>");
			</script>
		<?php
			unset($_SESSION["mensaje"]);
		}
		
		if(isset($_SESSION["error"])){
		?>
			<script>
				alert("<?php echo $_SESSION['error'] ?> ");
			</script>
		<?php	
		}
				unset($_SESSION["error"]);
		?>
	</body>
</html>