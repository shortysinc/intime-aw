<?php
require_once 'op_base_datos.php';

class MysqlServicioRealizado extends Mysql {
	
	/**
	 * Inserta un servicio realizado en la bdd
	 */
	public function insertarServicioRealizado($id_solicitud){
		$this->conectar();
		$args = array($id_solicitud);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("insert into servicio_realizado(id_solicitud) values (?)");
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
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("SELECT * FROM servicio_realizado WHERE id_solicitud = ?");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->bind_result($id_ser_realizado, $id_solicitud);
		$resultado = NULL;
		while($pst->fetch()){
			$resultado = new ServicioRealizado($id_ser_realizado, $id_solicitud);
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
		$this->escapaBd($args);
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
	