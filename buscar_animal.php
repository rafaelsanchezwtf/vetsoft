<?php

require('configs/include.php');

class c_buscar_animal extends super_controller {
    public function buscar(){
        $id= $_POST['codigo'];
        if(is_empty($id)){
            $this->engine->assign('error1',1);
            throw_exception("Error, el campo de texto está vacío!");
            
        }
        elseif(is_numeric($id)){
            $options['animal']['lvl2'] = "some";
            $cod['animal']['id'] = $id;
            $this->orm->connect();
            $this->orm->read_data(array("animal"), $options, $cod);
            $animales = $this->orm->get_objects("animal");
            $this->orm->close();
            if (is_empty($animales)){
                $this->engine->assign('error3',3);
                throw_exception("Código no existe o no ha sido asignado");
            }else{
                $this->engine->assign("animal",$animales);
            }
        }else{
            $this->engine->assign('error2',2);
            throw_exception("Dato incorrecto!");
        }

        #$this->engine->assign('type_warning','success');
        #$this->engine->assign('msg_warning',"Welcome!");
        $this->temp_aux = 'message.tpl';
    }
    
  
    public function display(){;
        $this->engine->display('cabecera.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('buscar_animal.tpl');
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
            #$this->error=1;
            $this->msg_warning=$e->getMessage();
            $this->temp_aux = 'message.tpl';
            $this->engine->assign('type_warning',$this->type_warning);
            $this->engine->assign('msg_warning',$this->msg_warning);
        }
        $this->display();
    }
        
}

    $call = new c_buscar_animal();
    $call->run();


?>