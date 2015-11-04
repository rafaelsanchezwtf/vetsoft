<?php

require('configs/include.php');

class c_registrar_dueno extends super_controller {

    public function aceptar(){

        $dueno = new dueno($this->post);

        $nombre_vacio = "";
        $cedula_vacio = "";
        $telefono_vacio = "";
        $email_vacio = "";

        $cedula_invalido = "";
        $telefono_invalido = "";
        $email_invalido = "";


        if (is_empty($this->post->nombre)){
            $this->engine->assign("nombre_vacio",0);
            $nombre_vacio = " Campo nombre vacío";
        }

        if (is_empty($this->post->telefono)){
            $this->engine->assign("telefono_vacio",0);
            $telefono_vacio = " Campo telefono vacío";
        }

        if (is_empty($this->post->cedula)){
            $this->engine->assign("cedula_vacio",0);
            $cedula_vacio = " Campo cedula vacío";
        }

        if (is_empty($this->post->email)){
            $this->engine->assign("email_vacio",0);
            $email_vacio = " Campo email vacío";
        }

        if ($nombre_vacio<>"" || $telefono_vacio<>"" || $cedula_vacio<>"" || $email_vacio<>""){
            throw_exception("HAY DATOS INCOMPLETOS".$nombre_vacio.$cedula_vacio.
            $telefono_vacio.$email_vacio);
        }

        if (!is_numeric($this->post->telefono)){
            $this->engine->assign("telefono_invalido",0);
            $telefono_invalido = " Campo telefono invalido";      
        }

        if (!is_numeric($this->post->cedula)){
            $this->engine->assign("cedula_invalido",0);
            $cedula_invalido = " Campo cedula invalido";      
        }

        if (!filter_var($this->post->email, FILTER_VALIDATE_EMAIL)){
            $this->engine->assign("email_invalido",0);
            $email_invalido = " Campo email invalido";    
        }

        if ($telefono_invalido<>"" || $cedula_invalido<>"" || $email_invalido<>""){
            throw_exception("HAY DATOS INVALIDOS".$cedula_invalido.
            $telefono_invalido.$email_invalido);
        }

        if ($_FILES['foto']['name'] == "") {
            throw_exception("No se selecciono ninguna imagen");   
        }

        if ($_FILES['foto']['type'] != "image/png"
            && $_FILES['foto']['type'] != "image/jpeg"
            && $_FILES["foto"]["type"] != "image/pjpeg"){ 
                throw_exception("Archivo inválido");
        }
        
        $nombre_foto = $_FILES["foto"]["name"];
        $ext = strtolower(substr(strrchr($nombre_foto, '.'), 1));
        
        $nombre_final = $this->post->cedula;
        $nombre_final = $nombre_final . "." . $ext;

        if (file_exists("files/dueno/" . $nombre_final)){
            throw_exception($nombre_final . " ya existe.");
        }else{
            move_uploaded_file($_FILES["foto"]["tmp_name"],"files/dueno/" . $nombre_final);
        }

        $foto_para_subir = "http://localhost/vetsoft/files/dueno/" . $nombre_final;
        $foto_para_mostrar = "files/dueno/" . $nombre_final;
        $this->engine->assign('mostrar',$foto_para_mostrar);

        $dueno->set('foto',$foto_para_subir);

        $this->orm->connect();
        $this->orm->insert_data("normal",$dueno);
        $this->orm->close();

        $_SESSION['mensaje']['tipo'] = 'Confirmación: ';
        $_SESSION['mensaje']['texto'] = 'Dueño registrado';
        $_SESSION['animal']['dueno']['cedula'] = $this->post->cedula;
        
        $this->session = $_SESSION;
        header('Location: registrar_animal.php');

    }

    public function cancelar(){
        $_SESSION['animal']['dueno']['cedula'] = "";
        $_SESSION['mensaje']['tipo'] = 'Informacion: ';
        $_SESSION['mensaje']['texto'] = 'Dueño no registrado';
        $this->session = $_SESSION;
        header('Location: registrar_animal.php');
    }
    
    public function display(){

        $this->engine->assign('title', "Registrar Dueño");
        
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        
        $this->engine->display('cabecera.tpl');
        
        if ($this->session['usuario']['tipo'] == "administrador") {
            $this->engine->display($this->temp_aux);
            $this->engine->display('registrar_dueno.tpl');
        }else{
            $this->engine->assign('type_warning','Lo sentimos:');
            $this->engine->assign('msg_warning',"Usted no tiene permiso para acceder a esta opción.");
            $this->temp_aux = 'message.tpl';
            $this->engine->display($this->temp_aux);    
        }   
            $this->engine->display('piedepagina.tpl');
    
    }
    
    public function run() {
        try {
            if ($_POST[aceptar]){
                $this->get->option = "aceptar";   
            }elseif ($_POST[cancelar]){
                $this->get->option = "cancelar";  
            }  

            if (isset($this->get->option)) {
                if ($this->get->option == "aceptar"){
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

    $call = new c_registrar_dueno();
    $call->run();


?>