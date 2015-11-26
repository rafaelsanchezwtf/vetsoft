<div class="container">
    <section class="main row" >
    
    <form action="{$gvar.l_global}editar_animal.php?option=actualizar" method="post" enctype="multipart/form-data">
    
    <!-- Campo para obtencion de un post foto-->
    <input type="hidden"  name="foto">
    {if isset($id)}
           
            <table class="table customtable" id="altocorregido">
                <tr>
                   <td>
                   <b> Información del animal:</b><br>
                   <hr>
                   
                   <div class="camposeditar">
                   
                       <input type="hidden" value="{$id}" name="id" >
                       <div class="input-group">
                          <span class="input-group-addon" >Nombre</span>
                          <input type="text" class="form-control " value="{$nombre_animal}" required name="nombre_animal" aria-describedby="basic-addon1" {if isset($nombre_vacio)} style="background-color: #F78181" {/if}>
                        </div>
                   </div>
                       
                    <div class="camposeditar">
                        <div class="input-group" >
                            <span class="input-group-addon">Fecha de nacimiento:</span>
                            <input id ="datepicker" class="form-control " type="date" value="{$fecha_de_nacimiento}" required name="fecha_de_nacimiento" aria-describedby="basic-addon1" {if isset($fecha_vacio) or isset($fecha_invalido)} style="background-color: #F78181" {/if}>
                        </div>
                    </div> 
                     
                      <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Peso (Kg)</span>
                            <input class="form-control " type="text" value="{$peso}" required name="peso" aria-describedby="basic-addon1" {if isset($peso_vacio) or isset($peso_invalido)} style="background-color: #F78181" {/if}>
                        </div>
                    </div> 
                       
                     <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Talla (cm)</span>
                            <input type="text" value="{$talla}" required name="talla"  class="form-control " aria-describedby="basic-addon1" {if isset($talla_vacio) or isset($talla_invalido)} style="background-color: #F78181" {/if}>
                        </div>
                    </div>  
                       <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Genero</span>
                            <input type="text" value="{$genero}" required name="genero"  class="form-control " aria-describedby="basic-addon1" {if isset($genero_vacio)} style="background-color: #F78181" {/if}>
                        </div>
                    </div> 
                    
                    <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Especie</span>
                            <input type="text" value="{$especie}" required name="especie"  class="form-control " aria-describedby="basic-addon1" {if isset($especie_vacio)} style="background-color: #F78181" {/if}>
                        </div>
                    </div> 
                   
                      <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Foto</span>
                            <input type="hidden" value="{$foto_animal}" name="fotovieja" id="vieja_animal">
                            
                           <span class="input-group-addon" >
                               
                              
                        <!-- vista imagen nueva-->   
                        <img id="uploadPreview" style="width: 100px; height: 100px; " />
                        <!-- vista imagen nueva-->  
                        <img id="uploadPreviewInitial" style="width: 100px; height: 100px;" src="{$gvar.l_global}{$foto_animal}"/>
                              
                               <input  id="uploadImage" type="file" name="fotonueva" accept="image/*" onchange="PreviewImage();">
                               
                           </span>
                        </div>
                    </div>
                               
                                  
                    <button class="btn btn-default" type="submit"><span class="fa fa-check"></span> Aceptar</button>
                        <a href="{$gvar.l_global}editar_animal.php?option=cancelar" class="btn btn-default" role="button"><span class="fa fa-close"></span> Cancelar</a>    
                    
                    </td>                                  
                  <td>
                    {if isset($duenio)}
                    
                        <button class="btn btn-default" type="button" id="editardueno"><span class="fa fa-edit"></span> Editar dueño</button>
                    
                    
                    
                           
                           
                          
                        
                           
                           <div class="datosdeldueno">
                            
                            <b>Información del dueño</b><hr>

                            <div class="camposeditar">
                                <div class="input-group">
                                    <span class="input-group-addon" >Cedula</span>
                                    <span class="input-group-addon" >{$duenio->get('cedula')}</span>
                                    <input type="hidden" value="{$duenio->get('cedula')}" readonly name="cedula" >
                                    <input type="hidden" value="{$duenio->get('cedula')}" readonly name="dueno" >
                                    <div id="ocultodueno"></div>
                                </div>
                            </div>   
                            
                            
                            <div class="camposeditar">
                                <div class="input-group">
                                <span class="input-group-addon" >Nombre</span>
                                <input type="text" value="{$duenio->get('nombre')}" required name="nombre_dueno"  class="form-control " aria-describedby="basic-addon1"  {if isset($nombre_dueno_vacio)} style="background-color: #F78181" {/if}>
                                </div>
                            </div> 
                            
                            <div class="camposeditar">
                                <div class="input-group">
                                <span class="input-group-addon" >Telefono</span>
                                <input type="number" value="{$duenio->get('telefono')}" required name="telefono"  class="form-control " aria-describedby="basic-addon1" {if isset($telefono_dueno_vacio) or isset($telefono_dueno_invalido)} style="background-color: #F78181" {/if}>
                                </div>
                            </div> 
                            
                            <div class="camposeditar">
                                <div class="input-group">
                                <span class="input-group-addon" >Email</span>
                                <input type="email" value="{$duenio->get('email')}" required name="email"  class="form-control " aria-describedby="basic-addon1" {if isset($email_dueno_vacio) or isset($email_dueno_invalido)} style="background-color: #F78181" {/if}>
                                </div>
                            </div>
                            
                            
                            
                            <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Foto</span>
                            <input type="hidden" value="{$duenio->get('foto')}" name="fotoviejad">
                            
                           <span class="input-group-addon" >
                               
                              
                         <img id="uploadPreviewd" style="width: 100px; height: 100px;" />
                           <img id="uploadPreviewInitiald" style="width: 100px; height: 100px;" src="{$gvar.l_global}{$duenio->get('foto')}"/>
                              
                               <input id="uploadImaged" type="file" name="fotonuevad" accept="image/*" onchange="PreviewImaged();"> 
                               
                           </span>
                        </div>
                    </div>
                             
                           
                         </div>     
        {/if}
               
               
                </td>
                </tr>
        </table>
                {/if}
                
               
    </form>
    </section>
</div>

<script type="text/javascript">
    $(".form-control").focus(function(){
        $(this).attr("style","");
    });
    
    
    
    
    
    $("#editardueno").click(function(){
            $("#editardueno").css('display','none');
            $(".datosdeldueno").css('display','block');
            $(".datosdeldueno").css('visibility','visible');
            $( "#ocultodueno" ).append( "<input type='hidden' name='sidueno'>" );
        });
        
     
                            // Script para la carga de la imagen del animal
                            $("#uploadImage").bind('change',function(){
                                
                                var oFReader = new FileReader();
                                oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
                                oFReader.onload = function (oFREvent) {
                                document.getElementById("uploadPreview").src = oFREvent.target.result;
                                $('#uploadPreviewInitial').hide();
                            };
                            });
                           $("#uploadImaged").bind('change',function(){
                                 var oFReader = new FileReader();
                                oFReader.readAsDataURL(document.getElementById("uploadImaged").files[0]);
                                oFReader.onload = function (oFREvent) {
                                document.getElementById("uploadPreviewd").src = oFREvent.target.result;
                                $('#uploadPreviewInitiald').hide();
                            };
                            }); 
    
        
    
    
</script>


                       
                    






