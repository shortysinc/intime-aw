<?php
class Servicio {
	public $id_servicio, 
		   $id_usuario, 
		   $id_categoria, 
		   $nombre, 
		   $descripcion, 
		   $horas,
		   $foto;
		   
		   
	public function __construct($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto) {
	    $this->id_servicio = $id_servicio;
	    $this->id_usuario = $id_usuario;
	    $this->id_categoria = $id_categoria;
	    $this->nombre = $nombre;
	    $this->descripcion = $descripcion;
	    $this->horas = $horas;
	    $this->foto = $foto;
	}
	
	/**
	 * Comprueba si el servicio representada por su id está dentro del array de servicios.
	 * @param $id: id del servicio
	 * @param $solicitudes: array de servicios en el que se quiere buscar el servicio representado por el parámetro $id
	 */
	public static function estaDentro($id, $servicios){
		$len = count($servicios);
		$encontrado = false;
		$i = 0;
		while (!$encontrado && $i < $len) {
			$servicio = $servicios[$i];
			if($servicio->getIdServicio() == $id){
				$encontrado = true;
			}
			$i++;
		}
		
		return $encontrado;
	}
	
	public function getIdServicio(){
		
		return $this->id_servicio;
	}
	
	public function getOpinion(){
		
		return $this->opinion;
	}
	
	public function getIdUsuario(){
		
		return $this->id_usuario;
	}
	
	public function getNombre(){
			
		return $this->nombre;
	}
	
	public function getDescripcion() {
		return $this->descripcion;
	}
	
	public function getHoras() {
		return $this->horas;
	}
	
	public function getFoto(){
		return $this->foto;
	}
}
