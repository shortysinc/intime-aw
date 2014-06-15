<?php
require_once '../controlador/op_base_datos.php';

class MysqlServicioRealizado extends Mysql {
	
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
}
	