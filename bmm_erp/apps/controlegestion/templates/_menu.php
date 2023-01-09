<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php if ($_SESSION['statistique'] == 0) : ?>
                    <?php $acces_controle = $user->getProfilApplication("Unité Contrôle Budgétaire"); ?>
                    <?php if ($acces_controle) : ?>
                        <ul class="nav nav-list">
                            <!--accueil-->
                            <li>
                                <a href="<?php echo url_for('@homepage') ?>">
                                    <i class="menu-icon fa fa-home"></i>
                                    <span class="menu-text"> accueil </span>
                                </a>
                            </li>
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa  fa-cog"></i>
                                    <span class="menu-text"> Paramètres Globaux </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_controle->getId(), "Paramètre : Exercice")) echo 'disabledbutton' ?>" href="<?php echo url_for('@exercice') ?>">Exercice Budget</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_controle->getId(), "Paramètre : Sources Budget")) echo 'disabledbutton' ?>" href="<?php echo url_for('@sourcesbudget') ?>">Origine de finanacement </a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_controle->getId(), "Paramètre : Catégorie Budget")) echo 'disabledbutton' ?>" href="<?php echo url_for('@categorietitre') ?>">Catégorie Budget</a></li>
                                </ul>
                                <!-- /.dropdown-user -->
                            </li>
                            <li>
                                <a href="<?php echo url_for('@annexebudget') ?>">
                                    <i class="menu-icon fa fa-table"></i>
                                    <span class="menu-text"> Annexes Budgétaires </span>
                                </a>
                            </li>
                            <!--Budget-->
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa-money"></i>
                                    <span class="menu-text"> Budgets </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                <li class="active open hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Budget Prototype
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModuleAction($acces_controle->getId(), "Budgets Prototypes", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('prototype/new') ?>">Nouvelle Fiche Prototype </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_controle->getId(), "Budgets Prototypes")) echo 'disabledbutton' ?>" href="<?php echo url_for('prototype') ?>">Liste des Budgets Prototypes</a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>
                                    
                                    <li class="active open hover">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Budget Prévisionnel
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu" style="">
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModuleAction($acces_controle->getId(), "Budget : Budget Définitif", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/index?type=Budget Prévisionnel') ?>">Budget / Direction & Projet</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModuleAction($acces_controle->getId(), "Budget : Budget Définitif", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('budgetprevglobal') ?>">Budget Prévisionnel Global</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_controle->getId(), "Budget : Budget Définitif")) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/index?type=Final') ?>">Liste des Budgets Finaux</a></li>
                                </ul>
                                <!-- /.dropdown-user -->
                            </li>
                            <!--Suivi Budgétaire-->
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa-eye"></i>
                                    <span class="menu-text"> Suivi Budgétaire </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li><a class="<?php if (!$user->getProfilModule($acces_controle->getId(), "Budget : Transfert")) echo 'disabledbutton' ?>" href="<?php echo url_for('transfertbudget/index') ?>">Liste des Transferts</a></li>
                                    <li class="active open hover">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Engagements
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu" style="">
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_controle->getId(), "Budget : Engagement Provisoire")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentbudget/index?idtype=3') ?>">Liste des Engagements Provisoires</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_controle->getId(), "Budget : Engagement Définitif")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentbudget/index?idtype=1') ?>">Liste des Engagements Définitifs</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_controle->getId(), "Budget : Certificat de Retenue")) echo 'disabledbutton' ?>" href="<?php echo url_for('certificatretenue') ?>">Liste des Certificats de Retenue</a></li>
                                    <li class="active open hover">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Ordon. de Paiement
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu" style="">
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_controle->getId(), "Budget : Ordonnance de Paiement")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentbudget/index?idtype=2') ?>">Liste des Paiements</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_controle->getId(), "Budget : Ajustement sur Facture")) echo 'disabledbutton' ?>" href="<?php echo url_for('annulationengagement') ?>">Liste des Ajustements sur Factures</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_controle->getId(), "Rapport des Sous Rubriques")) echo 'disabledbutton' ?>" href="<?php echo url_for('ligprotitrub/rapportSousRubrique') ?>">Rapport des Sous Rubriques</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="active open hover">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Mvts Facturation
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu" style="">
                                            <?php $acces_bce = $user->getProfilModule($acces_controle->getId(), "Budget : Mouvement B.C.E"); ?>
                                            <li class="hover">
                                                <a class="<?php if (!$acces_bce) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal?idtype=7') ?>">Journal des Mvts B.C.E</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <?php $acces_bdc = $user->getProfilModule($acces_controle->getId(), "Budget : Mouvement B.D.C"); ?>
                                            <li class="hover">
                                                <a class="<?php if (!$acces_bdc) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal?idtype=2') ?>">Journal des Mvts B.D.C</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <?php $acces_contrat = $user->getProfilModule($acces_controle->getId(), "Budget : Mouvement Contrat"); ?>
                                            <li class="hover">
                                                <a class="<?php if (!$acces_contrat) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal?idtype=19') ?>">Journal des Mvts Contrat</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$acces_bce || !$acces_bdc || !$acces_contrat) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal') ?>">Journal des Mouvements</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <!-- /.dropdown-user -->
                            </li>
                            <!--Récapitulatif Budgétaire-->
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa-file-text-o"></i>
                                    <span class="menu-text"> Récap. Budgétaire </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="active open hover">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Engagement
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <?php $acces_engagement = $user->getProfilModule($acces_controle->getId(), "Budget : Récapitulatif Engagement"); ?>
                                        <ul class="submenu">
                                            <li class="hover">
                                                <a class="<?php if (!$acces_engagement) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/recapCourant') ?>">Courant</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$acces_engagement) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/recapFinMois') ?>">Fin du Mois</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="active open hover">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Dépenses
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <?php $acces_depense = $user->getProfilModule($acces_controle->getId(), "Budget : Récapitulatif Dépenses"); ?>
                                        <ul class="submenu">
                                            <li class="hover">
                                                <a class="<?php if (!$acces_depense) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/recapDepenseCourant') ?>">Courant</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$acces_depense) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/recapDepenseFinMois') ?>">Fin du Mois</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="hover">
                                        <a class="<?php if (!$user->getProfilModule($acces_controle->getId(), "Budget : Situation Cumulée")) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/recapSituationCumulee') ?>">Situation Cumulée</a>
                                        <b class="arrow"></b>
                                    </li>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                        </li>
                        <!--Exercice-->
                        <li>
                            <a id="id-btn-dialog1" onclick="showModal()">
                                <i class="menu-icon fa fa-refresh"></i>
                                <span class="menu-text">Exercice</span>
                            </a>
                        </li>
                        </ul>
                    <?php endif; ?>
                <?php elseif ($_SESSION['statistique'] == 1) : ?>
                    <?php $acces_suivi = $user->getProfilApplication("Unité Statistiques et Suivi"); ?>
                    <?php if ($acces_suivi) : ?>
                        <ul class="nav nav-list">
                            <!--accueil-->
                            <li>
                                <a href="<?php echo url_for('@homepage?stat=1') ?>">
                                    <i class="menu-icon fa fa-home"></i>
                                    <span class="menu-text"> accueil </span>
                                </a>
                            </li>
                            <!--Patrimoine-->
                            <li class="hover" id="menu_stat">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa-bank "></i>
                                    <span class="menu-text"> Patrimoine </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Patrimoine : Investissement Global / Site")) echo 'disabledbutton' ?>" href="<?php echo url_for('immobilisation/statistique?toussite=1') ?>">INVESTISSEMENT GLOBAL/SITE</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Patrimoine : Investissement Global / Type")) echo 'disabledbutton' ?>" href="<?php echo url_for('immobilisation/statistique?tous=1') ?>">INVESTISSEMENT GLOBAL/TYPE</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Patrimoine : Investissement Global / Locaux")) echo 'disabledbutton' ?>" href="<?php echo url_for('immobilisation/statistique?touslocal=1') ?>">INVESTISSEMENT GLOBAL/LOCAUX</a></li>

                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Patrimoine : Investissement / Catégorie")) echo 'disabledbutton' ?>" href="<?php echo url_for('immobilisation/statistique?categorie=1') ?>">INVESTISSEMENT PAR GATEGORIES</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Patrimoine : Investissement / Famille et Catégorie")) echo 'disabledbutton' ?>" href="<?php echo url_for('immobilisation/statistique?famille=1') ?>">INVESTISSEMENT PAR FAMILLE&GATEGORIES</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Patrimoine : Investissement / Famille")) echo 'disabledbutton' ?>" href="<?php echo url_for('immobilisation/statistique?famillegeneral=1') ?>">INVESTISSEMENT PAR FAMILLE </a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Patrimoine : Investissement / Sous Famille et Famille")) echo 'disabledbutton' ?>" href="<?php echo url_for('immobilisation/statistique?sfamille=1') ?>">INVESTISSEMENT PAR SOUS FAMILLE&FAMILLE</a></li>
                                </ul>
                            </li>
                            <!--Statistique Budget-->
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa fa-money"></i>
                                    <span class="menu-text"> Budget </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Budget : Rubrique Budgétaire")) echo 'disabledbutton' ?>" href="<?php echo url_for('rubrique/statistique') ?>">Rubrique Budgétaire</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Budget : Engagement Budgétaire / Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('rubrique/statistiqueFournisseur') ?>">Engagement Budgétaire / Fournisseur</a></li>
                                </ul>
                            </li>
                            <!--Statistique Marché-->
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa fa-bullhorn"></i>
                                    <span class="menu-text"> Marchés </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="active open hover">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Progression Projet
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu" style="">
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Marché : Progression Projet par Quantité")) echo 'disabledbutton' ?>" href="<?php echo url_for('marches/statistiqueQuantite') ?>">Par Quantité</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Marché : Progression Projet par Montant")) echo 'disabledbutton' ?>" href="<?php echo url_for('marches/statistiqueMontant') ?>">Par Montant</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!--Statistique Banque & Caisse-->
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa fa-credit-card"></i>
                                    <span class="menu-text"> Banque & Caisse </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="active open hover">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Répartition Budgétaire
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu" style="">
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Banque et Caisse : Répartition Budgétaire par Caisse")) echo 'disabledbutton' ?>" href="<?php echo url_for('ligneoperationcaisse/statistiqueCaisse') ?>">Par Caisse</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Banque et Caisse : Répartition Budgétaire par Compte Bancaire")) echo 'disabledbutton' ?>" href="<?php echo url_for('mouvementbanciare/statistiqueBanque') ?>">Par Compte Bancaire</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!--Statistique Gestion Carrière & Ressources Humaines-->
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa fa-user"></i>
                                    <span class="menu-text"> R. Humaine </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="active open hover">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Situat° Administrative
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu" style="">
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Situation Administrative : Corps")) echo 'disabledbutton' ?>" href="<?php echo url_for('corps/statistiqueAgentParCorps') ?>"> Par Corps</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Situation Administrative : Sous Corps")) echo 'disabledbutton' ?>" href="<?php echo url_for('souscorps/statistiqueAgentParSouscorps') ?>"> Par Sous Corps</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Situation Administrative : Catégorie")) echo 'disabledbutton' ?>" href="<?php echo url_for('categorierh/statistiqueAgentParCategorie') ?>"> Par Catégorie</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Situation Administrative : Grade")) echo 'disabledbutton' ?>" href="<?php echo url_for('grade/statistiqueAgentParGrade') ?>"> Par Grade</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Situation Administrative : Echelle")) echo 'disabledbutton' ?>" href="<?php echo url_for('echelle/statistiqueAgentParEchelle') ?>"> Par Echelle</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Situation Administrative : Echelon")) echo 'disabledbutton' ?>" href="<?php echo url_for('echelon/statistiqueAgentParEchelon') ?>"> Par Echelon</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="active open hover">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Par Hiérarchie
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu" style="">
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Hiérarchie : Direction")) echo 'disabledbutton' ?>" href="<?php echo url_for('direction/statistiqueAgentParDirection') ?>"> Par Direction</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Hiérarchie : Sous Direction")) echo 'disabledbutton' ?>" href="<?php echo url_for('sousdirection/statistiqueAgentParSousdirection') ?>"> Par Sous Direction</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Hiérarchie : Service")) echo 'disabledbutton' ?>" href="<?php echo url_for('servicerh/statistiqueAgentParService') ?>"> Par Service</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Hiérarchie : Unité")) echo 'disabledbutton' ?>" href="<?php echo url_for('unite/statistiqueAgentParUnite') ?>">Par Unité</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Hiérarchie : Poste")) echo 'disabledbutton' ?>" href="<?php echo url_for('posterh/statistiqueAgentParPoste') ?>">Par Poste</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>

                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H : Fonction")) echo 'disabledbutton' ?>" href="<?php echo url_for('fonction/statistiqueAgentParFonction') ?>">Par Fonction</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H : Situation Administrative")) echo 'disabledbutton' ?>" href="<?php echo url_for('typecontrat/statistiqueAgentParTypeContrat') ?>">Par Situat° administrative</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H : Sexe")) echo 'disabledbutton' ?>" href="<?php echo url_for('agents/statistiqueAgentParSexe') ?>">Par Sexe</a></li>
                                    <li class="active open hover">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Formation
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu">
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Formation : Par Agent")) echo 'disabledbutton' ?>" href="<?php echo url_for('evaluation/statistiqueEvaluationAgent') ?>">Statistiques (Par Agent)</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="active open hover">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            S. Présence & Congé
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu">
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Présence et Congé : Présence / Agent")) echo 'disabledbutton' ?>" href="<?php echo url_for('conge/statistiquePrsenceAgent'); ?>">Présence Par Agent</a>
                                                <b class="arrow"></b>
                                            </li>
                                            <li class="hover">
                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Présence et Congé : Absence / Agent")) echo 'disabledbutton' ?>" href="<?php echo url_for('conge/statistiqueAbsenceAgent'); ?>">Absence Par Agent</a>
                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!--Suivi Financier-->
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa fa-shopping-cart"></i>
                                    <span class="menu-text"> Suivi Financier </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <!--Banques & Caisses-->
                                    <li class="hover">
                                        <a href="#" class="dropdown-toggle">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Banques & Caisses
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu">
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Trésorerie : Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@fournisseur'); ?>">Liste des Fournisseurs</a></li>
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Trésoreries
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Trésorerie : Compte et Caisses")) echo 'disabledbutton' ?>" href="<?php echo url_for('caissesbanques') ?>">Liste des Comptes & Caisses</a></li>
                                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Trésorerie : Paramètre Compte et Caisse par Budget")) echo 'disabledbutton' ?>" href="<?php echo url_for('@lignebanquecaisse') ?>">Param. Compte & Caisse par Budget</a></li>
                                                </ul>
                                            </li>
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Doc. de Paiement
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Trésorerie : Document de Paiement")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentbudget') ?>">Liste des documents de Paiement</a></li>
                                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Trésorerie : Déclaration")) echo 'disabledbutton' ?>" href="<?php echo url_for('declaration') ?>">Liste des Déclarations</a></li>
                                                </ul>
                                            </li>
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Documents Achats
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Trésorerie : B.D. Comptant Provisoire")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrs?idtype=17') ?>">Liste Bon de dépenses au comptant provisoires</a></li>
                                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Trésorerie : B.D. Comptant")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrs?idtype=2') ?>">Liste Bon de dépenses au comptant</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Trésorerie : Quittance")) echo 'disabledbutton' ?>" href="<?php echo url_for('ligneoperationcaisse/index?categorie=1'); ?>">Quittances Provisoires & Définitives</a></li>
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Consultations & Mvts
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Trésorerie : Relevé des Mouvements")) echo 'disabledbutton' ?>" href="<?php echo url_for('mouvementbanciare') ?>">Relevé des mouvements</a></li>
                                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Trésorerie : Journal des Mouvements")) echo 'disabledbutton' ?>" href="<?php echo url_for('mouvementbanciare/journal') ?>">Journal des mouvements</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Trésorerie : Bordereau des Virements")) echo 'disabledbutton' ?>" href="<?php echo url_for('bordereauvirement') ?>">Bordereau des Virements</a></li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Trésorerie : Rapprochement")) echo 'disabledbutton' ?>" href="<?php echo url_for('mouvementbanciare/rapprochement') ?>">Rapprochement</a></li>
                                        </ul>
                                    </li>
                                    <!--Patrimoine-->
                                    <li class="hover">
                                        <a class="dropdown-toggle" href="#">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            <span class="menu-text"> Patrimoine </span>
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu">
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Patrimoine : Immobilisation")) echo 'disabledbutton' ?>" href="<?php echo url_for('@immobilisation') ?>">Gestion d'immobilisations</a></li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Patrimoine : Immobilisation / Type Affectation")) echo 'disabledbutton' ?>" href="<?php echo url_for('immobilisation/listeType') ?>">Imm. / Type Affectation</a></li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Patrimoine : Tableau Amortissement")) echo 'disabledbutton' ?>" href="<?php echo url_for('@tableauxammortisement') ?>">Tableau Amortissement</a></li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Patrimoine : Tableau de Variation des Immobilisations")) echo 'disabledbutton' ?>" href="<?php echo url_for('tableauxammortisement/variation') ?>">Tableau de Variation des Immobilisations</a></li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Patrimoine : Export Liste")) echo 'disabledbutton' ?>" href="<?php echo url_for('immobilisation/statistiquedate') ?>">Export Liste</a></li>
                                        </ul>
                                        <!-- /.dropdown-user -->
                                    </li>
                                    <!--Finance-->
                                    <li class="hover">
                                        <a class="dropdown-toggle" href="#">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            <span class="menu-text"> Finance </span>
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu">
                                            <!--Achat-->
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Achats
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Finance Achat : B.C. Interne")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=6') ?>">Liste des B.C. Internes</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Finance Achat : Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@fournisseur') ?>">Liste des Fournisseurs</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Finance Achat : Avis Budgétaire / B.C.I")) echo 'disabledbutton' ?>" href="<?php echo url_for('@ligavisdoc') ?>">Avis Budgétaire / B.C.I</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Finance Achat : Avis Budgétaire / Rubrique Budgétaire")) echo 'disabledbutton' ?>" href="<?php echo url_for('ligavisdoc/bciRubrique') ?>">Avis Budgétaire/Rubrique Budgétaire</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Finance Achat : B.C.E.S et B.D.C.S / Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/documentProvisoireFournisseur') ?>">B.C.E.S & B.D.C.S Provisoires</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Finance Achat : B.C.E.S et B.D.C.S / Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/documentFournisseur') ?>">B.C.E.S & B.D.C.S / Fournisseur</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Import Achat")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/import') ?>">Import Achat</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/showSuivicommande') ?>">Suivi des bons Commandes</a></li>
                                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/showSuivibdc') ?>">Suivi des Bons dépense a comptant</a></li>
                                                </ul>
                                            </li>
                                            <!--Marchee-->
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Marchés
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Finance Marché : B.C. Interne M.P")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=9') ?>">Liste B.C.Interne M.P</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Finance Marché : Fiche Marché")) echo 'disabledbutton' ?>" href="<?php echo url_for('@marches') ?>">Liste des Fiches Marchés</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Finance Marché : Bénéficiaire")) echo 'disabledbutton' ?>" href="<?php echo url_for('@lots') ?>">Liste des Bénéficiaire</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!--Facturation-->
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Facturation
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu">
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Finance Facturation : Décompte Marché")) echo 'disabledbutton' ?>" href="<?php echo url_for('lots/index') ?>">Décomptes Marchés</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Finance Facturation : Facture")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=15') ?>">Liste des Factures</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="active open hover">
                                                        <a href="#" class="dropdown-toggle">
                                                            <i class="menu-icon fa fa-caret-right"></i>
                                                            Consultaions & Mvts
                                                            <b class="arrow fa fa-angle-down"></b>
                                                        </a>
                                                        <b class="arrow"></b>
                                                        <ul class="submenu">
                                                            <?php $acces_facture_bce = $user->getProfilModule($acces_suivi->getId(), "Finance Facturation : Mouvement B.C.E"); ?>
                                                            <li class="hover">
                                                                <a class="<?php if (!$acces_facture_bce) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal?idtype=7') ?>">Journal des Mvts B.C.E</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <?php $acces_facture_bdc = $user->getProfilModule($acces_suivi->getId(), "Finance Facturation : Mouvement B.D.C"); ?>
                                                            <li class="hover">
                                                                <a class="<?php if (!$acces_facture_bdc) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal?idtype=2') ?>">Journal des Mvts B.D.C</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <?php $acces_facture_contrat = $user->getProfilModule($acces_suivi->getId(), "Finance Facturation : Mouvement Contrat"); ?>
                                                            <li class="hover">
                                                                <a class="<?php if (!$acces_facture_contrat) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal?idtype=19') ?>">Journal des Mvts Contrat</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$acces_facture_bce || !$acces_facture_bdc || !$acces_facture_contrat) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvementfacturation/journal') ?>">Journal des Mouvements</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!--Suivi R.H-->
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa fa-user"></i>
                                    <span class="menu-text"> Suivi R.H </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <!--Gestion Carrière & Ressources Humaines-->
                                    <li class="hover">
                                        <a class="dropdown-toggle" href="#">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            <span class="menu-text"> G. Carrière & R. Hum. </span>
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu">
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Hiérarchie
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Hiérarchie : Direction")) echo 'disabledbutton' ?>" href="<?php echo url_for('@direction') ?>">Direction</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Hiérarchie : Sous Direction")) echo 'disabledbutton' ?>" href="<?php echo url_for('@sousdirection') ?>">Sous Direction</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Hiérarchie : Service")) echo 'disabledbutton' ?>" href="<?php echo url_for('@servicerh') ?>">Service</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Hiérarchie : Unité")) echo 'disabledbutton' ?>" href="<?php echo url_for('@unite') ?>">Unité</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Hiérarchie : Poste")) echo 'disabledbutton' ?>" href="<?php echo url_for('@posterh') ?>">Poste</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Hiérarchie : Tâche")) echo 'disabledbutton' ?>" href="<?php echo url_for('@taches') ?>">Tâche</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Classification
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li class="active open hover">
                                                        <a class href="#" class="dropdown-toggle">
                                                            <i class="menu-icon fa fa-caret-right"></i>
                                                            Par S° Administrative
                                                            <b class="arrow fa fa-angle-down"></b>
                                                        </a>
                                                        <b class="arrow"></b>
                                                        <ul class="submenu" style="">
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Filière")) echo 'disabledbutton' ?>" href="<?php echo url_for('@corps') ?>">Filières</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Corps")) echo 'disabledbutton' ?>" href="<?php echo url_for('@corpsdet') ?>">Corps</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Sous Corps")) echo 'disabledbutton' ?>" href="<?php echo url_for('@souscorps') ?>">Sous Corps</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Grade")) echo 'disabledbutton' ?>" href="<?php echo url_for('@grade') ?>">Grades</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Catégorie")) echo 'disabledbutton' ?>" href="<?php echo url_for('@categorierh') ?>">Catégories</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Echelon")) echo 'disabledbutton' ?>" href="<?php echo url_for('@echelon') ?>">Echelons</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Echelle")) echo 'disabledbutton' ?>" href="<?php echo url_for('@echelle') ?>">Echelles</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Grille de Salaire")) echo 'disabledbutton' ?>" href="<?php echo url_for('salairedebase/new') ?>">Grille de Salaire</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Titre Prime")) echo 'disabledbutton' ?>" href="<?php echo url_for('@titreprimes') ?>">Titres Primes</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Prime")) echo 'disabledbutton' ?>" href="<?php echo url_for('@primes') ?>">Primes</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Etat Civil")) echo 'disabledbutton' ?>" href="<?php echo url_for('@etatcivil') ?>">Etat Civil</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="active open hover">
                                                        <a class href="#" class="dropdown-toggle">
                                                            <i class="menu-icon fa fa-caret-right"></i>
                                                            Par C.V
                                                            <b class="arrow fa fa-angle-down"></b>
                                                        </a>
                                                        <b class="arrow"></b>
                                                        <ul class="submenu" style="">
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Diplôme")) echo 'disabledbutton' ?>" href="<?php echo url_for('@diplome') ?>">Diplômes</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Spécialité")) echo 'disabledbutton' ?>" href="<?php echo url_for('@specialite') ?>">Spécialités</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Langue")) echo 'disabledbutton' ?>" href="<?php echo url_for('@langues') ?>">Langues</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Classification : Formation Continue")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typeexperience') ?>">Formations Continues</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Personnels
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu">
                                                    <li class="active open hover">
                                                        <a class="dropdown-toggle" href="#">
                                                            <i class="menu-icon fa fa-caret-right"></i>
                                                            Fiche Personnel
                                                            <b class="arrow fa fa-angle-down"></b>
                                                        </a>
                                                        <b class="arrow"></b>
                                                        <?php $regreppement_agents_menus = RegroupementagentsTable::getInstance()->findAll(); ?>
                                                        <?php $acces_personnel = $user->getProfilModule($acces_suivi->getId(), "R.H Personnel : Fiche Personnel"); ?>
                                                        <ul class="submenu">
                                                            <li class="hover">
                                                                <a class="<?php if (!$acces_personnel) echo 'disabledbutton' ?>" href="<?php echo url_for('@agents') ?>">Tous</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <?php foreach ($regreppement_agents_menus as $regreppement_agents_menu) : ?>
                                                                <li class="hover">
                                                                    <a class="<?php if (!$acces_personnel) echo 'disabledbutton' ?>" href="<?php echo url_for('agents/indexRegroupement?reg=' . $regreppement_agents_menu->getId()) ?>"><?php echo $regreppement_agents_menu ?></a>
                                                                    <b class="arrow"></b>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Personnel : Fiche Carrière")) echo 'disabledbutton' ?>" href="<?php echo url_for('@contrat') ?>">Fiche Carrière</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Personnel : Fiche Discipline et Sanction")) echo 'disabledbutton' ?>" href="<?php echo url_for('@discipline') ?>">Fiche Discipline et Sanction</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Personnel : Médailles et récompenses")) echo 'disabledbutton' ?>" href="<?php echo url_for('@recompense') ?>">Fiche Médaille et Récompense</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Ouvriers Occasionnels
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li class="active open hover">
                                                        <a href="#" class="dropdown-toggle">
                                                            <i class="menu-icon fa fa-caret-right"></i>
                                                            Paramètres Globaux
                                                            <b class="arrow fa fa-angle-down"></b>
                                                        </a>
                                                        <b class="arrow"></b>
                                                        <ul class="submenu" style="">
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Ouvrier : Chantier")) echo 'disabledbutton' ?>" href="<?php echo url_for('@chantier') ?>">Chantiers <span style="float: right; margin-right: 10px;"> (الحضيرة)</span></a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Ouvrier : Spécialité")) echo 'disabledbutton' ?>" href="<?php echo url_for('@specialiteouvrier') ?>">Spécilaités <span style="float: right; margin-right: 10px;"> ( الاختصاص)</span></a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Ouvrier : Situation Administrative")) echo 'disabledbutton' ?>" href="<?php echo url_for('@situationadminouvrier') ?>"> Situat° admin. <span style="float: right; margin-right: 10px;"> (الوضع الإداري)<span></a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Ouvrier : Lieu Affectation")) echo 'disabledbutton' ?>" href="<?php echo url_for('@lieuaffectationouvrier') ?>">L. afféctations <span style="float: right; margin-right: 10px;"> (مكان العمل )<span></a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Ouvrier : Ouvrier")) echo 'disabledbutton' ?>" href="<?php echo url_for('@ouvrier') ?>">Fiche Ouvrier</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Ouvrier : Contrat")) echo 'disabledbutton' ?>" href="<?php echo url_for('@contratouvrier') ?>">Fiche Contrat</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Ouvrier : Pointage")) echo 'disabledbutton' ?>" href="<?php echo url_for('@salaireouvrier') ?>">Fiche Pointage</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Editions Personnels
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li class="active open hover">
                                                        <a href="#" class="dropdown-toggle">
                                                            <i class="menu-icon fa fa-caret-right"></i>
                                                            Fichiers de Base
                                                            <b class="arrow fa fa-angle-down"></b>
                                                        </a>
                                                        <b class="arrow"></b>
                                                        <ul class="submenu" style="">
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Edition : Liste Employés")) echo 'disabledbutton' ?>" href="#my-modalrecherche" role="button" data-toggle="modal">Liste des Employés</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Edition : Liste Employés / Situation")) echo 'disabledbutton' ?>" href="#my-modal1" role="button" data-toggle="modal">Liste des Employés / Situation</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="active open hover">
                                                        <a href="#" class="dropdown-toggle">
                                                            <i class="menu-icon fa fa-caret-right"></i>
                                                            Attestation
                                                            <b class="arrow fa fa-angle-down"></b>
                                                        </a>
                                                        <b class="arrow"></b>
                                                        <ul class="submenu" style="">
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Edition Attestation : Travail")) echo 'disabledbutton' ?>" href="<?php echo url_for('@attestationdetravail') ?>">de Travail </a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Edition Attestation : Salaire Annuel")) echo 'disabledbutton' ?>" href="<?php echo url_for('@attestationdesalaire') ?>">de Salaire Annuel</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover align_right_menu">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Edition Attestation : استرجاع مصاريف")) echo 'disabledbutton' ?>" style="padding-right: 10px;" class href="<?php echo url_for('@demandederemboursement') ?>">استرجاع مصاريف</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover align_right_menu">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Edition Attestation : استمارة فردية")) echo 'disabledbutton' ?>" style="padding-right: 10px;" class href="<?php echo url_for('@formulaire') ?>">استمارة فردية</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover align_right_menu">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Edition Attestation : بطاقة تشغيل")) echo 'disabledbutton' ?>" style="padding-right: 10px;" class href="<?php echo url_for('@attestationouvrier') ?>">بطاقة تشغيل</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover align_right_menu">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Edition Attestation : أمـر بمـهـمــة")) echo 'disabledbutton' ?>" style="padding-right: 10px;" class href="<?php echo url_for('@mission') ?>"> أمـر بمـهـمــة</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover align_right_menu">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Edition Attestation : مطلب إطلاع على ملف إداري")) echo 'disabledbutton' ?>" style="padding-right: 10px;" class href="<?php echo url_for('@demandedevoirfichieradmin') ?>">مطلب إطلاع على ملف إداري </a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                            <li class="hover align_right_menu">
                                                                <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "R.H Edition Attestation : ترخيص للقيام بعيادة طبية")) echo 'disabledbutton' ?>" style="padding-right: 10px;" class href="<?php echo url_for('autoristation') ?>">ترخيص للقيام بعيادة طبية</a>
                                                                <b class="arrow"></b>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <!--Formation-->
                                    <li class="hover">
                                        <a class="dropdown-toggle" href="#">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            <span class="menu-text"> Formation </span>
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu">
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Formation : Besoin de Formation")) echo 'disabledbutton' ?>" href="<?php echo url_for('@besoinsdeformation') ?>">Besoins de Formation</a></li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Formation : Planning Prévisionnel")) echo 'disabledbutton' ?>" href="<?php echo url_for('@planing') ?>">Planning Prévisionnel</a></li>
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Tableau de Bord
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Formation : Exécution Plan Définitif")) echo 'disabledbutton' ?>" href="#my-modalplan" role="button" onclick="insiliserselect()" data-toggle="modal">T.B.Execution Plan Défintif</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Formation : Suivi des Règlements")) echo 'disabledbutton' ?>" href="#my-modalplan2" role="button" onclick="insiliserselect()" data-toggle="modal">Suivi des Règlements</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Formation : Evaluation")) echo 'disabledbutton' ?>" href="<?php echo url_for('@evaluation') ?>">Evaluation</a></li>
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Editions
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Formation : Liste Agents")) echo 'disabledbutton' ?>" href="#my-modaledition-planning" role="button" data-toggle="modal">Liste des Agents</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Formation : Liste Formations")) echo 'disabledbutton' ?>" href="#my-modaleditionformation" role="button" data-toggle="modal">Liste des Formations</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <!--Suivi Présence & Congé-->
                                    <li class="hover">
                                        <a class="dropdown-toggle" href="#">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            <span class="menu-text"> S. Présence & Congé </span>
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu">
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Présence et Congé : Suivi de Présence")) echo 'disabledbutton' ?>" href="<?php echo url_for('@presence') ?>">Suivi de Présence</a></li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Présence et Congé : Demande de Congé")) echo 'disabledbutton' ?>" href="<?php echo url_for('@conge') ?>">Demande de Congé</a></li>
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Tableau de Bord
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Présence et Congé : T.B Suivi Demande Individuel")) echo 'disabledbutton' ?>" href="#my-modalsuivi" role="button" onclick="insiliserselect()" data-toggle="modal">Suivi Demande Individuel</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Présence et Congé : T.B Suivi Congé Individuel")) echo 'disabledbutton' ?>" href="#my-modalTB" role="button" onclick="insiliserselect()" data-toggle="modal">Suivi Congés Individuels </a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Présence et Congé : T.B Suivi Congé")) echo 'disabledbutton' ?>" href="<?php echo url_for('conge/recapsuivi') ?>">Suivi Congés</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Editions
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Présence et Congé : Liste des Suivis des Congés")) echo 'disabledbutton' ?>" href="#my-modaledition" role="button" data-toggle="modal">Liste des Suivis des Congés</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <!--Affaires Sociales-->
                                    <li class="hover">
                                        <a class="dropdown-toggle" href="#">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            <span class="menu-text"> A. Sociales </span>
                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>
                                        <b class="arrow"></b>
                                        <ul class="submenu">
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "A. Sociale : Demande Avance")) echo 'disabledbutton' ?>" href="<?php echo url_for('@demandeavance') ?>">Demande d'Avance</a></li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "A. Sociale : Demande Prêt Personnel")) echo 'disabledbutton' ?>" href="<?php echo url_for('@demandepret') ?>">Demande de Prêt Personnel</a></li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "A. Sociale : Retenue sur Salaire")) echo 'disabledbutton' ?>" href="<?php echo url_for('@retenuesursalaire') ?>">Retenues sur Salaire</a></li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "A. Sociale : Paiement")) echo 'disabledbutton' ?>" href="<?php echo url_for('@historiqueretenue') ?>">Paiements</a></li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "A. Sociale : Visite Médicale")) echo 'disabledbutton' ?>" href="<?php echo url_for('@visitemedicale') ?>">Visites Médicales</a></li>
                                            <li class="active open hover">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Services Sociaux
                                                    <b class="arrow fa fa-angle-down"></b>
                                                </a>
                                                <b class="arrow"></b>
                                                <ul class="submenu" style="">
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "A. Sociale : Accident de Travail")) echo 'disabledbutton' ?>" href="<?php echo url_for('@accidents') ?>"> Fiche Accident de Travail </a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                    <li class="hover">
                                                        <a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "A. Sociale : Aide Sociale")) echo 'disabledbutton' ?>" href="<?php echo url_for('@aidesociale') ?>"> Fiche Aide Sociale</a>
                                                        <b class="arrow"></b>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "A. Sociale : Tenue de Travail")) echo 'disabledbutton' ?>" href="<?php echo url_for('@tenues') ?>">Tenues de Travail</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <!--suivi achat-->
                            <!--                                                                                            <li class="hover">
                                                                                                <a class="dropdown-toggle" href="#">
                                                                                                    <i class="menu-icon fa fa-desktop"></i>
                                                                                                    <span class="menu-text"> Suivi Achat </span>
                                                                                                    <b class="arrow fa fa-angle-down"></b>
                                                                                                </a>
                                                                                                <ul class="submenu">

                                                                                                    <li><a class="<?php // if (!$user->getProfilModule($acces_suivi->getId(), "Suivi des commandes")) echo 'disabledbutton' 
                                                                                                                    ?>" href="<?php // echo url_for('accueil/showSuivicommande') 
                                                                                                                                                                                                                                        ?>" >Suivi des bons Commandes</a></li>
                                                                                                    <li><a class="<?php // if (!$user->getProfilModule($acces_suivi->getId(), "Suivi des commandes")) echo 'disabledbutton' 
                                                                                                                    ?>" href="<?php // echo url_for('accueil/showSuivibdc') 
                                                                                                                                                                                                                                        ?>" >Suivi des Bons dépense a comptant</a></li>
                                                                                                   <li><a class="<?php // if (!$user->getProfilModule($acces_budget->getId(), "Suivi des commandes")) echo 'disabledbutton'   
                                                                                                                    ?>" href="<?php // echo url_for('accueil/showSuivicontrat')   
                                                                                                                                                                                                                                        ?>" >Suivi des Contrats</a></li>
                                                                                                </ul>
                                                                                            </li>                                                                -->
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa-desktop"></i>
                                    <span class="menu-text"> Tableau de Bord </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <ul class="submenu">

                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/showSuivicommande') ?>">Suivi des bons Commandes</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/showSuivibdc') ?>">Suivi des Bons dépense a comptant</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/showSuivibdcRegroupe') ?>">Suivi des Bons dépense a comptant Regroupes</a></li>
                                    <!--<li><a class="<?php // if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton' 
                                                        ?>" href="<?php // echo url_for('accueil/showSuivicontratlivraisontotal')       
                                                                                                                                                                            ?>" >Suivi des Contrats</a></li>-->
                                    <!--<li><a class="<?php // if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton' 
                                                        ?>" href="<?php // echo url_for('accueil/showSuivicontrat')       
                                                                                                                                                                            ?>" >Suivi les Contrat bci test </a></li>-->
                                    
                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/showSuivicontrattotal') ?>">Suivi des Contrats</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/tableauBord') ?>">Tab.de Bord Contrats</a></li>
                               <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('accueil/showSuiviBcicontrat') ?>">Suivi les BCI/Contrat</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php endif; ?>
                <?php else : ?>
                    <?php $acces_couts = $user->getProfilApplication("Unité Contrôle des Coûts"); ?>
                    <?php if ($acces_couts) : ?>
                        <ul class="nav nav-list">
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa fa-cogs"></i>
                                    <span class="menu-text"> Paramètres Globaux </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li><a class="<?php if (!$user->getProfilModule($acces_couts->getId(), "Paramètre : Projet")) echo 'disabledbutton' ?>" href="<?php echo url_for('@projet'); ?>">Projets</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_couts->getId(), "Paramètre : Lieu Chantier")) echo 'disabledbutton' ?>" href="<?php echo url_for('@lieuchantier'); ?>">Lieux Chantiers</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_couts->getId(), "Paramètre : Nature Travaux")) echo 'disabledbutton' ?>" href="<?php echo url_for('@naturetravaux'); ?>">Natures Travaux</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_couts->getId(), "Paramètre : Service")) echo 'disabledbutton' ?>" href="<?php echo url_for('@servicecontrole'); ?>">Services</a></li>
                                </ul>
                            </li>
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa fa-wrench"></i>
                                    <span class="menu-text"> Chantier </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li><a class="<?php if (!$user->getProfilModuleAction($acces_couts->getId(), "Chantier", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('chantiercontrole/new'); ?>">Ajouter Chantier</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_couts->getId(), "Chantier")) echo 'disabledbutton' ?>" href="<?php echo url_for('@chantiercontrole'); ?>">Liste Chantiers</a></li>
                                </ul>
                            </li>
                            <li class="hover">
                                <a class="dropdown-toggle" href="#">
                                    <i class="menu-icon fa fa fa-file-text-o"></i>
                                    <span class="menu-text"> Rapports </span>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li><a class="<?php if (!$user->getProfilModuleAction($acces_couts->getId(), "Rapport", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('rapportcontrole/new'); ?>">Ajouter Rapport</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_couts->getId(), "Rapport")) echo 'disabledbutton' ?>" href="<?php echo url_for('@rapportcontrole'); ?>">Liste Rapports</a></li>
                                </ul>
                            </li>

                        </ul>
                    <?php endif; ?>
                <?php endif; ?>

            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->