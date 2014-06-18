<!DOCTYPE html>
<html lang="es">
	<?php
		require_once '../controlador/op_base_datos_servicio.php';
		require_once '../modelo/usuario.php';
		require_once '../controlador/op_base_datos_usuario.php';
		require_once '../modelo/servicio.php';
		session_start();
	?>
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
								<div class="buscador">
									<form method="post" action="busqueda.php" accept-charset="utf-8">
										<form action="" method="get" accept-charset="utf-8">
											<label>Buscar</label>
											<input type="text" name="nombrebusq" size="50">
											<button type="submit" name="submit" value="Enviar">
												Enviar
											</button>
										</form>
										<?php if (isset($_SESSION['login_usuario'])){ ?>
											<div class="avanzada">
												<form method="post" action="busqueda.php" accept-charset="utf-8">
													<label>Busqueda por confianza: </label>
													<input type="radio" name="consulta" value="propia" checked="checked" />
													Busca por confianza propia.
													<input type="radio" name="consulta" value="red" />
													Busca por red de confianza
													<select name="valbusq">
														<option value="5" selected>5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
													</select>
													<button type="submit" value="Entrar">
														Entrar
													</button>
												</form>
											</div>
										<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="lista">
					<?php include "../controlador/busquedanormal.php"?>
				</div>
			</div>
			<!-- /.templatemo -->
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content -->
	</body>
</html>