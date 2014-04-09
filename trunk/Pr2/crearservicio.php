<!DOCTYPE html>
<html lang="es">
	<head>
		<title>inTime / Crear una cuenta</title>
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
				<div class="section-content">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">
								<h1>Crear servicio</h2>
							</div>
							<!-- section-title -->
						</div>
						<!-- col-md-12 -->
					</div>
					<!-- /#row -->
					<div class="cuerpo">
						<div class="contact-form" id="crear-cuenta-form">
							<form action="index.php" method="post" accept-charset="utf-8">
								<div class="col-md-4">
									<label for="nombreserv" class="required">Nombre del servicio:</label>
									<input name="nombreserv" type="text" id="nombreserv" maxlength="40" required/>
								</div>
								<div class="col-md-4">
									<label for="descrpserv">Descripcion:</label>
									<textarea name="descrpserv" rows="4" cols="50" placeholder="Escribe un comentario"></textarea>
								</div>
								<div class="col-md-8">
									<label for="categoria" class="required">Categoría:</label>
									<input name="categoria" type="text" id="categoria" maxlength="60" required/>
								</div>
								<!-- /.col-md-4 -->
								<div class="col-md-8">
									<label for="foto" class="required">Imagen del servicio:</label>
									<input name="foto" type="file" id="foto" maxlength="40" required/>
								</div>
								<!-- /.col-md-4 -->
								<div class="col-md-12">
										<!--<a ="#" class="largeButton contactBgColor">Send Message</a>-->
										<button class="largeButton submitBgColor" type="submit" value="Enviar">
											Enviar
										</button>
								</div>
								<!-- /.col-md-12 -->
							</form>
						</div>
					<!-- /.contatc-form -->
					</div>
				</div>
				<!-- /#section-content -->
			</div>
			<!-- /#templatemo"-->
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content-->
	</body>
