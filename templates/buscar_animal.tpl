<section class="main row">         
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" action="{$gvar.l_global}buscar_animal.php?option=buscar" style="margin-top: 10px;">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-4">
                            <h3 align="center">Ingrese el código del animal.</h3>
                            <input {if isset($error2)} style="background-color: #F78181" {/if} {if isset($error1)} style="background-color: #F78181" {/if}title="Ingrese un valor numérico." class="form-control" name="codigo" placeholder="Código"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-4">
                            <button type="submit" class="btn btn-primary">Buscar Animal</button>
                        </div>
                    </div>
                </form>
            </div>
</section>