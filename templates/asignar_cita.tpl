<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/vetsoft.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
</head>
<body>
    <header>
    </header>
    <div>
        <b>PACIENTE: {$nombre_animal}</b><br/>
        <b>Por favor ingrese los datos de la cita:</b><br/>
    </div>
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        {if $tipo eq "administrador"}
            <form class="form-horizontal" action="{$gvar.l_global}asignar_cita.php?option=asignar_por_administrador" method="post">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Veterinario*</h4>
                        <select name="veterinario" class="form-control default_color" {if isset($vet_c_vacio) or isset($vet_c_invalido)} style="background-color: #F78181" {/if}>
                            <option value="seleccion">Seleccion</option>
                        {section loop=$objeto name=i}
                            <option value="{$objeto[i]->get('identificacion')}">{$objeto[i]->get('identificacion')} - {$objeto[i]->get('nombre')}</option>
                        {/section} 
                        </select> 
                    </div>
                </div> 
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Motivo*</h4>
                        <input type="text" {if isset($motivo_c)}value="{$motivo_c}"{/if} {if isset($motivo_c_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" name="motivo" placeholder="Razón de la cita">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-2">
                        <h4>Fecha*</h4>
                        <input type="text" {if isset($fecha_c)}value="{$fecha_c}"{/if} {if isset($fecha_c_vacio) or isset($fecha_c_invalido)} style="background-color: #F78181" {/if} class="form-control default_color" name="fecha" placeholder="YYY-mm-dd">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-2">
                        <h4>Hora* (24 hrs)</h4>
                        <input type="text" {if isset($hora_c)}value="{$hora_c}"{/if} {if isset($hora_c_vacio) or isset($hora_c_invalido)} style="background-color: #F78181" {/if} class="form-control default_color" name="hora" placeholder="HH:MM">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Lugar*</h4>
                        <input type="text" {if isset($lugar_c)}value="{$lugar_c}"{/if} {if isset($lugar_c_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" name="lugar" placeholder="Lugar de la cita">
                    </div>
                </div>
            </br>
            <div class="col-sm-offset-3 col-sm-6">
                * Campos obligatorios.
            </div>
            </br>
            </br>
                <input type="hidden" name="nombre" value="{$nombre_animal}">
                <input type="hidden" name="id" value="{$id_animal}">
                <div class="col-sm-offset-5 col-sm-6">              
                    <button class="btn btn-default" type="submit"><span class="fa fa-check"></span> Asignar</button>
                    <a href="{$gvar.l_global}asignar_cita.php?option=cancelar" class="btn btn-default" role="button"><span class="fa fa-close"></span> Cancelar</a>
                </div>
            </form>
        {/if}
        {if $tipo eq "veterinario"}
            <form class="form-horizontal" action="{$gvar.l_global}asignar_cita.php?option=asignar_por_veterinario" method="post">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Motivo*</h4>
                        <input type="text" {if isset($motivo_c)}value="{$motivo_c}"{/if} {if isset($motivo_c_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" name="motivo" placeholder="Razón de la cita">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-2">
                        <h4>Fecha*</h4>
                        <input type="text" {if isset($fecha_c)}value="{$fecha_c}"{/if} {if isset($fecha_c_vacio) or isset($fecha_c_invalido)} style="background-color: #F78181" {/if} class="form-control default_color" name="fecha" placeholder="YYY-mm-dd">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-2">
                        <h4>Hora* (24 hrs)</h4>
                        <input type="text" {if isset($hora_c)}value="{$hora_c}"{/if} {if isset($hora_c_vacio) or isset($hora_c_invalido)} style="background-color: #F78181" {/if} class="form-control default_color" name="hora" placeholder="HH:MM">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Lugar*</h4>
                        <input type="text" {if isset($lugar_c)}value="{$lugar_c}"{/if} {if isset($lugar_c_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" name="lugar" placeholder="Lugar de la cita">
                    </div>
                </div>
            </br>
            <div class="col-sm-offset-3 col-sm-6">
                * Campos obligatorios.
            </div>
            </br>
            </br>
                <input type="hidden" name="nombre" value="{$nombre_animal}">
                <input type="hidden" name="id" value="{$id_animal}">
                <div class="col-sm-offset-5 col-sm-6">              
                    <button class="btn btn-default" type="submit"><span class="fa fa-check"></span> Asignar</button>
                    <a href="{$gvar.l_global}asignar_cita.php?option=cancelar" class="btn btn-default" role="button"><span class="fa fa-close"></span> Cancelar</a>
                </div>
            </form>
        {/if}
        </div>
    </div>
    <script type="text/javascript">
        $(".default_color").focus(function(){
            $(this).attr("style","");
        });
    </script>
</body>
</html>

