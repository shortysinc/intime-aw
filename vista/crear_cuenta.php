<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
		<?php include "head.php"?>
	<body>
		<?php include "sidebar.php"?>
		<div id="main-content">
			<div id="templatemo">
				<div class="section-content">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">
								<h1>Únete a inTime</h2>
							</div>
							<!-- section-title -->
						</div>
							<div class="cuerpo">
								<div class="contact-form" id="form">
									<form action="../controlador/procesar_crear_cuenta.php" method="post" accept-charset="utf-8">
										<div class="col-md-4">
											<label for="nombre" class="required">Nombre:</label>
											<input name="nombre" type="text" id="nombre" maxlength="40" required/>
										</div>
										<div class="col-md-4">
											<label for="apellidos">Apellidos:</label>
											<input name="apellidos" type="text" id="apellidos" maxlength="40"/>
										</div>
										<div class="col-md-8">
											<label for="domicilio" class="required">Domicilio:</label>
											<input name="domicilio" type="text" id="domicilio" maxlength="60" required/>
										</div>
										<!-- /.col-md-4 -->
										<div class="col-md-8">
											<label for="email" class="required">Correo electrónico:</label>
											<input name="email" type="email" id="email" maxlength="40" required/>
										</div>
										<!-- /.col-md-4 -->
										<div class="col-md-4" id="pass">
											<label for="pass" class="required">Contraseña:</label>
											<input name="pass" type="password" id="pass" maxlength="60" required/>
										</div>
										<!-- /.col-md-4 -->
										<div class="col-md-4">
											<label for="repass" class="required">Repite la contraseña:</label>
											<input name="repass" type="password" id="repass" maxlength="60" required/>
										</div>
										<div class="col-md-6">
											<!--<p><label for="birth">Fecha de nacimiento:</label></p>
											<span class="birth">
												<select id="dia"></select>
												<select id="mes"></select>
												<select id="anio"></select>
											</span>-->
										</div>
										<!-- /.col-md-12 -->
										<div class="col-md-4">
												<!--<a ="#" class="largeButton contactBgColor">Send Message</a>-->
												<button class="largeButton submitBgColor" id="enviar-usr" type="submit" value="Enviar">
													Enviar
												</button>
										</div>
										<!-- /.col-md-12 -->
									</form>
								</div>
						<!-- /.contatc-form -->
						</div>
						<!-- col-md-12 -->
					</div>
					<!-- /#row -->
					
				</div>
				<!-- /#section-content -->
			</div>
			<!-- /#templatemo"-->
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content-->
	</body>
	<?php
			if(isset($_SESSION["error"])){
		?>
				<script>			
					alert("<?php echo $_SESSION['error']?>");
				</script>
				
		<?php
				unset($_SESSION["error"]);
				
			}
		?>
</html>