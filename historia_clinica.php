<?php

require('configs/include.php');
        
class c_historia_clinica extends super_controller {

    public function buscar(){
        
       
        
        
        if (is_empty($this->post->id)){
            $this->engine->assign("id_vacio",0); 
            $this->mensaje("warning","Error","","Hay campos vacíos");
            throw_exception("");
        }
        
        if (!is_numeric($this->post->id) or ($this->post->id<0) ){
            $this->engine->assign("id_invalido",0); 
            $this->mensaje("warning","Error","","Hay datos invalidos");
            throw_exception("");
        }
        
        
         $consulta = "by_animal_hist";
        
  
        $options['tratamiento']['lvl2'] = $consulta;
        $auxiliars['tratamiento']=array("nombre_animal");
        $cod['tratamiento']['valor'] = $this->post->id;
        $this->orm->connect();
        $this->orm->read_data(array("tratamiento"), $options, $cod);
        $tratamientos = $this->orm->get_objects("tratamiento",NULL,$auxiliars);
        $this->orm->close();
        
        print_r2($tratamientos);
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