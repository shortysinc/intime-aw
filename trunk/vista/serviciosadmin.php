<!DOCTYPE html>
<?php
	require_once '../controlador/op_base_datos_servicio.php';
	require_once '../modelo/servicio.php';
	require_once '../modelo/admin.php';
	session_start();
?>
<html lang="es">
	<?php include "head.php";?>
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
										<button type="submit" name="submit">
											Enviar
										</button>
										<a href="busqueda.php">Búsqueda avanzada</a>
									</form>
								</div>
							</div>
							<!-- /#sTop -->
						</div>
					</div>
					<div class="panel-admin">
						<div class="lista-admin">
								<?php
								$BDD = new MysqlServicio();
								$resultado = $BDD->mostrar_todos_servicios();
								echo "<h1>LISTA DE USUARIOS</h1>";
								echo "<table border='1' cellpadding='2' cellspacing='2'>";
								echo "<tr><td>ID Servicio</td><td>ID Usuario Ofertante</td><td>Nombre del Servicio</td>";
								while ($row = mysqli_fetch_array($resultado)) {
								$id = $row['id_servicio'];
								$id_usuario = $row['id_usuario'];
							        echo "<tr>";
							        echo "<td>".$row["id_servicio"]."</td>";
							        echo "<td><a href='../vista/perfil.php?id_usuario=$id_usuario'>".$row["id_usuario"]."</a></td>";
							        echo "<td><a href='../vista/servicio.php?id_servicio=$id';>".$row["nombre_servicio"]."</a></td>";
									echo "<td><a href ='#' onClick='javascript:ConfirmDelete($id)'‌​>Borrar Servicio</a></td>";
									echo "<td><a href='../vista/editarservicio.php?id_servicio=$id'>Editar Servicio</a></td>";
							        echo "</tr>";
								}
								$resultado->free(); 
								?>
								</table>
					</div>
				</div>
			</div>
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content -->
	</body>
	<script>
 	     function ConfirmDelete(ID)
  		    {
        	    if (confirm("¿Seguro que desea borrar el Servicio " + ID +" ?"))
       	          location.href='../controlador/deleteservice.php?id=' + ID;
  		    }
	 </script>
</html>