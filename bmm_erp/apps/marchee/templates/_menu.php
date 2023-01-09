<?php use_helper('I18N') ?>
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_marche = $user->getProfilApplication("Unité Marchés"); ?>
               
                <?php if ($acces_marche) : ?>
                    <ul class="nav nav-list">
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cog "></i>
                                <span class="menu-text"> Paramètres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Nature du Marchés")) echo 'disabledbutton' ?>" href="<?php echo url_for('@naturemarche') ?>">Nature du Marché</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Procédure de Passation")) echo 'disabledbutton' ?>" href="<?php echo url_for('@procedurepassation') ?>">Procédure de Passation</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Unités de Mesure")) echo 'disabledbutton' ?>" href="<?php echo url_for('@unitemarche') ?>">Unités de Mesures</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Unités de Mesure")) echo 'disabledbutton' ?>" href="<?php echo url_for('@methode_conclusion') ?>">
                                        <?php echo __('Methode de conclusion', null, 'marchee') ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Unités de Mesure")) echo 'disabledbutton' ?>" href="<?php echo url_for('@procedure_marche') ?>">
                                        <?php echo __('Procedure marches', null, 'marchee') ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Unités de Mesure")) echo 'disabledbutton' ?>" href="<?php echo url_for('@source_marcheprevesionelle') ?>">
                                        <?php echo __('Sources du marches', null, 'marchee') ?>
                                    </a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>

                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-users"></i>
                                <span class="menu-text"> Fournisseurs </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@fournisseur') ?>">Fournisseurs</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Famille Article/Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@familleartfrs') ?>">Famille Art/Frs</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Activité Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@activitetiers') ?>">Activité Fournisseur</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Réclamation Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@reclamationfrs') ?>">Réclamation Fournisseur</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-hourglass-start"></i>
                                <span class="menu-text"> Marches prévisionnelle </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Unités de Mesure")) echo 'disabledbutton' ?>" href="<?php echo url_for('marche_prevesionelle/new') ?>">Nouvelle fiche du marches prévisionnelle</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Unités de Mesure")) echo 'disabledbutton' ?>" href="<?php echo url_for('@marche_prevesionelle') ?>">Liste des marches prévisionnelle</a>
                                </li>

                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-folder"></i>
                                <span class="menu-text"> B. Commande Interne </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if ($user->getProfilModuleAction($acces_marche->getId(), "Marchés Public", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/new?idtype=9') ?>">N.Fiche B.C.Interne M.P </a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Bon Commande Interne")) echo 'disabledbutton' ?>" href="<?php echo url_for(array('module' => 'documentachat', 'action' => 'index', 'idtype' => 9)); ?>">Liste B.C.Interne M.P</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-folder"></i>
                                <span class="menu-text"> Marchés Publics </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if ($user->getProfilModuleAction($acces_marche->getId(), "Marchés Public", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('marches/new') ?>">N. Fiche Marché</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Marchés Public")) echo 'disabledbutton' ?>" href="<?php echo url_for(array('module' => 'marches', 'action' => 'index')); ?>">Liste des Fiches Marchés</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Bénéficiaire")) echo 'disabledbutton' ?>" href="<?php echo url_for(array('module' => 'lots', 'action' => 'index')); ?>">Bénéficiaire</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_marche->getId(), "Bénéficiaire")) echo 'disabledbutton' ?>" href="<?php echo url_for('@pvrception'); ?>">Liste P.V Réceptions</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li>
                            <a class="<?php // if (!$user->getProfilModule($acces_marche->getId(), "Import")) echo 'disabledbutton'  
                                        ?>" href="<?php echo url_for('Accueil/import') ?>">
                                <i class="menu-icon fa fa-upload"></i>
                                <span class="menu-text"> Import </span>
                            </a>
                        </li>
                        <li>
                            <a class="<?php // if (!$user->getProfilModule($acces_marche->getId(), "Import")) echo 'disabledbutton'  
                                        ?>" href="<?php echo url_for('Accueil/tableauBord') ?>">
                                <i class="menu-icon fa fa-tachometer"></i>
                                <span class="menu-text"> Tableau de Bord </span>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->