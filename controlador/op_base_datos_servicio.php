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
	 public function conseguirServicio($id_servicio) {
		$this->conectar();
		$args = array($id_servicio);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("select * from servicio where id_servicio = ?");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->bind_result($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto);
		$resultado = NULL;
		
		if($pst->fetch()){
			$resultado = new Servicio($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto);
		}
		
		$pst->close();
		$this->cerrar();
	
		return $resultado;
	}
	 
	 public function busqueda($nombre){
		$this->conectar();
		$args = array($nombre);
		$ret = array();
		$i=0;
		//Escapamos los datos obtenidos del formulario
		$this->escapaBd($args);
		$args[0]="%".$args[0]."%";
		$pst =  $this->conexion->prepare("select * from servicio where nombre_servicio like ? ");
		$pst->bind_param("s", $args[0]);
		$pst->execute();
		$pst->bind_result($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto);
		while($pst->fetch()){
			$servicio = new Servicio($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto);
			$ret[$i]=$servicio;
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
			$pst =  $this->conexion->prepare("select distinct servicio.id_servicio,servicio.id_usuario,id_categoria,nombre_servicio,descripcion,horas,foto_servicio
			from servicio,solicitud,servicio_realizado,valoracion_servicio where servicio.id_servicio=solicitud.id_servicio and solicitud.id_solicitud=servicio_realizado.id_solicitud 
			and servicio_realizado.id_ser_realizado=valoracion_servicio.id_ser_realizado and servicio.id_usuario<>? and valoracion_servicio.id_usuario=? and nota>=?");
		$pst->bind_param("sss",$id,$id,$corte);
		$pst->execute();
		$pst->bind_result($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto);
		
		while($pst->fetch()){
			$servicio = new Servicio($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto);
			$ret[$i]=$servicio;
			$i=$i+1;
		}
		
		$pst->close();
		$this->cerrar();
		
		return $ret;
	}
	 
	 /**
	  * Obtiene la nota media del servicio cuyo id se pasa por parámetro
	  * @param $idServicio
	  * @return la nota media para ese servicio
	  */
	 public function notamedia($id_servicio){
		$this->conectar();
		$args = array($id_servicio);
		$this->escapaBd($args);
		$pst=$this->conexion->prepare("SELECT ROUND(avg(nota),1) FROM valoracion_servicio NATURAL JOIN servicio_realizado 
			JOIN solicitud WHERE servicio_realizado.id_solicitud = solicitud.id_solicitud and solicitud.id_servicio = ?");
		$pst->bind_param("i",$args[0]);
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
		$pst = $this->conexion->prepare("select * from categoria order by categoria");
		$pst->execute();
		$pst->bind_result($id, $categoria);
		$resultado = NULL;
		
		while ($pst->fetch()) {
			$resultado[] = array('id_categoria'=>$id, 'categoria'=>$categoria);
		}
		
		$pst->close();
		$this->cerrar();
		
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
		$resultado = NULL;
		while($pst->fetch()){
			$resultado[] = new Servicio($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto);
		}
		
		$pst->close();
		$this->cerrar();
		
		return $resultado;
	}
	
	/**
	 * Obtiene los servicios de un usuario a partir de su id
	 */
	public function conseguirServiciosByUserId($id){
		$this->conectar();
		$args = array($id);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("select * from servicio where id_usuario = ?");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->bind_result($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto);
		$resultado = NULL;
		
		while($pst->fetch()){
			$resultado[] = new Servicio($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto);
		}
		
		$this->cerrar();
		$pst->close();
		
		return $resultado;
	}
		
	public function conseguirNota($idservicio,$iduser){
		$this->conectar();
		$pst=$this->conexion->prepare("SELECT avg(nota) from valoracion_servicio where valoracion_servicio.id_servicio=? and valoracion_servicio.id_usuario=?");
		$pst->bind_param("ss",$idservicio,$iduser);
		$pst->execute();
		$pst->bind_result($nota);
		$pst->fetch();
		
		$pst->close();
		$this->cerrar();
		
		return $nota;
	}
	
	/**
	 * Obtiene los servicios que ha solicitado el usuario y que le han aceptado pero no están realizados junto con las solicitudes
	 * @param $id_usuario id del usuario del que se quiren obtener éstos servicios.
	 * @return un array que contiene otro array con los servicios con los servicios que han sido aceptados y que no han sido realizados
	 * 		   junto con la solicitud del usuario para cada servicio
	 */
	public function conseguirServiciosSolicitudAceptadosNoRealizados($id_usuario){
		$this->conectar();
		$args = array($id_usuario);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("SELECT * FROM servicio join solicitud WHERE solicitud.id_usuario = ? 
			and solicitud.id_servicio = servicio.id_servicio and estado = 1 and fin > NOW()
			order by inicio DESC");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->bind_result($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto,
						  $id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $inicio, $fin, $comentario);
		$resultado = NULL;
		
		while($pst->fetch()){
			$resultado[] = array (
				'servicio' => new Servicio($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto), 
				'solicitud' => new Solicitud($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $inicio, $fin, $comentario)
			);
		}
		
		$this->cerrar();
		$pst->close();
		
		return $resultado;
	}
	
	/**
	 * Obtiene los servicios realizados al usuario cuyo id es el que se pasa por parámetro junto con sus solicitudes.
	 * @param $id_usuario
	 * @return un array que contiene otro array con los servicios que han sido realizados junto con la solicitud del usuario 
	 * 		   para cada servicio realizado
	 */
	public function conseguirServiciosSolicitudAceptadosRealizados($id_usuario){
		$this->conectar();
		$args = array($id_usuario);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("SELECT * FROM servicio join solicitud WHERE solicitud.id_usuario = ? 
			and solicitud.id_servicio = servicio.id_servicio and estado = 1 and fin <= NOW()
			order by fin DESC");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->bind_result($id_servicio_, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto,
						  $id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $inicio, $fin, $comentario);
		$resultado = NULL;
		
		while($pst->fetch()){
			$resultado[] = array (
				'servicio' => new Servicio($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto), 
				'solicitud' => new Solicitud($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $inicio, $fin, $comentario)
			);
		}
		
		$this->cerrar();
		$pst->close();
		
		return $resultado;
	}
	
	/**
	 * Obtiene los servicios favoritos del usuario con id el que se pasa por parámetro
	 * @param id_usuario
	 * @return los servicios obtenidos
	 */
	public function conseguirServiciosFavoritos($id_usuario){
		$this->conectar();
		$pst = $this->conexion->prepare("SELECT servicio.* FROM favoritos join servicio 
			WHERE favoritos.id_usuario = ? and favoritos.id_servicio = servicio.id_servicio
			order by favoritos.fecha desc");
		$pst->bind_param("i", $id_usuario);
		$pst->execute();
		$pst->bind_result($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto);
			
			$resultado = NULL;
		
		while($pst->fetch()){
			$resultado[] = new Servicio($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto);
		}
		
		$pst->close();
		$this->cerrar();
		
		return $resultado;
	}
	
	/**
	 * Inserta un servicio favorito en la tabla de favoritos
	 * @param $id_servicio, $id_usuario
	 * @return 0 si no ha habido error al insertar, un número mayor que 0 si ha habido error
	 */
	public function insertarServicioFavorito($id_usuario, $id_servicio){
		$this->conectar();
		$args = array($id_servicio, $id_usuario);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("INSERT INTO favoritos (id_servicio, id_usuario, fecha) VALUES (?, ?, now())");
		$pst->bind_param("ii", $args[0], $args[1]);
		$pst->execute();
		
		$error = $pst->errno;
		
		$pst->close();
		$this->cerrar();
		
		return $error;
	}
	
	/**
	 * Elimina un servicio favorito de la tabla de favoritos
	 * @param $id_servicio, $id_usuario
	 * @return 0 si no ha habido error al eliminar, un número mayor que 0 si ha habido error
	 */
	public function eliminarServicioFavorito($id_servicio){
		$this->conectar();
		$args = array($id_servicio);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("DELETE FROM favoritos WHERE id_servicio = ?");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		
		$error = $pst->errno;
		
		$pst->close();
		$this->cerrar();
		
		return $error;
		
	}
	
	public function mostrar_todos_servicios(){
		$this->conectar();
		$pst = $this->conexion->prepare("select * from servicio");
		$pst->execute();
		$resultado = $pst->get_result();
		$pst->close();
		$this->cerrar();
		
		return $resultado;
	} 
	public function editarServicio($id,$nombreserv,$descrpserv,$foto){
		$this->conectar();
		$args = array($nombreserv,$descrpserv);
		$this->escapaBd($args);
		if ($nombreserv!=null){
			$pst = $this->conexion->prepare("update servicio set nombre_servicio=? WHERE id_servicio = ?");
			$pst->bind_param("si",$args[0],$id);
			$pst->execute();
			$pst->close();
		}
		if ($descrpserv!=null){
			$pst = $this->conexion->prepare("update servicio set descripcion=? WHERE id_servicio = ?");
			$pst->bind_param("si",$args[1],$id);
			$pst->execute();
			$pst->close();
		}
		if ($foto!=null){
			$pst = $this->conexion->prepare("update servicio set foto_servicio=? WHERE id_servicio = ?");
			$pst->bind_param("si",$foto,$id);
			$pst->execute();
			$pst->close();
		}
		
		$this->cerrar();
	}
	
	
	public function insertarCategoria($categoria){
		$this->conectar();
		$args = array($categoria);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("insert into categoria(categoria) values  (?)");
		$pst->bind_param("s",$args[0]);
		$pst->execute();
		$id = mysqli_insert_id($this->conexion);
		$pst->close();
		$this->cerrar();
		
		return $id;
	}
	
	public function conseguirIdCategoria($categoria){
		$this->conectar();
		$args = array($categoria);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("select id_categoria from categoria where categoria=?");
		$pst->bind_param("s",$args[0]);
		$pst->execute();
		$pst->bind_result($id_categoria);
		$pst->fetch();
		$pst->close();
		$this->cerrar();
		return $id_categoria;
	}
	
	public function crearservicio($iduser,$idcategoria,$nombre,$descripcion,$horas){
		$this->conectar();
		$args = array($iduser,$idcategoria,$nombre,$descripcion,$horas);
		$this->escapaBd($args);
	
		$pst = $this->conexion->prepare("insert into servicio(id_usuario,id_categoria,nombre_servicio,descripcion,horas) values (?,?,?,?,?)");
		$pst->bind_param("iissi",$args[0],$args[1],$args[2],$args[3],$args[4]);
		$pst->execute();
		$id = mysqli_insert_id($this->conexion);
		$pst->close();
		$this->cerrar();
		
		return $id;
	}
	
}
	