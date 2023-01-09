
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_achat = $user->getProfilApplication("Unité Achats"); ?>
                <?php $acces_marche = $user->getProfilApplication("Unité Marchés"); ?>
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
                                    <a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Paramètre : Avis par Unité")) echo 'disabledbutton' ?>" href="<?php echo url_for('@avis') ?>">Avis par Unité</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Paramètre : Visa d'Achat")) echo 'disabledbutton' ?>" href="<?php echo url_for('@visaachat') ?>">Visa d'Achat</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Paramètre : Paramétrage par Type Document")) echo 'disabledbutton' ?>" href="<?php echo url_for('@parametragetypedoc') ?>">Paramétrage par Type Doc.</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Paramètre : Type Bon de Commande Interne")) echo 'disabledbutton' ?>" href="<?php echo url_for('@objectdocument') ?>">Type Bon Commande Interne</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Paramètre : Demandeur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@demandeur') ?>">Demandeur</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Paramètre : Modalité de Livraison")) echo 'disabledbutton' ?>" href="<?php echo url_for('@notesbce') ?>">Modalité de Livraison</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Paramètre : Lieu de Livraison")) echo 'disabledbutton' ?>" href="<?php echo url_for('@lieulivraisson') ?>">Lieu de Livraison</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Paramètre : Symbole Désignation")) echo 'disabledbutton' ?>" href="<?php echo url_for('@symbole') ?>">Symbole Désignation</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Paramètre : Unite")) echo 'disabledbutton' ?>" href="<?php echo url_for('@unitemarche') ?>">Unités de Mesures</a>
                                </li>


                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "TVA")) echo 'disabledbutton' ?>" href="<?php echo url_for('@tva') ?>">TVA</a></li>
                              <!--<li><a class="<?php // if (!$user->getProfilModule($acces_achat->getId(), "Droit de Timbre")) echo 'disabledbutton'  ?>" href="<?php // echo url_for('@droittimbre')  ?>">Droit de Timbre</a></li>-->
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
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@fournisseur') ?>">Fournisseurs</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Famille Article/Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@familleartfrs') ?>">Famille Art/Frs</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Activité Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@activitetiers') ?>">Activité Fournisseur</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Réclamation Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@reclamationfrs') ?>">Réclamation Fournisseur</a></li>
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
                                <li><a class="<?php if (!$user->getProfilModuleAction($acces_achat->getId(), "Bon de Commande Interne", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/new?idtype=6') ?>"><i class="fa fa-file-o fa-fw"></i> N. Fiche Demande Interne</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Bon de Commande Interne")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste Demande Interne</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Bon de Commande Interne")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/listeAnnule') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste D.I. Annulé</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Liste Documents/D.I.")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/index') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste Documents/D.I.</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li class="hover">
                            <a href="">
                                <i class="menu-icon fa fa-bullhorn"></i>
                                <span class="menu-text">
                                    Demandes de Prix
                                </span>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Demande de Prix")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrs?idtype=8') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste des demandes de prix</a></li> 
                            </ul>
                        </li>
                        <li class="hover">
                            <a href="">
                                <i class="menu-icon fa fa-folder"></i>
                                <span class="menu-text">
                                    B. Commande Externe
                                </span>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Liste B.C.E Définitifs")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrs?idtype=7') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.C.E. Définitifs</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Liste B.C.E Provisoires")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrs?idtype=18') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.C.E. Provisoires</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Bon de Commande Interne")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/listeBCEAnnule') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.C.E Annulé</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a href="">
                                <i class="menu-icon fa fa-file-text"></i>
                                <span class="menu-text">
                                    Contrats
                                </span>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">

                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Contrat")) echo 'disabledbutton' ?>" href="<?php echo url_for('contratachat/indexfrs?idtype=20') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste des contrats Défintifs</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Contrat")) echo 'disabledbutton' ?>" href="<?php echo url_for('contratachat/listeconratdefinitifannule') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste des contrats Défintifs Annulés</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Contrat")) echo 'disabledbutton' ?>" href="<?php echo url_for('contratachat/listeconratdefinitifresilie') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste des contrats Défintifs Résiliés</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Contrat")) echo 'disabledbutton' ?>" href="<?php echo url_for('contratachat/indexfrs?idtype=19') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste des contrats Provisoires</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Contrat")) echo 'disabledbutton' ?>" href="<?php echo url_for('contratachat/listeconratprovisoireannule') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste des contrats Provisoires Annulés</a></li> 
                            </ul>

                        </li>
                        <li class="hover">
                            <a href="">
                                <i class="menu-icon fa fa-folder"></i>
                                <span class="menu-text">
                                    B. de Dépense au comptant
                                </span>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Liste B.D.C Définitifs")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrs?idtype=2') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.D.C. Définitifs</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Liste B.D.C Provisoires")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrs?idtype=17') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.D.C. Provisoires</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Liste B.D.C Provisoires")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrsBDCNull?idtype=17') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.D.C.NULL Provisoires</a></li> 
    <!--<li><a class="<?php // if (!$user->getProfilModule($acces_achat->getId(), "Liste B.D.C Provisoires")) echo 'disabledbutton'       ?>" href="<?php // echo url_for('Documents/indexfrs?idtype=21')       ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.D.C. Regroupé Provisoires</a></li>--> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Bon de Commande Interne")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/listeBDCAnnule') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.D.C Annulé</a></li>
                            </ul>
                        </li>

                        <li class="hover">
                            <a href="">
                                <i class="menu-icon fa fa-folder"></i>
                                <span class="menu-text">
                                    B. de Dépense au comptant Regroupe
                                </span>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Liste B.D.C Définitifs")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrs?idtype=22') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.D.C.Regroupe Définitifs</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Liste B.D.C Provisoires")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrs?idtype=21') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.D.C.Regroupe Provisoires</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Bon de Commande Interne")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/listeAnnule?id_type=21') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.D.C.Regroupe</a></li>
    <!--<li><a class="<?php // if (!$user->getProfilModule($acces_achat->getId(), "Liste B.D.C Provisoires")) echo 'disabledbutton'       ?>" href="<?php // echo url_for('Documents/indexfrs?idtype=21')       ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.D.C. Regroupé Provisoires</a></li>--> 
                            </ul>
                        </li>

                        <li>
                            <a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Import")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/import') ?>">
                                <i class="menu-icon fa fa-upload"></i>
                                <span class="menu-text"> Import </span>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Import Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/fournisseurExcel') ?>">
                                <i class="menu-icon fa fa-upload"></i>
                                <span class="menu-text"> Import Fournisseur </span>
                            </a>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-desktop"></i>
                                <span class="menu-text"> Tableau de Bord </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <ul class="submenu">

                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivicommande') ?>" >Suivi des bons Commandes</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivibdc') ?>" >Suivi des Bons dépense a comptant</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivibdcRegroupe') ?>" >Suivi des Bons dépense a comptant Regroupes</a></li>
                                <!--<li><a class="<?php // if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton'   ?>" href="<?php // echo url_for('Accueil/showSuivicontratlivraisontotal')         ?>" >Suivi des Contrats</a></li>-->
                             <!--<li><a class="<?php // if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton'   ?>" href="<?php // echo url_for('Accueil/showSuivicontrat')         ?>" >Suivi les Contrat bci test </a></li>-->
                                
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivicontrattotal') ?>" >Suivi des Contrats</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/tableauBord') ?>" >Tab.de Bord Contrats</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuiviBcicontrat') ?>" >Suivi les BCI/Contrat</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
  