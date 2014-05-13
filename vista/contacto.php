<!DOCTYPE html>
<html lang="es">
	<head>
		<title>inTime - Contacto</title>
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
				<div id="contact" class="section-content">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">
								<h2>contacto</h2>
							</div>
						</div>
						<div class="cuerpo">
							<p>
								¿Tienes sugerencia o has encontrado un fallo? ¿Quieres anunciarte en inTime?
							</p>
							<div class="contact-form" id="form">
								<form action="index.php" method="post" accept-charset="utf-8">
									<div class="form-left">
										<div class="col-md-8">
											<label for="nombre" >Nombre:</label>
											<input name="nombre" type="text" id="nombre" maxlength="40"/>
										</div>
										<!-- /.col-md-4 -->
										<div class="col-md-8">
											<label for="email" class="required">Correo electrónico:</label>
											<input name="email" type="text" id="email-cont" maxlength="40" required/>
										</div>
										<!-- /.col-md-4 -->
										<div class="col-md-8">
											<label for="ausnto" >Asunto:</label>
											<input name="asunto" type="text" id="asunto" maxlength="40"/>
										</div>
										<div class="col-md-8">
										<!--<a ="#" class="largeButton contactBgColor">Send Message</a>-->
										<button class="largeButton submitBgColor" type="submit" value="Enviar">
											Enviar
										</button>
									</div>
									<!-- /.col-md-8 -->
									</div>
									<div class="form-right">
										<div class="col-md-12">
											<label for="mensaje" class="required">Mensaje:</label>
											<textarea class="mensaje" rows="10"></textarea>
										</div>
									</div>
									<!-- /.col-md-8 -->
								</form>
							</div>
							<!-- /.contatc-form -->
						</div>
					</div>
				</div>
				<!-- /#contact -->
			</div>
			<!-- /#templatemo"-->
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content-->
	</body>
</html>