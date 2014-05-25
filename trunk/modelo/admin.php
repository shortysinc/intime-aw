<?php
class Admin {
	private $id;
	private $correo;
	private $pass;
	private $salt;
	
	function __contruct($id, $correo, $pass, $salt){
		$this->id = $id;
		$this->correo = $correo;
		$this->pass = $pass;
		$this->salt = $salt;
	}
}
