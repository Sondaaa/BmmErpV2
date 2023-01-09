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
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@fournisseur') ?>">Fournisseurs</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Famille Article/Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@familleartfrs') ?>">Famille Art/Frs</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Activité Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@activitetiers') ?>">Activité fournisseur</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Réclamation Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@reclamationfrs') ?>">Reclamation fournisseur</a></li>
                          <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Famille Article/Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@adressefrs') ?>">Adresse Fournisseur</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-folder"></i>
                                <span class="menu-text"> Documents Achats </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Bon de Commande Externe")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=7') ?>">Bons de Commandes<br>Externes</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Bon de Dépenses au Comptant")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=2') ?>">Bons de Dépenses<br>au Comptant</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Bon de Dépenses au Comptant")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=22&type=BDCG') ?>">Bons de Dépenses<br>au Comptant Regroupes</a></li>
                                  <!--<li><a class="<?php // if (!$user->getProfilModule($acces_facturation->getId(), "Bon de Dépenses au Comptant")) echo 'disabledbutton'    ?>" href="<?php // echo url_for('documentachat/listeMvt')    ?>">BDCG Liste des Mvts</a></li>-->
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Bon de Dépenses au Comptant")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=20') ?>">Contrats Totals</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Bon de Dépenses au Comptant")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=6') ?>">Contrats Partiels</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-folder"></i>
                                <span class="menu-text"> Documents Marchés </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Décomptes Marchés")) echo 'disabledbutton' ?>" href="<?php echo url_for('lots/index') ?>">Décomptes Marchés</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-folder"></i>
                                <span class="menu-text"> Factures </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Facture")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=15') ?>" >Liste des Factures</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-bank"></i>
                                <span class="menu-text"> Mouvements </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModuleAction($acces_facturation->getId(), "Mouvement Facturation", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/new') ?>">Nouvelle Opération BCE/BDC</a></li>
                                <li><a class="<?php if (!$user->getProfilModuleAction($acces_facturation->getId(), "Mouvement Facturation", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/newMvtBDCregroupe') ?>">Nouvelle Opération Du BDC.Reg.</a></li>
                               <!--<li><a class="<?php if (!$user->getProfilModuleAction($acces_facturation->getId(), "Mouvement Facturation", "Création")) echo 'disabledbutton' ?>" href="<?php // echo url_for('lignemouvementfacturation/nouveaumouvement')    ?>">Nouvelle fiche Mouvement Contrat</a></li>-->
                                <li><a class="<?php if (!$user->getProfilModuleAction($acces_facturation->getId(), "Mouvement Facturation", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/nouveaumouvementstandard') ?>">Nouvelle Opération Contrat</a></li>                                
                            </ul>
                        </li>
                          <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-bank"></i>
                                <span class="menu-text">Consultaions </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Mouvement Facturation")) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal?idtype=7') ?>">Journal des Mvts B.C.E</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Mouvement Facturation")) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal?idtype=2') ?>">Journal des Mvts B.D.C</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Mouvement Facturation")) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal?idtype=20') ?>">Journal des Mvts Contrat</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Mouvement Facturation")) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal') ?>">Journal.Mvts(S.Fiscale)</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Mouvement Facturation")) echo 'disabledbutton' ?>" href="<?php echo url_for('@historiquemouvement') ?>">Historiq.Mvts(S.Fiscale)</a></li>
                            </ul>
                        </li>
                       
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-desktop"></i>
                                <span class="menu-text"> Tableau de Bord </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <ul class="submenu">

                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivicommande') ?>" >Suivi des bons Commandes</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivibdc') ?>" >Suivi des Bons dépense a comptant</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivibdcRegroupe') ?>" >Suivi des Bons dépense a comptant Regroupes</a></li>                         
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivicontrattotal') ?>" >Suivi des Contrats</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/tableauBord') ?>" >Tab.de Bord Contrats</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_facturation->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuiviBcicontrat') ?>" >Suivi les BCI/Contrat</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->