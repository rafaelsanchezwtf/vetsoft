<?php
	
	class dueno extends object_standard{

		protected $cedula;
		protected $nombre;
		protected $telefono;
		protected $email;
		protected $foto;

		var $components = array();

		var $auxiliars = array();

		public function metadata(){
			return array("cedula" => array(), "nombre" => array(), "telefono" => array(), "email" => array(), "foto" => array()); 
		}

		public function primary_key(){
			return array("cedula");
		}

		public function relational_keys($class, $rel_name){
			switch ($class) {
				
				default:
				break;
			}
		}
	}
?>