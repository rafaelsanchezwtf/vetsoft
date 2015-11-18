<title>{$title}</title>
<section class="main row" >
            
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-5 panelperfil">
                <form class="form-horizontal">
                    <div class="page-header text-center titulobienvenida">
                      <h1>Bienvenido(a) {$nombre}</h1>
                    </div>
                      <div class="panel panel-default paneladmin">
                          <div class="panel-heading text-center">
                            <h3 class="panel-title">Opciones</h3>
                          </div>
                          <div class="panel-body text-center ">
                           
                            <div class="form-group">
                                <div class=" col-xs-8 col-sm-8 col-md-8 col-lg-8 parcito">
                                   <a href="{$gvar.l_global}registrar_animal_dueno.php" class="btn btn-default opcion" role="button">Registrar animal</a>
                                    <a href="{$gvar.l_global}contratar_veterinario.php" class="btn btn-default opcion" role="button">Contratar Veterinario</a>
                                </div>
                                <div class=" col-xs-8 col-sm-8 col-md-8 col-lg-8 parcito">
                                    <a href="{$gvar.l_global}adquirir_producto.php" class="btn btn-default opcion" role="button">Adquirir Producto</a>
                                    <a href="{$gvar.l_global}buscar_animal.php" class="btn btn-default opcion" role="button">Buscar Animal</a>
                                    <a href="{$gvar.l_global}buscar_producto.php" class="btn btn-default opcion" role="button">Buscar Producto</a>
                                </div>
                                <div class=" col-xs-8 col-sm-8 col-md-8 col-lg-8  parcito">
                                    <a href="{$gvar.l_global}buscar_veterinario.php" class="btn btn-default opcion" role="button">Buscar Veterinario</a>
                                    <a href="{$gvar.l_global}historia_clinica.php" class="btn btn-default opcion" role="button">Ver Historia Clinica</a>
                                </div>
                            </div>
                          </div>
                    </div> 
                </form>
            </div>
        </section>