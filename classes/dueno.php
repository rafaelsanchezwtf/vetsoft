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

		public static function validar_completitud($dueno){
			$flag = FALSE;
			if (is_empty($dueno->get('cedula'))){
            	$flag = TRUE;
        	}
        	if (is_empty($dueno->get('nombre'))){
            	$flag = TRUE;
	        }
	        if (is_empty($dueno->get('email'))){
	            $flag = TRUE;
	        }
	        if (is_empty($dueno->get('telefono'))){
	            $flag = TRUE;
	        }
        	RETURN $flag;
		}

		public static function validar_correctitud($dueno){
    		$flag = FALSE;
    		if ((!is_numeric($dueno->get('cedula'))) or ($dueno->get('cedula') <= 0)){
	            $flag = TRUE;     
	        }

	        if ((!is_numeric($dueno->get('telefono'))) or ($dueno->get('telefono') < 1000000)){
	            $flag = TRUE;      
	        }
	        if (!filter_var($dueno->get('email'), FILTER_VALIDATE_EMAIL)){
	            $flag = TRUE;   
        	}
	        RETURN $flag;
    	}

		public function relational_keys($class, $rel_name){
			switch ($class) {
				
				default:
				break;
			}
		}
	}
?>