<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_comptabilite = $user->getProfilApplication("Unité Comptabilité Générale"); ?>
                <?php if ($acces_comptabilite): ?>
                    <?php
                    $facturecomptable_dossier = FacturecomptableachatTable::getInstance()->findByPeriodeAndSaisie($_SESSION['dossier_id'], 0);
//                    $reglement_comptable_dossier = ReglementcomptableTable::getInstance()->findByIdDossierAndSaisie($_SESSION['dossier_id'], 0);
                    $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
                    $date_debut = $exercice->getDateDebut();
                    $date_fin = $exercice->getDateFin();
                    $reglement_comptable_dossier = ReglementcomptableTable::getInstance()->findByPeriode($date_debut, $date_fin);
                    $factutre_od_comptable_dossier = FacturecomptableodTable::getInstance()->findByPeriodeandNonSaisie($date_debut, $date_fin);
                      $rsclient_comptable_dossier = FacturecomptableodclientTable::getInstance()->findByPeriodeandNonSaisie($date_debut, $date_fin);
                  $facturecomptablevente_dossier=  FacturecomptableventeTable::getInstance()->findByPeriodeandNonSaisie($date_debut, $date_fin);
                    ?>
                    <ul class="nav nav-list">

                        <li>
                            <a href="<?php echo url_for('accueil/index') ?>">
                                <i class="menu-icon fa fa-tv"></i>
                                <span class="menu-text"> Accueil </span>
                            </a>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cogs"></i>
                                <span class="menu-text"> Paramètres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Paramètre : Secteur Activité")) echo 'disabledbutton' ?>" href="<?php echo url_for('@secteurActivite') ?>">Secteur d'activité</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Paramètre : Activité")) echo 'disabledbutton' ?>" href="<?php echo url_for('@activite') ?>">Activité</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Paramètre : Forme Juridique")) echo 'disabledbutton' ?>" href="<?php echo url_for('@formeJuridique') ?>">Forme juridique</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Paramètre : Type Journal")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typeJournal') ?>">Type journal</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Paramètre : Type Pièce")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typePiece') ?>">Type de pièce</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Paramètre : T.V.A")) echo 'disabledbutton' ?>" href="<?php echo url_for('@tva') ?>">T.V.A</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a href="">
                                <i class="menu-icon fa fa-cogs"></i>
                                <span class="menu-text">
                                    Paramétrage Dossier 
                                </span>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Dossier Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('dossier/index') ?>"> Dossier Juridique</a></li>
    <!--                                <li><a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Paramètre : Exercice Comptable")) echo 'disabledbutton'     ?>" href="<?php // echo url_for('@exercice')     ?>">Création Exercices</a></li>
                                <li><a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Exercice Antérieur")) echo 'disabledbutton'     ?>" href="<?php // echo url_for('@anterieurDossier')     ?>">Affectation Exercice</a></li>-->
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Exercice Antérieur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@dossierexerciceutilisateur') ?>"> Affectation Utilisateur</a></li>

                                <li class="hover">
                                    <a class="dropdown-toggle" href="#">

                                        <span class="menu-text ">Plan Comptable Client</span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Plan Comptable :  generer plan")) echo 'disabledbutton' ?>" href="<?php echo url_for('transfert/base-standard') ?>">Génerer Plan Comptable</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Plan Comptable : importer plan")) echo 'disabledbutton' ?>" href="<?php echo url_for('dossier/importerPlan') ?>">Importer Plan Comptable/Excel</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Plan comptable : annnulation importation")) echo 'disabledbutton' ?>" href="<?php echo url_for('annulation/index') ?>">Annuler Importation P.Comptable /Excel</a> </li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Plan Comptable : imporation plan d'un dossier")) echo 'disabledbutton' ?>" href="<?php echo url_for('plan_comptable/importation') ?>">Importer à partir d'un Dossier</a></li>
                                    </ul>
                                </li>


                                <li class="hover">
                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text">Pramètrage Jornaux.C</span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>

                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <?php $acces_achat_creation = $user->getProfilModuleAction($acces_comptabilite->getId(), "Importation : Achat", "Création"); ?>



                                        <li><a class="<?php if (!$acces_achat_creation) echo 'disabledbutton' ?>" href="<?php echo url_for('@newJournalComptable') ?>">Création Journaux </a></li>


                                        <li><a class="<?php if (!$acces_achat_creation) echo 'disabledbutton' ?>" href="<?php echo url_for('journal/importation') ?>">Importer à partir d'un dossier</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-list-ol"></i>
                                <span class="menu-text"> Base Comptable </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Base Comptable : Compte Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('@ajouterCompteComptable') ?>">Ajouter compte</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Base Comptable : Plan Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('@planStandard') ?>">Aperçu Plan comptable</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Base Comptable : Journal Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('@listeJournalComptable') ?>">Aperçu Journaux.C</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Base Comptable : Maquette de saisie")) echo '' ?>" href="<?php echo url_for('maquette_saisie/index') ?>">Maquette de saisie</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-keyboard-o"></i>
                                <span class="menu-text"> Traitement </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModuleAction($acces_comptabilite->getId(), "Traitement : Pièce Comptable", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('@saisiePieces') ?>">Saisie des pièces</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Traitement : Pièce Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('@listePiece') ?>">Liste des pièces</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Traitement : Recherche Multicritère")) echo 'disabledbutton' ?>" href="<?php echo url_for('multicriteres/index') ?>">Recherche multicritères</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Traitement : Recherche Multicritère")) echo 'disabledbutton' ?>" href="<?php echo url_for('multicriteres/reimputation') ?>">Réimputation  Pièce comptable </a></li>

                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-exchange"></i>
                                <span class="menu-text"> Importation </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-arrow-down"></i>
                                        <!--<i class="menu-icon fa fa-desktop"></i>-->
                                        <span class="menu-text">
                                            Achat
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <?php $acces_achat_creation = $user->getProfilModuleAction($acces_comptabilite->getId(), "Importation : Achat", "Création"); ?>

                                        <li class="hover">
                                            <a class="<?php if (!$acces_achat_creation) echo 'disabledbutton' ?>" href="<?php echo url_for('importation/achatExcel'); ?>">Impoter achat / Excel</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li><a class="<?php if (!$acces_achat_creation) echo 'disabledbutton' ?>" href="<?php echo url_for('annulation/annulationachat') ?>">Annuler Importation Achat/Excel </a> </li>

                                        <?php $acces_achat = $user->getProfilModule($acces_comptabilite->getId(), "Importation : Achat"); ?>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_achat) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/listAchat') ?>">Liste achats importés <span style="font-size: 14px;color: #1087dd"><?php echo '( ' . sizeof($facturecomptable_dossier) . ' )'; ?></span></a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_achat) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/listAchatSaisie') ?>">Liste achats saisies</a>
                                            <b class="arrow"></b>
                                        </li>

                                    </ul>
                                </li>
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-arrow-up"></i>
                                        <span class="menu-text">
                                            Vente
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <?php $acces_vente_creation = $user->getProfilModuleAction($acces_comptabilite->getId(), "Importation : Vente", "Création"); ?>

                                        <li class="hover">
                                            <a class="<?php if (!$acces_vente_creation) echo 'disabledbutton' ?>" href="<?php echo url_for('importation/venteExcel'); ?>">Impoter vente / Excel</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li><a class="<?php if (!$acces_vente_creation) echo 'disabledbutton' ?>" href="<?php echo url_for('annulation/annulationfacturevente') ?>">Annuler Importation Vente </a> </li>

                                        <?php $acces_vente = $user->getProfilModule($acces_comptabilite->getId(), "Importation : Vente"); ?>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_vente) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/listVente') ?>">Liste ventes importées <span style="font-size: 14px;color: #1087dd"><?php echo '( ' . sizeof($facturecomptablevente_dossier) . ' )'; ?></span></a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_vente) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/listVenteSaisie') ?>">Liste ventes saisies</a>
                                            <b class="arrow"></b>
                                        </li>

                                    </ul>
                                </li>
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-arrow-up"></i>

                                        <span class="menu-text">
                                            Balance
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <?php $acces_balance = $user->getProfilModule($acces_comptabilite->getId(), "Importation : Balance"); ?>

                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/balanceexcel') ?>">Impoter Balance / Excel</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/listBalance') ?>">Liste Balances importées</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('annulation/annulationBalance') ?>">Annuler Importation Balance/Excel </a>
                                            <b class="arrow"></b>
                                        </li>

                                    </ul>
                                </li>
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-arrow-up"></i>

                                        <span class="menu-text">
                                            Mouvement
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <?php $acces_balance = $user->getProfilModule($acces_comptabilite->getId(), "Importation : Balance"); ?>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/mouvementExcel') ?>">Impoter Mouvements / Excel </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('annulation/annulationMouvemnetpiece') ?>">Annuler Importation Mouvements / Excel </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/listMouvement') ?>">Liste Mouvements importées </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_achat) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/listMouvementSaisie') ?>">Liste Mouvements saisies</a>
                                            <b class="arrow"></b>
                                        </li>

                                    </ul>
                                </li>
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-arrow-up"></i>

                                        <span class="menu-text">
                                            Retenue à la source Fournisseur
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <?php $acces_balance = $user->getProfilModule($acces_comptabilite->getId(), "Importation : Balance"); ?>

                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/odExcel') ?>">Impoter Retenue Â la Source Fournisseur / Excel </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('annulation/annulationod') ?>">Annuler Importation Retenue Â la Source Fournisseur / Excel </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php
                                            if ($_SESSION['dossier_id'] == 1) {
                                                echo url_for('importation/listeOd_1');
                                            } else {
                                                echo url_for('importation/listeOd');
                                            }
                                            ?>">Liste Retenues Â la Source Fournisseur importées  <span style="font-size: 14px;color: #1087dd"> <?php echo ' ( ' . sizeof($factutre_od_comptable_dossier) . ' ) '; ?></span></a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_achat) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/listOdSaisie') ?>">Liste Retenues à la source Fournisseur saisies</a>
                                            <b class="arrow"></b>
                                        </li>


                                    </ul>
                                </li>
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-arrow-up"></i>

                                        <span class="menu-text">
                                            Retenue à la source Client
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <?php $acces_balance = $user->getProfilModule($acces_comptabilite->getId(), "Importation : Balance"); ?>

                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/odExcelClient') ?>">Impoter Retenue Â la Source Client / Excel </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('annulation/annulationodClient') ?>">Annuler Importation Retenue Â la Source Client / Excel </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/listeOdClient') ?>">Liste Retenues Â la Source Client importées  <span style="font-size: 14px;color: #1087dd">  <?php echo '( ' . sizeof($rsclient_comptable_dossier) . ' )'; ?></span></a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_achat) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/listOdSaisieClient') ?>">Liste Retenues à la source Client saisies</a>
                                            <b class="arrow"></b>
                                        </li>


                                    </ul>
                                </li>
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-arrow-up"></i>

                                        <span class="menu-text">
                                            Trésorerie
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <?php $acces_balance = $user->getProfilModule($acces_comptabilite->getId(), "Importation : Balance"); ?>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/tresorieExcel') ?>">Impoter Trésorerie / Excel </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('annulation/annulationTresorerie') ?>">Annuler Importation Trésorerie / Excel </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/listTresorerie') ?>">Liste Tréso.Importées <span style="font-size: 14px;color: #1087dd"><?php echo '( ' . sizeof($reglement_comptable_dossier) . ' )'; ?></span></a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_achat) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/listTresorerieSaisie') ?>">Liste Trésorerie saisies</a>
                                            <b class="arrow"></b>
                                        </li>

                                    </ul>
                                </li>
                                <!--                              <li class="hover">
                                                                    <a href="#" class="dropdown-toggle">
                                                                        <i class="menu-icon fa fa-arrow-up"></i>
                                
                                                                        <span class="menu-text">
                                                                            Banque
                                                                        </span>
                                                                        <b class="arrow fa fa-angle-down"></b>
                                                                    </a>
                                                                    <b class="arrow"></b>
                                                                    <ul class="submenu">
                                <?php $acces_balance = $user->getProfilModule($acces_comptabilite->getId(), "Importation : Balance"); ?>
                                
                                                                        <li class="hover">
                                                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php // echo url_for('importation/balanceexcel')            ?>">Impoter Banque / Excel </a>
                                                                            <b class="arrow"></b>
                                                                        </li>
                                                                        <li class="hover">
                                                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('importation/listBalance') ?>">Liste Banque Importées</a>
                                                                            <b class="arrow"></b>
                                                                        </li>
                                                                        <li class="hover">
                                                                            <a class="<?php if (!$acces_balance) echo 'disabledbutton'; ?>" href="<?php echo url_for('annulation/annulationBalance') ?>">Annuler Importation Banque / Excel </a>
                                                                            <b class="arrow"></b>
                                                                        </li>
                                
                                                                    </ul>
                                                                </li>   -->
                            </ul>
                        </li>

                        <li class="hover"><a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-file-text-o"></i>
                                <span class="menu-text">
                                    P. E. Financiers
                                </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "P.E. Financiers")) echo 'disabledbutton' ?>" href="<?php echo url_for('fiche_Bilan/parametre') ?>">Paramétrage Etat Financiers</a>
                                    <b class="arrow"></b>
                                </li>

                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-lightbulb-o"></i>
                                        <span class="menu-text">
                                            Etat Financiers
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat Liasse Fiscale : Bilan (Actif / Passif)")) echo 'disabledbutton' ?>" href="<?php echo url_for('fiche_Bilan/parametreEtat') ?>">Bilan ( Actif / Passif )</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <?php if ($_SESSION['dossier_id'] == 1): ?>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat Liasse Fiscale : Etat de Résultat")) echo 'disabledbutton' ?>" href="<?php echo url_for('fiche_Bilan/etatResultat') ?>">Etat de résultat</a>
                                                <b class="arrow"></b>
                                            </li>
                                        <?php elseif ($_SESSION['dossier_id'] != 1): ?>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat Liasse Fiscale : Etat de Résultat")) echo 'disabledbutton' ?>" href="<?php echo url_for('fiche_Bilan/etatResultatgeneral') ?>">Etat de résultat</a>
                                                <b class="arrow"></b>
                                            </li>
                                        <?php endif; ?>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat Liasse Fiscale : Flux de Trésorerie (Flux MA)")) echo 'disabledbutton' ?>" href="<?php echo url_for('fiche_Bilan/etatFlux') ?>">Etat de flux de trésorerie (Flux MA)</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat Liasse Fiscale : Solde Intermediaire de Gestion (S.I.G)")) echo 'disabledbutton' ?>" href="<?php echo url_for('fiche_Bilan/etatSig') ?>">Solde intermediaire de gestion (SIG)</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat Liasse Fiscale : Notes au Etats Financiers")) echo 'disabledbutton' ?>" href="<?php echo url_for('fiche_Bilan/etatNote') ?>">Notes aux états financiers</a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>


                            </ul>
                        </li>


                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-magic"></i>
                                <span class="menu-text"> Utilitaires </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-edit"></i>
                                        <span class="menu-text">
                                            Modification
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Utilitaire Modification : Numéro Pièce Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('modification_numero/index') ?>">Modification du numéro des pièces comptables</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Utilitaire Modification : Journal Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('modification_numero/modificationJournal') ?>">Modification du journal</a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-sort-numeric-asc"></i>
                                        <!--<i class="menu-icon fa fa-desktop"></i>-->
                                        <span class="menu-text">
                                            Rénumérotation
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModuleAction($acces_comptabilite->getId(), "Utilitaire : Rénumérotation Pièce Comptable", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('renumerotation/index') ?>">Rénumérotation des pièces comptables</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Utilitaire : Rénumérotation Pièce Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('renumerotation/liste') ?>">Liste des pièces rénuméroteés</a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>

                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-files-o"></i>
                                        <span class="menu-text">
                                            Duplication
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModuleAction($acces_comptabilite->getId(), "Utilitaire : Duplication Pièce Comptable", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('operation_piece/duplication') ?>">Dupliquer une pièce</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Utilitaire : Duplication Pièce Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('operation_piece/listePieceDuplique') ?>">Liste des pièces dupliquées</a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-chain-broken"></i>
                                        <span class="menu-text">
                                            Libération
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModuleAction($acces_comptabilite->getId(), "Utilitaire : Libération Pièce Comptable", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('operation_piece/liberation') ?>">Libérer une pièce</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <!--                                        <li class="hover">
                                                                                    <a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Utilitaire : Libération Pièce Comptable")) echo 'disabledbutton'                    ?>" href="<?php // echo url_for('operation_piece/listePieceLibere')                    ?>">Liste des pièces libérées</a>
                                                                                    <b class="arrow"></b>
                                                                                </li>-->
                                    </ul>
                                </li>

                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-print"></i>
                                <span class="menu-text"> Etat </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">

                                        <span class="menu-text">
                                            Plan Comptable
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : plan comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('plan_comptable/imprimerexporter') ?>">Imprimer & exporter Plan Comptable</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : pln comptable general")) echo 'disabledbutton' ?>" href="<?php echo url_for('plan_comptable/imprimergenerale') ?>">Imprimer & exporter Plan.C Général</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : plan collectif")) echo 'disabledbutton' ?>" href="<?php echo url_for('plan_comptable/imprimercollectif') ?>">Imprimer & exporter Plan.C Collectif </a>
                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : plan fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('plan_comptable/imprimerfournisseur') ?>">Imprimer & exporter Plan.C Founisseur </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : plan client")) echo 'disabledbutton' ?>" href="<?php echo url_for('plan_comptable/imprimerclient') ?>">Imprimer & exporter Plan.C Client </a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-newspaper-o"></i>
                                        <span class="menu-text">
                                            Journal
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : un Seul Journal")) echo 'disabledbutton' ?>" href="<?php echo url_for('etat/etatJournalSeul') ?>">Un seul journal</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : Tout les Journaux")) echo 'disabledbutton' ?>" href="<?php echo url_for('etat/etatJournal') ?>">Tout les journaux</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : Journal Centralisateur")) echo 'disabledbutton' ?>" href="<?php echo url_for('etat/etatJournalCentralisateurM2') ?>">Journal centralisateur</a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>
                                <!--                                <li class="hover">
                                                                    <a href="#" class="dropdown-toggle">
                                                                        <i class="menu-icon fa fa-balance-scale"></i>
                                                                        <span class="menu-text">
                                                                            Balance
                                                                        </span>
                                                                        <b class="arrow fa fa-angle-down"></b>
                                                                    </a>
                                                                    <b class="arrow"></b>
                                                                    <ul class="submenu">
                                                                        <li class="hover">
                                                                            <a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : Balance Générale (Simple)")) echo 'disabledbutton'                        ?>" href="<?php // echo url_for('etat/etatBalanceTotaux')                        ?>">Balance générale (simple)</a>
                                                                            <b class="arrow"></b>
                                                                        </li>
                                                                        <li class="hover">
                                                                            <a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : Balance Sous Totaux")) echo 'disabledbutton'                        ?>" href="<?php // echo url_for('etat/etatBalanceTotaux')                        ?>">Balance sous totaux</a>
                                                                            <b class="arrow"></b>
                                                                        </li>
                                                                        <li class="hover">
                                                                            <a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : Balance Tiers")) echo 'disabledbutton'                        ?>" href="<?php // echo url_for('etat/etatBalanceTiers')                        ?>">Balance tiers</a>
                                                                            <b class="arrow"></b>
                                                                        </li>
                                                                    </ul>
                                                                </li>-->
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : Balance Générale (Simple)")) echo 'disabledbutton' ?>" href="<?php echo url_for('etat/etatBalanceTotaux') ?>">Balance générale</a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : Grand Livre")) echo 'disabledbutton' ?>" href="<?php echo url_for('etat/etatLivre') ?>">Grand livre</a>
                                </li>
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-arrow-down"></i>
                                        <span class="menu-text">
                                            Compte Comptable
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : Extrait Compte Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('etat/etatExtraitCompte') ?>">Extrait de compte</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Etat : Fiche Compte Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('etat/etatFicheCompte') ?>">Fiche de compte</a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-lightbulb-o"></i>
                                        <span class="menu-text">
                                            Liasse Fiscale
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>

                                </li>
                            </ul>
                        </li>

                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-exchange"></i>
                                <span class="menu-text">
                                    Mis à jour fiche
                                </span>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <!--<li>
                                <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Tiers : Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@listFournisseur') ?>"> Fournisseur</a></li>-->
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-arrow-down"></i>
                                        <span class="menu-text">
                                            Fournisseur 
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Tiers : Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@listFournisseur') ?>"> Liste des Fournisseurs</a>   <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Tiers : Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@etatFournisseur') ?>"> Extrait Auxiliaire Fournisseur</a>   <b class="arrow"></b>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-arrow-down"></i>
                                        <span class="menu-text">
                                            Client 
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Tiers : Client")) echo 'disabledbutton' ?>" href="<?php echo url_for('@listClient') ?>">Liste des  Clients</a>  </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Tiers : Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@etatClient') ?>"> Extrait Auxiliaire Client</a>   <b class="arrow"></b>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>


                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Tiers : Banque et Caisse")) echo '' ?>" href="<?php echo url_for('tiers/listBanqueCaisse') ?>"> Banque & Caisse</a></li>
                            </ul>
                        </li>
                        <li>
                            <a id="id-btn-dialog1" onclick="showModal()">
                                <i class="menu-icon fa fa-refresh"></i>
                                <span class="menu-text">
                                    Dossier Comptable
                                </span>
                            </a>
                        </li>
                        <!--                        <li>
                        
                                                    <a id="id-btn-dialog1" 
                                                       href="<?php // echo url_for('@referentielcomptable')                             ?>">
                                                        <i class="menu-icon fa fa-file"></i>
                                                        <span class="menu-text">
                                                            Référentiel  Comptable
                                                        </span>
                                                    </a>
                                                </li>-->
                        <li class="hover">
                            <a href="">
                                <i class="menu-icon fa fa-file"></i>
                                <span class="menu-text">
                                    Référentiel
                                </span>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Referentiel Comptable : referentiel Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('@referentielcomptable') ?>">Référentiels Comptables </a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Referentiel Comptable : dossier utile Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('@dossierutile') ?>">Dossiers Utilies</a></li>

                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Referentiel Comptable :  piece jurudique")) echo 'disabledbutton' ?>" href="<?php echo url_for('@piecejuridique') ?>">Aperçu Pièces Juridiques</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->