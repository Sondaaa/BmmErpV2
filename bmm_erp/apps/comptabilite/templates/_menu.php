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
                    <ul class="nav nav-list">
                        <li>
                            <a href="<?php echo url_for('accueil/index') ?>">
                                <i class="menu-icon fa fa-tv"></i>
                                <span class="menu-text"> Accueil </span>
                            </a>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cog"></i>
                                <span class="menu-text"> Paramètres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Paramètre : Secteur Activité")) echo 'disabledbutton' ?>" href="<?php echo url_for('@secteurActivite') ?>">Secteur d'activité</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Paramètre : Activité")) echo 'disabledbutton' ?>" href="<?php echo url_for('@activite') ?>">Activité</a></li>
                                <!--<li><a href="<?php //echo url_for('')                                                        ?>">Devise</a></li>-->
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Paramètre : Forme Juridique")) echo 'disabledbutton' ?>" href="<?php echo url_for('@formeJuridique') ?>">Forme juridique</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Paramètre : Type Journal")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typeJournal') ?>">Type journal</a></li>
                                <!--<li><a href="<?php // echo url_for('@typeCompte')                                         ?>">Type compte comptable</a></li>-->
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Paramètre : Type Pièce")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typePiece') ?>">Type de pièce</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!--                        <li class="hover">
                                                    <a class="dropdown-toggle" href="#">
                                                        <i class="menu-icon fa fa-list-ol"></i>
                                                        <span class="menu-text"> Base Comptable </span>
                                                        <b class="arrow fa fa-angle-down"></b>
                                                    </a>
                                                    <b class="arrow"></b>
                                                                            <ul class="submenu">
                                                                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Base Comptable : Compte Comptable")) echo 'disabledbutton' ?>" href="<?php // echo url_for('@ajouterCompteComptable')                                         ?>">Ajouter compte</a></li>
                                                                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Base Comptable : Journal Comptable")) echo 'disabledbutton' ?>" href="<?php // echo url_for('@listeJournalComptable')                                         ?>">Journaux comptables</a></li>
                                                                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Base Comptable : Importer Journaux")) echo 'disabledbutton' ?>" href="<?php // echo url_for('journal/importation');                                         ?>">Importer journaux</a></li>
                                                                            </ul>
                                                     /.dropdown-user 
                                                </li>-->
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
                                <!--<li><a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Paramètre : Exercice Comptable")) echo 'disabledbutton' ?>" href="<?php // echo url_for('@exercice') ?>">Création Exercice comptable</a></li>-->

                                <!--<li><a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Exercice Antérieur")) echo 'disabledbutton' ?>" href="<?php // echo url_for('@anterieurDossier') ?>">Affectation Exercice</a></li>-->

                                <!--                                <li class="hover">
                                                                    <a class="dropdown-toggle" href="#">
                                                                        <span class="menu-text">Plan Comptable Client</span>
                                                                    </a>
                                                                    <b class="arrow"></b>
                                                                    <ul class="submenu">
                                                                        <li><a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Exercice Antérieur")) echo 'disabledbutton'          ?>" href="<?php // echo url_for('transfert/base-standard')          ?>">Génerer Plan Comptable</a></li>
                                                                        <li><a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Exercice Antérieur")) echo 'disabledbutton'          ?>" href="<?php // echo url_for('dossier/importerPlan')          ?>">Importer Plan Comptable</a></li>
                                                                        <li><a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Exercice Antérieur")) echo 'disabledbutton'          ?>" href="<?php // echo url_for('plan_comptable/importation')          ?>">Importer à partir d'un Dossier</a></li>
                                                                        <li><a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Exercice Antérieur")) echo 'disabledbutton'          ?>" href="<?php // echo url_for('@baseStandard')          ?>">Aperçu Plan Comptable </a></li>
                                
                                                                    </ul>
                                                                </li>
                                                                <li class="hover">
                                                                    <a class="dropdown-toggle" href="#">
                                
                                                                        <span class="menu-text">Jornaux Comptables</span>
                                
                                                                    </a>
                                                                    <b class="arrow"></b>
                                
                                                                    <ul class="submenu">
                                                                        <li><a class="<?php
//                                            if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Exercice Antérieur"))
//                                                echo 'disabledbutton'
                                ?>" onclick="showModalCreationjournaux()"
                                                                               >Création Journaux </a></li>
                                                                                                       <a id="id-btn-dialog1" >
                                                                                                            <i class="menu-icon fa fa-refresh"></i>
                                                                                                            <span class="menu-text">
                                                                                                                Dossier Comptable
                                                                                                            </span>
                                                                                                        </a>         
                                
                                
                                                                        <li><a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Exercice Antérieur")) echo 'disabledbutton'          ?>" href="<?php // echo url_for('journal/importation')          ?>">Importer à partir d'un Dossier</a></li>
                                                                            <li><a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Exercice Antérieur")) echo 'disabledbutton'             ?>" href="<?php // echo url_for('importation/achatExcel')             ?>">Importer achat/Exel</a></li>
                                                                        <li><a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Exercice Antérieur")) echo 'disabledbutton'             ?>" href="<?php // echo url_for('importation/venteExcel')             ?>">Importer vente/Exel</a></li>
                                                                    </ul>
                                                                </li>-->
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Exercice Antérieur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@dossierexerciceutilisateur') ?>"> Affectation Utilisateur</a></li>
                                <!--<li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Transfert")) echo 'disabledbutton' ?>" href="<?php //echo url_for('@transfert')                  ?>"> Transfert</a></li>-->
                            </ul>
                            <!-- /.dropdown-user -->
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
                                                       href="<?php // echo url_for('@referentielcomptable')   ?>">
                                                        <i class="menu-icon fa fa-file"></i>
                                                        <span class="menu-text">
                                                            Référentiel  
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
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Dossier Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('@referentielcomptable') ?>">Référentiel Comptable </a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_comptabilite->getId(), "Paramètre : Exercice Comptable")) echo 'disabledbutton' ?>" href="<?php echo url_for('@dossierutile')  ?>">Dossier Utilie</a></li>

                                <!--<li><a class="<?php // if (!$user->getProfilModule($acces_comptabilite->getId(), "Dossier Comptable : Exercice Antérieur")) echo 'disabledbutton' ?>" href="<?php // echo url_for('@piecejuridique')  ?>">Aperçu Pièces Juridiques</a></li>-->
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->