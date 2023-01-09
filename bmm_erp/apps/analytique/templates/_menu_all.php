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
                                <i class="menu-icon fa fa-cog "></i>
                                <span class="menu-text"> Paramétres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_analytique->getId(), "Paramètre : Exercice Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('@exercice') ?>">Exercice Comptable</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_analytique->getId(), "Paramètre : Service (Rapport)")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typerapport') ?>">Service (Rapport)</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-keyboard-o"></i>
                                <span class="menu-text"> Saisie de Données </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li class="hover">
                                    <a class="dropdown-toggle" href="#">
                                        <i class="menu-icon fa fa-keyboard-o"></i>
                                        <span class="menu-text"> Répartition Mensuelle </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModuleAction($acces_analytique->getId(), "Répartition Mensuelle", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('repartitionsalaireouvrier/new') ?>">Ajouter Répartition</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_analytique->getId(), "Répartition Mensuelle")) echo 'disabledbutton' ?>" href="<?php echo url_for('@repartitionsalaireouvrier') ?>">Liste des Répartitions</a></li>
                                    </ul>
                                </li>
                                <li class="hover">
                                    <a class="dropdown-toggle" href="#">
                                        <i class="menu-icon fa fa-keyboard-o"></i>
                                        <span class="menu-text"> Rapport des Travaux </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModuleAction($acces_analytique->getId(), "Rapport des Travaux", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('rapporttravaux/new') ?>">Ajouter Rapport</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_analytique->getId(), "Rapport des Travaux")) echo 'disabledbutton' ?>" href="<?php echo url_for('@rapporttravaux') ?>">Liste des Rapports</a></li>
                                    </ul>
                                </li>
                                <li class="hover">
                                    <a class="dropdown-toggle" href="#">
                                        <i class="menu-icon fa fa-keyboard-o"></i>
                                        <span class="menu-text"> Génération Comptable (Frais Généraux) </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModuleAction($acces_analytique->getId(), "Génération Comptable (Fraix Généraux)", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('fraisgeneraux/new') ?>">Ajouter Rapport</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_analytique->getId(), "Génération Comptable (Fraix Généraux)")) echo 'disabledbutton' ?>" href="<?php echo url_for('@fraisgeneraux') ?>">Liste des Rapports</a></li>
                                    </ul>
                                </li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_analytique->getId(), "Charge Directe")) echo 'disabledbutton' ?>" href="<?php echo url_for('rapporttravaux/chargeDirecte') ?>">Charges Directes</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-sitemap"></i>
                                <span class="menu-text"> Répartition des Charges </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModuleAction($acces_analytique->getId(), "Répartition Mensuelle", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('repartitioncharge/new') ?>">Ajouter Répartition</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_analytique->getId(), "Répartition Mensuelle")) echo 'disabledbutton' ?>" href="<?php echo url_for('@repartitioncharge') ?>">Liste des Répartitions</a></li>
                            </ul>
                        </li>
                        <li>
                            <a id="id-btn-dialog1" onclick="showModal()">
                                <i class="menu-icon fa fa-refresh"></i>
                                <span class="menu-text">
                                    Changer Exercice
                                </span>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->