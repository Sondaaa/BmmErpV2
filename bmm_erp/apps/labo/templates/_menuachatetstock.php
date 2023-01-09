<?php $acces_stock = $user->getProfilApplication("Unité Gestion des Stocks"); ?>
<?php $acces_achat = $user->getProfilApplication("Unité Achats"); ?>
    <?php $acces_marche = $user->getProfilApplication("Unité Marchés"); ?>
<?php if ($acces_stock) : ?>
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
                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Paramètre : Magasin")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typearticle') ?>">Type d'article</a></li>
                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Paramètre : Magasin")) echo 'disabledbutton' ?>" href="<?php echo url_for('@magasin') ?>">Magasin</a></li>
                <li>
                        <a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Paramètre : Demandeur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@demandeur') ?>">Demandeur</a>
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
                <li>
                    <a class="dropdown-toggle" href="#">
                        <span class="menu-text"> Articles & Stocks </span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li><a class="<?php if (!$user->getProfilModuleAction($acces_stock->getId(), "Article", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('article/new') ?>">Nouvelle Fiche</a></li>
                        <li><a class="<?php // if (!$user->getProfilModule($acces_stock->getId(), "Article")) echo 'disabledbutton' 
                                        ?>" href="<?php echo url_for('@article') ?>">Liste des Articles</a></li>
                        <!--<li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Article")) echo 'disabledbutton' ?>" href="<?php // echo url_for('article/liste') 
                                                                                                                                                ?>">Liste des Articles</a></li>-->
                        <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Stock")) echo 'disabledbutton' ?>" href="<?php echo url_for('stock/index') ?>">Stock</a></li>
                        <li>
                            <a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Mouvements Stock")) echo 'disabledbutton' ?>" href="<?php echo url_for('lignemouvemententetestock/mouvement') ?>"><span class="menu-text"> Mouvements Stocks </span></a>
                        </li>
                    </ul>
                </li>
                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Famille Article")) echo 'disabledbutton' ?>" href="<?php echo url_for('@famillearticle') ?>">Famille Article</a></li>
                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Sous Famille Article")) echo 'disabledbutton' ?>" href="<?php echo url_for('@sousfamillearticle') ?>">S. Famille Article</a></li>
                <!-- <li><a class="<?php //if (!$user->getProfilModule($acces_stock->getId(), "Nature Article")) echo 'disabledbutton' ?>" href="<?php //echo url_for('@naturearticle') ?>">Nature Article</a></li> -->
                <li><a class="<?php if (!$user->getProfilModule($acces_stock->getId(), "Import Article")) echo 'disabledbutton' ?>" href="<?php echo url_for('@importArticle') ?>">Import Article </a></li>
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
                <!-- <li>
                    <a class="dropdown-toggle" href="#">
                        <span class="menu-text"> P.V. de Réception</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <ul class="submenu">
                        <li><a class="<?php //if (!$user->getProfilModule($acces_stock->getId(), "Liste B.C Externe")) echo 'disabledbutton' ?>" href="<?php //echo url_for('Documents/indexfrs?idtype=7') ?>"> Liste B.C. Externe</a></li>
                        
                        <li><a class="<?php //if (!$user->getProfilModule($acces_stock->getId(), "Liste B.D Comptant")) echo 'disabledbutton' ?>" href="<?php //echo url_for('Documents/indexfrs?idtype=2') ?>"> Liste B.D. Comptant</a></li>
                    </ul>
                </li> -->
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
                <span class="menu-text"> Sortie Stock </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <!-- <li>
                    <a class="dropdown-toggle" href="#">
                        <span class="menu-text"> Réception </span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li><a class="<?php //if (!$user->getProfilModuleAction($acces_stock->getId(), "Fiche Entrée", "Création")) echo 'disabledbutton' ?>" href="<?php //echo url_for('documentachat/new?idtype=10') ?>">Nouvelle Fiche Entrée</a></li>
                        <li><a class="<?php // if (!$user->getProfilModule($acces_stock->getId(), "Fiche Entrée")) echo 'disabledbutton' ?>" href="<?php //echo url_for('documentachat/index?idtype=10') ?>">Liste Fiches Entrée</a></li>
                    </ul>
                </li> -->
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
        <li class="hover">
                <a href="">
                    <i class="menu-icon fa fa-folder"></i>
                    <span class="menu-text">
                        B. Commande Interne
                    </span>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li><a class="<?php if (!$user->getProfilModuleAction($acces_achat->getId(), "Bon de Commande Interne", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('Achatdoc/new') ?>"><i class="fa fa-file-o fa-fw"></i> N. Fiche Demande Interne</a></li>
                    <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Bon de Commande Interne")) echo 'disabledbutton' ?>" href="<?php echo url_for('Achatdoc/index') ?>"><i class="fa fa-list-alt fa-fw"></i> Liste Demande Interne</a></li>
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

                    <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>"
                     href="<?php echo url_for('Achatdoc/showSuivicommandeBCI') ?>">
                     Suivi des bons Commandes</a>
                    </li>
                    <!-- <li><a class="<?php //if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton' 
                                        ?>" href="<?php //echo url_for('Accueil/showSuivibdc') 
                                                                                                                                                            ?>" >Suivi des Bons dépense a comptant</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php //echo url_for('Accueil/showSuivibdcRegroupe') 
                                                                                                                                                                ?>" >Suivi des Bons dépense a comptant Regroupes</a></li>
                                <li><a class="<?php // if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton'   
                                                ?>" href="<?php // echo url_for('Accueil/showSuivicontratlivraisontotal')         
                                                            ?>" >Suivi des Contrats</a></li>
                    <li><a class="<?php // if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton'   
                                    ?>" href="<?php // echo url_for('Accueil/showSuivicontrat')         
                                                ?>">Suivi les Contrat bci test </a></li>

                    <li><a class="<?php //if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton' 
                                    ?>" href="<?php //echo url_for('Accueil/showSuivicontrattotal') 
                                                                                                                                                        ?>">Suivi des Contrats</a></li>
                    <li><a class="<?php //if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton' 
                                    ?>" href="<?php //echo url_for('Accueil/tableauBord') 
                                                                                                                                                        ?>">Tab.de Bord Contrats</a></li>
                    <li><a class="<?php // if (!$user->getProfilModule($acces_achat->getId(), "Suivi des commandes")) echo 'disabledbutton' 
                                    ?>" href="<?php //echo url_for('Accueil/showSuiviBcicontrat') 
                                                                                                                                                        ?>">Suivi les BCI/Contrat</a></li> -->
                </ul>
            </li>
    </ul>
<?php endif; ?>