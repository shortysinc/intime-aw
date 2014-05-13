<?php
class Mysql{
	private $host="localhost";
	private $user="root";
    private $clave="";
    private $bd="intime";
    private $conexion;  
    private $sql;
	
	public function conectar(){
        $this->conexion=mysqli_connect($this->host,$this->user,$this->clave);
        mysqli_select_db($this->conexion, $this->bd);
    }
	
	 public function cerrar () {
        @mysql_close($this->conexion);
    }
	
	public function insertarUsuarioRegistro($correo, $nombre, $apellidos, $direccion, $pass, $salt){
		$consulta = "insert into usuario (correo, nombre, apellidos, direccion, pass, salt) values 
		('$correo', '$nombre', '$apellidos', '$direccion', '$pass', '$salt')";
		$this->conectar();
		$resultado = mysqli_query($this->conexion,$consulta);
		$this->cerrar();
		unset($consulta);
		
		return $resultado;
	}
	
	
}

?>