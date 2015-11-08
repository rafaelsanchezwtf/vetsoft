<div>
    <b>Por favor ingrese los datos del animal</b><br /><br />
</div>
<div class="col-sm-offset-2 col-sm-10">
    <form action="{$gvar.l_global}registrar_animal.php" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" cellpadding="50" cellspacing="50">
            <tr>
                <td>
                    
                    <b>Nombre:</b> <input {if isset($nombre_vacio)} style="background-color: #F78181" {/if} type="text" name="nombre" {if isset($nombre_animal)} value="{$nombre_animal}" {/if}/>

                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                    <b>Fecha de nacimiento:</b> <input {if isset($fecha_de_nacimiento)}value="{$fecha_de_nacimiento}"{/if} {if isset($fecha_vacio) or isset($fecha_invalido)} style="background-color: #F78181" {/if} {if isset($fecha_invalido)} value="" {/if} type="date" size="5" name="fecha_de_nacimiento"/></br></br>

                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                    <b>Talla:</b> <input {if isset($talla)}value="{$talla}"{/if} {if isset($talla_vacio) or isset($talla_invalido)} style="background-color: #F78181" {/if}  {if isset($talla_invalido)} value="" {/if} type="text" size="5" name="talla"/><b>cm</b>

                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    
                    <b>Peso:</b> <input {if isset($peso)}value="{$peso}"{/if} {if isset($peso_vacio) or isset($peso_invalido)} style="background-color: #F78181" {/if} {if isset($peso_invalido)} value="" {/if} type="text" size="5" name="peso"/><b>kg</b>
                    
                    </br></br>
                    
                    <b>Género:</b> <input {if isset($genero)}value="{$genero}"{/if} {if isset($genero_vacio)} style="background-color: #F78181" {/if} type="text" name="genero" />

                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    
                    <b>Especie:</b> <input {if isset($especie)}value="{$especie}"{/if} {if isset($especie_vacio)} style="background-color: #F78181" {/if} type="text" name="especie"/>
                    
                    </br></br>
                    
                    <b>Fotografia:</b></br> 
                    <input type="file" name="foto" id="foto" onchange="PreviewImage();"/>

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
    {if $dueno eq ""}
        <form action="{$gvar.l_global}registrar_dueno.php?" method="post">
            <input class="btn btn-primary" type="submit" value="Registrar Dueño" />
        </form> 
    {/if} 

</div>

