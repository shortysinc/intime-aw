<?php
require_once '../controlador/op_base_datos.php';

class MysqlValoracion extends Mysql {
	
	public function insertarvaloracion($id_ser_realizado,$id_usuario,$nota,$opinion){
		$this->conectar();
		$args = array($id_ser_realizado,$id_usuario,$nota,$opinion);
		$this->escapaBdYDesinfecta($args);
		$pst = $this->conexion->prepare("insert into valoracion_servicio(id_ser_realizado,id_usuario,nota,opinion,fecha) values (?,?,?,?,now())");
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
	 public function conseguirValoraciones($id_servicio) {
		$this->conectar();
		$args = array($id_servicio);
		$pst = $this->conexion->prepare("SELECT valoracion_servicio.* FROM valoracion_servicio NATURAL JOIN servicio_realizado 
			JOIN solicitud WHERE servicio_realizado.id_solicitud = solicitud.id_solicitud and solicitud.id_servicio = ?");
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
