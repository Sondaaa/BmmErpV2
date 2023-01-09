<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_stock = $user->getProfilApplication("Unité Gestion des Stocks"); ?>
                <?php if ($acces_stock): ?>
                    <ul class="nav nav-list">
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cog"></i>
                                <span class="menu-text"> Paramètres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Paramètre : Unité de Mesure")) echo 'disabledbutton' ?>" href="<?php echo url_for('@unitemarche') ?>">Unité de Mesures</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Paramètre : Caractéristique")) echo 'disabledbutton' ?>" href="<?php echo url_for('@caracteristiquearticle') ?>">Caractéristiques</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Paramètre : Fabricant")) echo 'disabledbutton' ?>" href="<?php echo url_for('@fabricant') ?>">Fabricants</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Paramètre : Magasin")) echo 'disabledbutton' ?>" href="<?php echo url_for('@magasin') ?>">Magasins</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Paramètre : T.V.A")) echo 'disabledbutton' ?>" href="<?php echo url_for('@tva') ?>">T.V.A</a></li>
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
                                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@fournisseur') ?>">Fournisseurs</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Famille Article / Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@familleartfrs') ?>">Famille Art/Frs</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Activité Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@activitetiers') ?>">Activité Fournisseur</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-sellsy"></i>
                                <span class="menu-text"> Articles </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text"> Articles & Stocks </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModuleAction($acces_stock->getId(), "Article", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('article/new') ?>">Nouvelle Fiche</a></li>
                                        <li><a class="<?php // if (!$user->getProfilModule($acces_stock->getId(), "Article")) echo 'disabledbutton' ?>" href="<?php echo url_for('@article') ?>">Liste des Articles</a></li>
                                        <!--<li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Article")) echo 'disabledbutton' ?>" href="<?php // echo url_for('article/liste') ?>">Liste des Articles</a></li>-->
                                        <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Stock")) echo 'disabledbutton' ?>" href="<?php echo url_for('stock/index') ?>">Stock</a></li>
                                        <li>
                                            <a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Mouvements Stock")) echo 'disabledbutton' ?>" href="<?php echo url_for('article/mouvement') ?>"><span class="menu-text"> Mouvements Stocks </span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Famille Article")) echo 'disabledbutton' ?>" href="<?php echo url_for('@famillearticle') ?>">Famille Article</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Sous Famille Article")) echo 'disabledbutton' ?>" href="<?php echo url_for('@sousfamillearticle') ?>">S. Famille Article</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Nature Article")) echo 'disabledbutton' ?>" href="<?php echo url_for('@naturearticle') ?>">Nature Article</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Import Article")) echo 'disabledbutton' ?>" href="<?php echo url_for('article/import') ?>">Import Article</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Mise à jour T.V.A Article")) echo 'disabledbutton' ?>" href="<?php echo url_for('article/misajourtva') ?>">Mise à jour T.V.A Article</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-external-link"></i>
                                <span class="menu-text"> Transfert Achats & Marchés</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text"> P.V. de Réception</span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Liste B.C Externe")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrs?idtype=7') ?>"> Liste B.C. Externe</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Liste B.D Comptant")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexfrs?idtype=2') ?>"> Liste B.D. Comptant</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text"> Bon de Sortie</span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Bon de Commande Interne")) echo 'disabledbutton' ?>" href="<?php echo url_for('Documents/indexdemandeur?idtype=6') ?>"> Bon de Commande Interne </a></li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-exchange"></i>
                                <span class="menu-text"> Entrée & Sortie Stock </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text"> Réception </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>

                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModuleAction($acces_stock->getId(), "Fiche Entrée", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/new?idtype=10') ?>">Nouvelle Fiche Entrée</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Fiche Entrée")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=10') ?>">Liste Fiches Entrée</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text"> Sortie </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModuleAction($acces_stock->getId(), "Fiche Sortie", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/new?idtype=11') ?>">Nouvelle Fiche Sortie</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Fiche Sortie")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=11') ?>">Liste Fiches Sortie</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text"> Transfert </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModuleAction($acces_stock->getId(), "Fiche Transfert", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/new?idtype=13') ?>">Nouvelle Fiche Transfert</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Fiche Transfert")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=13') ?>">Liste Fiches Transfert</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cloud-download"></i>
                                <span class="menu-text"> Retour & Avoir Fournisseur </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li>
                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text"> Retour </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModuleAction($acces_stock->getId(), "Fiche Retour", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/new?idtype=12') ?>">Nouvelle Fiche de Retour</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Fiche Retour")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=12') ?>">Liste des Fiches de Retour</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="dropdown-toggle" href="#">
                                        <span class="menu-text"> Avoir Fournisseur</span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModuleAction($acces_stock->getId(), "Fiche Avoir Fournisseur", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/new?idtype=14') ?>">Nouvelle Fiche Avoir</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Fiche Avoir Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('documentachat/index?idtype=14') ?>">Liste des Fiches Avoir</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa  fa-bolt"></i>
                                <span class="menu-text">Inventaire</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModuleAction($acces_stock->getId(), "Inventaire", "Impression")) echo 'disabledbutton' ?>" href="<?php echo url_for('article/exportinv') ?>">Export les Fiches Inventaires</a></li>
                                <li><a class="<?php if (!$user->getProfilModuleAction($acces_stock->getId(), "Inventaire", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('inventairestock/ouvrir') ?>">Nouvelle Fiche d'Inventaire</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Inventaire")) echo 'disabledbutton' ?>" href="<?php echo url_for('inventairestock/index') ?>">Liste des Inventaires</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->