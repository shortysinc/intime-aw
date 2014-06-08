<?php
require_once '../controlador/op_base_datos.php';
/**
 * Para hacer las consultas relativas a la tabla de usuario
 */
class MysqlUsuario extends Mysql {
	
	public function conseguirUsuarioById($id){
		$this->conectar();
		$pst = $this->conexion->prepare("select * from usuario where id_usuario = ?");
		$pst->bind_param("s", $id);
		$pst->execute();
		$pst->bind_result($id_usuario, $correo, $nombre, $apellidos, $direccion, $horas, $foto, $pass, $salt, 
			$vio_sol_recibidas, $vio_sol_enviadas);
		$usuario = NULL;
		if($pst->fetch()){
			$usuario = new Usuario($id_usuario, $correo, $nombre, $apellidos, $direccion, $horas, $foto, $pass, $salt, 
				$vio_sol_recibidas, $vio_sol_enviadas);
		}
		$this->cerrar();
		$pst->close();
		return $usuario;
	}
	
	/**
	 * Inserta un usuario en la bdd cuando se registra. 
	 * @return El número de error al intentar introducir el usuario. 0 si no hay error.
	 */
	public function insertarUsuarioRegistro($correo, $nombre, $apellidos, $direccion, $pass) {
		$this->conectar();
		$args = array($correo, $nombre, $apellidos, $direccion, $pass);
		//Escapamos los datos obtenidos del formulario
		$this->escapaBd($args);
		
		//Crea una salt al azar
		$salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		$pass = $args[4]; // Para hacer el hash con la pass escapada
		//Crea una contraseña a partir del hash con salt
		$pass = hash('sha512', $pass.$salt);
		
		$pst =  $this->conexion->prepare("insert into usuario (correo, nombre, apellidos, direccion, horas_usuario, pass, salt) values 
		(?, ?, ?, ?, ?, ?, ?)");
		
		//Los dos ultimos parámetros generados a partir de $pass inicial una vez escapada
		$pst->bind_param("ssssss", $args[0], $args[1], $args[2], $args[3], 0, $pass, $salt);
		$pst->execute();
		$error = $pst->errno;
		//printf("Num error: %d. Error message: %s\n", $error, mysqli_error($this->conexion));
		
		$pst->close();
		$this->cerrar();
		
		return $error;
	}
	
	/**
	 * Obtiene el usuario especificado por su correo y por su contraseña de la bdd
	 * @return el usuario
	 */
	public function loginuser($correo,$pass){
		$this->conectar();
		$args = array($correo, $pass);
		//Escapamos los datos obtenidos del formulario
		$this->escapaBd($args);
		$pst =  $this->conexion->prepare("select * from usuario where correo = ?");
		$pst->bind_param("s", $args[0]);
		$pst->execute();
		$pst->bind_result($id, $correo, $nombre, $apellidos, $direccion, $horas, $foto,
							$pass, $salt, $vio_sol_recibidas, $vio_sol_enviadas);
		$pst->fetch();
		$usuario = new Usuario($id, $correo, $nombre, $apellidos, $direccion, $horas, $foto,
							$pass, $salt, $vio_sol_recibidas, $vio_sol_enviadas);
		
		$pst->close();
		$this->cerrar();
		
		$pass = hash('sha512', $args[1].$usuario->getSalt());
		$password = $usuario->getPass();
		if ($password === $pass){
			return $usuario;
			
		}else {
			return NULL;
		}
	}
	 
	 public function mostrar_todos_usuarios(){
		$this->conectar();
		$pst = $this->conexion->prepare("select * from usuario");
		$pst->execute();
		$resultado = $pst->get_result();
		$pst->close();
		$this->cerrar();
		
		return $resultado;
	}
	 
	 /**
	  * Obtiene la solicitud dada por su id de la bdd
	  * @param id_solicitud
	  * @return la solicitud conseguida
	  */
	 public function conseguirSolicitudPorId($id_solicitud){
	 	$this->conectar();
		$args = array($id_solicitud);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("SELECT * FROM solicitud WHERE id_solicitud = ?");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->bind_result($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $comentario, $vista);
		$solicitud = NULL;
		if($pst->fetch()){
			$solicitud = new Solicitud($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $comentario, $vista);
		}
		 
		$pst->close();
		$this->cerrar();
		return $solicitud;
	 }
	 
	 /**
	 * Obtiene todas las solicitudes que le han hecho al usuario pasado por parámetro
	 * @param $id_usuario 
	 * @return las solicitudes obtenidas
	 */
	public function conseguirSolicitudesRecibidas($id_usuario){
		$this->conectar();
		$pst = $this->conexion->prepare("SELECT solicitud.id_solicitud, solicitud.id_usuario, solicitud.id_servicio, solicitud.estado, 
			solicitud.fecha, solicitud.comentario, solicitud.vista FROM solicitud join servicio where servicio.id_usuario = ? 
			and solicitud.id_servicio = servicio.id_servicio order by solicitud.fecha DESC");
		$pst->bind_param("i", $id_usuario);
		$pst->execute();
		$pst->bind_result($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $comentario, $vista);
		$resultado = NULL;
		while($pst->fetch()){
			$resultado[] = new Solicitud($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $comentario, $vista);
		}
		
		$pst->close();
		$this->cerrar();
		return $resultado;
	}
	
	/**
	 * Obtiene todas las solicitudes no vistas que le han hecho al usuario cuyo id es el pasado por parámetro
	 * @param $id_usuario
	 * @return las solicitudes obtenidas
	 */
	public function conseguirSolicitudesRecibidasNoVistas($id_usuario){
		$this->conectar();
		$args = array($id_usuario);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("SELECT solicitud.id_solicitud, solicitud.id_usuario, solicitud.id_servicio, solicitud.estado, 
			solicitud.fecha, solicitud.comentario, solicitud.vista FROM solicitud join servicio where servicio.id_usuario = ? 
			and solicitud.id_servicio = servicio.id_servicio and solicitud.vista = 0 order by solicitud.fecha DESC");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->bind_result($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $comentario, $vista);
		$resultado = NULL;
		while($pst->fetch()){
			$resultado[] = new Solicitud($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $comentario, $vista);
		}
		
		$pst->close();
		$this->cerrar();
		return $resultado;
	}
	
	/**
	 * Obtiene todas las solicitudes que le han hecho al usuario pasado por parámetro y estan pendientes de aceptar o rechazar
	 * @param $id_usuario 
	 * @return las solicitudes pendientes obtenidas
	 */
	public function conseguirSolicitudesRecibidasPendientes($id_usuario){
		$this->conectar();
		$args = array($id_usuario);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("SELECT solicitud.id_solicitud, solicitud.id_usuario, solicitud.id_servicio, solicitud.estado, 
			solicitud.fecha, solicitud.comentario, solicitud.vista FROM solicitud join servicio where servicio.id_usuario = ? 
			and solicitud.id_servicio = servicio.id_servicio and solicitud.estado = 0 order by solicitud.fecha DESC");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->bind_result($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $comentario, $vista);
		$resultado = NULL;
		while($pst->fetch()){
			$resultado[] = new Solicitud($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $comentario, $vista);
		}
		
		$pst->close();
		$this->cerrar();
		return $resultado;
	}
	
	/**
	 * Obtiene todas las solicitudes enviadas por el usuario cuyo id es el que se pasa por parámetro
	 * @param $id_usuario: id del usuario del cual se quieren obtener sus solicitudes enviadas
	 * @return las solicitudes obtenidas
	 */
	public function conseguirSolicitudesEnviadas($id_usuario){
		$this->conectar();
		$pst = $this->conexion->prepare("SELECT * FROM solicitud WHERE id_usuario = ?");
		$pst->bind_param("i", $id_usuario);
		$pst->execute();
		$pst->bind_result($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $comentario, $vista);
		$resultado = NULL;
		while($pst->fetch()){
			$resultado[] = new Solicitud($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $comentario, $vista);
		}
		 
		$pst->close();
		$this->cerrar();
		return $resultado;
	}
	
	/**
	 * Obtiene todas las solicitudes que han sido enviadas por el usuario y están pendientes de confirmar
	 * @param $id_usuario
	 * @return las solicitudes obtenidas
	 */
	public function conseguirSolicitudesEnviadasPendientes($id_usuario){
		$this->conectar();
		$args = array($id_usuario);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("SELECT * FROM solicitud where id_usuario = ? and estado = 0 order by solicitud.fecha DESC ");
		$pst->bind_param("i", $args[0]);
		$pst->execute();
		$pst->bind_result($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $comentario, $vista);
		$resultado = NULL;
		while($pst->fetch()){
			$resultado[] = new Solicitud($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $comentario, $vista);
		}
		
		$pst->close();
		$this->cerrar();
		return $resultado;
	}
	
	public function actualizarSolicitud($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $comentario, $vista){
		$this->conectar();
		$args = array($id_usuario, $id_servicio, $estado, $fecha, $comentario, $vista, $id_solicitud);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("UPDATE solicitud SET id_usuario=?, id_servicio=?, estado=?,
			fecha=?, comentario=?, vista=? WHERE id_solicitud=?");
		$pst->bind_param("iiissii", $args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6]);
		$pst->execute();
		$pst->close();
		
		$this->cerrar();
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
		$pst->bind_result($id_valoracion, $id_servicio, $id_usuario, $nota, $opinion);
		$resultado = NULL;
		while($pst->fetch()){
			$resultado[] = array('id_valoracion' => $id_valoracion, 'id_servicio' => $id_servicio, 'id_usuario' => $id_usuario,
				'nota' => $nota, 'opinion' => $opinion);
		}
		$pst->close();
		$this->cerrar();
		return $resultado;

	}
	 
	 public function editarUsuario($id,$correo,$foto,$nombre,$apellidos,$direccion,$pass,$salt){
		$this->conectar();
		$args = array($correo,$nombre,$apellidos,$direccion,$pass);
		$this->escapaBd($args);
		if ($correo!=null){
			$pst = $this->conexion->prepare("update usuario set correo=? WHERE id_usuario = ?");
			$pst->bind_param("ss",$args[0],$id);
			$pst->execute();
			$pst->close();
		}
		if ($foto!=null){
			$pst = $this->conexion->prepare("update usuario set foto_usuario=? WHERE id_usuario = ?");
			$pst->bind_param("ss",$foto,$id);
			$pst->execute();
			$pst->close();
		}
		if ($nombre!=null){
			$pst = $this->conexion->prepare("update usuario set nombre=? WHERE id_usuario = ?");
			$pst->bind_param("ss",$args[1],$id);
			$pst->execute();
			$pst->close();
		}
		if ($apellidos!=null){
			$pst = $this->conexion->prepare("update usuario set apellidos=? WHERE id_usuario = ?");
			$pst->bind_param("ss",$args[2],$id);
			$pst->execute();
			$pst->close();
		}
		if ($direccion!=null){
			$pst = $this->conexion->prepare("update usuario set direccion=? WHERE id_usuario = ?");
			$pst->bind_param("ss",$args[3],$id);
			$pst->execute();
			$pst->close();
		}
		if ($pass!=null){
			$pass = hash('sha512', $args[4].$salt);
			$pst = $this->conexion->prepare("update usuario set pass=? WHERE id_usuario = ?");
			$pst->bind_param("ss",$pass,$id);
			$pst->execute();
			$pst->close();
		}
		$this->cerrar();
	}
	
	/**
	 * Inserta una solicitud en la bdd
	 * @param $id_usuario: el id del usuario que solicita
	 * 		  $id_servicio: el id del servicio que se solicita
	 * 		  $comentario:
	 * @return el id de la solicitud que se ha insertado si todo ha ido bien. 0 en caso de que la consulta no haya generado ningún id. False
	 * en caso de que falle la conexion.
	 */
	public function insertarSolicitud($id_usuario, $id_servicio, $comentario){
		$this->conectar();
		$args = array($id_usuario, $id_servicio, $comentario);
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("insert into solicitud(id_usuario,id_servicio,estado,fecha,comentario,vista) values (?,?,0,now(),?,0)");
		$pst->bind_param("iis", $args[0], $args[1], $args[2]);
		$pst->execute();
		
		$id = mysqli_insert_id($this->conexion);
		
		$pst->close();
		$this->cerrar();
		
		return $id;
	}
}
