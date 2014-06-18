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
