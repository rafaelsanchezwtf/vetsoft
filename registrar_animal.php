<?php

require('configs/include.php');

class c_registrar_animal extends super_controller {
    
    public function display(){

        $this->engine->assign('title', "Registrar Animal");
        $this->engine->display('cabecera_administrador.tpl');
        $this->engine->display('registrar_animal.tpl');
        $this->engine->display('piedepagina.tpl');
    }
    
    public function run() {
        $this->display();
    }
        
}

    $call = new c_registrar_animal();
    $call->run();


?>