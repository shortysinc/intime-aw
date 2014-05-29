<?php
class Mysql{
	protected $host="localhost";
	protected $user="root";
    protected $clave="";
    protected $bd="intime";
    private $conexion;  
    private $sql;
	const ERR_DUP_KEY = 1062;
	
	public function conectar(){
        $this->conexion=mysqli_connect($this->host,$this->user,$this->clave);
        mysqli_select_db($this->conexion, $this->bd);
		$this->conexion->set_charset("utf8");
    }
	
	 public function cerrar () {
        @mysql_close($this->conexion);
    }
	
	/**
	 * @param $args: array con todos los elementos que se quieren escapar pasado por referencia.
	 */
	private function escapaBd(&$args) {
		$numElems = count($args);
	
		for($i=0; $i < $numElems; $i++){
			$args[$i] = mysqli_real_escape_string($this->conexion, $args[$i]);
		}
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
			$resultado[] = array('id'=>$id, 'categoria'=>$categoria);
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
	public function conseguirServiciosCategoria($categoria) {
		$this->conectar();
		$pst = $this->conexion->prepare("SELECT * FROM servicio natural join categoria WHERE categoria = ?");
		$pst->bind_param("s", $categoria);
		$pst->execute();
		$pst->bind_result($result); $pst->fetch();
		
		$pst->close();
		$this->cerrar();
		
		return $resultado;
	}
	
	public function mostrar_todos_servicios(){
		$this->conectar();
		$pst = $this->conexion->prepare("select * from servicio");
		$pst->execute();
		$pst->bind_result($result); $pst->fetch();
		$pst->close();
		$this->cerrar();
		
		return $resultado;
	} 
	public function notamedia($idservicio){
		$this->conectar();
		$pst=$this->conexion->prepare("SELECT avg(nota) from valoracion_servicio,servicio where servicio.id_servicio=? and servicio.id_servicio=valoracion_servicio.id_servicio");
		$pst->bind_param("s",$idservicio);
		$pst->execute();
		$pst->bind_result($nota);
		$pst->fetch();
		$pst->close();
		return $nota;
	}
	
	public function busqueda($nombre){
		$this->conectar();
		$args = array($nombre);
		$ret = array();
		$i=0;
		//Escapamos los datos obtenidos del formulario
		$this->escapaBd($args);
		$args[0]="%".$args[0]."%";
		$pst =  $this->conexion->prepare("select nombre,apellidos,usuario.foto,nombre_servicio,descripcion,usuario.id_usuario,servicio.id_servicio from usuario,servicio where nombre_servicio like ? and usuario.id_usuario=servicio.id_usuario ");
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
		$pst->bind_param("sss",$id,$id,$corte);
		$pst->execute();
		$pst->bind_result($nombre,$apellidos,$foto,$nomservicio,$decripcion,$idusuario,$idservicio,$nota);
		echo"<p>".$nomservicio."</p>";
		while($pst->fetch()){
			$info = array($nombre,$apellidos,$foto,$nomservicio,$decripcion,$idusuario,$idservicio,$nota);
			$ret[$i]=$info;
			$i=$i+1;
		}
		$pst->close();
		return $ret;
	}
	
	public function loginAdmin($correo, $pass){
		$this->conectar();
		$args = array($correo, $pass);
		//Escapamos los datos obtenidos del formulario
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("select * from admin where correo = ?");
		$pst->bind_param("s", $args[0]);
		$pst->execute();
		$pst->bind_result($result); $pst->fetch();
		
		$pst->close();
		$this->cerrar();
		
		$row = $resultado->fetch_assoc();
		
		$pass = hash('sha512', $args[1].$row['salt']);
		$password = $row['pass'];
		
		if ($password === $pass){
			return $row;
			
		}else {
			return NULL;
		}
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