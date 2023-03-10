<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
    <?php if ($user->getProfil()): ?>
        <ul class="nav nav-list">
              <li class="hover" style="margin-left: 5%">
                <a href="">
                    <i class="menu-icon fa fa-cogs"></i>
                    <span class="menu-text"> ADMINISTRATION </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    
                    <li class="hover">
                        <!--<a href="<?php // echo url_for('utilisateur/index')    ?>" class="<?php // if (!$user->getAcceesDroit("utilisateur/index")) echo 'disabledbutton'    ?>">-->
                        <a href="<?php echo url_for('utilisateur/index') ?>" class="<?php if (!$user->getProfilApplication("Administration E.R.P")) echo 'disabledbutton' ?>">
                            Administration ERP
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
             <li class="hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-envelope"></i>
                    <span class="menu-text"> GESTION DES COURRIERS </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="hover">
    <!--                    <a href="<?php // echo sfconfig::get('sf_appdir')    ?>bureauxdordre.php" class="<?php
//                    if ($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("Admin B.O"))
//                        echo '';
//                    else
//                        echo 'disabledbutton';
                        ?>">-->
                        <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?bureau=abo" class="<?php if (!$user->getProfilApplication("Administration Bureau d'ordre")) echo 'disabledbutton'; ?>">
                            Administration Bureau d'Ordre
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
    <!--                    <a href="<?php // echo sfconfig::get('sf_appdir')    ?>bureauxdordre.php/?id_famexpdes=<?php // echo $user->getRoleByLibelle("Responsable bureau d'ordre")->getIdFamexpdes();    ?>" class="<?php
//                    if ($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("responsable bureaux d'ordre"))
//                        echo '';
//                    else
//                        echo 'disabledbutton';
                        ?>">-->
                        <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("Responsable bureau d'ordre")->getIdFamexpdes(); ?>&bureau=boc" 
                           class="<?php if (!$user->getProfilApplication("Bureau d'Ordre Central")) echo 'disabledbutton'; ?>">
                            <i class="menu-icon fa fa-envelope"></i>
                            Bureau d'Ordre Central
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <a href="">
                            <i class="menu-icon fa fa-envelope-o"></i>
                            Secr??tariats
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="hover">
                        <a href="" class="dropdown-toggle">
                            <i class="menu-icon fa fa-envelope-o"></i>
                            Secr??tariat SOUS/DAF
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')     ?>bureauxdordre.php/?id_famexpdes=<?php // echo $user->getRoleByLibelle("Secr??tariat sous DAF")->getIdFamexpdes();     ?>" class="<?php // if (!($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("Secr??tariat sous DAF"))) echo 'disabledbutton';     ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("Secr??tariat sous DAF")->getIdFamexpdes(); ?>&bureau=daf"
                                   class="<?php if (!$user->getProfilApplication("Secr??tariat SOUS/DAF : Gestion des Courriers")) echo 'disabledbutton'; ?>">
                                    Gestion des Courriers
                                </a>
                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                     <li class="hover">
                        <a href="" class="dropdown-toggle">
                            <i class="menu-icon fa fa-envelope-o"></i>
                            Secr??tariat SOUS/DCG
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="hover">
    <!--                            <a href="<?php // echo sfconfig::get('sf_appdir')    ?>bureauxdordre.php/?id_famexpdes=<?php // echo $user->getRoleByLibelle("S.Unit?? de contr??le de gestion et Cellule informatique ")->getIdFamexpdes();    ?>" class=" <?php
//                            if ($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("S.Unit?? de contr??le de gestion et Cellule informatique"))
//                                echo '';
//                            else
//                                echo 'disabledbutton';
                                ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Unit?? de contr??le de gestion et Cellule informatique ")->getIdFamexpdes(); ?>&bureau=dcg"
                                   class="<?php if (!$user->getProfilApplication("Secr??tariat SOUS/DCG : Gestion des Courriers")) echo 'disabledbutton'; ?>">
                                    Gestion des Courriers
                                </a>
                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                            <li class="hover">
    <!--                            <a href="<?php // echo sfconfig::get('sf_appdir')    ?>bureauxdordre.php/?id_famexpdes=<?php // echo $user->getRoleByLibelle("S.Direction des travaux ")->getIdFamexpdes();    ?>" class=" <?php
//                            if ($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("S.Direction des travaux"))
//                                echo '';
//                            else
//                                echo 'disabledbutton';
                                ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Direction des travaux ")->getIdFamexpdes(); ?>&bureau=sdt"
                                   class="<?php if (!$user->getProfilApplication("Secr??tariat Direction des Travaux")) echo 'disabledbutton'; ?>">
                                    S. Direction des Travaux
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
    <!--                            <a href="<?php // echo sfconfig::get('sf_appdir')    ?>bureauxdordre.php/?id_famexpdes=<?php // echo $user->getRoleByLibelle("S.Direction de planification et suivi ")->getIdFamexpdes();    ?>" class=" <?php
//                            if ($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("S.Direction de planification et suivi"))
//                                echo '';
//                            else
//                                echo 'disabledbutton';
                                ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Direction de planification et suivi ")->getIdFamexpdes(); ?>&bureau=sdps" class="<?php if (!$user->getProfilApplication("Secr??tariat Direction de Planification et Suivi")) echo 'disabledbutton'; ?>">
                                    S. Direction de Planification et Suivi
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
    <!--                            <a href="<?php // echo sfconfig::get('sf_appdir')    ?>bureauxdordre.php/?id_famexpdes=<?php // echo $user->getRoleByLibelle("S.Unit?? audit interne ")->getIdFamexpdes();    ?>" class=" <?php
//                            if ($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("S.Unit?? audit interne"))
//                                echo '';
//                            else
//                                echo 'disabledbutton';
                                ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Unit?? audit interne ")->getIdFamexpdes(); ?>&bureau=suai" 
                                   class="<?php if (!$user->getProfilApplication("Secr??tariat Unit?? Audit Interne")) echo 'disabledbutton'; ?>">
                                    S. Unit?? Audit Interne
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
    <!--                            <a href="<?php // echo sfconfig::get('sf_appdir')    ?>bureauxdordre.php/?id_famexpdes=<?php // echo $user->getRoleByLibelle("S.Officier de securite militaire")->getIdFamexpdes();    ?>" class=" <?php
//                            if ($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("S.Officier de securite militaire"))
//                                echo '';
//                            else
//                                echo 'disabledbutton';
                                ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Officier de securite militaire")->getIdFamexpdes(); ?>&bureau=sosm"
                                   class="<?php if (!$user->getProfilApplication("Secr??tariat Officier de S??curit?? Militaire")) echo 'disabledbutton'; ?>">
                                    S. Officier de S??curit?? Militaire
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
    <!--                            <a href="<?php // echo sfconfig::get('sf_appdir')    ?>bureauxdordre.php" class=" <?php
//                            if ($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("S.Service du mat??riel roulant et des engins"))
//                                echo '';
//                            else
//                                echo 'disabledbutton';
                                ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?bureau=ssmre" 
                                   class="<?php if (!$user->getProfilApplication("Secr??tariat Service du Mat??riel Roulant et des Engins")) echo 'disabledbutton'; ?>">
                                    S. Service du Mat??riel Roulant et des Engins
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
    <!--                            <a href="<?php // echo sfconfig::get('sf_appdir')    ?>bureauxdordre.php/?id_famexpdes=<?php // echo $user->getRoleByLibelle("S.Bureau du personnel militaire ")->getIdFamexpdes();    ?>" class=" <?php
//                            if ($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("S.Bureau du personnel militaire"))
//                                echo '';
//                            else
//                                echo 'disabledbutton';
                                ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Bureau du personnel militaire ")->getIdFamexpdes(); ?>&bureau=sbpm"
                                   class="<?php if (!$user->getProfilApplication("Secr??tariat Bureau du Personnel Militaire")) echo 'disabledbutton'; ?>">
                                    S. Bureau du Personnel Militaire
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
    <!--                            <a href="<?php // echo sfconfig::get('sf_appdir')    ?>bureauxdordre.php/?id_famexpdes=<?php // echo $user->getRoleByLibelle("S.Unit?? de contr??le de gestion et Cellule informatique ")->getIdFamexpdes();    ?>" class=" <?php
//                            if ($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("S.Unit?? de contr??le de gestion et Cellule informatique"))
//                                echo '';
//                            else
//                                echo 'disabledbutton';
                                ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Unit?? de contr??le de gestion et Cellule informatique ")->getIdFamexpdes(); ?>&bureau=suci" 
                                   class="<?php if (!$user->getProfilApplication("Secr??tariat UCG et Cellule Informatique")) echo 'disabledbutton'; ?>">
                                    S. UCG et Cellule Informatique
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
    <!--                            <a href="<?php // echo sfconfig::get('sf_appdir')    ?>bureauxdordre.php/?id_famexpdes=<?php // echo $user->getRoleByLibelle("Responsable Affaire Sociale")->getIdFamexpdes();    ?>" class=" <?php
//                            if ($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("S.Affaires Sociales"))
//                                echo '';
//                            else
//                                echo 'disabledbutton';
                                ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("Responsable Affaire Sociale")->getIdFamexpdes(); ?>&bureau=sas" 
                                   class="<?php if (!$user->getProfilApplication("Secr??tariat Affaires Sociales")) echo 'disabledbutton'; ?>">
                                    S. Affaires Sociales
                                </a>
                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
           
             <!--Finance-->   
            <li class="hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-money"></i>
                    <span class="menu-text">
                        Finance
                    </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                     <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir') . "budget.php"   ?>" class="<?php // if (!$user->getAcceesDroit("budget.php")) echo 'disabledbutton'   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') . "budget.php" ?>" class="<?php if (!$user->getProfilApplication("Unit?? Budget")) echo 'disabledbutton' ?>">
                                    Budget
                                </a>
                                <b class="arrow"></b>
                            </li>
<!--                     <li class="hover">
                                <a href="<?php // echo sfconfig::get('sf_appdir')   ?>achats.php" class="<?php // if (!$user->getAcceesDroit("achats.php")) echo 'disabledbutton'   ?>">
                                <a href="<?php // echo sfconfig::get('sf_appdir') ?>achats.php" class="<?php // if (!$user->getProfilApplication("Unit?? Achats")) echo 'disabledbutton' ?>">
                                     Ventes
                                </a>
                                <b class="arrow"></b>
                            </li>-->
                     <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>achats.php" class="<?php // if (!$user->getAcceesDroit("achats.php")) echo 'disabledbutton'   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>achats.php" class="<?php if (!$user->getProfilApplication("Unit?? Achats")) echo 'disabledbutton' ?>">
                                     Achats
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>marchee.php" class="<?php // if (!$user->getAcceesDroit("marchee.php")) echo 'disabledbutton'   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>marchee.php" class="<?php if (!$user->getProfilApplication("Unit?? March??s")) echo 'disabledbutton' ?>">
                                     March??s
                                </a>
                                <b class="arrow"></b>
                            </li>
                           
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>stock.php" class=" <?php // if (!$user->getAcceesDroit("stock.php")) echo 'disabledbutton'   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>stock.php" class=" <?php if (!$user->getProfilApplication("Unit?? Gestion des Stocks")) echo 'disabledbutton' ?>">
                                     Gestion des Stocks
                                </a>
                                <b class="arrow"></b>
                            </li>
                             <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>immobilisation.php" class=" <?php // if (!$user->getAcceesDroit("immobilisation.php")) echo 'disabledbutton'   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>immobilisation.php" class="<?php if (!$user->getProfilApplication("Unit?? Patrimoine (Immobilisation)")) echo 'disabledbutton' ?>">
                                    Gestion Patrimoine
                                </a>
                                <b class="arrow"></b>
                            </li>
<!--                            <li class="hover">
                                <a href="<?php // echo sfconfig::get('sf_appdir')   ?>immobilisation.php" class=" <?php // if (!$user->getAcceesDroit("immobilisation.php")) echo 'disabledbutton'   ?>">
                                <a href="<?php //echo sfconfig::get('sf_appdir') ?>gestionmaitenance.php" class="<?php //if (!$user->getProfilApplication("Unit?? Patrimoine (Immobilisation)")) echo 'disabledbutton' ?>">
                                    GMAO 
                                </a>
                                <b class="arrow"></b>
                            </li>-->
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>facturation.php" class="<?php // if (!$user->getAcceesDroit("facturation.php")) echo 'disabledbutton'   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>facturation.php" class="<?php if (!$user->getProfilApplication("Unit?? Contr??le des Factures")) echo 'disabledbutton' ?>">
                                    Contr??le des Factures
                                </a>
                                <b class="arrow"></b>
                            </li>
                           
                            <li class="hover">
                                <a href="">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Tr??sorerie
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="hover">
                                        <!--<a href="<?php // echo sfconfig::get('sf_appdir') . "tresoriecaisse.php"   ?>" class=" <?php // if (!$user->getAcceesDroit("tresorie.php")) echo 'disabledbutton'   ?>">-->
                                        <a href="<?php echo sfconfig::get('sf_appdir') . "tresoriecaisse.php" ?>" class=" <?php if (!$user->getProfilApplication("Banque")) echo 'disabledbutton' ?>">
                                            Banques
                                        </a>
                                        <b class="arrow"></b>
                                    </li>
                                    <li class="hover">
                                        <!--<a href="<?php // echo sfconfig::get('sf_appdir') . "tresorie.php"   ?>" class=" <?php // if (!$user->getAcceesDroit("tresorie.php")) echo 'disabledbutton'   ?>">-->
                                        <a href="<?php echo sfconfig::get('sf_appdir') . "tresorie.php" ?>" class=" <?php if (!$user->getProfilApplication("Caisse")) echo 'disabledbutton' ?>">
                                            Caisses
                                        </a>
                                        <b class="arrow"></b>
                                    </li>
                                </ul>
                            </li>
                   
                </ul>
            </li>
            <!--Contablilite-->
              <li class="hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-balance-scale"></i>
                    <span class="menu-text">
                        Comptabilit??
                    </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    
                     <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>comptabilite.php" class="<?php // if (!$user->getAcceesDroit("comptabilite.php")) echo 'disabledbutton'   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>comptabilite.php" class="<?php if (!$user->getProfilApplication("Unit?? Comptabilit?? G??n??rale")) echo 'disabledbutton' ?>">
                                    Unit?? Comptabilit?? G??n??rale
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>analytique.php" class="<?php // if (!$user->getAcceesDroit("comptabilite.php")) echo 'disabledbutton'   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>analytique.php" class="<?php if (!$user->getProfilApplication("Unit?? Comptabilit?? Analytique")) echo 'disabledbutton' ?>">
                                    Unit?? Comptabilit?? Analytique
                                </a>
                                <b class="arrow"></b>
                            </li>
                    
                    
                </ul>
            </li>    
            <!--Ressource Humaine-->
             <li class="hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-user-times"></i>
                    <span class="menu-text">
                        Ressources Humaines
                    </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    
<li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>paie.php" class="<?php // if (!$user->getAcceesDroit("paie.php")) echo 'disabledbutton'   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>paie.php" class="<?php if (!$user->getProfilApplication("Unit?? Paie")) echo 'disabledbutton' ?>">
                                    Unit?? Paie
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>Ressourcehumaine.php" class="<?php // if (!$user->getAcceesDroit("responsable RH et gestion de carri??re")) echo 'disabledbutton'   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>Ressourcehumaine.php" class="<?php if (!$user->getProfilApplication("Unit?? Gestion des Carri??res et des Ouvriers Occasionnels")) echo 'disabledbutton' ?>">
                                    U. Gestion des Carri??res et des Ouvriers Occasionnels
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>formation.php" class="<?php // if (!$user->getAcceesDroit("formation.php")) echo 'disabledbutton'   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>formation.php" class="<?php if (!$user->getProfilApplication("Unit?? Formation")) echo 'disabledbutton' ?>">
                                    Unit?? Formation
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>suivipresence.php" class="<?php // if (!$user->getAcceesDroit("suivipresence.php")) echo 'disabledbutton'   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>suivipresence.php" class="<?php if (!$user->getProfilApplication("Unit?? de Suivi des Pr??sences et des Cong??s")) echo 'disabledbutton' ?>">
                                    U. de Suivi des Pr??sences et des Cong??s
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir') . "affairesociale.php"   ?>" class="<?php // if (!$user->getAcceesDroit("affairesociale.php")) echo 'disabledbutton'   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') . "affairesociale.php" ?>" class="<?php if (!$user->getProfilApplication("Unit?? des Affaires Sociales")) echo 'disabledbutton' ?>">
                                    U. des Affaires Sociales
                                </a>
                                <b class="arrow"></b>
                            </li>
                </ul>
            </li>   
            <li class="hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-eye"></i>
                    <span class="menu-text">
                        Controle de gestion
                    </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>controlegestion.php/?stat=0" class="<?php // if (!$user->getAcceesDroit("controlegestion")) echo 'disabledbutton';   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>controlegestion.php/?stat=0" class="<?php if (!$user->getProfilApplication("Unit?? Contr??le Budg??taire")) echo 'disabledbutton'; ?>">
                                    Contr??le Budg??taire
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>controlegestion.php/?stat=1" class="<?php // if (!$user->getAcceesDroit("controlegestion")) echo 'disabledbutton';   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>controlegestion.php/?stat=1" class="<?php if (!$user->getProfilApplication("Unit?? Statistiques et Suivi")) echo 'disabledbutton'; ?>">
                                    Statistiques et Suivi
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>controlegestion.php/?stat=2" class="<?php // if (!$user->getAcceesDroit("controlegestion")) echo 'disabledbutton';   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>controlegestion.php/?stat=2" class="<?php if (!$user->getProfilApplication("Unit?? Contr??le des Co??ts")) echo 'disabledbutton'; ?>">
                                    Contr??le des Co??ts
                                </a>
                                <b class="arrow"></b>
                            </li>
                        </ul>
            </li>

            <li class="hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-eye"></i>
                    <span class="menu-text">
                    Audit interne
                    </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>controlegestion.php/?stat=0" class="<?php // if (!$user->getAcceesDroit("controlegestion")) echo 'disabledbutton';   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>audit.php/?stat=0" class="<?php if (!$user->getProfilApplication("Unit?? Audit interne")) echo 'disabledbutton'; ?>">
                                Plan Annuel d'Audit
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>controlegestion.php/?stat=1" class="<?php // if (!$user->getAcceesDroit("controlegestion")) echo 'disabledbutton';   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>audit.php/?stat=1" class="<?php if (!$user->getProfilApplication("Unit?? Audit interne")) echo 'disabledbutton'; ?>">
                                Justificatif d'Audit
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="hover">
                                <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>controlegestion.php/?stat=2" class="<?php // if (!$user->getAcceesDroit("controlegestion")) echo 'disabledbutton';   ?>">-->
                                <a href="<?php echo sfconfig::get('sf_appdir') ?>audit.php/?stat=2" class="<?php if (!$user->getProfilApplication("Unit?? Audit interne")) echo 'disabledbutton'; ?>">
                                Missions d'Audit
                                </a>
                                <b class="arrow"></b>
                            </li>
                        </ul>
            </li>           

            

            <li class="active open hover" >
                <a href="<?php echo sfconfig::get('sf_appdir') . 'accueil.php/Accueil/global' ?>">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> TABLEAUX DE BORD </span>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="hover">
                        <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>direction.php" class="<?php // if (!$user->getAcceesDroit("DIRECTION DAF")) echo 'disabledbutton';   ?>">-->
                        <a href="<?php echo sfconfig::get('sf_appdir') ?>direction.php" class="<?php if (!$user->getProfilApplication("Direction G??n??rale")) echo 'disabledbutton'; ?>">
                            GENERALE
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <!--<a href="<?php // echo sfconfig::get('sf_appdir')   ?>direction.php" class="<?php // if (!$user->getAcceesDroit("DIRECTION S/DAF")) echo 'disabledbutton';   ?>">-->
                        <a href="<?php echo sfconfig::get('sf_appdir') ?>direction.php" class="<?php if (!$user->getProfilApplication("Direction SOUS/DAF")) echo 'disabledbutton'; ?>">
                            SOUS/DAF
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
        </ul><!-- /.nav-list -->
    <?php else: ?>
        <?php
        $name_user = '';
        if ($sf_user->getAttribute('userB2m')) {
            if ($sf_user->getAttribute('userB2m')->getIdParent() != null)
                $name_user = $sf_user->getAttribute('userB2m');
            else
                $name_user = "Admin. Formanet";
        }
        ?>
        <ul class="nav nav-list" style="height: 85px;">
            <li style="width: 100%; text-align: center;">
                <div style="font-size: 16px; color: #B74635; padding: 2%;">
                    <i class="fa fa-exclamation-triangle"></i> 
                    Bonjour <?php echo $name_user; ?>, vous n'avez pas encore un profil. 
                    Veuillez contactez votre administrateur.
                </div>
            </li>
        </ul>
    <?php endif; ?>
</div>

