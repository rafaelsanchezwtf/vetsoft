<?php

require('configs/include.php');

class c_registrar_animal extends super_controller {
    
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

    public function registrar(){

        $this->engine->assign($nombre_animal,$this->post->nombre);
        $this->engine->assign($fecha_de_nacimiento,$this->post->fecha_de_nacimiento);
        $this->engine->assign($peso,$this->post->peso);
        $this->engine->assign($talla,$this->post->talla);
        $this->engine->assign($genero,$this->post->genero);
        $this->engine->assign($especie,$this->post->especie);

        $animal = new animal($this->post);

        $incompletitud = animal::validar_completitud($animal);

        if ($incompletitud){

            if (is_empty($this->post->nombre)){
                $this->engine->assign("nombre_vacio",0);
            }

            if (is_empty($this->post->fecha_de_nacimiento)){
                $this->engine->assign("fecha_vacio",0);
            }

            if (is_empty($this->post->peso)){
                $this->engine->assign("peso_vacio",0);
            }

            if (is_empty($this->post->talla)){
                $this->engine->assign("talla_vacio",0);
            }

            if (is_empty($this->post->genero)){
                $this->engine->assign("genero_vacio",0);
            }

            if (is_empty($this->post->especie)){
                $this->engine->assign("especie_vacio",0);
            }

            self::mensaje("warning","Error","","Hay campos vacíos");
            throw_exception("");
        }

        $incorrectitud = animal::validar_correctitud($animal);

        if ($incorrectitud){

            if(!(animal::validateDate($this->post->fecha_de_nacimiento))){
                $this->engine->assign("fecha_invalido",0);
            }

            if (!is_numeric($this->post->peso)){
                $this->engine->assign("peso_invalido",0); 
            }

            if (!is_numeric($this->post->talla)){
                $this->engine->assign("talla_invalido",0);    
            }

            self::mensaje("warning","Error","","Hay datos invalidos");
            throw_exception("");
        }

        if ($_FILES['foto']['name'] == "") {
            throw_exception("No se selecciono ninguna imagen");   
        }

        if ($_FILES['foto']['type'] != "image/png"
            && $_FILES['foto']['type'] != "image/jpeg"
            && $_FILES["foto"]["type"] != "image/pjpeg"){ 
                throw_exception("Archivo inválido");
        }

        $options['animal']['lvl2']="max";
        $this->orm->connect();
        $this->orm->read_data(array("animal"), $options);
        $animalmaxid = $this->orm->get_objects("animal");

        if (is_null($animalmaxid)) {
            $id = 1;
        }else{
            $id = $animalmaxid[0]->get('id') + 1;
        }

        $nombre_foto = $_FILES["foto"]["name"];
        $ext = strtolower(substr(strrchr($nombre_foto, '.'), 1));
        
        $nombre_final = $id;
        $nombre_final = $nombre_final . "." . $ext;

        if (file_exists("files/animal/" . $nombre_final)){
            throw_exception($nombre_final . " ya existe.");
        }else{
            move_uploaded_file($_FILES["foto"]["tmp_name"],"files/animal/" . $nombre_final);
        }

        $foto_para_subir = "http://localhost/vetsoft/files/animal/" . $nombre_final;
        $foto_para_mostrar = "files/animal/" . $nombre_final;
        $this->engine->assign('mostrar',$foto_para_mostrar);

        $animal->set('foto',$foto_para_subir);
        $animal->set('dueno',$this->session['animal']['dueno']['cedula']);
        $this->orm->connect();
        $this->orm->insert_data("normal",$animal);
        $this->orm->close();

        $options['animal']['lvl2']="max";
        $this->orm->connect();
        $this->orm->read_data(array("animal"), $options);
        $animalmaxid = $this->orm->get_objects("animal");

        $id = $animalmaxid[0]->get('id');
        $mensaje = " Codigo asignado: " . $id;

        $_SESSION['mensaje']['tipo'] = 'Confirmación: ';
        $_SESSION['mensaje']['texto'] = 'Animal registrado.';
        $_SESSION['mensaje']['codigo'] = $mensaje;
        
        $this->session = $_SESSION;
        header('Location: perfil_administrador.php');
    }

    public function cancelar(){
        $_SESSION['mensaje']['tipo'] = 'Informacion: ';
        $_SESSION['mensaje']['texto'] = 'Operación cancelada por el administrador';
        $this->session = $_SESSION;
        header('Location: perfil_administrador.php');
    }

    public function display(){
        $this->engine->assign('title', "Registrar Animal");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->assign('dueno',$this->session['animal']['dueno']['cedula']);
        $this->engine->display('cabecera.tpl');

        if ($this->session['usuario']['tipo'] == "administrador") {
            echo $this->session['mensaje']['tipo']. $this->session['mensaje']['texto'];
            $this->engine->display($this->temp_aux);
            $this->engine->display('registrar_animal.tpl');
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
            if ($_POST[registrar]){
                $this->get->option = "registrar";   
            }elseif ($_POST[cancelar]){
                $this->get->option = "cancelar";  
            }  

            if (isset($this->get->option)) {
                if ($this->get->option == "registrar"){
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

    $call = new c_registrar_animal();
    $call->run();


?>