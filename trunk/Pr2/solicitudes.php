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
										<button type="submit" name="submit">
											Enviar
										</button>
										<a href="">Búsqueda avanzada</a>
									</form>
								</div>
							</div>
						</div>
						<h1>Solicitudes</h2>
					</div>
					<div class="cuerpo"><div class="sol-rec")>
					<h2>Recibidas</h2>
					<div class="solicitud">
						<a href="trabajo.php"><h5>Nombre del servicio solicitado</h5></a>
						<a href="perfil.php">Nombre del usuario que lo ha solicitado</a>
						<p>fake2@mail.com</p>
						<p>Informacion que el usuario ha dado en la solicitud</p>
						<form action="solicitudes.php" method="get" accept-charset="utf-8">
							<button type="submit" name="solicitud" value="aceptar">
								Aceptar
							</button>
							<button type="submit" name="solicitud" value="denegar">
								Denegar
							</button>
						</form>
					</div>
					<h2>Enviadas</h2>
					<div class="solicitud">
						<a href="trabajo.php"><h5>Nombre del servicio que has solicitado</h5></a>
						<a href="perfil.php">Nombre del usuario que da el servicio</a>
						<p>fake2@mail.com</p>
						<p>Informacion has dado en la solicitud</p>
						<p>Estado de la peticion: Pendiente</p>
					</div>
				</div></div>
				</div>
				<!-- /#services -->
			</div>
			<!-- /#templatemo"-->
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content-->
	</body>
