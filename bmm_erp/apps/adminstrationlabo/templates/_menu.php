
       
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_adminlabo = $user->getProfilApplication("Unité administration labo"); ?>
                <?php if ($acces_adminlabo) : ?>
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
                                    <a class="<?php if (!$user->getProfilModule($acces_adminlabo->getId(), "demandeur")) {
                                                    echo 'disabledbutton';
                                                }
                                                ?>" href="<?php echo url_for('@demandeur') ?>">Demandeur
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon  fa fa-file-text-o"></i>
                                <span class="menu-text"> Document Achat </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_adminlabo->getId(), "documentachat")) {
                                                    echo 'disabledbutton';
                                                } ?>" href="<?php echo url_for('documentachat/index?id_valide=""') ?>">Liste des D.I.nterne
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_adminlabo->getId(), "documentachat")) {
                                                    echo 'disabledbutton';
                                                } ?>" href="<?php echo url_for('documentachat/index?id_valide=1') ?>">Liste des D.I.nterne Validé
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if (!$user->getProfilModule($acces_adminlabo->getId(), "documentachat")) {
                                                    echo 'disabledbutton';
                                                } ?>" href="<?php echo url_for('documentachat/listeAnnule?id_type=4') ?>">Liste des BCI Annulés
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-file-text"></i>
                                <span class="menu-text"> Budgets </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">

                                <li class="hover">
                                    <a class="<?php if (!$user->getProfilModule($acces_adminlabo->getId(), "Budgets Définitifs")) {
                                                    echo 'disabledbutton';
                                                }
                                                ?>" href="<?php echo url_for('@titrebudjet') ?>">Liste des Budgets Définitifs</a>
                                    <b class="arrow"></b>
                                </li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_adminlabo->getId(), "Situation Engagements")) {
                                                    echo 'disabledbutton';
                                                }
                                                ?>" href="<?php echo url_for('titrebudjet/situationEngagement')
                                                            ?>">Situation Engagements</a></li>
                                <li class="">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Récapitulatif d'Engage.
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <?php $acces_engage = $user->getProfilModule($acces_adminlabo->getId(), "Récapitulatif d'Engagements"); ?>
                                    <ul class="submenu">

                                        <li class="hover">
                                            <a class="<?php if (!$acces_engage) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" href="<?php echo url_for('titrebudjet/recapCourant') ?>">Courant</a>
                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                            <a class="<?php if (!$acces_engage) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" href="<?php echo url_for('titrebudjet/recapFinMois') ?>">Fin du Mois</a>
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
                                    <?php $acces_depense = $user->getProfilModule($acces_adminlabo->getId(), "Récapitulatif des Dépenses"); ?>
                                    <ul class="submenu">

                                        <li class="hover">
                                            <a class="<?php if (!$acces_depense) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" href="<?php echo url_for('titrebudjet/recapDepenseCourant') ?>">Courant</a>
                                            <b class="arrow"></b>
                                        </li>

                                        <li class="hover">
                                            <a class="<?php if (!$acces_depense) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" href="<?php echo url_for('titrebudjet/recapDepenseFinMois') ?>">Fin du Mois</a>
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
                                    <?php $acces_cumulee = $user->getProfilModule($acces_adminlabo->getId(), "Situation Cumulée"); ?>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$acces_cumulee) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" href="<?php echo url_for('titrebudjet/situationCumulee') ?>">Traiter Antécédent</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_cumulee) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" href="<?php echo url_for('titrebudjet/recapSituationCumulee') ?>">Etat Récapitulatif</a>
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
                                    <?php $acces_antecedent = $user->getProfilModule($acces_adminlabo->getId(), "Engagement Antécédent"); ?>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$acces_antecedent) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" href="<?php echo url_for('titrebudjet/engagementAntecedent') ?>">Ajouter Antécédent</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$acces_antecedent) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" href="<?php echo url_for('titrebudjet/etatEngagementAntecedent') ?>">Etat</a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>


                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-sellsy"></i>
                                <span class="menu-text"> Articles </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">

                                <li><a href="<?php echo url_for('@article') ?>">Liste des Articles</a></li>
                                <li><a href="<?php echo url_for('stock/index') ?>">Stock</a></li>
                                <li>
                                    <a href="<?php echo url_for('lignemouvemententetestock/mouvement') ?>"><span class="menu-text"> Mouvements Stocks </span></a>
                                </li>


                            </ul>
                        </li>

                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-tags"></i>
                                <span class="menu-text"> Immobilisations </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">

                                <li><a href="<?php echo url_for('@immobilisation') ?>">Liste des Fiches Immobilisations</a></li>
                                <li class="">
                                    <a href="#" class="dropdown-toggle">
                                        Statistiques
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModule($acces_adminlabo->getId(), "INVESTISSEMENT GLOBAL")) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" target="_black" href="<?php echo url_for('immobilisation/statistique?toussite=1') ?>">INVESTISSEMENT GLOBAL/SITE</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_adminlabo->getId(), "INVESTISSEMENT GLOBAL")) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" target="_black" href="<?php echo url_for('immobilisation/statistique?tous=1') ?>">INVESTISSEMENT GLOBAL/Catégorie</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_adminlabo->getId(), "INVESTISSEMENT GLOBAL")) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" target="_black" href="<?php echo url_for('immobilisation/statistique?touslocal=1') ?>">INVESTISSEMENT GLOBAL/LOCAUX</a></li>

                                        <li><a class="<?php if (!$user->getProfilModule($acces_adminlabo->getId(), "INVESTISSEMENT GLOBAL")) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" target="_black" href="<?php echo url_for('immobilisation/statistique?famillegeneral=1') ?>">INVESTISSEMENT PAR FAMILLE </a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_adminlabo->getId(), "INVESTISSEMENT GLOBAL")) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" target="_black" href="<?php echo url_for('immobilisation/statistique?sfamille=1') ?>">INVESTISSEMENT PAR SOUS FAMILLE&FAMILLE</a></li>

                                    </ul>
                                </li>
                                <li class="">
                                    <a href="#" class="dropdown-toggle">


                                        Edition
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModule($acces_adminlabo->getId(), "CODE-BAREE")) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" href="<?php echo url_for('@Imprimercb') ?>">CODE-BAREE/IMMOB.</a></li>
                                        <li><a target="_black" class="<?php if (!$user->getProfilModule($acces_adminlabo->getId(), "CODE-BAREE")) {
                                                                            echo 'disabledbutton';
                                                                        }
                                                                        ?>" href="<?php echo url_for('immobilisation/statistiquedate') ?>">Export Liste Immobilisations </a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_adminlabo->getId(), "CODE-BAREE")) {
                                                            echo 'disabledbutton';
                                                        }
                                                        ?>" href="<?php echo url_for('immobilisation/listeType') ?>">Export Imm. / Type d'affectation</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </li>

                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
  