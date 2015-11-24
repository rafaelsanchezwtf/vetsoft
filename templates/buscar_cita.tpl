<div class="container">
<section class="main row">                   
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"  style="margin-top: 10px;">
                <form class="form-horizontal" method="post" action="{$gvar.l_global}buscar_cita.php?option=buscar">
                    <div class="form-group">
                        <h3 align="center"><b>Ingrese un valor en el campo de busqueda</b></h3>
                        <div class="col-sm-offset-4 col-sm-4">
                            
                            <input {if isset($error1)} style="background-color: #F78181" {/if} {if isset($error2)} style="background-color: #F78181" {/if} title="Ingrese un valor numérico." type="text" class="form-control default_color" name="codigo" placeholder="Campo de busqueda"/>
                        </div>
                    </div>
                        <h4 align="center">Criterio de busqueda</h4>
        
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <label class="radio-inline"><input type="radio" name="optradio" value="c">Código</label>
                            <label class="radio-inline"><input type="radio" name="optradio" value="m">Motivo</label> 
                            <label class="radio-inline"><input type="radio" name="optradio" value="f">Fecha</label>                            
                            <label class="radio-inline"><input type="radio" name="optradio" value="h">Hora (HH:mm 24 hrs)</label>
                            <label class="radio-inline"><input type="radio" name="optradio" value="a">Animal (nombre)</label>
                            
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
    {if isset($cita)}
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr class="info">
                        <th>Código</th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Lugar</th>
                        <th>Estado</th>
                        <th>Paciente</th>
                        <th>Condición</th>
                        <th>Diagnóstico</th>
                        <th>Atender</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    {for $j=0 to count($cita)-1}
                    <tr>
                            <td>{$cita[$j]->get("codigo")}</td>
                            <td>{$cita[$j]->get("motivo")}</td>
                            <td>{$cita[$j]->get("fecha")}</dh>
                            <td>{$cita[$j]->get("hora")}</td>
                            <td>{$cita[$j]->get("lugar")}</td>
                            <td>{$cita[$j]->get("estado")}</td>
                            <td>{$cita[$j]->get("animal")} - {$cita[$j]->auxiliars['nombre_animal']}</td>
                            <td>{$cita[$j]->get("condicion")}</td>
                            <td>{$cita[$j]->get("diagnostico")}</td>
                            
                        
                           
                        <form action="{$gvar.l_global}atender_cita.php" method="post">    
                            <input type="hidden" name="codigo" value="{$cita[$j]->get('codigo')}">
                            <input type="hidden" name="motivo" value="{$cita[$j]->get('motivo')}">
                            <input type="hidden" name="fecha" value="{$cita[$j]->get('fecha')}">                            
                            <input type="hidden" name="hora" value="{$cita[$j]->get('hora')}">
                            <input type="hidden" name="animal" value="{$cita[$j]->get('animal')}">
                            <!--No borrar en el merge-->
                            <input type="hidden" name="veterinario" value="{$cita[$j]->get('veterinario')}">
                            <td><button {if $cita[$j]->get('estado') eq "finalizado"} disabled="disabled" {/if} type ="submit" class="btn btn-primary"><span class="fa fa-stethoscope"></span> Atender</button></td>
                        </form>
                        
                        
                       
                        <form action="{$gvar.l_global}editar_cita.php" method="post">    
                            <input type="hidden" name="codigo" value="{$cita[$j]->get('codigo')}">
                            <input type="hidden" name="motivo" value="{$cita[$j]->get('motivo')}">
                            <input type="hidden" name="fecha" value="{$cita[$j]->get('fecha')}">
                            <input type="hidden" name="hora" value="{$cita[$j]->get('hora')}">
                            <input type="hidden" name="lugar" value="{$cita[$j]->get('lugar')}">
                            <input type="hidden" name="animal" value="{$cita[$j]->get('animal')}">
                            <input type="hidden" name="veterinario" value="{$cita[$j]->get('veterinario')}">
 

                            <td><button {if $cita[$j]->get('estado') eq "finalizado"} disabled="disabled" {/if} type ="submit" class="btn btn-primary"><span class="fa fa-edit"></span> Editar</button></td>
                        </form>
                        
                        
                        
                        <form action="{$gvar.l_global}eliminar_cita.php" method="post">    
                            <input type="hidden" name="codigo" value="{$cita[$j]->get('codigo')}">
                            <td><button {if $cita[$j]->get('estado') eq "finalizado"} disabled="disabled" {/if} type ="submit" class="btn btn-primary"><span class="fa fa-close"></span> Eliminar</button></td>
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