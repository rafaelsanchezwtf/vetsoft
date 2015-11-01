<?php

require('configs/include.php');

class c_registrar_dueno extends super_controller {
    
    public function display(){

        $this->engine->assign('title', "Registrar Dueño");
        $this->engine->display('cabecera_administrador.tpl');
        $this->engine->display('registrar_dueno.tpl');
        $this->engine->display('piedepagina.tpl');
    }
    
    public function run() {
        $this->display();
    }
        
}

    $call = new c_registrar_dueno();
    $call->run();


?>