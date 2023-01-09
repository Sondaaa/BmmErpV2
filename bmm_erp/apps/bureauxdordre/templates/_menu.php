<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php
                switch ($_SESSION['bureau']) {
                    case 'daf':
                        $libelle_application = "Secrétariat SOUS/DAF : Gestion des Courriers";
                        break;
                    case 'dcg':
                        $libelle_application = "Secrétariat SOUS/DCG : Gestion des Courriers";
                        break;
                    case 'boc':
                        $libelle_application = "Bureau d'Ordre Central";
                        break;
                    case 'sdt':
                        $libelle_application = "Secrétariat Direction des Travaux";
                        break;
                    case 'sdps':
                        $libelle_application = "Secrétariat Direction de Planification et Suivi";
                        break;
                    case 'suai':
                        $libelle_application = "Secrétariat Unité Audit Interne";
                        break;
                    case 'sosm':
                        $libelle_application = "Secrétariat Officier de Sécurité Militaire";
                        break;
                    case 'ssmre':
                        $libelle_application = "Secrétariat Service du Matériel Roulant et des Engins";
                        break;
                    case 'sbpm':
                        $libelle_application = "Secrétariat Bureau du Personnel Militaire";
                        break;
                    case 'suci':
                        $libelle_application = "Secrétariat UCG et Cellule Informatique";
                        break;
                    case 'sas':
                        $libelle_application = "Secrétariat Affaires Sociales";
                        break;
                    case 'abo':
                        $libelle_application = "Administration Bureau d'ordre";
                        break;
                }
                $acces_bureau = $user->getProfilApplication($libelle_application);
                ?>
                <?php if ($acces_bureau): ?>
                    <ul class="nav nav-list">
                        <li class="hover" id="userparametrage">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cog"></i>
                                <span class="menu-text"> Paramétrages </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Paramètre : Pays")) echo 'disabledbutton' ?>" href="<?php echo url_for('@pays') ?>">Pays</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Paramètre : Gouvernorat")) echo 'disabledbutton' ?>" href="<?php echo url_for('@gouvernera') ?>">Gouvernorats</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Paramètre : Famille Tiers")) echo 'disabledbutton' ?>" href="<?php echo url_for('@famexpdes') ?>">Familles Tiers</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Paramètre : Type Tiers")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typexpdes') ?>">Types Tiers</a></li>

                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Paramètre : Paramétrage d'envoie")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typeparamcourrier') ?>">Param. d'envoie</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Paramètre : Type Courrier")) echo 'disabledbutton' ?>" href="<?php echo url_for('@modescourrier') ?>">Types Courrier</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Paramètre : Note Courrier")) echo 'disabledbutton' ?>" href="<?php echo url_for('@famillecourrier') ?>">Notes Courrier</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Paramètre : Action Courrier")) echo 'disabledbutton' ?>" href="<?php echo url_for('@actionparcour') ?>">Actions Courrier</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Paramètre : Affectation Courrier")) echo 'disabledbutton' ?>" href="<?php echo url_for('@affectaioncourrier') ?>">Affectations Courrier</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Paramètre : Paramétrage d'Expédition")) echo 'disabledbutton' ?>" href="<?php echo url_for('@parametreexpedition') ?>">Param. d'expéditions</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-user"></i>
                                <span class="menu-text">
                                    Gestion des Tiers
                                    <span class="badge badge-transparent tooltip-error" title="(Exp.Rec.)">
                                        <i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
                                    </span>
                                </span>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Expéditeurs et Récepteurs")) echo 'disabledbutton' ?>" href="<?php echo url_for('expdest/index') ?>">Expéditeurs & Récepteurs</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-envelope"></i>
                                <span class="menu-text">Courrier Interne</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu" id="userinterne">
                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Courrier Interne : Arrivée")) echo 'disabledbutton' ?>" href="<?php echo url_for('courrier/index?idtype=1') ?>"> Courrier Arrivée Int.</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Courrier Interne : Départ")) echo 'disabledbutton' ?>" href="<?php echo url_for('courrier/index?idtype=2') ?>"> Courrier Départ Int.</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-envelope-o"></i>
                                <span class="menu-text">Courrier Externe</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu" id="userexterne">
                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Courrier Externe : Arrivée Externe")) echo 'disabledbutton' ?>" href="<?php echo url_for('courrier/index?idtype=3') ?>"> Courrier Arrivée Ext.</a></li>
                                <!-- <li><a class="<?php //if (!$user->getProfilModule($acces_bureau->getId(), "Courrier Externe : Arrivée Interne")) echo 'disabledbutton' ?>" href="<?php //echo url_for('courrier/index?idtype=1') ?>"> Courrier Arrivée Int.</a></li> -->
                                <li><a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Courrier Externe : Départ Externe")) echo 'disabledbutton' ?>" href="<?php echo url_for('courrier/index?idtype=4') ?>"> Courrier Départ Ext.</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li class="hover" id="userstatiqtique">
                            <a class="<?php if (!$user->getProfilModule($acces_bureau->getId(), "Mouvements des Courriers")) echo 'disabledbutton' ?>" href="<?php echo url_for('parcourcourier/index') ?>">
                                <i class="menu-icon fa fa-exchange"></i>
                                <span class="menu-text"> Mouvements des Courriers </span>
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul><!-- /.nav-list -->
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->