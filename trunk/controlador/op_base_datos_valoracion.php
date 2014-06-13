<?php
require_once '../controlador/op_base_datos.php';

class MysqlValoracion extends Mysql {
	
	public function insertarvaloracion($comentario,$valoracion,$id_servicio,$id_usuario){
		$this->conectar();
		$args = array($id_servicio,$id_usuario,$valoracion,$comentario);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("insert into valoracion_servicio(id_servicio,id_usuario,nota,opinion,fecha) values (?,?,?,?,now())");
		$pst->bind_param("iiis", $args[0], $args[1], $args[2], $args[3]);
		$pst->execute();
		$id = mysqli_insert_id($this->conexion);
		
		$pst->close();
		$this->cerrar();
		
		return $id;
	}
	
	/**
	 * Obtiene la valoracion de un servicio con el id pasado por parámetro.
	 * @param id de la valoracion que se quiere obtener
	 * @return la valoración obtenida de la bdd.
	 */ 
	 public function conseguirValoraciones($id) {
		$this->conectar();
		$args = array($id);
		$pst = $this->conexion->prepare("SELECT * FROM valoracion_servicio WHERE id_servicio = ?");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->bind_result($id_valoracion, $id_servicio, $id_usuario, $nota, $opinion, $fecha);
		$resultado = NULL;
		while($pst->fetch()){
			$resultado[] = new Valoracion($id_valoracion, $id_servicio, $id_usuario, $nota, $opinion, $fecha);
		}
		$pst->close();
		$this->cerrar();
		return $resultado;
	}
	
}
