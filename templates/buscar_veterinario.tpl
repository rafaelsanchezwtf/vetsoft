<div class="container">
<section class="main row">                   
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"  style="margin-top: 10px;">
                <form class="form-horizontal" method="post" action="{$gvar.l_global}buscar_veterinario.php?option=buscar">
                    <div class="form-group">
                        <h3 align="center"><b>Ingrese un valor en el campo de busqueda</b></h3>
                        <div class="col-sm-offset-4 col-sm-4">
                            
                            <input {if isset($error1)} style="background-color: #F78181" {/if} {if isset($error2)} style="background-color: #F78181" {/if} title="Ingrese un valor numérico." type="text" class="form-control default_color" name="codigo" placeholder="Campo de busqueda"/>
                        </div>
                    </div>
                        <h4 align="center">Criterio de busqueda</h4>
        
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-6">
                            <label class="radio-inline"><input type="radio" name="optradio" value="n">Nombre</label>
                            <label class="radio-inline"><input type="radio" name="optradio" value="i">Identificación</label> 
                            <label class="radio-inline"><input type="radio" name="optradio" value="t">Teléfono</label>                            
                            <label class="radio-inline"><input type="radio" name="optradio" value="e">email</label>
                            <label class="radio-inline"><input type="radio" name="optradio" value="u">User</label>
                            
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
    {if isset($veterinarios)}
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr class="info">
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Sueldo</th>
                        <th>User</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        
                    </tr>
                    {for $j=0 to count($veterinarios)-1}
                    <tr>
                            <td>{$veterinarios[$j]->get("identificacion")}</td>
                            <td>{$veterinarios[$j]->get("nombre")}</td>
                            <td>{$veterinarios[$j]->get("telefono")}</dh>
                            <td>{$veterinarios[$j]->get("email")}</td>
                            <td>{$veterinarios[$j]->get("sueldo")}</td>
                            <td>{$veterinarios[$j]->get("user")}</td>
                       
                        <form action="{$gvar.l_global}editar_veterinario.php" method="post">    
                            <input type="hidden" name="identificacion" value="{$veterinarios[$j]->get('identificacion')}">
                            <input type="hidden" name="nombre" value="{$veterinarios[$j]->get('nombre')}">
                            <input type="hidden" name="telefono" value="{$veterinarios[$j]->get('telefono')}">
                            <input type="hidden" name="email" value="{$veterinarios[$j]->get('email')}">
                            <input type="hidden" name="sueldo" value="{$veterinarios[$j]->get('sueldo')}">
                            
 

                            <td><button type ="submit" class="btn btn-primary"><span class="fa fa-edit"></span> Editar</button></td>
                        </form>
                        
                        
                        
                        <form action="{$gvar.l_global}eliminar_veterinario.php" method="post">    
                            <input type="hidden" name="codigo" value="{$veterinarios[$j]->get('identificacion')}">
                            <td><button type ="submit" class="btn btn-primary"><span class="fa fa-close"></span> Eliminar</button></td>
                        </form>
                         

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