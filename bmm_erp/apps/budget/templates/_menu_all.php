<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_budget = $user->getProfilApplication("Unité Budget"); ?>
                <?php if ($acces_budget): ?>
                    <ul class="nav nav-list">
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cog "></i>
                                <span class="menu-text"> Paramètres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Paramètre : Projet")) echo 'disabledbutton' ?>" href="<?php echo url_for('@exercice') ?>">Exercice</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Paramètre : Projet")) echo 'disabledbutton' ?>" href="<?php echo url_for('@projet') ?>">Projet</a></li>

                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Paramètre : Type Pièce Jointe")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typepiecejointbudget') ?>">Type Piéce Jointe</a></li>

                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Paramètre : Type de Transfert")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typetransfert') ?>">Type de Transfert</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Paramètre : Retenue à la Source")) echo 'disabledbutton' ?>" href="<?php echo url_for('@retenuesource') ?>">Retenue à la Source</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Paramètre : Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@fournisseur') ?>">Fournisseur</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Paramètre : Compte/Budget")) echo 'disabledbutton' ?>" href="<?php echo url_for('@lignebanquecaisse') ?>">Param. Compte/Budget</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!--documentbudget-->
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-file-text"></i>
                                <span class="menu-text"> Budgets </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                            <li class="">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Budget Prototype
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModuleAction($acces_budget->getId(), "Budgets Prototypes", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('Prototype/new') ?>">Nouvelle Fiche Prototype </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Budgets Prototypes")) echo 'disabledbutton' ?>" href="<?php echo url_for('@titrebudjet_Prototype') ?>">Liste des Budgets Prototypes</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Budgets Prototypes")) echo 'disabledbutton' ?>" href="<?php echo url_for('@importbudget') ?>">Import Budgets</a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>
                                <li class="">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Budget Définitif
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModuleAction($acces_budget->getId(), "Budgets Définitifs", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/new') ?>">Nouvelle Fiche</a>
                                            <b class="arrow"></b>
                                        </li> 
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Budgets Définitifs")) echo 'disabledbutton' ?>" href="<?php echo url_for('@titrebudjet') ?>">Liste des Budgets/Tranche</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Budgets Définitifs")) echo 'disabledbutton' ?>" href="<?php echo url_for('@titrebudjet_Budgetdefinitif') ?>">Liste des Budgets Définitifs</a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>
                                <?php //if ($_SESSION['exercice_budget'] == date('Y')): ?>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Situation Engagements")) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/situationEngagement') ?>">Situation Engagements</a></li>
                                    <li class="">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Récapitulatif d'Engage.
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <?php $acces_engage = $user->getProfilModule($acces_budget->getId(), "Récapitulatif d'Engagements"); ?>
                                        <ul class="submenu">
                                            <?php if ($_SESSION['exercice_budget'] == date('Y')): ?>
                                                <li class="hover">
                                                    <a class="<?php if (!$acces_engage) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/recapCourant') ?>">Courant</a>
                                                    <b class="arrow"></b>
                                                </li>
                                            <?php endif; ?>
                                            <li class="hover">
                                                <a class="<?php if (!$acces_engage) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/recapFinMois') ?>">Fin du Mois</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Récap. des Dépenses
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <?php $acces_depense = $user->getProfilModule($acces_budget->getId(), "Récapitulatif des Dépenses"); ?>
                                        <ul class="submenu">
                                            <?php //if ($_SESSION['exercice_budget'] == date('Y')): ?>
                                                <li class="hover">
                                                    <a class="<?php if (!$acces_depense) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/recapDepenseCourant') ?>">Courant</a>
                                                    <b class="arrow"></b>
                                                </li>
                                            <?php //endif; ?>
                                            <li class="hover">
                                                <a class="<?php if (!$acces_depense) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/recapDepenseFinMois') ?>">Fin du Mois</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Situation Cumulée
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <?php $acces_cumulee = $user->getProfilModule($acces_budget->getId(), "Situation Cumulée"); ?>
                                        <ul class="submenu">
                                            <li class="hover">
                                                <a class="<?php if (!$acces_cumulee) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/situationCumulee') ?>">Traiter Antécédent</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$acces_cumulee) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/recapSituationCumulee') ?>">Etat Récapitulatif</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Engage. Antécédent
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <?php $acces_antecedent = $user->getProfilModule($acces_budget->getId(), "Engagement Antécédent"); ?>
                                        <ul class="submenu">
                                            <li class="hover">
                                                <a class="<?php if (!$acces_antecedent) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/engagementAntecedent') ?>">Ajouter Antécédent</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$acces_antecedent) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/etatEngagementAntecedent') ?>">Etat</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                <?php //endif; ?>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <?php //if ($_SESSION['exercice_budget'] == date('Y')): ?>
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa-exchange "></i>
                                    <span class="menu-text"> Transfert Rubrique </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li><a class="<?php if (!$user->getProfilModuleAction($acces_budget->getId(), "Transfert Rubrique", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('transfertbudget/new') ?>">Nouv. Fiche Transfert</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Transfert Rubrique")) echo 'disabledbutton' ?>" href="<?php echo url_for('transfertbudget/index') ?>">Liste des Transferts</a></li>

                                    <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Transfert Rubrique")) echo 'disabledbutton' ?>" href="<?php echo url_for('transfertbudget/index?etat=' . "Annulé(é)") ?>">Liste des Transferts Annulés</a></li>
                                </ul>
                                <!-- /.dropdown-user -->
                            </li>
                        <?php // endif; ?>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-pencil-square-o"></i>
                                <span class="menu-text"> Engagements Budget </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li class="">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Eng. Provisoires
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModuleAction($acces_budget->getId(), "Engagements Provisoires", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrs') ?>">Nouvelle Fiche Eng. Pr.</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Engagements Provisoires")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentbudget/index?idtype=3') ?>">Liste des Eng. Pr.</a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>
                                <li class="">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Eng. définitifs
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModuleAction($acces_budget->getId(), "Engagements Définitifs", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/bondefinitif?idtype=7') ?>">Nouvelle F. Eng. Df.</a>
                                            <b class="arrow"></b>
                                        </li>
                                         <li class="hover">
                                            <a class="<?php if (!$user->getProfilModuleAction($acces_budget->getId(), "Engagements Définitifs", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/preengagementSansBCII') ?>">Nouvelle F. Eng. Df.<br>Sans BCI</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <!--<a class="<?php //if (!$user->getProfilModuleAction($acces_budget->getId(), "Engagements Définitifs", "Création")) echo 'disabledbutton' ?>" href="<?php // echo url_for('Documents/preengagementSansBCI') ?>">Nouvelle F. Eng. Df.<br>Sans BCI</a>-->
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Engagements Définitifs")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentbudget_DocumentDef') ?>">Liste des Eng. Df.</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Engagements Définitifs")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentbudget/index?idtype=1&paye=non') ?>">Liste des Documents Budgets </a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <?php // endif; ?>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-file-text-o"></i>
                                <span class="menu-text">Ordonnance de Paiement</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <?php $acces_creation_ordonnance = $user->getProfilModuleAction($acces_budget->getId(), "Ordonnance de Paiement", "Création"); ?>
                            <ul class="submenu">
                                <li><a class="<?php if (!$acces_creation_ordonnance) echo 'disabledbutton' ?>" href="<?php echo url_for('documentbudget/newordenanaceparfour?idtype=2') ?>">Nouvelle Fiche de Paiement / Rubrique</a></li>
                                <li><a class="<?php if (!$acces_creation_ordonnance) echo 'disabledbutton' ?>" href="<?php echo url_for('documentbudget/ordonnancefournisseur') ?>">Nouvelle Fiche de Paiement / Fournisseur</a></li>
                                <!--<li><a class="<?php //if (!$acces_creation_ordonnance) echo 'disabledbutton' ?>" href="<?php // echo url_for('documentbudget/newordonancehorsBCI?idtype=2') ?>">Nouvelle Fiche de Paiement / HORS BCI</a></li>-->
                                
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Ordonnance de Paiement")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentbudget_Ordonnancement') ?>">Liste des Fiches des Ordonnancements</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Ajustement sur les Factures")) echo 'disabledbutton' ?>" href="<?php echo url_for('annulationengagement') ?>">Liste des Ajustements sur Factures</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Rapport des Sous Rubriques")) echo 'disabledbutton' ?>" href="<?php echo url_for('ligprotitrub/rapportSousRubrique') ?>">Rapport des Sous Rubriques</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-bank "></i>
                                <span class="menu-text"> Mouvements Facturation </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <?php $acces_journal = $user->getProfilModule($acces_budget->getId(), "Mouvements Facturation"); ?>
                            <ul class="submenu">
                                <li><a class="<?php if (!$acces_journal) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal?idtype=7') ?>">Journal des Mvts B.C.E</a></li>
                                <li><a class="<?php if (!$acces_journal) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal?idtype=2') ?>">Journal des Mvts B.D.C</a></li>
                                <li><a class="<?php if (!$acces_journal) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal?idtype=19') ?>">Journal des Mvts Contrat</a></li>
                                <li><a class="<?php if (!$acces_journal) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal') ?>">Journal des Mouvements</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-star"></i>
                                <span class="menu-text">Certificat de Retenue</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Certificat de Retenue")) echo 'disabledbutton' ?>" href="<?php echo url_for('certificatretenue') ?>">Liste des Certificats</a></li>
                                <li><a class="<?php if (!$user->getProfilModuleAction($acces_budget->getId(), "Liste des Déclarations", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('declaration/new') ?>">Nouvelle Déclaration</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Liste des Déclarations")) echo 'disabledbutton' ?>" href="<?php echo url_for('declaration') ?>">Liste des Déclarations</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <?php //if ($_SESSION['exercice_budget'] != date('Y')): ?>
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa-file-text-o"></i>
                                    <span class="menu-text">Achat Antécédent</span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li><a class="<?php if (!$user->getProfilModuleAction($acces_budget->getId(), "Achat Antécédent : Bon de Commande Interne", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/new?idtype=6') ?>"><i class="fa fa-file-o fa-fw"></i> N. Fiche Demande Interne</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Achat Antécédent : Bon de Commande Interne")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=6') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste Demande Interne</a></li>
                                    <li class="">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            B. Commande Externe
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu">
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Achat Antécédent : Liste B.C.E Définitifs")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexAchatfrs?idtype=7') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.C.E. Définitifs</a> 
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Achat Antécédent : Liste B.C.E Provisoires")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexAchatfrs?idtype=18') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.C.E. Provisoires</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            B. de Dépense au comptant
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu">
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Achat Antécédent : Liste B.D.C Définitifs")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexAchatfrs?idtype=2') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.D.C. Définitifs</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Achat Antécédent : Liste B.D.C Provisoires")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexAchatfrs?idtype=17') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste B.D.C. Provisoires</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <!-- /.dropdown-user -->
                            </li>
                        <?php // endif; ?>
                        <li>
                            <a id="id-btn-dialog1" onclick="showModal()">
                                <i class="menu-icon fa fa-refresh"></i>
                                <span class="menu-text">Exercice</span>
                            </a>
                        </li>
                       
                            <li class="hover">
                        <a class="dropdown-toggle" href="#">
                            <i class="menu-icon fa fa-file-text"></i>
                                <span class="menu-text">Marchés</span>
                            </a>
                            <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php //if (!$user->getProfilModule($acces_budget->getId(), "formulaire budget")) echo 'disabledbutton' ?>" 
                                href="<?php echo url_for('@marches') ?>" >Liste des Fiches Marchés</a></li>
                                </ul>   

                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-desktop"></i>
                                <span class="menu-text"> Tableau de Bord </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <ul class="submenu">

                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/showSuivicommande') ?>" >Suivi des bons Commandes</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/showSuivibdc') ?>" >Suivi des Bons dépense a comptant</a></li>
                                <!-- <li><a class="<?php //if (!$user->getProfilModule($acces_budget->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php //echo url_for('accueil/showSuivibdcRegroupe') ?>" >Suivi des Bons dépense a comptant Regroupes</a></li> -->
                                <!--<li><a class="<?php // if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton'   ?>" href="<?php // echo url_for('Accueil/showSuivicontratlivraisontotal')         ?>" >Suivi des Contrats</a></li>-->
                             <!--<li><a class="<?php // if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton'   ?>" href="<?php // echo url_for('Accueil/showSuivicontrat')         ?>" >Suivi les Contrat bci test </a></li>-->
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/showSuiviBcicontrat') ?>" >Suivi les BCI/Contrat</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/showSuivicontrattotal') ?>" >Suivi des Contrats</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/tableauBord') ?>" >Tab.de Bord Contrats</a></li>
                            </ul>
                        </li>
                        <li>
                        <a class="<?php //if (!$user->getProfilModule($acces_budget->getId(), "Import operation budget")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/import') ?>">
                        <i class="menu-icon fa fa-upload"></i>
                            <span class="menu-text"> Import opération budget </span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                    </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->