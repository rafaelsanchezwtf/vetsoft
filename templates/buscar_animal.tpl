<div class="container">
<section class="main row">                   
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"  style="margin-top: 10px;">
                <form class="form-horizontal" method="post" action="{$gvar.l_global}buscar_animal.php?option=buscar">
                    <div class="form-group">
                        <h3 align="center"><b>Ingrese un valor en el campo de busqueda</b></h3>
                        <div class="col-sm-offset-4 col-sm-4">
                            
                            <input {if isset($error1)} style="background-color: #F78181" {/if} {if isset($error2)} style="background-color: #F78181" {/if} title="Ingrese un valor numérico." type="text" class="form-control default_color" name="codigo" placeholder="Campo de busqueda"/>
                        </div>
                    </div>
                        <h4 align="center">Criterio de busqueda</h4>
        
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-5">
                            <label class="radio-inline"><input type="radio" name="optradio" value="i">Id</label>
                            <label class="radio-inline"><input type="radio" name="optradio" value="n">Nombre</label>
                            <label class="radio-inline"><input type="radio" name="optradio" value="e">Especie</label>
                            <label class="radio-inline"><input type="radio" name="optradio" value="f">Fecha de nacimiento</label>
                            
                        </div>
                    </div>
                    <div class="form-group">
                            <button type="submit" class="col-sm-offset-5 col-sm-2 btn btn-primary"><span class="fa fa-search"></span> Buscar</button>         
                    </div>
                </form>
            </div>
</section>
</div>
<div class="container">
    {if isset($animal)}
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr class="info">
                        <th>Id:</th>
                        <th>Nombre</th>
                        <th>Foto</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Peso (kg)</th>
                        <th>Talla (cm)</th>
                        <th>Genero</th>
                        <th>Especie</th>
                    {if $tipo eq "administrador"}
                        <th>Editar</th>
                    {/if}
                    {if $tipo eq "veterinario" or $tipo eq "administrador"}
                        <th>Cita</th>
                    {/if}
                    {if $tipo eq "veterinario"}
                        <th>Tratamiento</th>
                    {/if}
                    </tr>
                    {for $j=0 to count($animal)-1}
                    <tr>
                            <td>{$animal[$j]->get("id")}</td>
                            <td>{$animal[$j]->get("nombre")}</td>

                            <td><img src="{$gvar.l_global}{$animal[$j]->get('foto')}" width="50" height="70"></td>

                            <td>{$animal[$j]->get("fecha_de_nacimiento")}</dh>
                            <td>{$animal[$j]->get("peso")}</td>
                            <td>{$animal[$j]->get("talla")}</td>
                            <td>{$animal[$j]->get("genero")}</td>
                            <td>{$animal[$j]->get("especie")}</td>
                        
                        {if $tipo eq "administrador"}    
                        <form action="{$gvar.l_global}editar_animal.php" method="post">    
                            <input type="hidden" name="id" value="{$animal[$j]->get('id')}">
                            <input type="hidden" name="nombre" value="{$animal[$j]->get('nombre')}">
                            <input type="hidden" name="foto" value="{$animal[$j]->get('foto')}">
                            <input type="hidden" name="fecha_de_nacimiento" value="{$animal[$j]->get('fecha_de_nacimiento')}">
                            <input type="hidden" name="peso" value="{$animal[$j]->get('peso')}">
                            <input type="hidden" name="talla" value="{$animal[$j]->get('talla')}">
                            <input type="hidden" name="genero" value="{$animal[$j]->get('genero')}">
                            <input type="hidden" name="especie" value="{$animal[$j]->get('especie')}">
                            <input type="hidden" name="dueno" value="{$animal[$j]->get('dueno')}">

                            <td><button type ="submit" class="btn btn-primary"><span class="fa fa-edit"></span> Editar</button></td>
                        </form>
                        {/if}
                        
                        {if $tipo eq "veterinario" or $tipo eq "administrador"}
                        <form action="{$gvar.l_global}asignar_cita.php" method="post">    
                            <input type="hidden" name="id" value="{$animal[$j]->get('id')}">
                            <input type="hidden" name="nombre" value="{$animal[$j]->get('nombre')}">
                            <input type="hidden" name="foto" value="{$animal[$j]->get('foto')}">

                            <td><button type ="submit" class="btn btn-primary"><span class="fa fa-stethoscope"></span> Asignar</button></td>
                        </form>
                        {/if}
                        
                        {if $tipo eq "veterinario"}
                        <form action="{$gvar.l_global}asignar_tratamiento.php" method="post">    
                            <input type="hidden" name="id" value="{$animal[$j]->get('id')}">
                            <input type="hidden" name="nombre" value="{$animal[$j]->get('nombre')}">
                            <input type="hidden" name="foto" value="{$animal[$j]->get('foto')}">

                            <td><button type ="submit" class="btn btn-primary"><span class="fa fa-medkit"></span> Asignar</button></td>
                        </form>
                        {/if}  

                      </tr>    
                    {/for}
                </table>
        </div>
    {/if}
</div>
<script type="text/javascript">
    $(".default_color").focus(function(){
        $(this).attr("style","");
    });
</script>