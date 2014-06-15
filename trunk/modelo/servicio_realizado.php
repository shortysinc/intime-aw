<?php

class ServicioRealizado{
	private $id_ser_realizado,
			$id_solicitud;
			
	public function __construct($id_ser_realizado, $id_solicitud) {
		$this->id_ser_realizado = $id_ser_realizado;
		$this->id_solicitud = $id_solicitud;	
	}
	
	public function getIdSerRealizado(){
		return $this->id_ser_realizado;
	}
	
	public function getIdSolicitud(){
		return $this->id_solicitud;
	}
}
