<div>
    <b>Por favor ingrese los datos del animal</b><br /><br />
</div>
<div class="col-sm-offset-3 col-sm-10">
    <form action="{$gvar.l_global}registrar_.php" method="post">
        <table width="100%" border="0" cellpadding="0" cellspacing="5">
            <tr>
                <td>
                    
                    <b>Nombre:</b> <input class="input" type="text" required name="nombre"/>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <b>Fecha de nacimiento:</b> <input type="date" size="5" required name="fecha_de_nacimiento"/></br></br>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Talla:</b> <input  type="text" size="5" required name="talla"/><b>cm</b>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <b>Peso:</b> <input  type="text" size="5" required name="peso"/><b>kg</b>
                    </br></br>
                    <b>Género:</b> <input  type="text" required name="genero"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <b>Especie:</b> <input  type="text"required name="especie"/>
                    </br></br>
                    <b>Fotografia:</b></br> <input type="file" name="foto" />
                </br>
                    <input class="btn btn-primary" type="submit" value="Registrar"/>
                </td>
            </tr>
        </table>
    </form> 
</br>
    <form action="{$gvar.l_global}index.php" method="post">
        <input class="btn btn-primary" type="submit" value="Cancelar" />
    </form>
    <br/>
    <form action="{$gvar.l_global}registrar_dueno.php?" method="post">
        <input class="btn btn-primary" type="submit" value="Registrar Dueño" />
    </form>  
</div>

