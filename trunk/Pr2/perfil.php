<!DOCTYPE html>
<html lang="es">
	<head>
		<title>inTime - Servicios</title>
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
		<?php include "sidebarusuario.php"
		?>
		<div id="main-content">
			<div id="templatemo">
				<div class="section-content">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">
								<div class="buscador">
									<form class="buscador-form" method="get" action="busqueda.php" accept-charset="utf-8">
										<label>Buscar</label>
										<input type="text" size="50">
										<button type="submit" name="submit" value="Enviar">
											Enviar
										</button>
										<a href="">Búsqueda avanzada</a>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="perfil">
					<h1>Nombre del Usuario</h1>
					<img src="images/team1.jpg" >
					<div class="infouser">
						<p>fake1@mail.com</p>
						<p>Nota media de sus servicios: 7,1</p>
					</div>
					<div class="lista-serv">
						<h3>Lista de servicios del usuario:</h3>
							<div class="servicio-ej">
								<a href="trabajo.php"><h4>Nombre del servicio</h4></a>
								<div class="serv-nota">
									<p>
										Nota: 5,4
									</p>
								</div>
								<div class="serv-desc">
									<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc facilisis arcu quis auctor congue. Donec a nulla eleifend, accumsan ipsum vitae, porttitor purus. Nulla sapien enim, mollis eget dignissim nec, porta sed sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris et venenatis mi, nec mattis purus.
									</p>
								</div>
							</div>
					</div>
				</div>
				
				<!-- /#services -->
			</div>
			<!-- /#templatemo"-->
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
		<!-- /#main-content-->
	</body>
