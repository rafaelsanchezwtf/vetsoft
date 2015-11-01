<?php

require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_login extends super_controller {


    public function login() {

         $message1 = "";
         $message2 = "";

        if (is_empty($this->post->user)){
            $this->engine->assign("error1",0);
            $message1 = " Campo usuario vacío";
        }

        if (is_empty($this->post->pass)){
            $this->engine->assign("error2",0);
            $message2 = " Campo contraseña vacío";
        }

        if ($message1<>"" || $message2<>""){
            throw_exception("Hay datos incompletos".$message1.$message2);
        }

        $options['administrador']['lvl2'] = "one_login";
        $cod['administrador']['user'] = $this->post->user;
        $cod['administrador']['pass'] = $this->post->pass;

        $options['veterinario']['lvl2'] = "one_login";
        $cod['veterinario']['user'] = $this->post->user;
        $cod['veterinario']['pass'] = $this->post->pass;

        $this->orm->connect();
        $this->orm->read_data(array("administrador","veterinario"), $options, $cod);
        $administrador = $this->orm->get_objects("administrador");
        $veterinario = $this->orm->get_objects("veterinario");
        $this->orm->close();

        if (is_empty($administrador) && is_empty($veterinario))
            throw_exception("Error, los datos ingresados son incorrectos");

        if (!is_empty($administrador)){
            $_SESSION['administrador']['identificacion'] = $administrador[0]->get('identificacion');
            $_SESSION['administrador']['nombre'] = $administrador[0]->get('nombre');
            $_SESSION['administrador']['telefono'] = $administrador[0]->get('telefono');
            $_SESSION['administrador']['email'] = $administrador[0]->get('email');
            
            $this->engine->assign("administrador",$administrador[0]);
            $this->session = $_SESSION;

        }elseif (!is_empty($veterinario)){
            $_SESSION['veterinario']['identificacion'] = $veterinario[0]->get('identificacion');
            $_SESSION['veterinario']['nombre'] = $veterinario[0]->get('nombre');
            $_SESSION['veterinario']['telefono'] = $veterinario[0]->get('telefono');
            $_SESSION['veterinario']['email'] = $veterinario[0]->get('email');
            $_SESSION['veterinario']['sueldo'] = $veterinario[0]->get('sueldo');

            $this->engine->assign("veterinario",$veterinario[0]);
            $this->session = $_SESSION;     
        }

        $this->engine->assign('type_warning','success');
        $this->engine->assign('msg_warning',"Welcome!");
        $this->temp_aux = 'message.tpl';

        if (isset($administrador) && !is_null($administrador)){
            header('Location: perfil_administrador.php');
        }elseif (isset($veterinario) && !is_null($veterinario)) {
            header('Location: perfil_veterinario.php');
        }
        
    }
    
    public function display(){

        $this->engine->display('cabecera.tpl');
        $this->engine->display($this->temp_aux);
        $this->engine->display('login.tpl');
        $this->engine->display('piedepagina.tpl');
    
    }
    
    public function run() {
        try {
            if (isset($this->get->option)) {
                if ($this->get->option == "login")
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

    $call = new c_login();
    $call->run();


?>