<?php
require_once '../controlador/op_base_datos.php';
require_once '../modelo/servicio.php';
/**
 * Para hacer las consultas relativas a la tabla de servicio
 */
class MysqlServicio extends Mysql {
	
	/**
	 * Obtiene un servicio con el id pasado por parámetro.
	 * @return el servicio de la base de datos.
	 */ 
	 public function conseguirServicio($id) {
		$this->conectar();
		$pst = $this->conexion->prepare("select * from servicio where id_servicio = ?");
		$pst->bind_param("i", $id);
		$pst->execute();
		$resultado = $pst->bind_result($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto); 
		$pst->fetch();
		$servicio = new Servicio($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto);
	
		$pst->close();
		$this->cerrar();
		unset($resultado);
	
		return $servicio;
	}
		
}
	