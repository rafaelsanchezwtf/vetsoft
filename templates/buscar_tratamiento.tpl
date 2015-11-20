<div class="container">
<section class="main row">                   
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"  style="margin-top: 10px;">
                <form class="form-horizontal" method="post" action="{$gvar.l_global}buscar_tratamiento.php?option=buscar">
                    <div class="form-group">
                        <h3 align="center"><b>Ingrese un valor en el campo de busqueda</b></h3>
                        <div class="col-sm-offset-4 col-sm-4">
                            
                            <input {if isset($error1)} style="background-color: #F78181" {/if} {if isset($error2)} style="background-color: #F78181" {/if} title="Ingrese un valor numérico." type="text" class="form-control default_color" name="codigo" placeholder="Campo de busqueda"/>
                        </div>
                    </div>
                        <h4 align="center">Criterio de busqueda</h4>
        
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <label class="radio-inline"><input type="radio" name="optradio" value="c">Codigo</label>
                            <label class="radio-inline"><input type="radio" name="optradio" value="t">Titulo</label>
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
    {if isset($tratamiento)}
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr class="info">
                        <th>Código</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Lugar</th>
                        <th>Estado</th>
                        <th>Paciente</th>
                        <th>Duracion</th>
                        <th>Resultado</th>
                        <th>Atender</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    {for $j=0 to count($tratamiento)-1}
                    <tr>
                            <td>{$tratamiento[$j]->get("codigo")}</td>
                            <td>{$tratamiento[$j]->get("titulo")}</td>
                            <td>{$tratamiento[$j]->get("descripcion")}</td>
                            <td>{$tratamiento[$j]->get("fecha")}</dh>
                            <td>{$tratamiento[$j]->get("hora")}</td>
                            <td>{$tratamiento[$j]->get("lugar")}</td>
                            <td>{$tratamiento[$j]->get("estado")}</td>
                            <td>{$tratamiento[$j]->get("animal")}</td>
                            <td>{$tratamiento[$j]->get("duracion")}</td>
                            <td>{$tratamiento[$j]->get("especie")}</td>
                         
                        <form action="{$gvar.l_global}atender_tratamiento.php" method="post">    
                            <input type="hidden" name="codigo" value="{$tratamiento[$j]->get('codigo')}">
                            <input type="hidden" name="titulo" value="{$tratamiento[$j]->get('titulo')}">
                            <input type="hidden" name="fecha" value="{$tratamiento[$j]->get('fecha')}">
                            <input type="hidden" name="hora" value="{$tratamiento[$j]->get('hora')}">
                            <input type="hidden" name="descripcion" value="{$tratamiento[$j]->get('animal')}">

                            <td><button {if $tratamiento[$j]->get('estado') eq "finalizado"} disabled="disabled" {/if} type ="submit" class="btn btn-primary"><span class="fa fa-edit"></span> Atender</button></td>
                        </form>
                        
                        <form action="{$gvar.l_global}editar_tratamiento.php" method="post">    
                            <input type="hidden" name="codigo" value="{$tratamiento[$j]->get('codigo')}">
                            <input type="hidden" name="titulo" value="{$tratamiento[$j]->get('titulo')}">
                            <input type="hidden" name="descripcion" value="{$tratamiento[$j]->get('descripcion')}">
                            <input type="hidden" name="fecha" value="{$tratamiento[$j]->get('fecha')}">
                            <input type="hidden" name="hora" value="{$tratamiento[$j]->get('hora')}">
                            <input type="hidden" name="lugar" value="{$tratamiento[$j]->get('lugar')}">
                            <input type="hidden" name="animal" value="{$tratamiento[$j]->get('animal')}">

                            <td><button {if $tratamiento[$j]->get('estado') eq "finalizado"} disabled="disabled" {/if} type ="submit" class="btn btn-primary"><span class="fa fa-stethoscope"></span> Editar</button></td>
                        </form>
                        
                        <form action="{$gvar.l_global}eliminar_tratamiento.php" method="post">    
                            <input type="hidden" name="codigo" value="{$tratamiento[$j]->get('codigo')}">

                            <td><button {if $tratamiento[$j]->get('estado') eq "finalizado"} disabled="disabled" {/if} type ="submit" class="btn btn-primary"><span class="fa fa-medkit"></span> Eliminar</button></td>
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