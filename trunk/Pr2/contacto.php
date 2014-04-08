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
						<div class="formulario">
				<form action="send.php" method="post"" name="contacto" id ="contacto" > 
					Nombre completo <input name="nombre" type="text" id="nombre completo"size="30" maxlength="100"> 
						<br> 
						<br> 
					Correo electrónico <input name="email" type="text" onBlur="MM_validateForm('email','','NisEmail');return document.MM_returnValue" size="25" maxlength="100" > 
						<br> 
						<br> 
					¿Qué opina de nuestra página?
						<br> 
						<input type="radio" name="GrupoOpciones2" value="mucho" >Es excelente.
						<br> 
						<input type="radio" name="GrupoOpciones2" value="regular" >No está mal.
						<br> 
						<input type="radio" name="GrupoOpciones2" value="mal" >Es horrible
						<br> 
						<br> 
					Danos tu opinión  
					    <br>
						<textarea cols="50" rows="5" name="opinion"></textarea> 
						<br> 
						<br> 
						<input type="submit" value="Enviar formulario"> 
						<input type="Reset" value="Borrar datos"> 
				</form> 
				
			</div>
					</div>
				</div>
				<!-- /#contact -->
				
			</div>
			<!-- /#templatemo"-->
		
		</div>
		<!-- /#main-content-->
	</body>
