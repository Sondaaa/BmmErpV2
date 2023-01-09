<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_facturation = $user->getProfilApplication("Unité Contrôle des Factures"); ?>
                <?php if ($acces_facturation): ?>
                    <ul class="nav nav-list">
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-users"></i>
                                <span class="menu-text"> Fournisseurs </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php //if (!$user->getProfilModule($acces_facturation->getId(), "Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@fournisseur') ?>">Fournisseurs</a></li>                               
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                      
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->