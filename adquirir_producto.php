<?php

require('configs/include.php');

class c_adquirir_producto extends super_controller {
    
    public function asignar_datos($nombre, $marca, $cantidad, $precio_neto){
        $this->engine->assign('nombre_p',$nombre);
        $this->engine->assign('marca',$marca);
        $this->engine->assign('cantidad',$cantidad);
        $this->engine->assign('precio_neto',$precio_neto);      
    }

    public function asignar_vacios($nombre, $marca, $cantidad, $precio_neto, $tipo){
        if (is_empty($nombre)){
            $this->engine->assign("nombre_vacio",0);
        }
        if (is_empty($marca)){
            $this->engine->assign("marca_vacio",0);
        }
        if (is_empty($precio_neto)){
            $this->engine->assign("precio_neto_vacio",0);
        }
        if (is_empty($cantidad)){
            $this->engine->assign("cantidad_vacio",0);
        } 
        if ($tipo == "seleccion"){
            $this->engine->assign("tipo_vacio",0);
        } 
    }

    public function asignar_invalidos($producto){
        if ((!is_numeric($producto->get('cantidad'))) OR ($producto->get('cantidad') <= 0)){
            $this->engine->assign("cantidad_invalido",0);     
        }
        if ((!is_numeric($producto->get('precio_neto'))) OR ($producto->get('precio_neto') <= 0)){
            $this->engine->assign("precio_neto_invalido",0);    
        }
        if (($producto->get('tipo') != "medicamento") AND ($producto->get('tipo') != "implemento")){
            $this->engine->assign("tipo_invalido",0);    
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
        self::asignar_datos($this->post->nombre,$this->post->marca,$this->post->cantidad,$this->post->precio_neto);

        $producto = new producto($this->post);

        $hoy = getdate();
        $año = $hoy['year'];
        if ($hoy['mon']<10){
            $mes = "0" . $hoy['mon'];
        }else{
            $mes = $hoy['mon'];
        }
        if ($hoy['mday']<10){
            $dia = "0" . $hoy['mday'];
        }else{
            $dia = $hoy['mday'];
        }
        $fecha_actual = $año . "-" . $mes . "-" . $dia;

        $producto->set('fecha_de_adquisicion',$fecha_actual);

        $incompletitud_producto = producto::validar_completitud($producto);

        if ($incompletitud_producto){
            self::asignar_vacios($this->post->nombre,$this->post->marca,$this->post->cantidad,$this->post->precio_neto,$this->post->tipo);
            self::mensaje("warning","Error","","Hay campos vacíos");
            throw_exception("");  
        }
            
        $incorrectitud_producto = producto::validar_correctitud($producto);

        if ($incorrectitud_producto){
            self::asignar_invalidos($producto);
            self::mensaje("warning","Error","","Hay datos invalidos");
            throw_exception("");
        }

        $option['producto']['lvl2']="all";
        $this->orm->connect();
        $this->orm->read_data(array("producto"), $option);
        $productos = $this->orm->get_objects("producto");
        
        if (!(is_empty($productos))){
            foreach($productos as $prod_aux){
                if (($prod_aux->get('nombre') == $producto->get('nombre')) AND ($prod_aux->get('marca') == $producto->get('marca'))){
                    $this->mensaje("warning","Error","","Ya existe un producto con ese nombre y esa marca");
                    throw_exception(""); 
                }
            }
        }

        $this->orm->connect();
        $this->orm->insert_data("normal",$producto);
        $this->orm->close();

        $dir=$gvar['l_global']."perfil_administrador.php";
        self::mensaje("check-circle","Confirmación",$dir,"Producto ingresado satisfactoriamente");
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