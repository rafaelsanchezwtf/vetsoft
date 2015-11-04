<div>
    <b>Datos del dueño:</b><br /><br />
</div>
<div class="col-sm-offset-3 col-sm-10">
    <form action="{$gvar.l_global}registrar_dueno.php" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" cellpadding="0" cellspacing="5"> 
            <tr>
                <td>
                    
                    &nbsp<b>Cedula:</b> <input {if isset($cedula_vacio) or isset($cedula_invalido)} style="background-color: #F78181" {/if} type="number" name="cedula"/>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <b>Telefono:</b> <input {if isset($telefono_vacio) or isset($telefono_invalido)} style="background-color: #F78181" {/if} type="number" name="telefono"/></br></br>
                    
                    <b>Nombre:</b> <input {if isset($nombre_vacio)} style="background-color: #F78181" {/if} type="text" name="nombre"/>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <b>Email:</b> <input  {if isset($email_vacio) or isset($email_invalido)} style="background-color: #F78181" {/if} type="text" name="email"/>
                    </br></br>
                    <b>Fotografia:</b></br> <input type="file" name="foto" id="foto" onchange="PreviewImage();"/>
                    <script>  
                             
                            $("#foto").change(function(){
                                PreviewImage();
                            });
                            function PreviewImage() {
                                var oFReader = new FileReader();
                                oFReader.readAsDataURL(document.getElementById("foto").files[0]);
                                oFReader.onload = function (oFREvent) {
                                document.getElementById("uploadPreview").src = oFREvent.target.result;
                            };
                            };

                        </script>
                    
                    
                    
                    <img id="uploadPreview" style="width: 100px; height: 100px;" />
                    
                    
                    
                    
                    
                </br>
                    {if isset($mostrar)}
                        <img src="{$mostrar}" height='20%' width='20%'/>
                    {/if}
                </br>
                </br>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input class="btn btn-primary" name="cancelar" type="submit" value="Cancelar" />
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input class="btn btn-primary" name="aceptar" type="submit" value="Aceptar" />
                    
                </td>
            </tr>
        </table>
    </form> 
</br>
        
</div>

