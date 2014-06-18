<?php

class ServicioRealizado{
	private $id_ser_realizado,
			$id_solicitud,
			$cobrado;
			
	public function __construct($id_ser_realizado, $id_solicitud, $cobrado) {
		$this->id_ser_realizado = $id_ser_realizado;
		$this->id_solicitud = $id_solicitud;
		$this->cobrado = $cobrado;
	}
	
	public function getIdSerRealizado(){
		return $this->id_ser_realizado;
	}
	
	public function getIdSolicitud(){
		return $this->id_solicitud;
	}
}
