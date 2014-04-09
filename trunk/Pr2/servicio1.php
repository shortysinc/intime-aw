<!DOCTYPE html>
<html lang="es">
	<head>
		<title>inTime - Servicios</title>
		<meta name="keywords" content="sonic, responsive, free template, fluid layout, bootstrap, templatemo" />
		<meta name="description" content="Sonic is one-page responsive free template using Bootstrap. This layout is suitable for creative portfolio showcase." />
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1">

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/templatemo_misc.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/templatemo_style.css">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="css/rating.css">

	</head>
	<body>
		<?php include "sidebar.php"
		?>
		<div id="main-content">
			<div id="templatemo">
				<div id="services" class="section-content">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">

								<h2>Servicios</h2>
								<div class="buscador">
									<form class="buscador-form" method="get" accept-charset="utf-8">
										<label>Buscar</label>
										<input type="text" size="50">
										<button type="submit" name="submit" value="Enviar">
											Enviar
										</button>
										<a href="">Búsqueda avanzada</a>
									</form>
								</div>

							</div>

							<!--NUEVO!! -->
							
							
							
							<div class="descripcion-servicios"> 
								<p><strong>Descripción del Servicio 1:</strong> </p>
								<div class="descripcion-servicios">
									<img src="images/piano.jpg" alt="Aqui iria una imagen"/>
									<p>
										Este servicio nos ofrece clases de piano. Para todas las edades
										y las horas que sean necesarias.
									</p>	
									<fieldset class="rating">
										<legend>
											Valoración:
										</legend>
										<input type="radio" id="star5" name="rating" value="5" />
										<label for="star5" title="Rocks!">5 stars</label>
										<input type="radio" id="star4" name="rating" value="4" />
										<label for="star4" title="Pretty good">4 stars</label>
										<input type="radio" id="star3" name="rating" value="3" />
										<label for="star3" title="Meh">3 stars</label>
										<input type="radio" id="star2" name="rating" value="2" />
										<label for="star2" title="Kinda bad">2 stars</label>
										<input type="radio" id="star1" name="rating" value="1" />
										<label for="star1" title="Sucks big time">1 star</label>
									</fieldset>
								</div>
								
							</div> <!--descripcion-servicios -->
							<div class="panel-servicios">
								<div class="lista-servicios">
									<table>
										<caption>
											<strong>Servicios que ofrecemos!!</strong> 
										</caption>
										<thead>
											<th>Categorias</th>
											<th>Servicios</th>
										</thead>
										<tbody>
											<tr>
												<th>Categoria 1</th>
												<td>
													<ul>
														<li><a href="#">Servicio1</a></li>
														<li><a href="#">Servicio2</a></li>
														<li><a href="#">Servicio3</a></li>
													</ul>
												</td>
											</tr>
											<tr>
												<th>Categoria 2</th>
												<td>
													<ul>
														<li><a href="#">Servicio1</a></li>
														<li><a href="#">Servicio2</a></li>
														<li><a href="#">Servicio3</a></li>
													</ul>
												</td>
											</tr>
											<tr>
												<th>Categoria 3</th>
												<td>
													<ul>
														<!--<li><a href="#">Servicio1</a></li>
														<li><a href="#">Servicio2</a></li>-->
														<li><a href="#">Servicio1</a></li>
													</ul>
												</td>
											</tr>
										</tbody>
									</table>
									
									<p> Descripcion del servicio 1 </p>
								</div>
							</div>
						</div>
						<div class="cuerpo"></div>
						
					</div>
					<!-- /#services -->
				</div>
				<!-- /#templatemo"-->
				<?php include 'footer.php'
				?>
			</div>
			<!-- /#main-content-->

	</body>
