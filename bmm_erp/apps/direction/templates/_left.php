<div id="sidebar" class="sidebar responsive ace-save-state compact">
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li class="hover">
            <a href="<?php echo sfconfig::get('sf_appdir') . 'accueil.php/Accueil/global' ?>">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> TABLEAUX DE BORD </span>
            </a>
            <b class="arrow"></b>
        </li>
    </ul>   
    <ul class="nav nav-list">
        <li class="hover">
            <a href="#">
                <i class="menu-icon fa fa-desktop"></i>
                <span class="menu-text"> SOUS DAF </span>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="hover">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-envelope-o"></i>
                        Secrétariat SOUS/DAF
                        <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("Secrétariat sous DAF")->getIdFamexpdes(); ?>" class="<?php if (!$user->getProfilApplication("Secrétariat SOUS/DAF : Gestion des Courriers")) echo 'disabledbutton'; ?>">
                                Gestion des Courriers
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
                <li class="hover">
                    <a href="#" class="hover">
                        <i class="menu-icon fa fa-money "></i>
                        <span class="menu-text">
                            Service Financier
                        </span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>achats.php" class="<?php if (!$user->getProfilApplication("Unité Achats")) echo 'disabledbutton' ?>">
                                Unité Achats
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>marchee.php" class="<?php if (!$user->getProfilApplication("Unité Marchés")) echo 'disabledbutton' ?>">
                                Unité Marchés
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>immobilisation.php" class="<?php if (!$user->getProfilApplication("Unité Patrimoine (Immobilisation)")) echo 'disabledbutton' ?>">
                                Unité Patrimoine
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>stock.php" class=" <?php if (!$user->getProfilApplication("Unité Gestion des Stocks")) echo 'disabledbutton' ?>">
                                U. Gestion des Stocks
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>facturation.php" class="<?php if (!$user->getProfilApplication("Unité Contrôle des Factures")) echo 'disabledbutton' ?>">
                                U. Contrôle des Factures
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') . "budget.php" ?>" class="<?php if (!$user->getProfilApplication("Unité Budget")) echo 'disabledbutton' ?>">
                                Unité Budget
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Trésorerie
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li class="hover">
                                    <a href="<?php echo sfconfig::get('sf_appdir') . "tresoriecaisse.php" ?>" class=" <?php if (!$user->getProfilApplication("Banque")) echo 'disabledbutton' ?>">
                                        Banques
                                    </a>
                                    <b class="arrow"></b>
                                </li>
                                <li class="hover">
                                    <a href="<?php echo sfconfig::get('sf_appdir') . "tresorie.php" ?>" class=" <?php if (!$user->getProfilApplication("Caisse")) echo 'disabledbutton' ?>">
                                        Caisses
                                    </a>
                                    <b class="arrow"></b>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="hover">
                    <a href="#" class="hover">
                        <i class="menu-icon fa fa-money "></i>
                        <span class="menu-text">
                            Service Comptable
                        </span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>comptabilite.php" class="<?php if (!$user->getProfilApplication("Unité Comptabilité Générale")) echo 'disabledbutton' ?>">
                                Unité Comptabilité Générale
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>analytique.php" class="<?php if (!$user->getProfilApplication("Unité Comptabilité Analytique")) echo 'disabledbutton' ?>">
                                Unité Comptabilité Analytique
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
                <li class="hover">
                    <a href="#" class="hover">
                        <i class="menu-icon fa fa-money "></i>
                        <span class="menu-text">
                            Service Ressources Humaines
                        </span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>paie.php" class="<?php if (!$user->getProfilApplication("Unité Paie")) echo 'disabledbutton' ?>">
                                Unité Paie
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>Ressourcehumaine.php" class="<?php if (!$user->getProfilApplication("Unité Gestion des Carrières et des Ouvriers Occasionnels")) echo 'disabledbutton' ?>">
                                U. Gestion des Carrières et des Ouvriers Occasionnels
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>formation.php" class="<?php if (!$user->getProfilApplication("Unité Formation")) echo 'disabledbutton' ?>">
                                Unité Formation 
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>suivipresence.php" class="<?php if (!$user->getProfilApplication("Unité de Suivi des Présences et des Congés")) echo 'disabledbutton' ?>">
                                U. de Suivi des Présences et des Congés
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') . "affairesociale.php" ?>" class="<?php if (!$user->getProfilApplication("Unité des Affaires Sociales")) echo 'disabledbutton' ?>">
                                U. des Affaires sociales
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li> 
            </ul>
        </li>
    </ul><!-- /.nav-list -->
    <ul class="nav nav-list">
        <li class="hover">
            <a href="#">
                <i class="menu-icon fa fa-eye"></i>
                <span class="menu-text"> SOUS / DCG </span>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="hover">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-envelope-o"></i>
                        Secrétariat SOUS/DCG
                        <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Unité de contrôle de gestion et Cellule informatique ")->getIdFamexpdes(); ?>" class="<?php if (!$user->getProfilApplication("Secrétariat SOUS/DCG : Gestion des Courriers")) echo 'disabledbutton'; ?>">
                                Gestion des Courriers
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
                <li class="hover">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-folder-open-o"></i>
                        Service de contrôle de gestion
                        <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>controlegestion.php/?stat=0" class="<?php if (!$user->getProfilApplication("Unité Contrôle Budgétaire")) echo 'disabledbutton'; ?>">
                                U. Contrôle Budgétaire
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>controlegestion.php/?stat=1" class="<?php if (!$user->getProfilApplication("Unité Statistiques et Suivi")) echo 'disabledbutton'; ?>">
                                U. Statistiques et Suivi
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>controlegestion.php/?stat=2" class="<?php if (!$user->getProfilApplication("Unité Contrôle des Coûts")) echo 'disabledbutton'; ?>">
                                U. Contrôle des Coûts
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>  
    <ul class="nav nav-list">
        <li class="hover">
            <a href="">
                <i class="menu-icon fa 	fa-envelope-square "></i>
                <span class="menu-text"> G. COURRIER </span>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="hover">
                    <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("Responsable bureau d'ordre")->getIdFamexpdes(); ?>" class="<?php if (!$user->getProfilApplication("Bureau d'Ordre Central")) echo 'disabledbutton'; ?>">
                        <i class="menu-icon fa  fa-envelope"></i>
                        <span class="menu-text"> Bureau d'Ordre Central </span>
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="hover">
                    <a href="">
                        <i class="menu-icon fa fa-envelope-o"></i>
                        Secrétariats
                    </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Direction des travaux ")->getIdFamexpdes(); ?>" class="<?php if (!$user->getProfilApplication("Secrétariat Direction des Travaux")) echo 'disabledbutton'; ?>">
                                S. Direction des Travaux
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Direction de planification et suivi ")->getIdFamexpdes(); ?>" class="<?php if (!$user->getProfilApplication("Secrétariat Direction de Planification et Suivi")) echo 'disabledbutton'; ?>">
                                S. Direction de Planification et Suivi
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Unité audit interne ")->getIdFamexpdes(); ?>" class="<?php if (!$user->getProfilApplication("Secrétariat Unité Audit Interne")) echo 'disabledbutton'; ?>">
                                S. Unité Audit Interne
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Officier de securite militaire")->getIdFamexpdes(); ?>" class="<?php if (!$user->getProfilApplication("Secrétariat Officier de Sécurité Militaire")) echo 'disabledbutton'; ?>">
                                S. Officier de Sécurité Militaire
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php" class="<?php if (!$user->getProfilApplication("Secrétariat Service du Matériel Roulant et des Engins")) echo 'disabledbutton'; ?>">
                                S. Service du Matériel Roulant et des Engins
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Bureau du personnel militaire ")->getIdFamexpdes(); ?>" class="<?php if (!$user->getProfilApplication("Secrétariat Bureau du Personnel Militaire")) echo 'disabledbutton'; ?>">
                                S.Bureau du Personnel Militaire
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Unité de contrôle de gestion et Cellule informatique ")->getIdFamexpdes(); ?>" class="<?php if (!$user->getProfilApplication("Secrétariat UCG et Cellule Informatique")) echo 'disabledbutton'; ?>">
                                S. UCG et Cellule Informatique
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="hover">
                            <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("Responsable Affaire Sociale")->getIdFamexpdes(); ?>" class="<?php if (!$user->getProfilApplication("Secrétariat Affaires Sociales")) echo 'disabledbutton'; ?>">
                                S.Affaires Sociales 
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="nav nav-list">
        <li class="hover">
            <a>
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text"> DIRECTION </span>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="hover">
                    <a href="<?php echo sfconfig::get('sf_appdir') ?>direction.php" class="<?php if (!$user->getProfilApplication("Direction Générale")) echo 'disabledbutton'; ?>">
                        GENERALE
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="hover">
                    <a href="<?php echo sfconfig::get('sf_appdir') ?>direction.php" class="<?php if (!$user->getProfilApplication("Direction SOUS/DAF")) echo 'disabledbutton'; ?>">
                        SOUS/DAF
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="nav nav-list">
        <li class="hover">
            <a>
                <i class="menu-icon fa fa-cogs"></i>
                <span class="menu-text"> ADMINISTRA° </span>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="hover">
                    <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php" class="<?php if (!$user->getProfilApplication("Administration Bureau d'ordre")) echo 'disabledbutton'; ?>">
                        Administration bureau d'ordre
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="hover">
                    <a href="<?php echo url_for('utilisateur/index') ?>" class="<?php if (!$user->getProfilApplication("Administration E.R.P")) echo 'disabledbutton' ?>">
                        Administration ERP
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
    </ul>
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>