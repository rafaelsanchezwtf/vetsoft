<?php

require('configs/include.php');

class c_login extends super_controller {

    
  
    public function display(){;
        #$this->engine->display('header.tpl');
        $this->engine->display('iniciar_sesion.tpl');
        #$this->engine->display('footer.tpl');
    
    }
    
    public function run(){
        $this->display();
    }
        
}

    $call = new c_login();
    $call->run();


?>