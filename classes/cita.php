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

		public static function validar_completitud($cita){
			$flag = FALSE;
			if ($cita->get('veterinario') == "seleccion"){
            	$flag = TRUE;
		    }
		    if (is_empty($cita->get('motivo'))){
		        $flag = TRUE;
		    }
		    if (is_empty($cita->get('fecha'))){
		        $flag = TRUE;
		    }
		    if (is_empty($cita->get('hora'))){
		        $flag = TRUE;
		    }
		    if (is_empty($cita->get('lugar'))){
		        $flag = TRUE;
		    }
		    RETURN $flag;
		}

		public static function validar_correctitud($cita, $variable){
			$flag = FALSE;
			$cont = 0;
			$hoy = getdate();
			$año = $hoy['year'];
		    if ($hoy['mon']<10){
		        $mes = "0" . $hoy['mon'];
		    }else{
		    	$mes = $hoy['mon'];
		    }
		    if ($hoy['mday']<10){
		        $dia = "0" . $hoy['mday'];
		    }else{
		    	$dia = $hoy['mday'];
		    }
        	$fecha_actual = $año . "-" . $mes . "-" . $dia;
			$hoy['hours'] = $hoy['hours']-6;
			if ($hoy['hours']<0){
           		$hora = 24  +  $hoy['hours'];
        	}elseif ($hoy['hours']>=0 AND $hoy['hours']<10){
            	$hora = "0" . $hoy['hours'];
        	}else{
            	$hora = $hoy['hours'];
        	}
        	if ($hoy['hours'] == "0"){
            	$hora = "00";
        	}
        	if ($hoy['minutes']<10){
            	$minutos = "0" . $hoy['minutes'];
        	}else{
        		$minutos = $hoy['minutes'];
        	}
        	$hora_actual = $hora . ":" . $minutos;
        	if((!(parent::validateDate($cita->get('fecha')))) or ($cita->get('fecha') < $fecha_actual)){
    			$flag = TRUE;	
    		}
    		if((!(parent::validateTime($cita->get('hora')))) OR (($cita->get('fecha') == $fecha_actual) AND ($cita->get('hora') <= $hora_actual))){
    			$flag = TRUE;	
    		}
    		foreach ($variable as $veterinario) {
    			if ($cita->get('veterinario') == $veterinario->get('identificacion')){
    				$cont = 1;
    				break;
    			}
			}
			if ($cont==0){
				$flag = TRUE;		
			}
    		RETURN $flag;
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