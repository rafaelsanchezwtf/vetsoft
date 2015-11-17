<?php
 
	class veterinario extends object_standard{

		protected $identificacion;
		protected $nombre;
		protected $telefono;
		protected $email;
		protected $sueldo;
		protected $user;
		protected $pass;
		
		//components
		var $components = array();
		
		//auxiliars for primary key and for files
		var $auxiliars = array();
		
		//data about the attributes
		public function metadata(){
			return array("identificacion" => array(), "nombre" => array(), "telefono" => array(), "email" => array(), "sueldo" => array(), "user" => array(), "pass" => array()); 
		}

		public function primary_key(){
			return array("identificacion");
		}

		public static function validar_completitud($veterinario){
			$flag = FALSE;
			if (is_empty($veterinario->get('identificacion'))){
            	$flag = TRUE;
        	}
        	if (is_empty($veterinario->get('nombre'))){
            	$flag = TRUE;
	        }
	        if (is_empty($veterinario->get('telefono'))){
	            $flag = TRUE;
	        }
	        if (is_empty($veterinario->get('email'))){
	            $flag = TRUE;
	        }
	        if (is_empty($veterinario->get('sueldo'))){
	            $flag = TRUE;
	        }
        	RETURN $flag;
		}

		public static function validar_correctitud($veterinario){
    		$flag = FALSE;
    		if ((!is_numeric($veterinario->get('identificacion'))) or ($veterinario->get('identificacion') <= 0)){
	            $flag = TRUE;     
	        }
	        if ((!is_numeric($veterinario->get('telefono'))) or ($veterinario->get('telefono') < 1000000)){
	            $flag = TRUE;      
	        }
	        if (!filter_var($veterinario->get('email'), FILTER_VALIDATE_EMAIL)){
	            $flag = TRUE;   
        	}
        	if ((!is_numeric($veterinario->get('sueldo'))) or ($veterinario->get('sueldo') <= 0)){
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