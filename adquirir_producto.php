<?php

require('configs/include.php');

class c_adquirir_producto extends super_controller {
    
    public function asignar_datos($nombre, $fecha_de_nacimiento, $peso, $talla, $genero, $especie){
        $this->engine->assign('nombre_animal',$nombre);
        $this->engine->assign('fecha_de_nacimiento',$fecha_de_nacimiento);
        $this->engine->assign('peso',$peso);
        $this->engine->assign('talla',$talla);
        $this->engine->assign('genero',$genero);
        $this->engine->assign('especie',$especie);  
    }

    public function asignar_vacios($nombre, $fecha_de_nacimiento, $peso, $talla, $genero, $especie){
        if (is_empty($nombre)){
            $this->engine->assign("nombre_vacio",0);
        }
        if (is_empty($fecha_de_nacimiento)){
            $this->engine->assign("fecha_vacio",0);
        }
        if (is_empty($peso)){
            $this->engine->assign("peso_vacio",0);
        }
        if (is_empty($talla)){
            $this->engine->assign("talla_vacio",0);
        }
        if (is_empty($genero)){
            $this->engine->assign("genero_vacio",0);
        }
        if (is_empty($tespecie)){
            $this->engine->assign("especie_vacio",0);
        }
    }

    public function asignar_invalidos($animal){
        $fecha_actual = date('Y-m-d');
        if((!(animal::validateDate($animal->get('fecha_de_nacimiento')))) or ($animal->get('fecha_de_nacimiento') > $fecha_actual)){
            $this->engine->assign("fecha_invalido",0);
        }
        if ((!is_numeric($animal->get('peso'))) or ($animal->get('peso') <= 0)){
            $this->engine->assign("peso_invalido",0); 
        }
        if ((!is_numeric($animal->get('talla'))) or ($animal->get('talla') <= 0)){
            $this->engine->assign("talla_invalido",0);    
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

    public function agregar(){
        echo "in";
        // self::asignar_datos_dueno($this->post->cedula_dueno,$this->post->nombre_dueno,$this->post->telefono_dueno,$this->post->email_dueno);
        // self::asignar_datos_animal($this->post->nombre,$this->post->fecha_de_nacimiento,$this->post->peso,$this->post->talla,$this->post->genero,$this->post->especie);

        // $animal = new animal($this->post);
        // $dueno = new dueno();

        // $dueno->set('cedula',$this->post->cedula_dueno);
        // $dueno->set('nombre',$this->post->nombre_dueno);
        // $dueno->set('telefono',$this->post->telefono_dueno);
        // $dueno->set('email',$this->post->email_dueno);

        // $incompletitud_animal = animal::validar_completitud($animal);
        // $incompletitud_dueno = dueno::validar_completitud($dueno);

        // if ($incompletitud_animal or $incompletitud_dueno){

        //     self::asignar_vacios_animal($this->post->nombre,$this->post->fecha_de_nacimiento,$this->post->peso,$this->post->talla,$this->post->genero,$this->post->especie);
        //     self::asignar_vacios_dueno($this->post->cedula_dueno,$this->post->nombre_dueno,$this->post->telefono_dueno,$this->post->email_dueno);

        //     self::mensaje("warning","Error","","Hay campos vacíos");
        //     throw_exception("");
        // }

        // $incorrectitud_animal = animal::validar_correctitud($animal);
        // $incorrectitud_dueno = dueno::validar_correctitud($dueno);

        // if ($incorrectitud_animal or $incorrectitud_dueno){

        //     self::asignar_invalidos_animal($animal);
        //     self::asignar_invalidos_dueno($dueno);

        //     self::mensaje("warning","Error","","Hay datos invalidos");
        //     throw_exception("");
        // }

        // self::verificar_fotografia("foto");
        // self::verificar_fotografia("foto_dueno");

        // $foto_atributo_dueno = self::insertar_fotografia("foto_dueno",$this->post->cedula_dueno);
        // $dueno->set('foto',$foto_atributo_dueno);

        // $this->orm->connect();
        // $this->orm->insert_data("normal",$dueno);
        // $this->orm->close();

        // $options['animal']['lvl2']="max";
        // $this->orm->connect();
        // $this->orm->read_data(array("animal"), $options);
        // $animalmaxid = $this->orm->get_objects("animal");

        // if (is_null($animalmaxid)) {
        //     $id = 1;
        // }else{
        //     $id = $animalmaxid[0]->get('id') + 1;
        // }

        // $foto_atributo_animal = self::insertar_fotografia("foto",$id);

        // $animal->set('dueno',$this->post->cedula_dueno);
        // $animal->set('foto',$foto_atributo_animal);

        // $this->orm->connect();
        // $this->orm->insert_data("normal",$animal);
        // $this->orm->close();

        // $options['animal']['lvl2']="max";
        // $this->orm->connect();
        // $this->orm->read_data(array("animal"), $options);
        // $animalmaxid = $this->orm->get_objects("animal");

        // $id = $animalmaxid[0]->get('id');

        // $msg = "Animal y dueño registrados, Codigo asignado: " . $id;
        // $dir=$gvar['l_global']."perfil_administrador.php";
        // self::mensaje("check-circle","Confirmación",$dir,$msg);
    }

    public function cancelar(){
        $msg_dir=$gvar['l_global']."perfil_administrador.php";
        self::mensaje("info","Informacion",$msg_dir,"Operación cancelada por el administrador");
    }

    public function display(){
        $this->engine->assign('title', "Adquirir Producto");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if ($this->session['usuario']['tipo'] == "administrador") {
            $this->engine->display($this->temp_aux);
            $this->engine->display('adquir_producto.tpl');
        }else{
            $direccion=$gvar['l_global']."index.php";
            self::mensaje("warning","Informacion",$direccion,"Lo sentimos, usted no tiene permisos para acceder");
            $this->engine->display($this->temp_aux); 
        }
        $this->engine->display('piedepagina.tpl');
    }
    
    public function run() {
        try {
            if ($_POST[agregar]){
                $this->get->option = "agregar";   
            }elseif ($_POST[cancelar]){
                $this->get->option = "cancelar";  
            }

            if (isset($this->get->option)) {
                if ($this->get->option == "agregar"){
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
    $call = new c_adquirir_producto();
    $call->run();
?>