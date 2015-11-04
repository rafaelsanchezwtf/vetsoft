<?php

require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_password extends super_controller {
    
    public function generarhash(){
        
        $hasher = new PasswordHash(8, FALSE);
        $password = $hasher->HashPassword($this->post->pass);
        echo $password;
    }

    public function display()
    {
        
        $this->engine->display($this->temp_aux);
        $this->engine->display('password.tpl');
    }
    
    public function run() {
        try {
            if (isset($this->get->option)) {
                if ($this->get->option == "generarhash")
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

$call = new c_password();
$call->run();

?>
