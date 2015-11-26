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
        <b>RESULTADOS DEL TRATAMIENTO</b><br/><br/>
        PACIENTE: {$mi_tratamiento->auxiliars['nombre_animal']}<br/>
        Fecha: {$mi_tratamiento->get('fecha')}<br/>
        Hora: {$mi_tratamiento->get('hora')}<br/>
        Titulo: {$mi_tratamiento->get('titulo')}<br/>
        Descripción: {$mi_tratamiento->get('descripcion')}<br/>
    </div>
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form class="form-horizontal" action="{$gvar.l_global}completar_tratamiento.php?option=usar_producto" method="post">
                <input type="hidden" name="desde" value="tratamiento">
                <input type="hidden" name="codigo" value="{$mi_tratamiento->get('codigo')}">
                <div class="col-sm-offset-5 col-sm-6">              
                    <button class="btn btn-default" type="submit"><span class="fa fa-star"></span> Usar Producto</button>
                </div>
            </form>
            <form class="form-horizontal" action="{$gvar.l_global}completar_tratamiento.php?option=finalizar" method="post">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Duracion*</h4>
                        <input type="text" id="duracion1" {if isset($duracion_t)}value="{$duracion_t}"{/if} {if isset($duracion_t_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" name="duracion" onkeyup="cambio1()" placeholder="Duración del tratamiento">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <h4>Resultado*</h4>
                        <input type="text" id="resultado1" {if isset($resultado_t)}value="{$resultado_t}"{/if} {if isset($resultado_t_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" onkeyup="cambio2()" name="resultado" placeholder="Resultado del tratamiento">
                    </div>
                </div>
            </br>
            <div class="col-sm-offset-3 col-sm-6">
                * Campos obligatorios.
            </div>
            <br/>
                <input type="hidden" name="codigo" value="{$mi_tratamiento->get('codigo')}">
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

