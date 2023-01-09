
<div id="login_page">
    <div class="login_container">

        <form action="<?php echo url_for('@connect') ?>" method="get">
            <fieldset>
                <div class="form-group">
                    <input class="form-control" placeholder="Login" name="login"  autofocus>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Mot de passe" name="password" type="password" value="">
                </div>
                <input type="submit" class="btn btn-lg btn-success btn-block" style="background-color: #006ea6 !important;border-color: #006ea6" value="Connect">
            </fieldset>

        </form>
    </div>
</div>