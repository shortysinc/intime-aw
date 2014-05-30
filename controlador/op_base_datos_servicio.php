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
	 
	 public function busqueda($nombre){
		$this->conectar();
		$args = array($nombre);
		$ret = array();
		$i=0;
		//Escapamos los datos obtenidos del formulario
		$this->escapaBd($args);
		$args[0]="%".$args[0]."%";
		$pst =  $this->conexion->prepare("select nombre,apellidos,usuario.foto_usuario,nombre_servicio,descripcion,usuario.id_usuario,servicio.id_servicio from usuario,servicio where nombre_servicio like ? and usuario.id_usuario=servicio.id_usuario  ");
		$pst->bind_param("s", $args[0]);
		$pst->execute();
		$pst->bind_result($nombre,$apellidos,$foto,$nomservicio,$decripcion,$idusuario,$idservicio);
		while($pst->fetch()){
			$info = array($nombre,$apellidos,$foto,$nomservicio,$decripcion,$idusuario,$idservicio);
			$ret[$i]=$info;
			$i=$i+1;
		}
		$pst->close();
		$this->cerrar();
		return $ret;
	}
	 
	 public function busquedaavanzada($corte,$id){
		$this->conectar();
		$ret = array();
		$i=0;
		
		//Escapamos los datos obtenidos del formulario
		$pst =  $this->conexion->prepare("select distinct nombre,apellidos,usuario.foto,nombre_servicio,descripcion,usuario.id_usuario,servicio.id_servicio,nota from usuario,servicio,valoracion_servicio where usuario.id_usuario=servicio.id_usuario and valoracion_servicio.id_servicio=servicio.id_servicio and servicio.id_usuario<>? and valoracion_servicio.id_usuario=? and nota>=? ");
		$pst->bind_param("sss",$id,$corte);
		$pst->execute();
		$pst->bind_result($nombre,$apellidos,$foto,$nomservicio,$decripcion,$idusuario,$idservicio,$nota);
		echo"<p>".$nomservicio."</p>";
		while($pst->fetch()){
			$info = array($nombre,$apellidos,$foto,$nomservicio,$decripcion,$idusuario,$idservicio,$nota);
			$ret[$i]=$info;
			$i=$i+1;
		}
		$pst->close();
		$this->cerrar();
		return $ret;
	}
	 
	 public function notamedia($idservicio){
		$this->conectar();
		$pst=$this->conexion->prepare("SELECT avg(nota) from valoracion_servicio,servicio where servicio.id_servicio=? and servicio.id_servicio=valoracion_servicio.id_servicio");
		$pst->bind_param("s",$idservicio);
		$pst->execute();
		$pst->bind_result($nota);
		$pst->fetch();
		$pst->close();
		$this->cerrar();
		return $nota;
	}
	
	/**
	 * Obtiene todas las categorías de la bdd.
	 * @return todas las categorías de la bdd.
	 */
	public function conseguirTodasLasCategorias() {
		$this->conectar();
		//var_dump("conexion", $this->conexion);
		$pst = $this->conexion->prepare("select * from categoria order by categoria");
		//var_dump("preparado", $pst);
		$pst->execute();
		//var_dump("ejecutado", $pst);
		$pst->bind_result($id, $categoria);
		while ($pst->fetch()) {
			$resultado[] = array('id_categoria'=>$id, 'categoria'=>$categoria);
		}
		$pst->close();
		$this->cerrar();
		//var_dump("cerrado",$resultado);
		return $resultado;
	}
	
	/**
	 * Obtiene todos los servicios de la categoría pasada por parámentro
	 * @param $categoria
	 * @return todos los servicios de una categoría
	 */
	public function conseguirServiciosPorCategoria($id) {
		$this->conectar();
		$pst = $this->conexion->prepare("SELECT * FROM servicio where id_categoria = ?");
		$pst->bind_param("i", $id);
		$pst->execute();
		$pst->bind_result($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto);
		while($pst->fetch()){
			$resultado[] = new Servicio($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto);
		}
		
		$pst->close();
		$this->cerrar();
		
		return $resultado;
	}
	
	public function conseguirServiciosByUserId($id){
		$this->conectar();
		$i=0;
		$ret=array();
		$pst = $this->conexion->prepare("select id_servicio,nombre_servicio,descripcion from servicio where id_usuario= ?");
		$pst->bind_param("s", $id);
		$pst->execute();
		$pst->bind_result($id,$nombre,$descripcion);
		while($pst->fetch()){
			$info = array($id,$nombre,$descripcion);
			$ret[$i]=$info;
			$i=$i+1;
			//
		}
		$pst->close();
		return $ret;
	}
		
}
	