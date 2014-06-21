<?php 
require_once '../modelo/usuario.php';
session_start();
?>
<!DOCTYPE html>
<html lang="es">
	<?php include "head.php"?>
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
							<form action="../controlador/createservice.php" method="post" enctype="multipart/form-data" accept-charset="utf-8">
								<div class="col-md-4">
									<label for="nombreserv" class="required">Nombre del servicio:</label>
									<input name="nombreserv" type="text" id="nombreserv" maxlength="40" required/>
								</div>
								<div class="col-md-4">
									<label for="descrpserv" class="required">Descripcion:</label>
									<textarea name="descrpserv" rows="4" cols="50" placeholder="Describe tu servicio" required></textarea>
								</div>
								<div class="col-md-4">
									<label for="categoria" class="required">Categoría:</label>
									<select name="categoria" class="required" required>
										<option value="1">Jardinería</option>
										<option value="2">Idiomas</option>
										<option value="3">Deportes</option>
										<option value="4">Hogar</option>
										<option value="5">Otros</option>
									</select>
								</div>
								<!-- /.col-md-4 -->
								<div class="col-md-8">
									<label for="foto">Imagen del servicio:</label>
									<input name="foto" type="file" id="foto" maxlength="40" />
								</div>
								<div class="col-md-4">
									<label for="horaserv" class="required">Horas que cuesta:</label>
									<input name="horaserv" type="text" id="horaserv" maxlength="40" required/>
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
</html>