<div class="container">
    <section class="main row" >
    
    <form action="{$gvar.l_global}editar_animal.php" method="post" enctype="multipart/form-data">
    
    <!-- Campo para obtencion de un post foto-->
    <input type="hidden"  name="foto">
    {if isset($id)}
           
            <div class="table-responsive tablaeditarcustom">
                <table class="table">
                   
                   <tr>
                       <td class="caracteristica">Id:</td>
                       <td><input type="text" value="{$id}" readonly name="id"></td>
                   </tr>
                   <tr>
                        <td class="caracteristica" >Nombre:</td>
                       <td><input type="text" value="{$nombrec}" required name="nombre"></td>
                   </tr>
                    <tr>
                        <td class="caracteristica">Fecha de nacimiento:</td>
                        <td><input type="date" value="{$fecha_de_nacimiento}" required name="fecha_de_nacimiento"></td>
                    </tr>
                    <tr>
                        <td class="caracteristica">Peso:</td>
                        <td><input type="text" value="{$peso}" required name="peso"></td>                        
                    </tr>
                    <tr>
                        <td class="caracteristica">Talla:</td>
                        <td><input type="text" value="{$talla}" required name="talla"></td>
                    </tr>
                    <tr>
                        <td class="caracteristica">Genero:</td>
                        <td><input type="text" value="{$genero}" required name="genero"></td>
                    </tr>
                    <tr>
                        <td class="caracteristica">Especie:</td>
                        <td><input type="text" value="{$especie}" required name="especie"></td>
                    </tr>
                    <tr>
                        <td class="caracteristica">Foto:</td>         
                        <td>         
                    
                <!--    <input  id="input-7" multiple type="file" class="file file-loading" data-allowed-file-extensions='["png", "jpg"]' data-show-upload="false" data-show-upload="false" name="fotonueva">-->
                    
                     <input id="uploadImage" type="file" name="fotonueva" accept="image/*" onchange="PreviewImage();"  > 
                     <input type="hidden" value="{$fotoc}" name="fotovieja">
                       
                         <script>  
                             
                            $("#uploadImage").change(function(){
                                PreviewImage();
                            });
                            function PreviewImage() {
                                var oFReader = new FileReader();
                                oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
                                oFReader.onload = function (oFREvent) {
                                document.getElementById("uploadPreview").src = oFREvent.target.result;
                            };
                            };

                        </script>
                           
                        <img id="uploadPreview" style="width: 100px; height: 100px;" />
                       
                            
                               
                                 
                                   
                                     
                                       
                                         
                                             
                        
                        </td>      
                    </tr>
                    {if isset($dueno)}
                   <tr>  
                        <td><button class="btn btn-default" type="button" id="editardueno">Editar dueño</button></td><td></td>    
                   </tr>
                    {/if}
                    
                    
                           
                           
                           <tr>
                        <td class="caracteristica"><button class="btn btn-default" type="submit">Aceptar</button></td>
                        <td class="caracteristica"><a href="{$gvar.l_global}editar_animal.php?op=cancelar" class="btn btn-default opcion" role="button">Cancelar</a></td>      
                    </tr>
                            
                        
                         <tr class="datosdeldueno">
                            <td class="caracteristica">Cedula:</td>
                            <td><input type="number" value="{$dueno}" readonly name="cedula">
                            
                            <div id="ocultodueno"></div>
                            
                            </td>
                        </tr>
                        <tr class="datosdeldueno">
                            <td class="caracteristica">Nombre:</td>
                            <td><input type="text" value="{$duenio->get('nombre')}" required name="nombred"></td>                        
                        </tr>
                        <tr class="datosdeldueno">
                            <td class="caracteristica">Telefono:</td>
                            <td><input type="number" value="{$duenio->get('telefono')}" required name="telefono"></td>
                        </tr>
                        <tr class="datosdeldueno">
                            <td class="caracteristica">Email:</td>
                            <td><input type="email" value="{$duenio->get('email')}" required name="email"></td>
                        </tr>
                        <tr class="datosdeldueno">
                            <td class="caracteristica">Foto:</td>
                            <td>
                            <input type="file" name="fotod" accept="image/*"> 
                         <input type="hidden" value="{$foto}" name="fotoviejad"> 
                            
                            
                            
                            </td>
                        </tr>
                        
                    
                    
                    
                    
                    

                </table>
        </div>
        
        
        
    {/if}
    </form>
    </section>
</div>