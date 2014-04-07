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
				<div class="busqueda">
					<form method="post" action="busqueda.php" accept-charset="utf-8">
						<form action="" method="get" accept-charset="utf-8">
						<label>Buscar</label>
						<input type="text" size="50">
						<button type="submit" name="submit" value="Enviar">Enviar</button>
					</form>
				</div>
				<div class="avanzada">
					<form method="post" action="busqueda.php" accept-charset="utf-8">
						<label>Busqueda por confianza: </label> 
						<input type="radio" name="consulta" value="propia" checked="checked" /> Busca por confianza propia.
						<input type="radio" name="consulta" value="red" /> Busca por red de confianza
						<select name="menu">
						<option value="5" selected>5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						</select>
						<button type="submit" value="Entrar">Entrar</button>
					</form>
				</div>	
				<div class="lista">	
					<div class ="busq-ej">
						<a href="trabajo.php"><h3>Nombre del servicio</h3></a>
						<a href="perfil.php"><h4>Perfil del usuario</h4></a>
						<div class="busq-foto">
							<img src="images/team1.jpg">
						</div>
						<div class="busq-nota">
							<p>Nota: 5,4</p>
						</div>
						<div class="busq-desc">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc facilisis arcu quis auctor congue. Donec a nulla eleifend, accumsan ipsum vitae, porttitor purus. Nulla sapien enim, mollis eget dignissim nec, porta sed sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris et venenatis mi, nec mattis purus.</p>
						</div>
					</div>
				</div>
			
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