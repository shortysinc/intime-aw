<!DOCTYPE html>
<html lang="es">
<?php 
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../controlador/op_base_datos_servicio.php';
	require_once '../controlador/op_base_datos_servicio_realizado.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/servicio.php';
	require_once '../modelo/solicitud.php';
	session_start();
	
	require_once '../controlador/comprobar_login.php';
	
?>
	<?php include "head.php"?>
	<script src="jquery/jquery-2.1.0.min.js" type="text/javascript"></script>
	<body>
		<?php include "sidebar.php";
		
			$solRecibidasNoVistas = $BDD->conseguirSolicitudesRecibidasNoVistas($usuario->getId());
			$solAceptadasNoVistas = $BDD->conseguirSolicitudesAceptadasNovistas($usuario->getId());
			$solRechazadasNoVistas = $BDD->conseguirSolicitudesRechazadasNovistas($usuario->getId());
			
			$num_sol_recibidas = count($solRecibidasNoVistas);
			$num_sol_aceptadas = count($solAceptadasNoVistas);
			$num_sol_rechazadas = count($solRechazadasNoVistas);
		
			$BDD = new MysqlServicio();
			$servicios_realizados = $BDD->conseguirServiciosSolicitudAceptadosRealizados($usuario->getId());
			$servicios_proximos = $BDD->conseguirServiciosSolicitudAceptadosNoRealizados($usuario->getId());
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
										<button type="submit" name="submit">
											Enviar
										</button>
										<a href="busqueda.php">Búsqueda avanzada</a>
									</form>
								</div>
							</div>
						</div>
						<h1 id='nombre-principal'><?php echo $usuario->getNombre()." ".$usuario->getApellidos(); ?></h1>
					</div>
					<div class="cuerpo">
						<?php
							if($num_sol_recibidas == 1){
								echo "<h3 id='solicitud'><a href='solicitudes.php?tipo=0&estado=0'>Tienes ".$num_sol_recibidas." solicitud pendiente de aceptar</a></h3>";
							}else if($num_sol_recibidas > 1){
								echo "<h3 id='solicitud'><a href='solicitudes.php?tipo=0&estado=0'>Tienes ".$num_sol_recibidas." solicitudes pendientes de aceptar</a></h3>";
							}
						
							if($num_sol_aceptadas == 1){
								echo "<h3><a class='solicitud-aceptada' href='solicitudes.php?tipo=1&estado=1'>Una solicitud enviada ha sido aceptada</a></h3>";
								
							}else if($num_sol_aceptadas > 1){
								echo "<h3><a class='solicitud-aceptada' href='solicitudes.php?tipo=1&estado=1>Varias solicitudes enviadas han sido aceptadas</a></h3>";
							}
							
							if($num_sol_rechazadas == 1){
								echo "<h3><a class='solicitud-rechazada' href='solicitudes.php?tipo=1&estado=2'>Una solicitud enviada ha sido rechazada</a></h3>";
							}else if($num_sol_rechazadas > 1){
								echo "<h3><a class='solicitud-rechazada' href='solicitudes.php?tipo=1&estado=2>Varias solicitudes enviadas han sido rechazadas</a></h3>";
							}
						?>
						<h2>Mis servicios comprados</h2>
						<div class="lista-serv" id="proximos">
							<?php
								if(isset($servicios_proximos)){
									$siguiente = $servicios_proximos[count($servicios_proximos)-1]['solicitud'];
									$fecha_fin = strtotime($siguiente->getInicio());
							?>
									<h3><span class="verde">Próximos</span></h3>
									<?php 
										$now = strtotime(date("d-m-Y H:i:00",time()));
										//Diferencia de horas
										$dif = $fecha_fin * 3600 - $now * 3600;
										//Si la diferencia de horas es menor que 24 se muestra el temporizador
										if($dif > 24){
											$fecha_fin = $fecha_fin * 1000;
									?>
									<div id="fecha">
										<h2>Tiempo que queda para el siguiente:</h2>
										<div id="reloj">
											<span id="horas" class="cuad"> </span>
											<span class="separador">:</span>
											<span id="minutos" class="cuad"> </span>
											<span class="separador">:</span>
											<span id="segundos" class="cuad"> </span>
										</div>
									</div>
									<script>
										var dateFin = new Date(<?php echo $fecha_fin ?>);
										
										setInterval( function mostrarReloj() {
											var dateNow = new Date();
											console.log(dateFin.getMilliseconds());
											var date = new Date(dateFin.getTime() - dateNow.getTime());
											console.log(dateFin);
											console.log(dateNow);
											var horas = date.getHours();
											var minutos = date.getMinutes();
											var segundos = date.getSeconds();
											if(horas >= 0 && horas <= 9){
												horas = '0' + horas;
											}
											if(minutos >= 0 && minutos <= 9){
												minutos = '0' + minutos;
											}
											if(segundos >= 0 && segundos <= 9){
												segundos = '0' + segundos;
											}
											
											document.getElementById("horas").innerHTML = horas;
											document.getElementById("minutos").innerHTML = minutos;
											document.getElementById("segundos").innerHTML = segundos;
											
											}, 1000);

									</script>
									</br>
							
							<?php		
							}
									foreach($servicios_proximos as $row){
										$servicio = $row['servicio'];
										$solicitud = $row['solicitud'];
							?>			
										<div class="servicio-ej">
											<?php 
												echo '<a href="servicio.php?id_servicio='.$servicio->getIdServicio().'"><h4>'.$servicio->getNombre().'</h4></a>';
											?>
											<div class="serv-nota">
											<?php
												$nota = $BDD->notamedia($servicio->getIdServicio());
												if (!empty($nota))
													echo"<p>Nota: ".$nota."</p>";
												else
													echo"<p>No valorado</p>";
											?>
											</div>
											<div class="serv-desc">
											<?php
												echo"<p><span class='explicacion'>".$servicio->getDescripcion()."</span></p>";
												echo "<p><span class='verde'>Inicio: ".$solicitud->getInicioFormateada()."</span>  - <span class='rojo'>Fin: ".$solicitud->getFinFormateada()."</span></p>";
											?>
											</div>
										</div>
							<?php 
									} 
								}
							?>
						</div>
						<div class="lista-serv" id="realizados">
							<h3>Realizados</h3>
							<?php
								if(isset($servicios_realizados)){
									foreach($servicios_realizados as $row){
										$servicio = $row['servicio'];
										$solicitud = $row['solicitud'];
							?>
										<div class="servicio-ej">
											<?php 
												echo '<a href="servicio.php?id_servicio='.$servicio->getIdServicio().'"><h4>'.$servicio->getNombre().'</h4></a>';
											?>
											<div class="serv-nota">
											<?php
												$nota = $BDD->notamedia($servicio->getIdServicio());
												if (!empty($nota))
													echo"<p>Nota: ".$nota."</p>";
												else
													echo"<p>No valorado</p>";
											?>
											</div>
												<div class="serv-desc">
												<?php
													echo"<p>".$servicio->getDescripcion()."</p>";
													echo "<p>Finalizado: ".$solicitud->getFinFormateada()."</p>";
													
													$BDDServicioRealizado = new  MysqlServicioRealizado();
													if(!$BDDServicioRealizado->estaValorado($solicitud->getIdSolicitud())){
												?>
													<p>
														<a id="mov<?php echo $solicitud->getIdSolicitud()?>" class="mostrar-ocultar" onclick="mostrarFormularioValoracion(<?php echo $solicitud->getIdSolicitud()?>)" >Valóralo</a>
													</p>
												<div id = "val<?php echo $solicitud->getIdSolicitud()?>" class="comment-form">
												</div>
												<?php
													}
												?>
											</div>
										</div>
										<script>
											function mostrarFormularioValoracion(num){
												if($("#mov"+num).text()=='Valóralo'){
													$("#val"+num).load("mostrar_formulario_valoracion.php?id_solicitud="+num);
													$("#mov"+num).text("Ocultar");
												}else{
													$("#val"+num).html("");
													$("#mov"+num).text("Valóralo");
												}
											}
										</script>
							<?php
									}
								}
							?>
						</div>
					</div>
				</div>
				<!-- /#services -->
			</div>
			<!-- /#templatemo"-->
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content-->
		
	</body>
</html>
<?php
	if(isset($_SESSION["mensaje"])){
	?>
		<script>
			alert("<?php echo $_SESSION['mensaje'] ?>");
		</script>
	<?php
		unset($_SESSION["mensaje"]);
	}
	
	if(isset($_SESSION["error"])){
	?>
		<script>
			alert("<?php echo $_SESSION['error'] ?> ");
		</script>
	<?php	
	}
			unset($_SESSION["error"]);
	?>