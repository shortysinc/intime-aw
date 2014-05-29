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
	
	public function mostrar_todos_servicios(){
		$this->conectar();
		$pst = $this->conexion->prepare("select * from servicio");
		$pst->execute();
		$pst->bind_result($result); $pst->fetch();
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