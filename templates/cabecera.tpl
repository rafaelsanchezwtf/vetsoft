<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{$gvar.l_global}pata.ico" />
    <title>{$title}</title>
    {literal} 
    <style type="text/css"> @import url({/literal}{$gvar.l_global}{literal}css/bootstrap3.min.css); </style>
    <style type="text/css"> @import url({/literal}{$gvar.l_global}{literal}css/font-awesome.min.css); </style>
    <style type="text/css"> @import url({/literal}{$gvar.l_global}{literal}css/vetsoft.css); </style> 
    <style type="text/css"> @import url({/literal}{$gvar.l_global}{literal}css/jquery-ui.min.css); </style> 
    <style type="text/css"> @import url({/literal}{$gvar.l_global}{literal}css/jquery-ui.structure.min.css); </style> 
    <style type="text/css"> @import url({/literal}{$gvar.l_global}{literal}css/jquery-ui.theme.min.css); </style> 
    <script type='text/javascript'>l_global = '{/literal}{$gvar.l_global}{literal}';</script>
    <script src="{/literal}{$gvar.l_global}{literal}js/jquery.min.js" language="Javascript"></script>
    <script src="{/literal}{$gvar.l_global}{literal}js/jquery-ui.min.js" language="Javascript"></script>
    <script src="{/literal}{$gvar.l_global}{literal}js/bootstrap3.min.js" language="Javascript"></script>
      <script>
      $(function() {
          

        $( "#datepicker" ).datepicker({
  dateFormat: "yy-mm-dd"
});
      });
     </script>
    {/literal}
</head>
<body>
 
   <nav class="navbar navbar-default no-margin">
    
                <div class="navbar-header fixed-brand">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"  id="menu-toggle">
                      <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
                    </button>
                    <a class="navbar-brand" href="{$gvar.l_global}index.php">
                    
                    <i class="fa fa-paw fa-4"></i> VETSOFT

                    
                    </a>
                </div>
 
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active" ><button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></button></li>
                            </ul>
                </div>
    </nav>
    

    <div id="wrapper">
         <!-- Barra Lateral -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
               
               {if $tipo eq "administrador" or $tipo eq "veterinario"}
                <li>
                    <a href="{$gvar.l_global}login.php?option=logout"><span class="fa-stack fa-lg pull-left"><i class="fa fa-power-off fa-stack-1x "></i></span>Cerrar Sesión</a>
                </li>
            
                {if $tipo eq "administrador"}
                <li>
                    <a href="{$gvar.l_global}perfil_administrador.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-bars fa-stack-1x "></i></span>Mi Perfil</a>
                </li>
                {/if}
                {if $tipo eq "veterinario"}
                <li>
                    <a href="{$gvar.l_global}perfil_veterinario.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-bars fa-stack-1x "></i></span>Mi Perfil</a>
                </li>
                {/if}
               
            {else}
                <li>
                    <a href="{$gvar.l_global}login.php?login"><span class="fa-stack fa-lg pull-left"><i class="fa fa-circle-o-notch fa-stack-1x "></i></span>Iniciar Sesión</a>
                </li>
            {/if}
                
            {if (not isset($tipo))}
                <li>
                    <a href="{$gvar.l_global}historia_clinica.php"> <span class="fa-stack fa-lg pull-left"><i class="fa fa-heartbeat fa-stack-1x "></i></span>Ver historia clínica</a>
                </li>
            
                <li>
                      <a href="{$gvar.l_global}acerca_de.php"> <span class="fa-stack fa-lg pull-left"><i class="fa fa-info-circle fa-stack-1x "></i></span>Acerca De</a>  
                </li>
            {/if}
               
            </ul>
            
        </div>
        
         <!-- Contenido de la página -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        
                        
                