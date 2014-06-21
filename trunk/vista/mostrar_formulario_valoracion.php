<?php
session_start();

require_once '../controlador/comprobar_login.php';

if(isset($_GET['id_solicitud'])){
	
?>

<form action="../controlador/insertarvaloracion.php?id_solicitud=<?php echo $_GET['id_solicitud'] ?>" method="post" accept-charset="utf-8">
	<label>Enviar comentario y/o valoración</label>
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
<?php
}
?>