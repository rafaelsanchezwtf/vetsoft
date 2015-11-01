<?php

require('configs/include.php');

class c_buscar_animal extends super_controller {
    public function buscar(){
        $id= $_POST['codigo'];
        if(is_null($id)){
            $this->engine->assign('error1',1);
        }
        elseif(is_numeric($id)){
            throw_exception("Error, el campo de texto está vacío!");
        
        }else{
            $this->engine->assign('error2',1);
            throw_exception("Dato incorrecto!");
        }
    }
    
  
    public function display(){;
        $this->engine->display('cabecera.tpl');
        $this->engine->display('buscar_animal.tpl');
        $this->engine->display('piedepagina.tpl');
    
    }
    
    public function run(){
        $this->display();
    }
        
}

    $call = new c_buscar_animal();
    $call->run();


?>