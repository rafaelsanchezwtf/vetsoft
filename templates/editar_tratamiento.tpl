<div class="container">
    <section class="main row" >
    <h1>Editar tratamiento</h1><br>
    <form action="{$gvar.l_global}editar_tratamiento.php?option=actualizar" method="post" >
    
    
    {if isset($codigo)}
           
            
               
                   <b> Información del tratamiento:</b><br>
                   <hr>
                   
                   <div class="camposeditar">
                   
                       <input type="hidden" value="{$codigo}" name="codigo" >
                       <input type="hidden" value="{$animal}" name="animal" >
                       <input type="hidden" value="{$veterinario}" name="veterinario" >
                       
                       <div class="input-group">
                          <span class="input-group-addon" >Titulo*</span>
                          <input type="text" class="form-control " value="{$titulo}" required name="titulo" aria-describedby="basic-addon1" {if isset($titulo_vacio)} style="background-color: #F78181" {/if}>
                        </div>
                   </div>
                      <div class="camposeditar">
                        
                       <div class="input-group">
                          <span class="input-group-addon" >Descripcion*</span>
                          <input type="text" class="form-control " value="{$descripcion}" required name="descripcion" aria-describedby="basic-addon1" {if isset($descripcion_vacio)} style="background-color: #F78181" {/if}>
                        </div>
                   </div>
                       
                    <div class="camposeditar">
                        <div class="input-group" >
                            <span class="input-group-addon">Fecha*</span>
                            <input id ="datepicker" class="form-control " type="date" value="{$fecha}" required placeholder="YYYY-mm-dd" name="fecha" aria-describedby="basic-addon1" {if isset($fecha_vacio) or isset($fecha_invalido)} style="background-color: #F78181" {/if}>
                        </div>
                    </div> 
                     
                      <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Hora* (HH:MM)</span>
                            <input  class="form-control " type="time" value="{$hora}" required name="hora" aria-describedby="basic-addon1" {if isset($hora_vacio) or isset($hora_t_invalido)} style="background-color: #F78181" {/if}>
                        </div>
                    </div> 
                       
                     <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Lugar*</span>
                            <input type="text" value="{$lugar}" required name="lugar"  class="form-control " aria-describedby="basic-addon1" {if isset($lugar_vacio)} style="background-color: #F78181" {/if}>
                        </div>
                    </div>  
                      
                      
                    <button class="btn btn-default" type="submit"><span class="fa fa-check"></span> Aceptar</button>
                        <a href="{$gvar.l_global}editar_tratamiento.php?option=cancelar" class="btn btn-default" role="button"><span class="fa fa-close"></span> Cancelar</a>    
                    
                                                   
            
        
    {/if}
                
               
    </form>
    </section>
</div>

<script type="text/javascript">
    $(".form-control").focus(function(){
        $(this).attr("style","");
    });

    
</script>


                       
                    






