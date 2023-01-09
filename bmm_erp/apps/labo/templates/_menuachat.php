<div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
    <?php $acces_achat = $user->getProfilApplication("Unité Achats");?>
    <?php $acces_marche = $user->getProfilApplication("Unité Marchés");?>
    <?php if ($acces_achat): ?>
        <ul class="nav nav-list">
            <li class="hover">
                <a class="dropdown-toggle" href="#">
                    <i class="menu-icon fa fa-cog"></i>
                    <span class="menu-text"> Paramètres Globaux </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">

                    <li>
                        <a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Paramètre : Demandeur")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('@demandeur') ?>">Demandeur</a>
                    </li>

                </ul>
                <!-- /.dropdown-user -->
            </li>
            <li class="hover">
                <a href="">
                    <i class="menu-icon fa fa-folder"></i>
                    <span class="menu-text">
                        B. Commande Interne
                    </span>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li><a class="<?php if (!$user->getProfilModuleAction($acces_achat->getId(), "Bon de Commande Interne", "Création")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('Achatdoc/new?idtype=4') ?>"><i class="fa fa-file-o fa-fw"></i> N. Fiche Demande Interne</a></li>
                    <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Bon de Commande Interne")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('Achatdoc/index?idtype=4') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste Demande Interne</a></li>
                <li><a class="<?php if (!$user->getProfilModuleAction($acces_achat->getId(), "Bon de Commande Interne", "Création")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('Achatdoc/new?idtype=6') ?>"><i class="fa fa-file-o fa-fw"></i> N. DA par Caisse</a></li>

<li><a class="<?php if (!$user->getProfilModuleAction($acces_achat->getId(), "Bon de Commande Interne", "Création")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('Achatdoc/index?idtype=6') ?>"><i class="fa fa-file-o fa-fw"></i> Liset des DA par Caisse</a></li>

                     <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Bon de Commande Interne")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('Achatdoc/index?idtype=23') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste des Bons de Sorties</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <li class="hover">
                <a class="dropdown-toggle" href="#">
                    <i class="menu-icon fa fa-desktop"></i>
                    <span class="menu-text"> Tableau de Bord </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <ul class="submenu">

                    <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) {
                                        echo 'disabledbutton';
                                    }
                                    ?>" href="<?php echo url_for('Accueil/showSuivicommande') ?>">
                                                                Suivi des bons Commandes</a>
                    </li>
                    <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) {
                                echo 'disabledbutton'
                                ;
                            }
                            ?>" href="<?php echo url_for('Accueil/showSuivibdc')
                            ?>" >Suivi des Bons dépense a comptant</a>
                    </li>                                             

                    <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) {
                            echo 'disabledbutton'
                            ;
                        }
                        ?>" href="<?php echo url_for('Accueil/showSuivicontrattotal')
                        ?>">Suivi des Contrats</a>
                    </li>
                    <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) {
                            echo 'disabledbutton'
                            ;
                        }
                        ?>" href="<?php echo url_for('Accueil/tableauBord')
                        ?>">Tab.de Bord Contrats</a>
                    </li>
                    <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) {
                            echo 'disabledbutton'
                            ;
                        }
                        ?>" href="<?php echo url_for('Accueil/showSuiviBcicontrat')
                        ?>">Suivi les BCI/Contrat</a>
                    </li>
                </ul>
            </li>
        </ul>
    <?php endif;?>
</div><!-- .sidebar -->