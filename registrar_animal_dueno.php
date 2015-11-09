<?php

require('configs/include.php');

class c_registrar_animal_dueno extends super_controller {
    
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

    public function registrar_dueno_nuevo(){

        $this->engine->assign('nombre_animal',$this->post->nombre);
        $this->engine->assign('fecha_de_nacimiento',$this->post->fecha_de_nacimiento);
        $this->engine->assign('peso',$this->post->peso);
        $this->engine->assign('talla',$this->post->talla);
        $this->engine->assign('genero',$this->post->genero);
        $this->engine->assign('especie',$this->post->especie);

        $this->engine->assign('registrar_dueno_nuevo',0);
    }

    public function registrar_dueno_existente(){

        $this->engine->assign('nombre_animal',$this->post->nombre);
        $this->engine->assign('fecha_de_nacimiento',$this->post->fecha_de_nacimiento);
        $this->engine->assign('peso',$this->post->peso);
        $this->engine->assign('talla',$this->post->talla);
        $this->engine->assign('genero',$this->post->genero);
        $this->engine->assign('especie',$this->post->especie);
        
        $option['dueno']['lvl2']="all";
        $this->orm->connect();
        $this->orm->read_data(array("dueno"), $option);
        $variable = $this->orm->get_objects("dueno");
        $this->engine->assign('objeto',$variable);
        $this->engine->assign('registrar_dueno_existente',0);
    }

    public function cancelar_dueno(){
        self::mensaje("info","Información","","Dueño no registrado");    
    }

    public function registrar(){

        if ($this->post->flag == "dueno_nuevo") {
            $this->engine->assign('registrar_dueno_nuevo',0);    
        }elseif ($this->post->flag == "dueno_existente") {
            $this->engine->assign('registrar_dueno_existente',0);    
        }
        
        if ($this->post->flag == "dueno_nuevo"){

            $this->engine->assign('cedula_dueno',$this->post->cedula_dueno);
            $this->engine->assign('nombre_dueno',$this->post->nombre_dueno);
            $this->engine->assign('telefono_dueno',$this->post->telefono_dueno);
            $this->engine->assign('email_dueno',$this->post->email_dueno);

            $this->engine->assign('nombre_animal',$this->post->nombre);
            $this->engine->assign('fecha_de_nacimiento',$this->post->fecha_de_nacimiento);
            $this->engine->assign('peso',$this->post->peso);
            $this->engine->assign('talla',$this->post->talla);
            $this->engine->assign('genero',$this->post->genero);
            $this->engine->assign('especie',$this->post->especie);

            $animal = new animal($this->post);
            $dueno = new dueno($this->post);

            $dueno->set('cedula',$this->post->cedula_dueno);
            $dueno->set('nombre',$this->post->nombre_dueno);
            $dueno->set('telefono',$this->post->telefono_dueno);
            $dueno->set('email',$this->post->email_dueno);

            $incompletitud_animal = animal::validar_completitud($animal);
            $incompletitud_dueno = dueno::validar_completitud($dueno);

            if ($incompletitud_animal or $incompletitud_dueno){

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
                if (is_empty($this->post->cedula_dueno)){
                    $this->engine->assign("cedula_dueno_vacio",0);
                }

                if (is_empty($this->post->nombre_dueno)){
                    $this->engine->assign("nombre_dueno_vacio",0);
                }

                if (is_empty($this->post->telefono_dueno)){
                    $this->engine->assign("telefono_dueno_vacio",0);
                }

                if (is_empty($this->post->email_dueno)){
                    $this->engine->assign("email_dueno_vacio",0);
                }

                self::mensaje("warning","Error","","Hay campos vacíos");
                throw_exception("");
            }

            $incorrectitud_animal = animal::validar_correctitud($animal);
            $incorrectitud_dueno = dueno::validar_correctitud($dueno);

            if ($incorrectitud_animal or $incorrectitud_dueno){

                if(!(animal::validateDate($this->post->fecha_de_nacimiento))){
                    $this->engine->assign("fecha_invalido",0);
                }

                if ((!is_numeric($animal->get('peso'))) or ($animal->get('peso') <= 0)){
                    $this->engine->assign("peso_invalido",0); 
                }

                if ((!is_numeric($animal->get('talla'))) or ($animal->get('talla') <= 0)){
                    $this->engine->assign("talla_invalido",0);    
                }

                if ((!is_numeric($dueno->get('cedula'))) or ($dueno->get('cedula') <= 0)){
                    $this->engine->assign("cedula_dueno_invalido",0);     
                }

                if ((!is_numeric($dueno->get('telefono'))) or ($dueno->get('telefono') < 1000000)){
                    $this->engine->assign("telefono_dueno_invalido",0);     
                }
                if (!filter_var($dueno->get('email'), FILTER_VALIDATE_EMAIL)){
                    $this->engine->assign("email_dueno_invalido",0);   
                }

                self::mensaje("warning","Error","","Hay datos invalidos");
                throw_exception("");
            }

            if ($_FILES['foto_dueno']['name'] == "" or $_FILES['foto']['name'] == "") {
                self::mensaje("warning","Error","","No se ha seleccionado una fotografia para dueño o para animal");
                throw_exception("");   
            }

            if (($_FILES['foto']['type'] != "image/png"
                && $_FILES['foto']['type'] != "image/jpeg"
                && $_FILES["foto"]["type"] != "image/pjpeg") ||
                ($_FILES['foto_dueno']['type'] != "image/png"
                && $_FILES['foto_dueno']['type'] != "image/jpeg"
                && $_FILES["foto_dueno"]["type"] != "image/pjpeg")){
                    self::mensaje("warning","Error","","Al menos un archivo subido no es una imagen"); 
                    throw_exception("");
            }

            $nombre_foto_dueno = $_FILES["foto_dueno"]["name"];
            $ext_dueno = strtolower(substr(strrchr($nombre_foto_dueno, '.'), 1));
        
            $nombre_final_dueno = $this->post->cedula_dueno;
            $nombre_final_dueno = $nombre_final_dueno . "." . $ext_dueno;

            if (file_exists("files/dueno/" . $nombre_final_dueno)){
                $mensaje = "Fotografia con nombre " . $nombre_final_dueno . " ya existe!";
                self::mensaje("warning","Error","",$mensaje);
                throw_exception("");
            }else{
                move_uploaded_file($_FILES["foto_dueno"]["tmp_name"],"files/dueno/" . $nombre_final_dueno);
            }

            $foto_atributo_dueno = "files/dueno/" . $nombre_final_dueno;

            $dueno->set('foto',$foto_atributo_dueno);

            $this->orm->connect();
            $this->orm->insert_data("normal",$dueno);
            $this->orm->close();

            $options['animal']['lvl2']="max";
            $this->orm->connect();
            $this->orm->read_data(array("animal"), $options);
            $animalmaxid = $this->orm->get_objects("animal");

            if (is_null($animalmaxid)) {
                $id = 1;
            }else{
                $id = $animalmaxid[0]->get('id') + 1;
            }

            $nombre_foto_animal = $_FILES["foto"]["name"];
            $ext_animal = strtolower(substr(strrchr($nombre_foto_animal, '.'), 1));
            
            $nombre_final_animal = $id;
            $nombre_final_animal = $nombre_final_animal . "." . $ext_animal;

            if (file_exists("files/animal/" . $nombre_final_animal)){
                $mensaje = "Fotografia con nombre " . $nombre_final_animal . " ya existe!";
                self::mensaje("warning","Error","",$mensaje);
                throw_exception("");
            }else{
                move_uploaded_file($_FILES["foto"]["tmp_name"],"files/animal/" . $nombre_final_animal);
            }

            $foto_atributo_animal = "files/animal/" . $nombre_final_animal;

            $animal->set('dueno',$this->post->cedula_dueno);
            $animal->set('foto',$foto_atributo_animal);

            $this->orm->connect();
            $this->orm->insert_data("normal",$animal);
            $this->orm->close();

            $options['animal']['lvl2']="max";
            $this->orm->connect();
            $this->orm->read_data(array("animal"), $options);
            $animalmaxid = $this->orm->get_objects("animal");

            $id = $animalmaxid[0]->get('id');

            $msg = "Animal y dueño registrados, Codigo asignado: " . $id;
            $dir=$gvar['l_global']."perfil_administrador.php";
            self::mensaje("check-circle","Confirmación",$dir,$msg);

        }elseif ($this->post->flag == "dueno_existente") {

            self::registrar_dueno_existente();

            $this->engine->assign('nombre_animal',$this->post->nombre);
            $this->engine->assign('fecha_de_nacimiento',$this->post->fecha_de_nacimiento);
            $this->engine->assign('peso',$this->post->peso);
            $this->engine->assign('talla',$this->post->talla);
            $this->engine->assign('genero',$this->post->genero);
            $this->engine->assign('especie',$this->post->especie);

            $animal = new animal($this->post);

            $incompletitud_animal = animal::validar_completitud($animal);

            if ($incompletitud_animal){

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

            $incorrectitud_animal = animal::validar_correctitud($animal);

            if ($incorrectitud_animal){

                if(!(animal::validateDate($this->post->fecha_de_nacimiento))){
                    $this->engine->assign("fecha_invalido",0);
                }

                if ((!is_numeric($animal->get('peso'))) or ($animal->get('peso') <= 0)){
                    $this->engine->assign("peso_invalido",0); 
                }

                if ((!is_numeric($animal->get('talla'))) or ($animal->get('talla') <= 0)){
                    $this->engine->assign("talla_invalido",0);    
                }

                self::mensaje("warning","Error","","Hay datos invalidos");
                throw_exception("");
            }

            if ($_FILES['foto']['name'] == "") {
                self::mensaje("warning","Error","","No se ha seleccionado una fotografia");
                throw_exception("");   
            }

            if ($_FILES['foto']['type'] != "image/png"
                && $_FILES['foto']['type'] != "image/jpeg"
                && $_FILES["foto"]["type"] != "image/pjpeg"){
                    self::mensaje("warning","Error","","Archivo subido no es una imagen"); 
                    throw_exception("");
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

            $nombre_foto_animal = $_FILES["foto"]["name"];
            $ext_animal = strtolower(substr(strrchr($nombre_foto_animal, '.'), 1));
            
            $nombre_final_animal = $id;
            $nombre_final_animal = $nombre_final_animal . "." . $ext_animal;

            if (file_exists("files/animal/" . $nombre_final_animal)){
                $mensaje = "Fotografia con nombre " . $nombre_final_animal . " ya existe!";
                self::mensaje("warning","Error","",$mensaje);
                throw_exception("");
            }else{
                move_uploaded_file($_FILES["foto"]["tmp_name"],"files/animal/" . $nombre_final_animal);
            }

            $foto_atributo_animal = "files/animal/" . $nombre_final_animal;

            $animal->set('dueno',$this->post->dueno);
            $animal->set('foto',$foto_atributo_animal);

            $this->orm->connect();
            $this->orm->insert_data("normal",$animal);
            $this->orm->close();

            $options['animal']['lvl2']="max";
            $this->orm->connect();
            $this->orm->read_data(array("animal"), $options);
            $animalmaxid = $this->orm->get_objects("animal");

            $id = $animalmaxid[0]->get('id');

            $msg = "Animal con dueño existente registrado, Codigo animal asignado: " . $id;
            $dir=$gvar['l_global']."perfil_administrador.php";
            self::mensaje("check-circle","Confirmación",$dir,$msg);
        
        } else{

            $this->engine->assign('nombre_animal',$this->post->nombre);
            $this->engine->assign('fecha_de_nacimiento',$this->post->fecha_de_nacimiento);
            $this->engine->assign('peso',$this->post->peso);
            $this->engine->assign('talla',$this->post->talla);
            $this->engine->assign('genero',$this->post->genero);
            $this->engine->assign('especie',$this->post->especie);

            $animal = new animal($this->post);

            $incompletitud_animal = animal::validar_completitud($animal);

            if ($incompletitud_animal){

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

            $incorrectitud_animal = animal::validar_correctitud($animal);

            if ($incorrectitud_animal){

                if(!(animal::validateDate($this->post->fecha_de_nacimiento))){
                    $this->engine->assign("fecha_invalido",0);
                }

                if ((!is_numeric($animal->get('peso'))) or ($animal->get('peso') <= 0)){
                    $this->engine->assign("peso_invalido",0); 
                }

                if ((!is_numeric($animal->get('talla'))) or ($animal->get('talla') <= 0)){
                    $this->engine->assign("talla_invalido",0);    
                }

                self::mensaje("warning","Error","","Hay datos invalidos");
                throw_exception("");
            }

            if ($_FILES['foto']['name'] == "") {
                self::mensaje("warning","Error","","No se ha seleccionado una fotografia");
                throw_exception("");   
            }

            if ($_FILES['foto']['type'] != "image/png"
                && $_FILES['foto']['type'] != "image/jpeg"
                && $_FILES["foto"]["type"] != "image/pjpeg"){
                    self::mensaje("warning","Error","","Archivo subido no es una imagen"); 
                    throw_exception("");
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

            $nombre_foto_animal = $_FILES["foto"]["name"];
            $ext_animal = strtolower(substr(strrchr($nombre_foto_animal, '.'), 1));
            
            $nombre_final_animal = $id;
            $nombre_final_animal = $nombre_final_animal . "." . $ext_animal;

            if (file_exists("files/animal/" . $nombre_final_animal)){
                $mensaje = "Fotografia con nombre " . $nombre_final_animal . " ya existe!";
                self::mensaje("warning","Error","",$mensaje);
                throw_exception("");
            }else{
                move_uploaded_file($_FILES["foto"]["tmp_name"],"files/animal/" . $nombre_final_animal);
            }

            $foto_atributo_animal = "files/animal/" . $nombre_final_animal;

            $animal->set('dueno',"");
            $animal->set('foto',$foto_atributo_animal);

            $this->orm->connect();
            $this->orm->insert_data("normal",$animal);
            $this->orm->close();

            $options['animal']['lvl2']="max";
            $this->orm->connect();
            $this->orm->read_data(array("animal"), $options);
            $animalmaxid = $this->orm->get_objects("animal");

            $id = $animalmaxid[0]->get('id');

            $msg = "Animal sin dueño registrado, Codigo asignado: " . $id;
            $dir=$gvar['l_global']."perfil_administrador.php";
            self::mensaje("check-circle","Confirmación",$dir,$msg);
        }
    }

    public function cancelar(){
        $msg_dir=$gvar['l_global']."perfil_administrador.php";
        self::mensaje("info","Informacion",$msg_dir,"Operación cancelada por el administrador");
    }

    public function display(){
        $this->engine->assign('title', "Registrar Animal");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if ($this->session['usuario']['tipo'] == "administrador") {
            $this->engine->display($this->temp_aux);
            $this->engine->display('registrar_animal_dueno.tpl');
        }else{
            $direccion=$gvar['l_global']."index.php";
            self::mensaje("warning","Informacion",$direccion,"Lo sentimos, usted no tiene permisos para acceder");
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
            }elseif ($_POST[dueno_nuevo]) {
                $this->get->option = "registrar_dueno_nuevo"; 
            }elseif ($_POST[dueno_existente]) {
                $this->get->option = "registrar_dueno_existente"; 
            }elseif ($_POST[cancelar_dueno]) {
                $this->get->option = "cancelar_dueno"; 
            }  

            if (isset($this->get->option)) {
                if ($this->get->option == "registrar"){
                    $this->{$this->get->option}();
                }elseif ($this->get->option == "cancelar") {
                    $this->{$this->get->option}();
                }elseif ($this->get->option == "registrar_dueno_nuevo") {
                    $this->{$this->get->option}();
                }elseif ($this->get->option == "registrar_dueno_existente") {
                    $this->{$this->get->option}();  
                }elseif ($this->get->option == "cancelar_dueno") {
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

    $call = new c_registrar_animal_dueno();
    $call->run();


?>