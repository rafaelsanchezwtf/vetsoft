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
        <b>RESULTADOS DE LA CITA</b><br/><br/>
        PACIENTE: {$mi_cita->auxiliars['nombre_animal']}<br/>
        Fecha: {$mi_cita->get('fecha')}<br/>
        Hora: {$mi_cita->get('hora')}<br/>
        Motivo: {$mi_cita->get('motivo')}<br/>
    </div>
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form class="form-horizontal" action="{$gvar.l_global}atender_cita.php?option=finalizar" method="post">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Condicion*</h4>
                        <input type="text" id="condicion1" {if isset($condicion_c)}value="{$condicion_c}"{/if} {if isset($condicion_c_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" name="condicion" onkeyup="cambio1()" placeholder="Estado del paciente antes de la cita">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <h4>Diagnostico*</h4>
                        <input type="text" id="diagnostico1" {if isset($diagnostico_c)}value="{$diagnostico_c}"{/if} {if isset($diagnostico_c_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" onkeyup="cambio2()" name="diagnostico" placeholder="Observacion y/o valoración del veterinario">
                    </div>
                </div>
            </br>
            <div class="col-sm-offset-3 col-sm-6">
                * Campos obligatorios.
            </div>
            <br/>
                <input type="hidden" name="codigo" value="{$mi_cita->get('codigo')}">
                <div class="col-sm-offset-5 col-sm-6">              
                    <button class="btn btn-default" type="submit"><span class="fa fa-check"></span> Finalizar</button>
                    <a href="{$gvar.l_global}atender_cita.php?option=cancelar" class="btn btn-default" role="button"><span class="fa fa-close"></span> Cancelar</a>
                </div>
            </form>
        <br/>
        <br/>
        <br/>
            <div class="col-sm-offset-5 col-sm-3">    
                <form class="form-horizontal" action="{$gvar.l_global}atender_cita.php?option=finalizar" method="post">
                    <input type="hidden" name="flagncita">
                    <input type="hidden" id="condicion2" name="condicion">
                    <input type="hidden" id="diagnostico2" name="diagnostico">
                    <input type="hidden" name="codigo" value="{$mi_cita->get('codigo')}">
                    <button class="btn btn-default" type="submit"><span class="fa fa-check"></span> Finalizar y asignar nueva Cita</button>
                </form>
            </div>
        <br/>
        <br/>
            <div class="col-sm-offset-5 col-sm-4">
                <form class="form-horizontal" action="{$gvar.l_global}atender_cita.php?option=finalizar" method="post">
                    <input type="hidden" name="flagntratamiento">
                    <input type="hidden" id="condicion2" name="condicion">
                    <input type="hidden" id="diagnostico2" name="diagnostico">
                    <input type="hidden" name="codigo" value="{$mi_cita->get('codigo')}">
                    <button class="btn btn-default" type="submit"><span class="fa fa-check"></span> Finalizar y asignar nuevo Tratamiento</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".default_color").focus(function(){
            $(this).attr("style","");
        });
    </script>
    <script type="text/javascript">
        function cambio1(){
        document.getElementById("condicion2").value=document.getElementById("condicion1").value}
    </script>
    <script type="text/javascript">
        function cambio2(){
        document.getElementById("diagnostico2").value=document.getElementById("diagnostico1").value}
    </script>
</body>
</html>

