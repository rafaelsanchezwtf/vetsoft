<?php
	
	class uso_de_producto extends object_standard
	{
		protected $id;
		protected $cantidad;
		protected $producto;
		protected $cita;
		protected $tratamiento;
		
		var $components = array();
		
		var $auxiliars = array();
		
		public function metadata(){
			return array("id" => array(), "cantidad" => array(),
				"producto" => array("foreign_name" => "up_p", "foreign" => "producto", "foreign_attribute" =>"id"),
				"cita" => array("foreign_name" => "up_c", "foreign" => "cita", "foreign_attribute" =>"codigo"),
				"tratamiento" => array("foreign_name" => "up_t", "foreign" => "tratamiento", "foreign_attribute" =>"codigo")); 
		}

		public function primary_key(){
			return array("id");
		}

		public function relational_keys($class, $rel_name){
			switch($class){
				case "producto":
					switch ($rel_name) {
							case "up_p":
								return array("producto");
								break;
					}
				break;

				case "cita":
					switch ($rel_name) {
							case "up_c":
								return array("cita");
								break;
					}
				break;

				case "tratamiento":
					switch ($rel_name) {
							case "up_t":
								return array("tratamiento");
								break;
					}
				break;
					
			    default:
				break;
			}
		}
	}
?>