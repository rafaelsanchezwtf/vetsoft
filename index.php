<?php

require('configs/include.php');

class c_prueba extends super_controller {


    
    
    public function display(){
        
        $this->engine->assign('title',$this->gvar['n_index']);
        $this->engine->display('cabecera.tpl');
        $this->engine->display('piedepagina.tpl');
    
    }
    
    public function run(){
    
        $this->display();
    
    }
        
}

    $call = new c_prueba();
    $call->run();


?>