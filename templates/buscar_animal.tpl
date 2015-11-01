<div class="container">
<section class="main row">         
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"  style="margin-top: 10px;">
                <form class="form-horizontal" method="post" action="{$gvar.l_global}buscar_animal.php?option=buscar">
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-4">
                            <h3 align="center">Ingrese el código del animal.</h3>
                            <input {if isset($error1)} style="background-color: #F78181" {/if} {if isset($error2)} style="background-color: #F78181" {/if} title="Ingrese un valor numérico." class="form-control" name="codigo" placeholder="Código"/>
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
    {if isset($animal)}
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr class="info">
                        <th>Id:</th>
                        <th>Nombre:</th>
                        <th>Foto:</th>
                        <th>Edad:</th>
                        <th>Peso</th>
                        <th>Talla:</th>
                        <th>Genero:</th>
                        <th>Especie</th>
                        <th>Editar</th>

                    </tr>
                    {for $j=0 to count($animal)-1}
                    <tr>
                        <td>{$animal[$j]->get("id")}</td>
                        <td>{$animal[$j]->get("nombre")}</td>
                        <td>{$animal[$j]->get("foto")}</td>
                        <td>{$animal[$j]->get("edad")}</dh>
                        <td>{$animal[$j]->get("peso")}</td>
                        <td>{$animal[$j]->get("talla")}</td>
                        <td>{$animal[$j]->get("genero")}</td>
                        <td>{$animal[$j]->get("especie")}</td>
                        <td><button class="btn btn-primary">Editar</button></td>

                    </tr>
                    {/for}
                </table>
        </div>
    {/if}

</div>