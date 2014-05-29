<?php
class Servicio {
	public $id_servicio, 
		   $id_usuario, 
		   $id_categoria, 
		   $nombre, 
		   $descripcion, 
		   $horas, 
		   $foto;
		   
	function __construct($id_servicio, $id_usuario, $id_categoria, $nombre, $descripcion, $horas, $foto) {
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
	
	public function getNombre(){
			
		return $this->nombre;
	}
	
}
