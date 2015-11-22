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
        <b>Resultados de la cita</b><br/>
        <b>PACIENTE: {$nombre}</b><br/>
        <b>id: {$mi_cita->get('codigo')}</b><br/>
        <b>Fecha: {$mi_cita->get('fecha')}</b><br/>
        <b>Hora: {$mi_cita->get('hora')}</b><br/>
        <b>Motivo {$mi_cita->get('motivo')}</b><br/>
    </div>
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form class="form-horizontal" action="{$gvar.l_global}atender_cita.php?option=finalizar" method="post">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Condicion*</h4>
                        <input type="text" {if isset($condicion_c)}value="{$condicion_c}"{/if} {if isset($condicion_c_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" name="condicion" placeholder="Estado del paciente antes de la cita">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-2">
                        <h4>Diagnostico*</h4>
                        <input type="text" {if isset($diagnostico_c)}value="{$diagnostico_c}"{/if} {if isset($diagnostico_c_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" name="diagnostico" placeholder="Observacion y/o valoración del veterinario">
                    </div>
                </div>
            </br>
            <div class="col-sm-offset-3 col-sm-6">
                * Campos obligatorios.
            </div>
            </br>
            </br>
                <div class="col-sm-offset-5 col-sm-6">              
                    <button class="btn btn-default" type="submit"><span class="fa fa-check"></span> Finalizar</button>
                    <a href="{$gvar.l_global}atender_cita.php?option=cancelar" class="btn btn-default" role="button"><span class="fa fa-close"></span> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(".default_color").focus(function(){
            $(this).attr("style","");
        });
    </script>
</body>
</html>

