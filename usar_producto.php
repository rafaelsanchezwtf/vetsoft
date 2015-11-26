<?php

require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_atender_cita extends super_controller {

    public function mostrar_buscar(){
        if ($this->post->tipo_prod == "implemento") {
            $this->engine->assign('opciones_datos',"implemento");
        }else if($this->post->tipo_prod == "medicamento"){
            $this->engine->assign('opciones_datos',"medicamento");   
        }
        $this->engine->assign('opciones',"si");
    }

    public function buscar_medicamento(){
        $nombre = $_POST['nombre_prod'];
        $_SESSION['nombre_prod'] = $nombre;
        
        if(is_empty($nombre)){
            $consulta = "by_all";   
        }else{
            $consulta = "by_nombre";    
        }
        $_SESSION['consulta_prod'] = $consulta;
        $_SESSION['consulta_tipo'] = "medicamento";
        $options['producto']['lvl2'] = $consulta;

        $cod['producto']['nombre'] = $nombre;
        $cod['producto']['tipo'] = "medicamento";
        $this->orm->connect();
        $this->orm->read_data(array("producto"), $options, $cod);
        $productos = $this->orm->get_objects("producto");
        $this->orm->close();
        $this->session = $_SESSION;
        if (is_empty($productos)){
            $this->mensaje("warning","Error","","No existen coincidencias");
            throw_exception("");
        }else{

            $this->engine->assign("producto",$productos);
            $this->engine->assign('opciones_datos',"medicamento");
            $this->engine->assign('opciones',"si");
        }
    }

    public function buscar_implemento(){
        $nombre = $_POST['nombre_prod'];
        $_SESSION['nombre_prod'] = $nombre;
        
        if(is_empty($nombre)){
            $consulta = "by_all";   
        }else{
            $consulta = "by_nombre";    
        }
        $_SESSION['consulta_prod'] = $consulta;
        $_SESSION['consulta_tipo'] = "implemento";
        $options['producto']['lvl2'] = $consulta;

        $cod['producto']['nombre'] = $nombre;
        $cod['producto']['tipo'] = "implemento";
        $this->orm->connect();
        $this->orm->read_data(array("producto"), $options, $cod);
        $productos = $this->orm->get_objects("producto");
        $this->orm->close();
        $this->session = $_SESSION;
        if (is_empty($productos)){
            $this->mensaje("warning","Error","","No existen coincidencias");
            throw_exception("");
        }else{

            $this->engine->assign("producto",$productos);
            $this->engine->assign('opciones_datos',"implemento");
            $this->engine->assign('opciones',"si");
        }    
    }

    public function usar(){     
        $unidades_disponibles = $this->post->cantidad_disponible;
        $unidades_usar = $this->post->cantidad_usar;
        if ($unidades_disponibles < $unidades_usar) {
            $options['producto']['lvl2'] = $this->session['consulta_prod'];
            $cod['producto']['nombre'] = $this->session['nombre_prod'];
            $cod['producto']['tipo'] = $this->session['consulta_tipo'];
            $this->orm->connect();
            $this->orm->read_data(array("producto"), $options, $cod);
            $productos = $this->orm->get_objects("producto");
            $this->orm->close();
            $this->engine->assign("producto",$productos);
            $this->engine->assign('opciones_datos',$this->session['consulta_tipo']);
            $this->engine->assign('opciones',"si");
            $this->mensaje("warning","Error","","No se pueden usar menos de las unidades disponibles");
            throw_exception("");   
        }else{
            $unidades = $unidades_disponibles - $unidades_usar;

            $options['producto']['lvl2'] = "por_id";
            $cod['producto']['id'] = $this->post->id_prod;
            $this->orm->connect();
            $this->orm->read_data(array("producto"), $options, $cod);
            $producto = $this->orm->get_objects("producto");
            $this->orm->close();

            $mi_producto = $producto[0];
            $mi_producto->set('cantidad',$unidades);
            $uso_de_producto = new uso_de_producto();
            $uso_de_producto->set('cantidad',$unidades);
            $uso_de_producto->set('producto',$this->post->id_prod);
                if($this->session['desde_prod'] == "tratamiento"){
                    $uso_de_producto->set('tratamiento',$this->session['desde_cod_prod']);
                    $this->orm->connect();
                    $this->orm->insert_data("desde_tratamiento",$uso_de_producto);
                    $this->orm->close();
                }else{
                    $uso_de_producto->set('cita',$this->session['desde_cod_prod']);
                    $this->orm->connect();
                    $this->orm->insert_data("desde_cita",$uso_de_producto);
                    $this->orm->close();     
                }

            $this->orm->connect();
            $this->orm->update_data("normal",$mi_producto);
            $this->orm->close();

            $options['producto']['lvl2'] = $this->session['consulta_prod'];
            $cod['producto']['nombre'] = $this->session['nombre_prod'];
            $cod['producto']['tipo'] = $this->session['consulta_tipo'];
            $this->orm->connect();
            $this->orm->read_data(array("producto"), $options, $cod);
            $productos = $this->orm->get_objects("producto");
            $this->orm->close();
            $this->engine->assign("producto",$productos);
            $this->engine->assign('opciones_datos',$this->session['consulta_tipo']);
            $this->engine->assign('opciones',"si");
            $this->mensaje("check-circle","Confirmacion","","Producto usado correctamente");  
        }
    }

    public function atras(){
        $this->engine->assign('opciones',"no");    
    }

    public function display(){
        $this->engine->assign('title', "Usar Producto");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('identificacion',$this->session['usuario']['identificacion']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if (($this->session['usuario']['tipo'] == "veterinario")) {
            $this->engine->display($this->temp_aux);
            $this->engine->display('usar_producto.tpl');
       
        }else{
            $direccion=$gvar['l_global']."index.php";
            $this->mensaje("warning","Informacion",$direccion,"Lo sentimos, usted no tiene permisos para acceder");
            $this->engine->display($this->temp_aux); 
        }
        $this->engine->display('piedepagina.tpl');
    }
    
    public function run() {
        try {
            if (isset($this->get->option)) {
                if ($this->get->option == "mostrar_buscar"){
                    $this->{$this->get->option}();
                }elseif ($this->get->option == "buscar_medicamento"){
                    $this->{$this->get->option}();
                }elseif ($this->get->option == "buscar_implemento"){
                    $this->{$this->get->option}();
                }elseif ($this->get->option == "atras"){
                    $this->{$this->get->option}();
                }elseif ($this->get->option == "usar"){
                    $this->{$this->get->option}();
                }else{
                    throw_exception("Opción ". $this->get->option." no disponible");
                }
            }
        }catch (Exception $e) {
            $this->error=1;
            $this->msg_warning=$e->getMessage();
            $this->temp_aux = 'message.tpl';
            $this->engine->assign('type_warning',$this->type_warning);
            $this->engine->assign('msg_warning',$this->msg_warning);
        }
        $this->display();
    }
        
}
    $call = new c_atender_cita();
    $call->run();
?>