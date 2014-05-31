<?php
	require_once '../modelo/usuario.php';
	require_once '../modelo/servicio.php';
	require_once '../controlador/op_base_datos_servicio.php';
	require_once '../controlador/op_base_datos_usuario.php';
	session_start();
?>
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
	
	<!--NUEVO -->
	<?php
		if(isset($_GET['id_servicio'])){
			$id_servicio = $_GET['id_servicio'];
			$BDDServicio = new MysqlServicio();
			$BDDUsuario = new MysqlUsuario();
			$servicio = $BDDServicio->conseguirServicio($id_servicio);
			if(isset($servicio)){
				$usuario = $BDDUsuario->conseguirUsuarioById($servicio->getIdUsuario());
				$resultadoValoracion= $BDDUsuario->conseguirValoraciones($id_servicio);
			}
			
		}
		//$resultadoMedia= $BDD->notamedia($idservicio);
	?>
	
	<!-- FIN -->
	
	<body>
		<?php include "sidebar.php"
		?>
		<div id="main-content">
			<div id="templatemo">
				<div class="cuerpo">
				<?php if(isset($servicio)){ ?>
				<div class="encabezado">
					 <img src="images/slide3.jpg" > 
					<!--Foto servicio -->
				</div>
				<div class="servicio">
					<div class="autor">
						<img src="images/team1.jpg" >
						<div class="nombretrabajo">
							<a href="perfil.php">
								<h3>
									<?php
										echo $usuario->getNombre();
									?>				
								</h3></a>
						</div>
						<div class="valoraciones">
							<p>
								<?php
									if(isset($resultadoValoracion)){
										foreach ($resultadoValoracion as $row) {
											echo $row["nota"];									
										}
									}
									
								?>
							</p>
							<p>
								Nota Media : 4,3
							</p>
							<a href="editarservicio.php"><h5>Editar</h5></a>
						</div>
					</div>
					<div class="descripcion">
						<h2>Descripción</h2>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec nulla sed augue pretium dignissim.
							Praesent consectetur ante sit amet elementum fringilla. Curabitur vitae neque justo. Ut luctus, tortor sed
							ultrices porta, arcu neque vestibulum sapien, sit amet venenatis quam eros eu neque. Nulla quis ligula ultricies,
							dapibus libero ac, laoreet est. Sed condimentum id mauris id congue. Nulla dictum massa sit amet porttitor
							rhoncus. Curabitur eu ultricies lorem. Donec diam leo, accumsan id tincidunt ut, lacinia id dolor. Nunc eget
							imperdiet dui, a elementum eros. Cras arcu eros, viverra nec fermentum et, dignissim et metus. Pellentesque at
							laoreet nibh. Quisque vitae felis massa. Nam lacus arcu, consequat sed ultrices sed, elementum sed leo
						</p>
					</div>
					<?php
						if(isset($_SESSION['login_admin']) && $_SESSION['login_admin'] ) {//Si es admin
							//No se hace nada
							
						} else if ( (!isset($_SESSION['login_usuario']) || !$_SESSION['login_usuario']) ) { //Si no es usuario registrado
							//No se hace nada
							
						// si id del usuario logueado es distinto del id del usuario que ofrece el servicio
						}else if (($_SESSION['usuario']->getId() == $usuario->getId()))  { 
							//No hacemos nada
						}else {
							
					?>
					<div class="solicitud">
						<form action=""method="get" accept-charset="utf-8">
							<label>Solicitar servicio</label>
							<p>
								<textarea name="solicitud" rows="4" cols="50" placeholder="Escribe una solicitud para este servicio"></textarea>
							</p>
							<button type="submit" name="submit" value="Enviar">
								Enviar
							</button>
						</form>
					</div>
					<?php
					}
					?>
				</div>
				<div class="comentarios">
					<!--comentarios ejemplo-->
					<h2>Comentarios y valoraciones</h2>
					<div class ="comentario-ej">
						<a href="perfil_usuario.php"><h4>Perfil del usuario</h4></a>
						<div class="coment-foto">
							<img src="images/team2.jpg">
						</div>
						<div class="coment-nota">
							<p>
								Nota: 3,1
							</p>
						</div>
						<div class="coment">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc facilisis arcu quis auctor congue. Donec a nulla eleifend, accumsan ipsum vitae, porttitor purus. Nulla sapien enim, mollis eget dignissim nec, porta sed sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris et venenatis mi, nec mattis purus.
							</p>
						</div>
					</div>
					<?php
						if ( isset($_SESSION['login_admin']) && $_SESSION['login_admin'] ) {//Si es admin
							//No hacemos nada
							
						} else if( (!isset($_SESSION['login_usuario']) || !$_SESSION['login_usuario'])  //Si no es usuario registrado
							|| ($_SESSION['usuario']->getId() == $usuario->getId()))  { // o el id del usuario logueado es distinto del id del usuario que ofrece el servicio 
					 		//no se hace nada
							
						}else { //Mostramos el formulario de valoración
					 		
					?>
					<div class="comment-form">
						<form action="" method="get" accept-charset="utf-8">
							<label>Enviar comentario y/o valoracion</label>
							<p>
								<textarea name="comentario" rows="4" cols="50" placeholder="Escribe un comentario"></textarea>
							</p>
							<p>
								<label>Valorar servicio:</label>
								<select name="valoracion">
									<option value="6">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5" selected>5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
								</select>
							</p>
							<button type="submit" name="submit" value="Enviar">
								Enviar
							</button>
						</form>
					</div>
					<?php
					}
					?>
				</div>
				<?php 
				}else{
					echo "<h1>Servicio inexistente</h1>";
				} ?>
				</div>
			</div> <!-- /#sTop -->
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content -->
	</body>
</html>