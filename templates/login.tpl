<title>{$title}</title>
<script language="JavaScript" src="js/form.js" type="text/javascript"></script>
<section class="main row" >
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 panellogin">
        <div class="centrardiv">
            <img src="images/login_huella.png" width="15%" height="15%"/>
        </div>
        <br/><br/>
        <form class="form-horizontal" action="{$gvar.l_global}login.php?option=login" method="post">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-4">
                    <input  {if isset($error1)} style="background-color: #F78181" {/if} type="text" name="user" class="form-control default_color" id="inputText3" placeholder="Usuario"/>
                </div>
            </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-4">
                        <input {if isset($error2)} style="background: #F78181" {/if}  type="password" name="pass" class="form-control default_color" id="inputPassword3" placeholder="Contraseña"/>
                    </div>
                </div>
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-4">
                    <input type="submit" class="btn btn-primary" value="Iniciar Sesión"/>
                </div>
            </div>
        </form>
    </div>
</section>
<script type="text/javascript">
    $(".default_color").focus(function(){
        $(this).attr("style","");
    });
</script>

