<?php

require('configs/include.php');

class c_editar_producto extends super_controller {
    
    public function asignar_datos_producto($id,$nombre, $marca, $cantidad, $fecha_de_adquisicion,$precio_unidad){
        $this->engine->assign('id',$id);
        $this->engine->assign('nombre_p',$nombre);
        $this->engine->assign('marca',$marca);
        $this->engine->assign('cantidad',$cantidad); 
        $this->engine->assign('fecha_de_adquisicion',$fecha_de_adquisicion); 
         $this->engine->assign('precio_unidad',$precio_unidad);
    }
    public function asignar_vacios_producto($nombre, $marca,$cantidad, $fecha_de_adquisicion,$precio_unidad){
        $vs = false;
        if (is_empty($nombre)){
            $this->engine->assign("nombre_vacio",0); $vs=true;
        }
        if (is_empty($marca)){
            $this->engine->assign("marca_vacio",0); $vs=true;
        }
        if (is_empty($cantidad)){
            $this->engine->assign("cantidad_vacio",0); $vs=true;
        }
        if (is_empty($fecha_de_adquisicion)){
            $this->engine->assign("fecha_vacio",0); $vs=true;
        }
        if (is_empty($precio_unidad)){
            $this->engine->assign("precio_unidad_vacio",0); $vs=true;
        }
    return $vs;
 
    }
      
    public function asignar_invalidos_producto($producto,$cantvieja){
        
        $v=false;
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
    
        
        if((!(producto::validateDate($producto->get('fecha_de_adquisicion')))) or ($producto->get('fecha_de_adquisicion') > $fecha_actual)){
            $this->engine->assign("fecha_invalido",0);
            $v=true;
        }
        
        if(!(is_numeric($producto->get('precio_unidad'))) or ($producto->get('precio_unidad') < 0))
           
           {
            $this->engine->assign("precio_unidad_invalido",0);
            $v=true;
        
        }
          
           if(!(is_numeric($producto->get('cantidad'))) or ($producto->get('cantidad') < $cantvieja)){
            
            $this->engine->assign("cantidad_invalido",0);
            $v=true;
        
        }
        
        return $v;
    }
   
    
    public function actualizar(){
  
        $vaciosproducto = self::asignar_vacios_producto($this->post->nombre_p,$this->post->marca,$this->post->cantidad,$this->post->fecha_de_adquisicion,$this->post->precio_unidad);  
        
        
        $producto = new producto($this->post);
        
        //print_r2($producto);
        if(isset($this->post->cantidadbd)){
            $incorrectosproducto = self::asignar_invalidos_producto($producto,$this->post->cantidadbd);}
        else{
         $incorrectosproducto = self::asignar_invalidos_producto($producto,$this->post->cantidad_viejo);
        }
 
        
        if($vaciosproducto){
            $this->mensaje("warning","Error","","Hay campos vacíos");
            throw_exception("");
        }
        if($incorrectosproducto){
            $this->mensaje("warning","Error","","Hay datos invalidos");
            throw_exception("");
        }
        
    
        $this->orm->connect();  
         $producto->set('nombre',$this->post->nombre_p);
        $this->orm->update_data("normal",$producto);   
        $this->orm->close();
        
        $dir = $gvar['l_global']."buscar_producto.php";
        $this->mensaje("warning","Confirmacion",$dir,"Edicion exitosa"); 
    
    }
    public function mostrarEditables(){
       
        // Se realizan los assign para mostrarsen en el tpl, los valores son los que se tenian
        // en los inputs en el ultimo submit
        if(isset($this->post->cantidad_viejo)){
         self::asignar_datos_producto($this->post->id,$this->post->nombre_p,$this->post->marca,$this->post->cantidad_viejo,$this->post->fecha_de_adquisicion,$this->post->precio_unidad);
            
         // cantidad del producto actual en la bd
        $this->engine->assign('cantidadbd',$this->post->cantidad_viejo); 
            
        
        }
           else{
           
            self::asignar_datos_producto($this->post->id,$this->post->nombre_p,$this->post->marca,$this->post->cantidad,$this->post->fecha_de_adquisicion,$this->post->precio_unidad);
            
         // cantidad del producto actual en la bd
        $this->engine->assign('cantidadbd',$this->post->cantidadbd); 
         
           }
        
       
        
    }

    public function cancelar(){
        $dir = $gvar['l_global']."buscar_producto.php";
        $this->mensaje("warning","Información",$dir,"Operacion cancelada por el administrador");
    }
    
    public function display(){
        $this->engine->assign('title', "Editar producto");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if ($this->session['usuario']['tipo'] == "administrador"){
            $this->engine->display($this->temp_aux);
            $this->engine->display('editar_producto.tpl');
        }else{
            $direccion=$gvar['l_global']."index.php";
            $this->mensaje("warning","Informacion",$direccion,"Lo sentimos, usted no tiene permisos para acceder");
            $this->engine->display($this->temp_aux); 
        }
        $this->engine->display('piedepagina.tpl');
    }
    
    public function run(){
        try {
            if(isset($this->get->option)){
                if($this->get->option=="cancelar"){
                    $this->{$this->get->option}();}
                else if($this->get->option=="actualizar"){
                    $this->{$this->get->option}();
                }
                
                else{throw_exception("Opción ". $this->get->option." no disponible");}
            }
           
            else if(isset($this->post->id)){ 
                $this->mostrarEditables();
            }
            else{
             
            }
        } catch (Exception $e) {
            $this->error=1;
            $this->msg_warning=$e->getMessage();
            $this->temp_aux = 'message.tpl';
            $this->engine->assign('type_warning',$this->type_warning);
            $this->engine->assign('msg_warning',$this->msg_warning);
            $this->mostrarEditables();
            }
        $this->display();
    }
        
}

    $call = new c_editar_producto();
    $call->run();


?>