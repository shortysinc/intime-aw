<?php
	require_once '../modelo/usuario.php';
	require_once '../modelo/servicio.php';
	require_once '../modelo/valoracion.php';
	require_once '../controlador/op_base_datos_servicio.php';
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../controlador/op_base_datos_valoracion.php';
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
			$BDDValoracion = new MysqlValoracion();
			$servicio = $BDDServicio->conseguirServicio($id_servicio);
			if(isset($servicio)){
				$usuario = $BDDUsuario->conseguirUsuarioById($servicio->getIdUsuario());
				$valoraciones= $BDDValoracion->conseguirValoraciones($id_servicio);
				$resuldescrip = $servicio->getDescripcion();
				$resulmedia = $BDDServicio->notamedia($id_servicio);
				$nombreServicio= $servicio->getNombre();
				$fotoservice= $usuario->getFoto();
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
					<h2><?php 
							echo $nombreServicio;
						
						?></h2>
					 <img src="images/slide3.jpg" > 
					<!--Foto servicio -->
				</div>
				<div class="servicio">
					<div class="autor">
						<img src="images/usuario/<?php if (isset($fotoservice)) {echo $usuario->getFoto();} else {echo "user_defect.png" ;}?>" >
						<div class="nombretrabajo">
							<a href="perfil.php?id_usuario=<?php echo $usuario->getId() ?>">
								<h3>
									<?php
										echo $usuario->getNombre();
									?>				
								</h3></a>
						</div>
						<div class="valoraciones">
							
							<p>
								<?php
									if ($resulmedia <= 0) {
										echo 'No se ha puntuado.';
									} else {
										echo 'Nota Media: ' . $resulmedia;
									}
								?>
								
							</p>
							<?php
							//Si es admin o es un usuario registrado y es su servicio entonces puede editar
							if( isset($_SESSION['login_admin']) && $_SESSION['login_admin'] ||
								(isset($_SESSION['login_usuario']) && $_SESSION['login_usuario'] && 
									isset($servicio) && $_SESSION['usuario']->getId() == $servicio->getIdUsuario()) ){
										
								echo'<a href="editarservicio.php?id_servicio='.$servicio->getIdServicio().'"><h5>Editar Servicio</h5></a>';
							}
						?>
						</div>
					</div>
					<div class="descripcion">
						<h2>Descripción</h2>
							<p>
								<?php
								
									echo $resuldescrip;
								?>
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
						<form action="../controlador/nuevasolicitud.php" method="post" enctype="multipart/form-data" accept-charset="utf-8">
							<label>Solicitar servicio</label>
							<p>
								<textarea name="solicitud" rows="4" cols="50" placeholder="Escribe una solicitud para este servicio"></textarea>
							</p>
							<button id="button-enviar-solicitud" type="submit" name="submit" value="Enviar">
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
					<!-- ************************************************* -->
					<!--Aqui es donde pongo los comentarios y valoraciones -->
					<!-- ************************************************* -->
					
					
					<?php
					
					for ($i=0; $i < count($valoraciones) ; $i++) 
					{
						
					 $consultanombre=$BDDUsuario->conseguirUsuarioById($valoraciones[$i]->getIdUsuario())->getNombre();
					 $consultafoto=$BDDUsuario->conseguirUsuarioById($valoraciones[$i]->getIdUsuario())->getFoto();
					 $consultavalnota= $valoraciones[$i]->getNota();
					 $consultavalopinion=$valoraciones[$i]->getOpinion();
					 $consultavalFecha=$valoraciones[$i]->getFechaFormateada();
					 ?>
							<a href="perfil_usuario.php"><h4><?php echo $consultanombre ?></h4></a>
							<div class="coment-foto">
								<img src="images/<?php if (!isset($consultafoto)) {echo 'logo.png';}else{ echo 'usuario/'.$consultafoto;}?>"/>
							</div>
							<div class="coment-nota">
								<p>
									<?php
										echo "Nota: ".$consultavalnota."<br>"."  Fecha: ".$consultavalFecha."<br>"."<br>";
										
									?>
								</p>
							</div>
							<div class="coment">
								<p>
									<?php
									 //Aqui va lo de los comentarios sobre el servicio.
									 
									 if(isset($valoraciones)){
											foreach ($valoraciones as $valoracion) {
												echo "Opinión: ".$consultavalopinion."<br>"."<br>";
											}
										}
									
											
									?>
								</p>
							</div>
					<?php
					}
					?>					
					<!-- ************************************************* -->
					<!--               Aquí tengo que terminar             -->
					<!-- ************************************************* -->
					</div>
					<?php
						if ( isset($_SESSION['login_admin']) && $_SESSION['login_admin'] ) {//Si es admin
							//No hacemos nada
							
						} else if( (!isset($_SESSION['login_usuario']) || !$_SESSION['login_usuario'])  //Si no es usuario registrado
							|| ($_SESSION['usuario']->getId() == $usuario->getId()))  { // o el id del usuario logueado es distinto del id del usuario que ofrece el servicio 
					 		//no se hace nada
							
						}else { //Mostramos el formulario de valoración
							//El id_servicio se guarda en la sesion para que un usuario no pueda enviarse una solicitud a sí mismo
							$_SESSION['id_servicio'] = $id_servicio;
					 		
					?>
					<div class="comment-form">
						<form action="../controlador/insertarvaloracion.php" method="post" accept-charset="utf-8">
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
<script>
<?php
	if(isset($_SESSION['error'])){
?>
		alert("<?php echo $_SESSION['error'] ?>");
<?php 
		unset($_SESSION['error']);
	}
?>
</script>