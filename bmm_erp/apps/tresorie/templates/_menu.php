<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_caisse = $user->getProfilApplication("Caisse"); ?>
                <?php if ($acces_caisse): ?>
                    <ul class="nav nav-list">
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa  fa-cog"></i>
                                <span class="menu-text"> Paramètres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Paramètre : Type Trésorerie")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typecaisse') ?>">Type Trésorerie</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Paramètre : Catégorie d'Opération")) echo 'disabledbutton' ?>" href="<?php echo url_for('@categorieoperation') ?>">Catégorie d'Opération</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Paramètre : Démarcheurs")) echo 'disabledbutton' ?>" href="<?php echo url_for('@demarcheur') ?>">Démarcheurs</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Paramètre : Démarcheurs")) echo 'disabledbutton' ?>" href="<?php echo url_for('@objetreglement') ?>">Objet de réglement</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!--documentbudget-->
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-bookmark"></i>
                                <span class="menu-text"> Trésoreries </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Liste des Caisses")) echo 'disabledbutton' ?>" href="<?php echo url_for('@caissesbanques') ?>">Liste des Caisses</a></li>
                                <li><a class="<?php if (!$user->getProfilModuleAction($acces_caisse->getId(), "Liste des Caisses", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('caissesbanques/new') ?>">Nouvelle Fiche Caisse</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Paramétrage Caisse/Budget")) echo 'disabledbutton' ?>" href="<?php echo url_for('@lignebanquecaisse') ?>">Param. Caisse/Budget</a></li>
                            </ul>
                            <!-- /.dropdown-user  -->
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-credit-card"></i>
                                <span class="menu-text"> Documents Achats </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Liste des Bon de Dépenses au Comptant Provisoires")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrs?idtype=17') ?>">
                                        Liste B. de dépenses au comptant provisoires
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Liste des Bon de Dépenses au Comptant")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrs?idtype=2') ?>">
                                        Liste B. de dépenses au comptant
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Liste des Bon de Dépenses au Comptant")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrsBDCG?idtype=21') ?>">
                                        Liste B. de dépenses au comptant Regroupé
                                    </a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user  -->
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-credit-card"></i>
                                <span class="menu-text"> Quittances </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Liste des Bon de Dépenses au Comptant")) echo 'disabledbutton' ?>" href="<?php echo url_for('ligneoperationcaisse/index') ?>">
                                        Liste des Quittances Provisoires & Définitives
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Ordonnance de Paiement")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentbudget/index?idtype=2') ?>">
                                <i class="menu-icon fa fa-file-text-o"></i>
                                <span class="menu-text">Ordonnance de Paiement</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-bank "></i>
                                <span class="menu-text"> Consultaions & Mouvements </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="<?php if (!$user->getProfilModuleAction($acces_caisse->getId(), "Mouvement Caisse", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('mouvementbanciare/new') ?>">
                                        Nouvelle fiche d'opération
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModuleAction($acces_caisse->getId(), "Mouvement Caisse", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('mouvementbanciare/newOrdonnaceHorsBci') ?>">
                                        Nouvelle fiche d'opération Hors BCI
                                    </a>
                                </li>
                                <?php $acces_mouvement = $user->getProfilModule($acces_caisse->getId(), "Mouvement Caisse"); ?>
                                <li>
                                    <a class="<?php if (!$acces_mouvement) echo 'disabledbutton' ?>" href="<?php echo url_for('mouvementbanciare') ?>">
                                        Relevé des mouvements
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if (!$acces_mouvement) echo 'disabledbutton' ?>" href="<?php echo url_for('mouvementbanciare/journal') ?>">
                                        Brouillard de caisse 
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if (!$acces_mouvement) echo 'disabledbutton' ?>" href="<?php echo url_for('mouvementbanciare/suivisoldeCaisseParCaisse') ?>">
                                        Suivi Solde Caisse 
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-desktop"></i>
                                <span class="menu-text"> Tableau de Bord </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <ul class="submenu">

                                <li><a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivicommande') ?>" >Suivi des bons Commandes</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivibdc') ?>" >Suivi des Bons dépense a comptant</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivibdcRegroupe') ?>" >Suivi des Bons dépense a comptant Regroupes</a></li>
                                <!--<li><a class="<?php // if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton'   ?>" href="<?php // echo url_for('Accueil/showSuivicontratlivraisontotal')         ?>" >Suivi des Contrats</a></li>-->
                             <!--<li><a class="<?php // if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton'   ?>" href="<?php // echo url_for('Accueil/showSuivicontrat')         ?>" >Suivi les Contrat bci test </a></li>-->
                                
                                <li><a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivicontrattotal') ?>" >Suivi des Contrats</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/tableauBord') ?>" >Tab.de Bord Contrats</a></li>
                          
                            <li><a class="<?php if (!$user->getProfilModule($acces_caisse->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuiviBcicontrat') ?>" >Suivi les BCI/Contrat</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->