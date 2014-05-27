<?php
class Mysql{
	protected $host="localhost";
	protected $user="root";
    protected $clave="";
    protected $bd="intime";
    protected $conexion;  
    protected $sql;
	const ERR_DUP_KEY = 1062;
	
	protected function conectar(){
        $this->conexion=mysqli_connect($this->host,$this->user,$this->clave);
        mysqli_select_db($this->conexion, $this->bd);
		$this->conexion->set_charset("utf8");
    }
	
	 protected function cerrar () {
        @mysql_close($this->conexion);
    }
	 
	 /**
	 * @param $args: array con todos los elementos que se quieren escapar pasado por referencia.
	 */
	protected function escapaBd(&$args) {
		$numElems = count($args);
	
		for($i=0; $i < $numElems; $i++){
			$args[$i] = mysqli_real_escape_string($this->conexion, $args[$i]);
		}
	}
		 
}