<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_admin = $user->getProfilApplication("Administration E.R.P"); ?>
                <?php if ($acces_admin): ?>
                <ul class="nav nav-list">
                    <li class="hover" id="menu_parameter">
                        <a class="dropdown-toggle" href="#">
                            <i class="menu-icon fa fa-cog"></i>
                            <span class="menu-text"> P. Globaux </span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Paramètre Société")) echo 'disabledbutton' ?>" href="<?php echo url_for('@societe') ?>">Société</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Paramètres - Paramétrage Société")) echo 'disabledbutton' ?>" href="<?php echo url_for('@parametragesociete') ?>">Parmétrage société</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Paramètre Projets")) echo 'disabledbutton' ?>" href="<?php echo url_for('@projet') ?>">Projets</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Paramètre Utilisateur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@utilisateur') ?>">Utilisateurs</a></li>
                             
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <li class="hover" id="menu_parameterdev">
                        <a class="dropdown-toggle" href="#">
                            <i class="menu-icon fa fa-wrench"></i>
                            <span class="menu-text"> ONE ERP Accès</span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Modules E.R.P")) echo 'disabledbutton' ?>" href="<?php echo url_for('@application') ?>">Modules E.R.P</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Sous Modules E.R.P")) echo 'disabledbutton' ?>" href="<?php echo url_for('@applicationmodule') ?>">Sous Modules E.R.P</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Profils")) echo 'disabledbutton' ?>" href="<?php echo url_for('@profil') ?>">Profils</a></li>
                            
<!--                            <li><a href="<?php // echo url_for('@moduleerp') ?>">Modules</a></li>
                            <li><a href="<?php // echo url_for('@role') ?>">Role</a></li>                           
                            <li><a href="<?php // echo url_for('@rolemodule') ?>">Roles / Modules</a></li>
                            <li><a href="<?php // echo url_for('@prevelege') ?>">Privilège</a></li>
                            <li><a href="<?php // echo url_for('@prvelegedroit') ?>">Privilège / Modules</a></li>-->
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <li class="hover">
                        <a class="dropdown-toggle" href="#">
                            <i class="menu-icon fa fa-home"></i>
                            <span class="menu-text"> Emplacement</span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Pays")) echo 'disabledbutton' ?>" href="<?php echo url_for('@pays') ?>">Pays</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Gouvernorats")) echo 'disabledbutton' ?>" href="<?php echo url_for('@gouvernera') ?>">Gouvernorats</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Adresses")) echo 'disabledbutton' ?>" href="<?php echo url_for('@adresse') ?>">Adresses</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Sites")) echo 'disabledbutton' ?>" href="<?php echo url_for('@site') ?>">Sites</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Emplacement")) echo 'disabledbutton' ?>" href="<?php echo url_for('@etage') ?>">Sous Sites </a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Local")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typebureaux') ?>">Etages</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Bureaux")) echo 'disabledbutton' ?>" href="<?php echo url_for('@bureaux') ?>">Bureaux</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Direction")) echo 'disabledbutton' ?>" href="<?php echo url_for('@direction') ?>">Directions</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <li class="hover">
                        <a class="dropdown-toggle" href="#">
                            <i class="menu-icon fa fa-tags"></i>
                            <span class="menu-text"> Immobilisation</span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Poste")) echo 'disabledbutton' ?>" href="<?php echo url_for('@poste') ?>">Poste</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Nature")) echo 'disabledbutton' ?>" href="<?php echo url_for('@nature') ?>">Nature</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Marque")) echo 'disabledbutton' ?>" href="<?php echo url_for('@marque') ?>">Marque</a></li>
                            <li class="hover">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-arrow-down"></i>
                                    <!--<i class="menu-icon fa fa-desktop"></i>-->
                                    <span class="menu-text">
                                        Import
                                    </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="hover">
                                        <a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Import Par. comptabilité")) echo 'disabledbutton' ?>" href="<?php echo url_for('import/index') ?>">Par. comptabilité</a>
                                        <b class="arrow"></b>
                                    </li>
                                    <li class="hover">
                                        <a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Import Par. Catégorie")) echo 'disabledbutton' ?>" href="<?php echo url_for('import/parcategorie') ?>">Par. Catégorie</a>
                                        <b class="arrow"></b>
                                    </li>
                                    <li class="hover">
                                        <a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Import Par. Emplacement")) echo 'disabledbutton' ?>" href="<?php echo url_for('import/paremplacment') ?>">Par. Emplacement</a>
                                        <b class="arrow"></b>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <li class="hover">
                        <a class="dropdown-toggle" href="#">
                            <i class="menu-icon fa fa-credit-card"></i>
                            <span class="menu-text"> Achats</span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "TVA")) echo 'disabledbutton' ?>" href="<?php echo url_for('@tva') ?>">TVA</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Type document")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typedoc') ?>">Type document</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Etat document")) echo 'disabledbutton' ?>" href="<?php echo url_for('@etatdocument') ?>">Etat document</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <li class="hover">
                        <a class="dropdown-toggle" href="#">
                            <i class="menu-icon fa fa-cubes"></i>
                            <span class="menu-text"> Stock</span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Types Articles")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typearticle') ?>">Types Articles</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Méthode de valorisation des stocks")) echo 'disabledbutton' ?>" href="<?php echo url_for('@methodevalorisation') ?>">Méthode de valorisation des stocks</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Modéle d'approvisionnement")) echo 'disabledbutton' ?>" href="<?php echo url_for('@modeleapro') ?>">Modèle d'approvisionnement</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <li class="hover">
                        <a class="dropdown-toggle" href="#">
                            <i class="menu-icon fa fa-money"></i>
                            <span class="menu-text"> Budget</span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Types Documents budget")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typedocbudget') ?>">Types Documents budget</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <li class="hover">
                        <a class="dropdown-toggle" href="#">
                            <i class="menu-icon fa fa-map-marker"></i>
                            <span class="menu-text"> Marchés</span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Types Ordre de services")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typeios') ?>">Types Ordre de services</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Type Détail de prix")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typedetailprix') ?>">Type Détail de prix</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <li class="hover">
                        <a class="dropdown-toggle" href="#">
                            <i class="menu-icon fa fa-list-ol"></i>
                            <span class="menu-text"> Comptable</span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Taux d'amortissement")) echo 'disabledbutton' ?>" href="<?php echo url_for('@tauxammortisement') ?>">Taux d'amortissement</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Compte comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('@compte') ?>">Compte comptable</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Mode d'amortissement")) echo 'disabledbutton' ?>" href="<?php echo url_for('@modeammortisement') ?>">Mode d'amortissement</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <li class="hover">
                        <a class="dropdown-toggle" href="#">
                            <i class="menu-icon fa fa-envelope-o"></i>
                            <span class="menu-text"> Bureaux d'ordre</span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Famille Exp.Des.")) echo 'disabledbutton' ?>" href="<?php echo url_for('@famexpdes') ?>">Famille Exp.Des.</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Type Exp.Des.")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typexpdes') ?>">Type Exp.Des.</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Type Courrier")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typecourrier') ?>">Type Courrier</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <li class="hover">
                        <a class="dropdown-toggle" href="#">
                            <i class="menu-icon fa fa-users"></i>
                            <span class="menu-text"> GRH</span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Employés")) echo 'disabledbutton' ?>" href="<?php echo url_for('@agents') ?>">Employés</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Type Demandeur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typeagents') ?>">Type Demandeur</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <li>
                        <a class="<?php if (!$user->getProfilModule($acces_admin->getId(), "Type Piéces-Jointes")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typepiece') ?>">
                            <i class="menu-icon fa fa-file-text-o"></i>
                            <span class="menu-text"> Type Piéces-Jointes </span>
                        </a>
                    </li>
                </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>

    </div><!-- /.col -->
</div><!-- /.row -->