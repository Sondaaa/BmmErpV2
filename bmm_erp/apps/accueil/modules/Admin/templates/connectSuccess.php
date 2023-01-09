<div id="login_page">
    <div class="login_container">
        <form autocomplete="off" class="form-row mt-4" action="<?php echo url_for('@connect') ?>" method="post">
            <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                    <input placeholder="Login" type="text" class="form-control form-control-lg pr-4 shadow-none" id="id-login-username" name="login"/>
                    <i class="fa fa-user text-grey-m2 ml-n4"></i>
                    <label class="floating-label text-grey-l1 ml-n3" for="id-login-username">
                        Login
                    </label>
                </div>
            </div>


            <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2 mt-md-1">
                <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                    <input  type="password" placeholder="Mot de passe" name="password" class="form-control form-control-lg pr-4 shadow-none" id="id-login-password" />
                    <i class="fa fa-key text-grey-m2 ml-n4"></i>
                    <label class="floating-label text-grey-l1 ml-n3" for="id-login-password">
                        Password
                    </label>
                </div>
            </div>


            


            <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
               
                <button type="submit" class="btn btn-primary btn-block px-4 btn-bold mt-2 mb-4">
                Connecter
                </button>
            </div>
        </form>
       
    </div>
</div>