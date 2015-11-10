{if isset($registrar_dueno_nuevo)}
    <div>
        <b>Datos del dueño:</b><br /><br />
    </div>
    <div class="col-sm-offset-3 col-sm-10">
        <form action="{$gvar.l_global}registrar_animal_dueno.php" method="post" enctype="multipart/form-data">
            <table width="100%" border="0" cellpadding="0" cellspacing="5"> 
                <tr>
                    <td>
                        
                        &nbsp<b>Cedula*</b> <input {if isset($cedula_dueno)} value="{$cedula_dueno}"{/if} {if isset($cedula_dueno_vacio) or isset($cedula_dueno_invalido)} style="background-color: #F78181" {/if} {if isset($cedula_dueno_invalido)} value="" {/if} type="number" name="cedula_dueno"/>

                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                        <b>Telefono*</b> <input {if isset($telefono_dueno)}value="{$telefono_dueno}"{/if} {if isset($telefono_dueno_vacio) or isset($telefono_dueno_invalido)} style="background-color: #F78181" {/if} {if isset($telefono_dueno_invalido)} value="" {/if} type="number" name="telefono_dueno"/></br></br>
                        
                        <b>Nombre*</b> <input {if isset($nombre_dueno)}value="{$nombre_dueno}"{/if} {if isset($nombre_dueno_vacio)} style="background-color: #F78181" {/if} type="text" name="nombre_dueno"/>

                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        
                        <b>Email*</b> <input {if isset($email_dueno)}value="{$email_dueno}"{/if} {if isset($email_dueno_vacio) or isset($email_dueno_invalido)} style="background-color: #F78181" {/if} {if isset($email_dueno_invalido)} value="" {/if} type="text" name="email_dueno"/>
                        
                        </br></br>
                        <input type="hidden" name="flag" value="dueno_nuevo">
                        <b>Fotografia*:</b></br> <input type="file" name="foto_dueno" id="foto_dueno" onchange="PreviewImage1();"/>
                        
                        <script>     
                                $("#foto_dueno").change(function(){
                                    PreviewImage();
                                });
                                function PreviewImage1() {
                                    var oFReader = new FileReader();
                                    oFReader.readAsDataURL(document.getElementById("foto_dueno").files[0]);
                                    oFReader.onload = function (oFREvent) {
                                    document.getElementById("uploadPreview_d").src = oFREvent.target.result;
                                };
                                };
                            </script>
                        <img id="uploadPreview_d" style="width: 100px; height: 100px;" />
                        </br>
                        </br>
                        <p>* Campos obligatorios</p>
                    </br>
                    
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                        <input class="btn btn-primary" name="cancelar_dueno" type="submit" value="Cancelar" />
                        
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        
                    </td>
                </tr>
            </table> 
    </br>   
    </div>

{/if}

{if isset($registrar_dueno_existente)}
<div>
        <b>Seleccione el dueño para este animal (obligatorio):</b><br /><br />
</div>
<div class="col-sm-offset-3 col-sm-10">
        <form action="{$gvar.l_global}registrar_animal_dueno.php" method="post" enctype="multipart/form-data">
        <select name="dueno">
                            <option value="0">Selección</option>    
                        {section loop=$objeto name=i}
                            <option value="{$objeto[i]->get('cedula')}">{$objeto[i]->get('cedula')} - {$objeto[i]->get('nombre')}</option>
                        {/section} 
                    </select>
        <input class="btn btn-primary" name="cancelar_dueno" type="submit" value="Cancelar" />
        <input type="hidden" name="flag" value="dueno_existente">
</div>
{/if}

<div>
    </br>
    </br>
    <b>Por favor ingrese los datos del animal:</b><br /><br />
</div>
<div class="col-sm-offset-2 col-sm-10">
    
    {if not isset($registrar_dueno_nuevo) and not isset($registrar_dueno_existente)}
        <form action="{$gvar.l_global}registrar_animal_dueno.php" method="post" enctype="multipart/form-data">
    {/if}
        <table width="100%" border="0" cellpadding="50" cellspacing="50">
            <tr>
                <td>
                    
                    <b>Nombre*</b> <input {if isset($nombre_vacio)} style="background-color: #F78181" {/if} type="text" name="nombre" {if isset($nombre_animal)} value="{$nombre_animal}" {/if}/>

                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                    <b>Fecha de nacimiento*</b> <input {if isset($fecha_de_nacimiento)}value="{$fecha_de_nacimiento}"{/if} {if isset($fecha_vacio) or isset($fecha_invalido)} style="background-color: #F78181" {/if} {if isset($fecha_invalido)} value="" {/if} type="date" size="5" name="fecha_de_nacimiento"/></br></br>

                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                    <b>Talla*</b> <input {if isset($talla)}value="{$talla}"{/if} {if isset($talla_vacio) or isset($talla_invalido)} style="background-color: #F78181" {/if}  {if isset($talla_invalido)} value="" {/if} type="text" size="5" name="talla"/><b>cm</b>

                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    
                    <b>Peso*</b> <input {if isset($peso)}value="{$peso}"{/if} {if isset($peso_vacio) or isset($peso_invalido)} style="background-color: #F78181" {/if} {if isset($peso_invalido)} value="" {/if} type="text" size="5" name="peso"/><b>kg</b>
                    
                    </br></br>
                    
                    <b>Género*</b> <input {if isset($genero)}value="{$genero}"{/if} {if isset($genero_vacio)} style="background-color: #F78181" {/if} type="text" name="genero" />

                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    
                    <b>Especie*</b> <input {if isset($especie)}value="{$especie}"{/if} {if isset($especie_vacio)} style="background-color: #F78181" {/if} type="text" name="especie"/>
                    
                    </br></br>
                    
                    <b>Fotografia:</b></br> 
                    <input type="file" name="foto" id="foto" onchange="PreviewImage2();"/>

                    <script>  
                        $("#foto").change(function(){
                            PreviewImage();
                        });
                        function PreviewImage2() {
                            var oFReader = new FileReader();
                            oFReader.readAsDataURL(document.getElementById("foto").files[0]);
                            oFReader.onload = function (oFREvent) {
                            document.getElementById("uploadPreview").src = oFREvent.target.result;
                            };
                        };
                    </script>

                    <img id="uploadPreview" style="width: 100px; height: 100px;" />
                    
                    </br>
                    </br>
                    <p>* Campos obligatorios</p>
                    </br>
                
                {if not isset($registrar_dueno_nuevo) and not isset($registrar_dueno_existente)}
                    Opcional: <input class="btn btn-primary" type="submit" name="dueno_nuevo" value="Registrar Dueño Nuevo" />
                    <input class="btn btn-primary" type="submit" name="dueno_existente" value="Registrar Dueño Existente" />
                    <input type="hidden" name="flag" value="sin_dueno">
                {/if}
                
                <br/>
                <br/>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                
                <input class="btn btn-primary" name="cancelar" type="submit" value="Cancelar" />
                
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                
                <input class="btn btn-primary" name="registrar" type="submit" value="Registrar"/>
                </td>
            </tr>
        </table>
    </form> 
</br>  

    <br/>

</div>

