<?php
	
	class cita extends object_standard
	{
		protected $codigo;
		protected $motivo;
		protected $fecha;
		protected $hora;
		protected $lugar;
		protected $condicion;
		protected $estado;
		protected $diagnostico;
		protected $animal;
		protected $veterinario;
		
		var $components = array();
		
		var $auxiliars = array();
		
		public function metadata(){
			return array("codigo" => array(), "motivo" => array(), "fecha" => array(), "hora" => array(), "lugar" => array(), "condicion" => array(), "estado" => array(), "diagnostico" => array(),
				"animal" => array("foreign_name" => "c_a", "foreign" => "animal", "foreign_attribute" =>"id"),
				"veterinario" => array("foreign_name" => "c_v", "foreign" => "veterinario", "foreign_attribute" =>"identificacion")); 
		}

		public function primary_key(){
			return array("fecha","hora","animal");
		}

		public function relational_keys($class, $rel_name){
			switch($class){
				case "animal":
					switch ($rel_name) {
							case "c_a":
								return array("animal");
								break;
					}
				break;

				case "veterinario":
					switch ($rel_name) {
							case "c_v":
								return array("veterinario");
								break;
					}
				break;
					
			    default:
				break;
			}
		}
	}
?>