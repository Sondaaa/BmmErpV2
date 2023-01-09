<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_analytique = $user->getProfilApplication("Unité Comptabilité Analytique"); ?>
                <?php if ($acces_analytique): ?>
                    <ul class="nav nav-list">
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cog"></i>
                                <span class="menu-text"> Paramétres Global </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_analytique->getId(), "Paramètre : Exercice Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('@exercice') ?>">Exercice Comptable</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_analytique->getId(), "Paramètre : Service (Rapport)")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typerapport') ?>">Service (Rapport)</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li>
                            <a id="id-btn-dialog1" onclick="showModal()">
                                <i class="menu-icon fa fa-refresh"></i>
                                <span class="menu-text">
                                    Exercice Courant
                                </span>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->