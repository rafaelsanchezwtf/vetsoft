<?php

require('configs/include.php');
        
class c_historia_clinica extends super_controller {

    public function buscar(){
        $opcion = $this->post->optradio;
        $valor = $_POST['codigo'];
        if(is_empty($valor) AND is_empty($opcion)){
            $consulta = "all";   
        }else{
            switch ($opcion) {
                case 'c':
                    if (is_numeric($valor)){
                        $consulta = "by_codigo";    
                    }elseif (!(is_numeric($valor))){
                        $this->engine->assign('error2',2);
                        $this->mensaje("warning","Error","","Dato incorrecto");
                        throw_exception("");
                    }elseif (is_empty($valor)){
                        $this->engine->assign('error1',1);
                        $this->mensaje("warning","Error","","El campo de busqueda está vacío");
                        throw_exception("");
                    }
                    break;

                case 't':
                    if (!(is_empty($valor))){
                        $consulta = "by_titulo";    
                    }else{
                        $this->engine->assign('error1',1);
                        $this->mensaje("warning","Error","","El campo de busqueda está vacío");
                        throw_exception("");
                    }
                    break;

                case 'f':
                    if (is_numeric($valor)){
                        $consulta = "by_fecha";    
                    }elseif (!(is_numeric($valor))){
                        $this->engine->assign('error2',2);
                        $this->mensaje("warning","Error","","Dato incorrecto");
                        throw_exception("");
                    }elseif (is_empty($valor)){
                        $this->engine->assign('error1',1);
                        $this->mensaje("warning","Error","","El campo de busqueda está vacío");
                        throw_exception("");
                    }
                    break;

                case 'h':
                    $aux=new animal();
                    if (!(is_empty($valor))){
                        if($aux->validateTime($valor)){
                            $consulta = "by_hora";
                        }else{
                            $this->engine->assign('error2',2);
                            $this->mensaje("warning","Error","","Dato incorrecto");
                            throw_exception("");
                        }
                    }else{
                        $this->engine->assign('error1',1);
                        $this->mensaje("warning","Error","","El campo de busqueda está vacío");
                        throw_exception("");    
                    }

                case 'a':
                    if (!(is_empty($valor))){
                        $consulta = "by_animal";    
                    }else{
                        $this->engine->assign('error1',1);
                        $this->mensaje("warning","Error","","El campo de busqueda está vacío");
                        throw_exception("");
                    }
                    break;
                
                default:
                    $this->mensaje("warning","Error","","Debe seleccionar un criterio de busqueda");
                    throw_exception(""); 
                    break;
            }
        }
        $options['tratamiento']['lvl2'] = $consulta;
        $auxiliars['tratamiento']=array("nombre_animal");
        $cod['tratamiento']['valor'] = $valor;
        $cod['tratamiento']['identificacion'] = $this->session['usuario']['identificacion'];
        $this->orm->connect();
        $this->orm->read_data(array("tratamiento"), $options, $cod);
        $tratamientos = $this->orm->get_objects("tratamiento",NULL,$auxiliars);
        $this->orm->close();
        if (is_empty($tratamientos)){
            $this->engine->assign('error3',3);
            $this->mensaje("warning","Error","","No existen coincidencias");
            throw_exception("");
        }else{
            $this->engine->assign("tratamiento",$tratamientos);
        }
    }
    
    
    public function display(){
        $this->engine->assign('title', "Historia Clinica");
        
        $this->engine->display('cabecera.tpl');
       
            $this->engine->display($this->temp_aux);
            $this->engine->display('historia_clinica.tpl');
       
            
        $this->engine->display('piedepagina.tpl');
    }
    
    public function run(){
        try {
            if (isset($this->get->option)) {
                if ($this->get->option == "buscar")
                    $this->{$this->get->option}();
                else
                    throw_exception("Opción ". $this->get->option." no disponible");
            }
        } catch (Exception $e) {
            $this->error=1;
            $this->msg_warning=$e->getMessage();
            $this->temp_aux = 'message.tpl';
            $this->engine->assign('type_warning',$this->type_warning);
            $this->engine->assign('msg_warning',$this->msg_warning);
        }
        $this->display();
    }
        
}

    $call = new c_historia_clinica();
    $call->run();


?>