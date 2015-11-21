<?php

require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_contratar_veterinario extends super_controller {
    
    public function asignar_datos($identificacion, $nombre, $telefono, $email, $sueldo){
        $this->engine->assign('id_v',$identificacion);
        $this->engine->assign('nombre_v',$nombre);
        $this->engine->assign('telefono_v',$telefono);     
        $this->engine->assign('email_v',$email);
        $this->engine->assign('sueldo_v',$sueldo); 
    }

    public function asignar_vacios($identificacion, $nombre, $telefono, $email, $sueldo){
        if (is_empty($identificacion)){
            $this->engine->assign("id_v_vacio",0);
        }
        if (is_empty($nombre)){
            $this->engine->assign("nombre_v_vacio",0);
        }
        if (is_empty($telefono)){
            $this->engine->assign("telefono_v_vacio",0);
        }
        if (is_empty($email)){
            $this->engine->assign("email_v_vacio",0);
        }
        if (is_empty($sueldo)){
            $this->engine->assign("sueldo_v_vacio",0);
        }
    }

    public function asignar_invalidos($veterinario){
        if ((!is_numeric($veterinario->get('identificacion'))) or ($veterinario->get('identificacion') <= 0)){
            $this->engine->assign("id_v_invalido",0);   
        }
        if ((!is_numeric($veterinario->get('telefono'))) or ($veterinario->get('telefono') < 1000000)){
            $this->engine->assign("telefono_v_invalido",0);      
        }
        if (!filter_var($veterinario->get('email'), FILTER_VALIDATE_EMAIL)){
            $this->engine->assign("email_v_invalido",0);   
        }
        if ((!is_numeric($veterinario->get('sueldo'))) or ($veterinario->get('sueldo') <= 0)){
            $this->engine->assign("sueldo_v_invalido",0);  
        }             
    }

   public function mensaje($icon, $type, $dir, $content){
        $msg_icon=$icon;
        $msg_dir=$dir;
        $msg_type=$type;
        $msg_content=$content;

        $this->temp_aux = 'message.tpl';
        $this->engine->assign('msg_icon',$msg_icon);
        $this->engine->assign('msg_dir',$msg_dir);
        $this->engine->assign('msg_type',$msg_type);
        $this->engine->assign('msg_content',$msg_content);
    }

    public function contratar(){
        self::asignar_datos($this->post->identificacion,$this->post->nombre,$this->post->telefono,$this->post->email,$this->post->sueldo);

        $veterinario = new veterinario($this->post);

        $incompletitud_veterinario = veterinario::validar_completitud($veterinario);

        if ($incompletitud_veterinario){
            self::asignar_vacios($this->post->identificacion,$this->post->nombre,$this->post->telefono,$this->post->email,$this->post->sueldo);
            self::mensaje("warning","Error","","Hay campos vacíos");
            throw_exception("");  
        }
            
        $incorrectitud_veterinario = veterinario::validar_correctitud($veterinario);

        if ($incorrectitud_veterinario){
            self::asignar_invalidos($veterinario);
            self::mensaje("warning","Error","","Hay datos invalidos");
            throw_exception("");
        }

        $hasher = new PasswordHash(8, FALSE);
        $password = $hasher->HashPassword($this->post->identificacion);

        $veterinario->set('user',$this->post->identificacion);
        $veterinario->set('pass',$password);

        $option['veterinario']['lvl2']="all";
        $this->orm->connect();
        $this->orm->read_data(array("veterinario"), $option);
        $veterinarios = $this->orm->get_objects("veterinario");
        
        if (!(is_empty($veterinarios))){
            foreach($veterinarios as $vet_aux){
                if ($vet_aux->get('identificacion') == $veterinario->get('identificacion')){
                    $this->mensaje("warning","Error","","Ya existe un veterinario con esa identificacion");
                    throw_exception(""); 
                }
            }
        }

        $this->orm->connect();
        $this->orm->insert_data("normal",$veterinario);
        $this->orm->close();

        $dir=$gvar['l_global']."perfil_administrador.php";
        self::mensaje("check-circle","Confirmación",$dir,"Registro exitoso, Nombre de usuario y contraseña generados.");
    }

    public function cancelar(){
        $msg_dir=$gvar['l_global']."perfil_administrador.php";
        self::mensaje("info","Informacion",$msg_dir,"Operacion cancelada por el administrador");
    }

    public function display(){
        $this->engine->assign('title', "Contratar Veterinario");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if ($this->session['usuario']['tipo'] == "administrador") {
            $this->engine->display($this->temp_aux);
            $this->engine->display('contratar_veterinario.tpl');
        }else{
            $direccion=$gvar['l_global']."index.php";
            self::mensaje("warning","Informacion",$direccion,"Lo sentimos, usted no tiene permisos para acceder");
            $this->engine->display($this->temp_aux); 
        }
        $this->engine->display('piedepagina.tpl');
    }
    
    public function run() {
        try {
            if (isset($this->get->option)) {
                if ($this->get->option == "contratar"){
                    $this->{$this->get->option}();
                }elseif ($this->get->option == "cancelar") {
                    $this->{$this->get->option}();
                }else{
                    throw_exception("Opción ". $this->get->option." no disponible");
                }
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
    $call = new c_contratar_veterinario();
    $call->run();
?>