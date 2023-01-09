<div id="login_page">
    <div class="login_container">
        <form action="<?php echo url_for('@connect') ?>" method="post">
            <fieldset>
                <label class="block clearfix">
                    <span class="block input-icon input-icon-right">
                        <input class="form-control" placeholder="Login" name="login" />
                        <i class="ace-icon fa fa-user"></i>
                    </span>
                </label>
                <label class="block clearfix">
                    <span class="block input-icon input-icon-right">
                        <input class="form-control" placeholder="Mot de passe" name="password" type="password" value="" />
                        <i class="ace-icon fa fa-lock"></i>
                    </span>
                </label>
                <div class="space"></div>
                <button type="submit" class="width-35 pull-right btn btn-sm btn-primary" >
                    <i class="ace-icon fa fa-key"></i>
                    <span class="bigger-110">Connecter</span>
                </button>
            </fieldset>
        </form>
    </div>
</div>