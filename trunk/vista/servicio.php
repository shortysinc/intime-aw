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
	<?php include "head.php"?>
	<!--NUEVO -->
	<?php
		if(isset($_GET['id_servicio'])){
			$id_servicio = $_GET['id_servicio'];
			$BDDServicio = new MysqlServicio();
			$BDDUsuario = new MysqlUsuario();
			$BDDValoracion = new MysqlValoracion();
			$servicio = $BDDServicio->conseguirServicio($id_servicio);
			if(isset($servicio)){
				$user = $BDDUsuario->conseguirUsuarioById($servicio->getIdUsuario());
				$valoraciones= $BDDValoracion->conseguirValoraciones($id_servicio);
				$resuldescrip = $servicio->getDescripcion();
				$resulmedia = $BDDServicio->notamedia($id_servicio);
				$nombreServicio= $servicio->getNombre();
				$fotoservice= $user->getFoto();
				$horasServicio = $servicio->getHoras();
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
				<div class="section-content">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">
								<div class="buscador">
									<form method="post" action="busqueda.php" accept-charset="utf-8">
										<label>Buscar</label>
										<input type="text" name="nombrebusq" size="50">
										<button type="submit" name="submit" value="Enviar">
											Enviar
										</button>
										<a href="busqueda.php">Búsqueda avanzada</a>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="cuerpo">
				<?php if(isset($servicio)){ ?>
				<div class="encabezado">
					<?php 
							echo "<h1>".$nombreServicio."</h1>";
							if ($servicio->getFoto()!=NULL)	{
								echo "<img src='images/servicio/".$servicio->getFoto()."'";
							}
							ELSE{
								echo '<img src="images/servicio/service_defect.png">';	
							}
					?>
					<!--Foto servicio -->
				</div>
				<div class="servicio">
					<div class="horas-servicio">
						<div class="contador-servicio">
							<?php echo $horasServicio ?>
						</div>
						<p>Horas</p>
					</div>
					<div class="autor">
						<img src="images/usuario/<?php if (isset($fotoservice)) {echo $user->getFoto();} else {echo "user_defect.png" ;}?>" >
							<div class="nombretrabajo">
							<a href="perfil.php?id_usuario=<?php echo $user->getId() ?>">
								<h3><?php echo $user->getNombre();?></h3></a>
						</div>
					
						<div class="valoraciones">
							
							<p>
								<?php
									if ($resulmedia <= 0) {
										echo 'No se ha puntuado.';
									} else {
										echo 'Nota Media: ' .'<span class="negrita">'.$resulmedia.'</span>';
									}
								?>
								
							</p>
							<?php
							//Si es admin o es un usuario registrado y es su servicio entonces puede editar
							if( isset($_SESSION['login_admin']) && $_SESSION['login_admin'] ||
								(isset($_SESSION['login_usuario']) && $_SESSION['login_usuario'] && 
									isset($servicio) && $_SESSION['usuario']->getId() == $servicio->getIdUsuario()) ){
										
								echo'<a href="editarservicio.php?id_servicio='.$servicio->getIdServicio().'"><h5>Editar Servicio</h5></a>';
								
							//Si es usuario registrado pero no es su servicio ni tampoco es admin entonces puede guardar en favoritos
							}if(isset($_SESSION['login_usuario']) && $_SESSION['login_usuario'] ) {
								$favoritos = $BDDServicio->conseguirServiciosFavoritos($_SESSION['usuario']->getId());
								//Si el servicio está en favoritos
								if(Servicio::estaDentro($servicio->getIdServicio(), $favoritos)){
									echo '<a href="../controlador/quitar_favorito.php?id_servicio='.$servicio->getIdServicio().'"><h5>Quitar de favoritos</h5></a>';
								}else{
									echo '<a href="../controlador/agregar_favorito.php?id_servicio='.$servicio->getIdServicio().'"><h5>Añadir a favoritos</h5></a>';
								}
								
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
							
						// si id del usuario logueado es igual al id del usuario que ofrece el servicio
						}else if (($_SESSION['usuario']->getId() == $user->getId()))  { 
							//No hacemos nada
						}else {
							
					?>
					<div class="solicitud">
						<form action="../controlador/nuevasolicitud.php?id_servicio=<?php echo $id_servicio?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
							<label>Solicitar servicio</label>
							<p>
								<textarea name="solicitud" rows="4" cols="50" placeholder="Escribe una solicitud para este servicio"></textarea>
							</p>
							
							<input type="text" id="hora_inicio" name="hora_inicio" placeholder="Fecha y Hora para servicio"/>
							
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
					if(isset($valoraciones)){
					foreach ($valoraciones as $valoracion) {
						
					 $consultanombre=$BDDUsuario->conseguirUsuarioById($valoracion->getIdUsuario())->getNombre();
					 $consultafoto=$BDDUsuario->conseguirUsuarioById($valoracion->getIdUsuario())->getFoto();
					 $consultavalnota= $valoracion->getNota();
					 $consultavalopinion= $valoracion->getOpinion();
					 $consultavalFecha=$valoracion->getFechaFormateada();
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
										echo "Opinión: ".$consultavalopinion."<br>"."<br>";
									?>
								</p>
							</div>
					<?php
					}
					}
					?>					
					<!-- ************************************************* -->
					<!--               Aquí tengo que terminar             -->
					<!-- ************************************************* -->
					</div>
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
<link rel="stylesheet" type="text/css" href="./css/jquery.datetimepicker.css"/>
<script type="text/javascript" src="./jquery/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.datetimepicker.js"></script>

<script> $('#hora_inicio').datetimepicker({
		 lang:'es',
		 i18n:{
		  de:{
		   months:[
		    'Enero','Febrero','Marzo','Abril',
		    'Mayo','Junio','Julio','Agosto',
		    'Septiembre','Octubre','Noviembre','Diciembre',
		   ],
		   dayOfWeek:[
		    "Do", "Lu", "Ma", "Mi", 
		    "Ju", "Vi", "Sa",
		   ]
		  }
		 },
		 timepicker:true,
		 dayOfWeekStart: 1,
		 format:'d-m-Y H:i',
		 minDate:'-1970/01/02',
});</script>
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