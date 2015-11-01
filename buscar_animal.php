<?php

require('configs/include.php');

class c_buscar_animal extends super_controller {

    
  
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