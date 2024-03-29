<!DOCTYPE html>
<?php
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/admin.php';
	session_start();
?>
<html lang="es">
	<?php include "head.php";?>
	<body>
		<?php include "sidebar.php";
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
							$BDD = new MysqlUsuario();
							$resultado = $BDD->mostrar_todos_usuarios();
							echo "<h1>LISTA DE USUARIOS</h1>";
							echo "<table border='1' cellpadding='2' cellspacing='2'>";
							echo "<tr><td>ID</td><td>Nombre</td><td>Correo</td><td>Direccion</td><td>Horas</td>";
							while ($row = mysqli_fetch_array($resultado)) {
							$id = $row['id_usuario'];
							        echo "<tr>";
							        echo "<td>".$row["id_usuario"]."</td>";
							        echo "<td><a href='../vista/perfil.php?id_usuario=$id'>".$row["nombre"]."</a></td>";
							        echo "<td>".$row["correo"]."</td>";
							        echo "<td>".$row["direccion"]."</td>";
							        echo "<td>".$row["horas_usuario"]."</td>";
									echo "<td><a href ='#' onClick='javascript:ConfirmDelete($id)'‌​>Borrar User</a></td>";
									echo "<td><a href='../vista/editarperfil.php?id_usuario=$id'>Editar User</a></td>";
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
		</div>
		<!-- /#main-content -->
		<script>
 	     function ConfirmDelete(ID)
  		    {
        	    if (confirm("¿Seguro que desea borrar el Usuario " + ID +" ?"))
       	          location.href='../controlador/deleteuser.php?id=' + ID;
  		    }
		 </script>
	</body>
</html>