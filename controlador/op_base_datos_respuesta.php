<?php
require_once '../controlador/op_base_datos.php';

/**
 * Para hacer las consultas relativas a la tabla de respuesta
 */
class MysqlRespuesta extends Mysql {
	/**
	 * Inserta una respuesta en la bdd
	 * @param $id_usuario, $id_solicitud, $comentario
	 * @return un número mayor que cero si ha ocurrido algún error, cero si todo ha ido bien
	 */
	public function insertarRespuesta($id_usuario, $id_solicitud, $comentario){
		$this->conectar();
		$args = array($id_usuario, $id_solicitud, $comentario);
		$this->escapaBdYDesinfecta($args);
		$pst = $this->conexion->prepare("INSERT INTO respuesta(id_usuario, id_solicitud, comentario, fecha) values (?,?,?,now())");
		$pst->bind_param("iis", $args[0], $args[1], $args[2]);
		$pst->execute();
		
		$error = $pst->errno;
		
		$pst->close();
		$this->cerrar();
		
		return $error;
	}
	
	
	/**
	 * Obtiene las respuestas a una solicitud
	 * @param id_solicitud id de la solicitud de la cual se quieren obtener sus respuestas
	 * @return las respuestas obtenidas de la bdd
	 */
	public function conseguirRespuestasASolicitud($idSolicitud){
		$this->conectar();
		$args = array($idSolicitud);
		$pst = $this->conexion->prepare("SELECT * FROM respuesta WHERE id_solicitud = ?");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->bind_result($id_respuesta, $id_usuario, $id_solicitud, $comentario, $fecha);
		$resultado = NULL;
		
		while($pst->fetch()){
			$resultado[] = new Respuesta($id_respuesta, $id_usuario, $id_solicitud, $comentario, $fecha);
		}
		
		$pst->close();
		$this->cerrar();
		return $resultado;
	}
}
	