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
								<form method="post" action="perfil.php" accept-charset="utf-8">
									<label>Usuario</label>
									<input type="text" />
									<label>Contraseña</label>
									<input type="password"/>
									<button type="submit" value="Entrar">
										Entrar
									</button>
								</form>
								<p>
									<a id="crear-cuenta" href="">Crear cuenta</a>
									<a id="olvidada" href="">¿Contraseña olvidada?</a>
								</p>
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
										<div class="welcome-text">
											<h2>Bienvenido a inTime</h2>
											<p>
												Sonic is provided by templatemo website for everyone. Credit goes to <a href="http://flexslider.woothemes.com" rel="nofollow">FlexSlider</a>. Maecenas adipiscing pellentesque elit eu volutpat. Integer vitae <a href="#">pulvinar magna</a>. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent auctor mi metus, nec sagittis purus ultrices id.
											</p>
										</div>
									</div>
								</div>
							</div>
							<img src="images/slide1.jpg" alt="Slide1">
						</div>
						<!-- /.busqueda -->
					</div>
					<!-- /.flexslider -->
				</div>
				<!-- /.main-slider -->
			</div>
			<!-- /.templatemo -->

			<div class="site-footer">
				<div class="first-footer">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="social-footer">
									<ul>
										<li>
											<a href="#" class="fa fa-facebook"> </a>
										</li>
										<li>
											<a href="#" class="fa fa-twitter"> </a>
										</li>
										<li>
											<a href="#" class="fa fa-rss"> </a>
										</li>
									</ul>
								</div>
								<!-- /.social-footer -->
							</div>
							<!-- /.col-md-12 -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.container-fluid -->
				</div>
				<!-- /.first-footer -->
				<div class="bottom-footer">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								<p class="copyright">
									Copyright � 2014 <a href="#">inTime</a>
								</p>
							</div>
							<!-- /.col-md-6 -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.container-fluid -->
				</div>
				<!-- /.bottom-footer -->
			</div>
			<!-- /.site-footer -->
		</div>
		<!-- /#main-content -->
	</body>
