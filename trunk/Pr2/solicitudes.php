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
				<h1>Solicitudes</h1>
				<div class="sol-rec")>
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
				</div>
			</div> <!-- /#sTop -->
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content -->
	</body>
</html>