<!DOCTYPE html>
<html lang="es">
	<head>
		<title>inTime</title>
		<meta name="keywords" content="sonic, responsive, free template, fluid layout, bootstrap, templatemo" />
		<meta name="description" content="Sonic is one-page responsive free template using Bootstrap. This layout is suitable for creative portfolio showcase." />
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1">

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/templatemo_misc.css">
		<link rel="stylesheet" href="css/templatemo_style.css">
	</head>
	<body>

		<?php include "sidebar.php"
		?>
		<div id="main-content">
			<div id="templatemo">
				<div class="main-slider">
					<div class="flexslider">
						<div class="bienvenida">
							<div class="box-login">
								<form method="post" action="perfilusuario.php" accept-charset="utf-8">
									<div class="u-login">
										<label>Usuario</label>
										<input type="text" />
										<a id="crear-cuenta" href="crearcuenta.php">Crear cuenta</a>
									</div>
									<div class="p-login">
										<label>Contraseña</label>
										<input type="password"/>
										<a id="olvidada" href="">¿Contraseña olvidada?</a>
									</div>
									<div>
										<button type="submit" name="entrar">
											Entrar
										</button>
											<!--link que da acceso al administrador. Esto con php se eliminaría-->
											<a href="perfiladmin.php">Entrar admin</a>
									</div>
								</form>
								<div class="main-buscador">
									<form class="buscador-form" method="get" action="busqueda.php" accept-charset="utf-8">
										<label>Buscar</label>
										<input type="text" size="50">
										<button type="submit" name="submit">
											Enviar
										</button>
										<a href="busqueda.php">Búsqueda avanzada</a>
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
									<div class="col-md-12">
									</div>
								</div>
							</div>
							<img src="images/slide1.jpg" alt="Slide1">
						</div>
						<!-- /.busqueda -->
					</div>
					<!-- /.flexslider -->
				</div
				<!-- /.WELCOME -->
				<div class="welcome-text">
					<h2>Bienvenido a inTime</h2>
					<p>Tu Banco de Tiempo</p>
				</div>
				<!-- /.WELCOME -->
				<!-- /.main-slider -->
			</div>
			<!-- /.templatemo -->
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content -->
	</body>
</html>