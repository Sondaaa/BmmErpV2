<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_generale = $user->getProfilApplication("Direction Générale"); ?>
                <?php $acces_sous_daf = $user->getProfilApplication("Direction SOUS/DAF");             
                $acces_immo = $user->getProfilApplication("Unité Patrimoine (Immobilisation)");
                ?>
                <?php if ($acces_generale || $acces_sous_daf || $acces_immo): ?>
                    <ul class="nav nav-list">
                        <li class="hover" id="userstatiqtique">
                            <a class="<?php if (!$user->getProfilModule($acces_sous_daf->getId(), "Mouvement des Courriers") && !$user->getProfilModule($acces_sous_daf->getId(), "Mouvement des Courriers")) echo 'disabledbutton' ?>" href="<?php echo url_for('parcourcourier/index') ?>">
                                <i class="menu-icon fa fa-exchange"></i>
                                <span class="menu-text"> Mouvements des Courriers </span>
                            </a>
                            <b class="arrow"></b>
                        </li>
                        
                        <li class="hover" id="menu_comp">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-dollar"></i>
                                <span class="menu-text"> Suivie Achats </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li id="menu_comptable">
                                <a class="<?php if (!$user->CanConnect("Direction SOUS/DAF", "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivicommande') ?>" >
                                
                                <span class="menu-text">Suivi des bons Commandes </span>
                                
                            </a>
                                </li>
                                <li>
                                <a class="<?php if (!$user->CanConnect("Direction SOUS/DAF", "Suivi des commandes")) echo 'disabledbutton' ?>" href="<?php echo url_for('Accueil/showSuivicommande') ?>" >
                               
                                <span class="menu-text">Suivi des Bons dépenses au comptant </span>
                                
                            </a>
                        </li>
                       
                                
                        </li>
                            </ul>
                        </li>
                        <li class="hover" id="menu_comp">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-money"></i>
                                <span class="menu-text"> Budgets </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li id="menu_comptable">
                                    <a class="<?php if (!$user->CanConnect("Direction SOUS/DAF", "LISTES_BUDGETS")) echo 'disabledbutton' ?>" href="<?php echo url_for('@titrebudjet') ?>">Listes des budgets definitive
                                </a>
                            </li>
                                
                            </ul>
                        </li>
                        <li class="hover" id="menu_comp">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-tags"></i>
                                <span class="menu-text"> Suivie Immobilisations </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li id="menu_comptable"><a class="<?php if (!$user->getProfilModule($acces_immo->getId(), "Liste d'immobilisations")) echo 'disabledbutton' ?>" href="<?php echo url_for('@immobilisation') ?>">Liste d'immobilisations</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immo->getId(), "Valider Immobilisation")) echo 'disabledbutton' ?>" href="<?php echo url_for('immobilisation/listeNonValide') ?>">Valider Immobilisation</a></li>
                                <li><a target="_black" class="<?php if (!$user->getProfilModule($acces_immo->getId(), "Export Liste")) echo 'disabledbutton' ?>" href="<?php echo url_for('immobilisation/statistiquedate') ?>">Export Liste</a></li>
                                 <li class="hover" id="menu_stat">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-bank"></i>
                                <span class="menu-text"> Statistique </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">

                                <li><a class="<?php if (!$user->getProfilModule($acces_immo->getId(), "INVESTISSEMENT GLOBAL/SITE")) echo 'disabledbutton' ?>" target="_black" href="<?php echo url_for('immobilisation/statistique?toussite=1') ?>">INVESTISSEMENT GLOBAL/SITE</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immo->getId(), "INVESTISSEMENT GLOBAL/TYPE")) echo 'disabledbutton' ?>" target="_black" href="<?php echo url_for('immobilisation/statistique?tous=1') ?>">INVESTISSEMENT GLOBAL/TYPE</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immo->getId(), "INVESTISSEMENT GLOBAL/LOCAUX")) echo 'disabledbutton' ?>" target="_black" href="<?php echo url_for('immobilisation/statistique?touslocal=1') ?>">INVESTISSEMENT GLOBAL/LOCAUX</a></li>

                                <li><a class="<?php if (!$user->getProfilModule($acces_immo->getId(), "INVESTISSEMENT PAR GATEGORIES")) echo 'disabledbutton' ?>" target="_black" href="<?php echo url_for('immobilisation/statistique?categorie=1') ?>">INVESTISSEMENT PAR GATEGORIES</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immo->getId(), "INVESTISSEMENT PAR FAMILLE")) echo 'disabledbutton' ?>" target="_black" href="<?php echo url_for('immobilisation/statistique?famille=1') ?>">INVESTISSEMENT PAR FAMILLE&GATEGORIES</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immo->getId(), "INVESTISSEMENT PAR FAMILLE")) echo 'disabledbutton' ?>" target="_black" href="<?php echo url_for('immobilisation/statistique?famillegeneral=1') ?>">INVESTISSEMENT PAR FAMILLE </a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immo->getId(), "INVESTISSEMENT PAR SOUS FAMILLE")) echo 'disabledbutton' ?>" target="_black" href="<?php echo url_for('immobilisation/statistique?sfamille=1') ?>">INVESTISSEMENT PAR SOUS FAMILLE&FAMILLE</a></li>
                            </ul>
                        </li>
                            </ul>
                        </li>
                    </ul>



                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->