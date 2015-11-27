<?php

require('configs/include.php');
        
class c_acerca_de extends super_controller {
    
    public function display(){
        $this->engine->assign('title', "Acerca de");
        $this->engine->display('cabecera.tpl');        
        $this->engine->display('acerca_de.tpl');           
        $this->engine->display('piedepagina.tpl');
    }
    
    public function run(){
        $this->display();
    }
        
}

    $call = new c_acerca_de();
    $call->run();


?>