<?php
require_once 'op_base_datos.php';

class MysqlServicioRealizado extends Mysql {
	
	/**
	 * Actualiza el campo de la tabla servicio_realizado a 1 (cobrado)
	 */
	public function cobrarServicio($id_ser_realizado){
		$this->conectar();
		$args = array($id_ser_realizado);
		$this->escapaBdYDesinfecta($args);
		$pst = $this->conexion->prepare("UPDATE servicio_realizado SET cobrado = 1 WHERE id_ser_realizado = ?");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->close();
		
		$this->cerrar();
	}
	
	/**
	 * Inserta un servicio realizado en la bdd
	 */
	public function insertarServicioRealizado($id_solicitud){
		$this->conectar();
		$args = array($id_solicitud);
		$this->escapaBdYDesinfecta($args);
		$pst = $this->conexion->prepare("insert into servicio_realizado(id_solicitud, cobrado) values (?, 0)");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		//$id = mysqli_insert_id($this->conexion);
		
		$pst->close();
		$this->cerrar();
		
		//return $id;
	}
	
	/**
	 * Obtiene el servicio realizado a partir de una solicitud
	 * @param id_solicitud
	 * @return el servicio realizado
	 */
	public function conseguirServicioRealizadoPorIdSol($id_solicitud){
		$this->conectar();
		$args = array($id_solicitud);
		$pst = $this->conexion->prepare("SELECT * FROM servicio_realizado WHERE id_solicitud = ?");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->bind_result($id_ser_realizado, $id_solicitud, $cobrado);
		$resultado = NULL;
		while($pst->fetch()){
			$resultado = new ServicioRealizado($id_ser_realizado, $id_solicitud, $cobrado);
		}
		
		$pst->close();
		$this->cerrar();
		
		return $resultado;
	}
	
	/**
	 * Obtiene los servicios realizados no cobrados por parte del usuario cuyo id se pasa por parámetro
	 * @param $id_usuario
	 * @return un array que contiene un array con los servicios realizados no cobrados junto con su servicio relacionado. 
	 */
	public function conseguirSerRealizadosNoCobrados($id_usuario){
		$this->conectar();
		$args = array($id_usuario);
		$this->escapaBdYDesinfecta($args);
		$pst = $this->conexion->prepare("SELECT servicio.*, servicio_realizado.* FROM servicio_realizado natural join 
			solicitud join servicio WHERE solicitud.id_servicio = servicio.id_servicio and servicio.id_usuario = ? and 
			servicio_realizado.cobrado = 0 ");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->bind_result($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto,
			$id_ser_realizado, $id_solicitud, $cobrado);
		$resultado = NULL;
		
		while($pst->fetch()){
			$resultado[] = array('servicio' => new Servicio($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto), 
				'servicio_realizado' => new ServicioRealizado($id_ser_realizado, $id_solicitud, $cobrado));
		}
		
		$pst->close();
		$this->cerrar();
		
		return $resultado;
	}
	
	
	/**
	 * Comprueba si un servicio realizado esta valorado a partir del id_solicitud
	 * @return true en caso de que este valorado, false si no está valorado
	 */
	public function estaValorado($id_solicitud){
		$this->conectar();
		$args = array($id_solicitud);
		$this->escapaBdYDesinfecta($args);
		$pst = $this->conexion->prepare("SELECT id_solicitud FROM servicio_realizado natural join valoracion_servicio WHERE id_solicitud = ?");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->bind_result($id);
		$esta = FALSE;
		
		if($pst->fetch()){
			$esta = TRUE;
		}
		
		$pst->close();
		$this->cerrar();
		
		return $esta;
	}
}
	