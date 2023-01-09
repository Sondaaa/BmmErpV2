<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_banque = $user->getProfilApplication("Banque"); ?>
                <?php if ($acces_banque): ?>
                    <ul class="nav nav-list">
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cog"></i>
                                <span class="menu-text"> Paramètres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Paramètre : Nature du Compte")) echo 'disabledbutton' ?>" href="<?php echo url_for('@naturebanque') ?>">Nature du compte</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Paramètre : Nature du Compte")) echo 'disabledbutton' ?>" href="<?php echo url_for('@banque') ?>">Banque</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Paramètre : Commission/Opération Bancaire/CCP")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typeoperation') ?>">Commissions/Opérations Bancaires/CCP</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Paramètre : Carnet de Chèques")) echo 'disabledbutton' ?>" href="<?php echo url_for('@carnetcheque') ?>">Carnet de chèques</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Paramètre : Carnet des Ordres de Virements Postaux")) echo 'disabledbutton' ?>" href="<?php echo url_for('@carnetordrepostal') ?>">Carnet des Ordres de virements postaux</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Paramèrte : Instrument")) echo 'disabledbutton' ?>" href="<?php echo url_for('@instrumentpaiment') ?>">Instruments</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Paramètre : Objet de Règlement")) echo 'disabledbutton' ?>" href="<?php echo url_for('@objetreglement') ?>">Objet de règlement</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-users"></i>
                                <span class="menu-text"> Fournisseurs </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@fournisseur') ?>">
                                        Detail fournisseur
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@ribbancaire') ?>">
                                        Rib fournisseur
                                    </a>
                                </li>
                            </ul>
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
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Liste des Comptes")) echo 'disabledbutton' ?>" href="<?php echo url_for('@caissesbanques') ?>">Liste des Comptes</a></li>
                                <li><a class="<?php if (!$user->getProfilModuleAction($acces_banque->getId(), "Liste des Comptes", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('caissesbanques/new?idtype=1') ?>">Nouvelle Fiche Compte</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Paramétrage Compte/Budget")) echo 'disabledbutton' ?>" href="<?php echo url_for('@lignebanquecaisse') ?>">Param. Compte/Budget</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Alimentation Compte")) echo 'disabledbutton' ?>" href="<?php echo url_for('@alimentationcompte') ?>">Alimentation Compte</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-file-text-o"></i>
                                <span class="menu-text">Document de Paiement</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Liste des Ordonnances de Paiement")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentbudget/index?idtype=2') ?>">Liste des Fiches de Paiement</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Liste des Déclarations")) echo 'disabledbutton' ?>" href="<?php echo url_for('declaration') ?>">Liste des Déclarations</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-bank "></i>
                                <span class="menu-text"> Consultations & Mouvements </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="<?php if (!$user->getProfilModuleAction($acces_banque->getId(), "Liste des Déclarations", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('mouvementbanciare/new') ?>">
                                        Nouvelle fiche d'opération
                                    </a>
                                </li>
                                <?php $acces_declaration = $user->getProfilModule($acces_banque->getId(), "Liste des Déclarations"); ?>
                                <li>
                                    <a class="<?php if (!$acces_declaration) echo 'disabledbutton' ?>" href="<?php echo url_for('mouvementbanciare') ?>">
                                        Relevé des mouvements
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if (!$acces_declaration) echo 'disabledbutton' ?>" href="<?php echo url_for('mouvementbanciare/journal') ?>">
                                        Journal des mouvements
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-file-text-o"></i>
                                <span class="menu-text"> Bordereau des Virements </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="<?php if (!$user->getProfilModuleAction($acces_banque->getId(), "Bordereau des Virements", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('mouvementbanciare/bordereau') ?>">
                                        Passer bordereau
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Bordereau des Virements")) echo 'disabledbutton' ?>" href="<?php echo url_for('bordereauvirement') ?>">
                                        Liste des bordereaux
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Rapprochement")) echo 'disabledbutton' ?>" href="<?php echo url_for('mouvementbanciare/rapprochement') ?>">
                                <i class="menu-icon fa fa-bookmark-o"></i>
                                <span class="menu-text"> Rapprochement </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-desktop"></i>
                                <span class="menu-text"> Tableau de Bord </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <ul class="submenu">

                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivicommande') ?>" >Suivi des bons Commandes</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivibdc') ?>" >Suivi des Bons dépense a comptant</a></li>
                                <!-- <li><a class="<?php //if (!$user->getProfilModule($acces_banque->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php //echo url_for('Accueil/showSuivibdcRegroupe') ?>" >Suivi des Bons dépense a comptant Regroupes</a></li> -->
                                
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivicontrattotal') ?>" >Suivi des Contrats</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/tableauBord') ?>" >Tab.de Bord Contrats</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_banque->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuiviBcicontrat') ?>" >Suivi les BCI/Contrat</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->