<?php
	
	class producto extends object_standard{

		protected $id;
		protected $nombre;
		protected $cantidad;
		protected $fecha_de_adquisicion;
		protected $marca;
		protected $precio_unidad;
		protected $tipo;

		var $components = array();

		var $auxiliars = array();

		public function metadata(){
			return array("id" => array(), "nombre" => array(), "cantidad" => array(), "fecha_de_adquisicion" => array(), "marca" => array(), "tipo" => array(), "precio_unidad" => array()); 
		}

		public function primary_key(){
			return array("nombre","marca");
		}

		public function relational_keys($class, $rel_name){
			switch ($class) {
				
				default:
				break;
			}
		}
	}
?>