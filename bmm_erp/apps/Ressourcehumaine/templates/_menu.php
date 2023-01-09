<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>

            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_rh = $user->getProfilApplication("Unité Gestion des Carrières et des Ouvriers Occasionnels"); ?>
                <?php if ($acces_rh): ?>
                    <ul class="nav nav-list">
                        <li class="hover" >
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cog"></i>
                                <span class="menu-text"> Paramètres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre : Fonction")) echo 'disabledbutton' ?>" href="<?php echo url_for('@fonction') ?>">Fonctions</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre : Régime Horaire")) echo 'disabledbutton' ?>" href="<?php echo url_for('@regimehoraire') ?>">Régimes Horaires</a></li>                                                
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre : Situation Administrative")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typecontrat') ?>">Situations administratives</a></li>        
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre : Type Permis")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typepermis') ?>">Types permis</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre : Sexe")) echo 'disabledbutton' ?>" href="<?php echo url_for('@sexe') ?>">Sexe</a></li>              

                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre : Type Disciplines et Sanctions")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typediscipline') ?>">Types Disciplines & Sanctions</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre : Nature Disciplines et Sanctions")) echo 'disabledbutton' ?>" href="<?php echo url_for('@naturediscipline') ?>">Natures Disciplines & Sanctions</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre : Type Récompenses et Médailles")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typerecompense') ?>">Types Récompenses & Médailles </a></li>

                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre : Retraite")) echo 'disabledbutton' ?>" href="<?php echo url_for('@retraite') ?>">Retraite </a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre : Regroupement Agents")) echo 'disabledbutton' ?>" href="<?php echo url_for('@regroupementagents') ?>">Regroupement Agents </a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre : Motif d'Absence")) echo 'disabledbutton' ?>" href="<?php echo url_for('@motifabsenceinactive') ?>">Motif d'Absence </a></li>
                            </ul>
                        </li>
                        <!-- /.dropdown-user -->
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cog"></i>
                                <span class="menu-text"> Hiérarchie</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Hiérarchie : Direction")) echo 'disabledbutton' ?>" href="<?php echo url_for('@direction') ?>">Direction</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Hiérarchie : Sous Direction")) echo 'disabledbutton' ?>" href="<?php echo url_for('@sousdirection') ?>">Sous Direction</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Hiérarchie : Service")) echo 'disabledbutton' ?>" href="<?php echo url_for('@servicerh') ?>">Service</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Hiérarchie : Unité")) echo 'disabledbutton' ?>" href="<?php echo url_for('@unite') ?>">Unité</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Hiérarchie : Poste")) echo 'disabledbutton' ?>" href="<?php echo url_for('@posterh') ?>">Poste</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Hiérarchie : Tâche")) echo 'disabledbutton' ?>" href="<?php echo url_for('@taches') ?>">Tâche</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cog"></i>
                                <span class="menu-text">Classificat° </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li class="hover">
                                    <a class="dropdown-toggle" href="#">
                                        <i class="menu-icon fa"></i>
                                        <span class="menu-text"> Par S° Administrative </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "S. Administrative : Filière")) echo 'disabledbutton' ?>" href="<?php echo url_for('@corps') ?>">Filières</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "S. Administrative : Corps")) echo 'disabledbutton' ?>" href="<?php echo url_for('@corpsdet') ?>">Corps</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "S. Administrative : Sous Corps")) echo 'disabledbutton' ?>" href="<?php echo url_for('@souscorps') ?>">Sous Corps</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "S. Administrative : Grade")) echo 'disabledbutton' ?>" href="<?php echo url_for('@grade') ?>">Grades</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "S. Administrative : Catégorie")) echo 'disabledbutton' ?>" href="<?php echo url_for('@categorierh') ?>">Catégories</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "S. Administrative : Echelon")) echo 'disabledbutton' ?>" href="<?php echo url_for('@echelon') ?>">Echelons</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "S. Administrative : Echelle")) echo 'disabledbutton' ?>" href="<?php echo url_for('@echelle') ?>">Echelles</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "S. Administrative : Grille de Salaire")) echo 'disabledbutton' ?>" href="<?php echo url_for('salairedebase/new') ?>">Grille de Salaire</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "S. Administrative : Titre Prime")) echo 'disabledbutton' ?>" href="<?php echo url_for('@titreprimes') ?>">Titres Primes</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "S. Administrative : Prime")) echo 'disabledbutton' ?>" href="<?php echo url_for('@primes') ?>">Primes</a></li>
                                    </ul>
                                </li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Etat Civil")) echo 'disabledbutton' ?>" href="<?php echo url_for('@etatcivil') ?>">Etat Civil</a></li>
                                <li class="hover">
                                    <a class="dropdown-toggle" href="#">
                                        <i class="menu-icon fa "></i>
                                        <span class="menu-text"> Par CV </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Diplôme")) echo 'disabledbutton' ?>" href="<?php echo url_for('@diplome') ?>">Diplômes</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Spécialité")) echo 'disabledbutton' ?>" href="<?php echo url_for('@specialite') ?>">Spécialités</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Langue")) echo 'disabledbutton' ?>" href="<?php echo url_for('@langues') ?>">Langues</a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Formation Continue")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typeexperience') ?>">Formations Continues</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-users"></i>
                                <span class="menu-text"> Personnels </span>
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
                                    <?php $acces_personnel = $user->getProfilModule($acces_rh->getId(), "Fiche Personnel"); ?>
                                    <?php $regreppement_agents_menus = RegroupementagentsTable::getInstance()->findAll(); ?>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$acces_personnel) echo 'disabledbutton'; ?>" href="<?php echo url_for('@agents') ?>">Tous</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <?php foreach ($regreppement_agents_menus as $regreppement_agents_menu): ?>
                                            <li class="hover">
                                                <a class="<?php if (!$acces_personnel) echo 'disabledbutton'; ?>" href="<?php echo url_for('agents/indexRegroupement?reg=' . $regreppement_agents_menu->getId()) ?>"><?php echo $regreppement_agents_menu ?></a>
                                                <b class="arrow"></b>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <li class="active open hover">
                                    <a class="dropdown-toggle" href="#">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Fiche Carrière 
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <?php $acces_personnel = $user->getProfilModule($acces_rh->getId(), "Fiche Personnel"); ?>
                                    <?php $regreppement_agents_menus = RegroupementagentsTable::getInstance()->findAll(); ?>
                                    <ul class="submenu">
<!--                                        <li class="hover">
                                            <a class="<?php // if (!$acces_personnel) echo 'disabledbutton'; ?>" href="<?php // echo url_for('@agents') ?>">Tous</a>
                                            <b class="arrow"></b>
                                        </li>-->
                                        <?php foreach ($regreppement_agents_menus as $regreppement_agents_menu): ?>
                                            <li class="hover">
                                                <a class="<?php if (!$acces_personnel) echo 'disabledbutton'; ?>" href="<?php echo url_for('contrat/indexRegroupement?reg=' . $regreppement_agents_menu->getId()) ?>"><?php echo $regreppement_agents_menu ?></a>
                                                <b class="arrow"></b>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                
                                <!--<li><a class="<?php // if (!$user->getProfilModule($acces_rh->getId(), "Fiche Carrière")) echo 'disabledbutton' ?>" href="<?php // echo url_for('@contrat') ?>">Fiche Carrière</a></li>-->  
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Fiche Discipline et Sanction")) echo 'disabledbutton' ?>" href="<?php echo url_for('@discipline') ?>">Fiche Discipline et Sanction</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Fiche Médaille et Récompense")) echo 'disabledbutton' ?>" href="<?php echo url_for('@recompense') ?>">Fiche Médaille et Récompense</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li class="hover" >
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-users"></i>
                                <span class="menu-text"> Ouvriers Occasionnels </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li class="hover">
                                    <a class="dropdown-toggle" href="#">
                                        <i class="menu-icon fa"></i>
                                        <span class="menu-text"> Paramètres Globaux</span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre Ouvrier : Chantier")) echo 'disabledbutton' ?>" href="<?php echo url_for('@chantier') ?>">Chantiers <span style="float: right; margin-right: 10px;"><?php echo '(الحضيرة)'; ?></span></a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre Ouvrier : Spécialité")) echo 'disabledbutton' ?>" href="<?php echo url_for('specialiteouvrier') ?>">Spécialités <span style="float: right; margin-right: 10px;"> <?php echo '( الاختصاص)' ?></span></a></li>
                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre Ouvrier : Situation Administrative")) echo 'disabledbutton' ?>" href="<?php echo url_for('situationadminouvrier') ?>">Situat° admin. <span style="float: right; margin-right: 10px;"><?php echo '(الوضع الإداري)'; ?><span></a></li>
                                         <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre Ouvrier : Lieu Affectation")) echo 'disabledbutton' ?>" href="<?php echo url_for('lieuaffectationouvrier') ?>">L. affectations <span style="float: right; margin-right: 10px;"><?php echo ' (مكان العمل )'; ?><span></a></li>
                                         <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Paramètre Ouvrier : Lieu Affectation")) echo 'disabledbutton' ?>" href="<?php echo url_for('@salairejournalier') ?>">Salaire Journalier <span style="float: right; margin-right: 10px;"><?php echo ' (الأجر اليومي)'; ?><span></a></li>
                                                                        </ul>
                                                                        </li>
                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Ouvrier")) echo 'disabledbutton' ?>" href="<?php echo url_for('@ouvrier') ?>">Fiche Ouvrier</a></li> 
                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Contrat Ouvrier")) echo 'disabledbutton' ?>" href="<?php echo url_for('contratouvrier') ?>">Fiche Contrat</a></li>  
                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Pointage Ouvrier")) echo 'disabledbutton' ?>" href="<?php echo url_for('@salaireouvrier') ?>">Fiche Pointage</a></li>
                                                                        </ul>
                                                                        </li>
                                                                        <li class="hover">
                                                                            <a class="dropdown-toggle" href="#">
                                                                                <i class="menu-icon fa fa-envelope"></i>
                                                                                <span class="menu-text"> Editions</span>
                                                                                <b class="arrow fa fa-angle-down"></b>
                                                                            </a>
                                                                            <b class="arrow"></b>
                                                                            <ul class="submenu">
                                                                                <li class="hover">
                                                                                    <a class="dropdown-toggle" href="#">
                                                                                        <i class="menu-icon fa"></i>
                                                                                        <span class="menu-text"> Fichiers de Base </span>
                                                                                        <b class="arrow fa fa-angle-down"></b>
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                                    <ul class="submenu">
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Edition Liste Employés")) echo 'disabledbutton' ?>" href="#my-modalrecherche" role="button" data-toggle="modal">Edition Liste des Employés</a></li>
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Edition Liste Employés / Situation")) echo 'disabledbutton' ?>" href="#my-modal1" role="button" data-toggle="modal">Edition Liste des Employés / Situation Administrative</a></li>
                                                                                    </ul>
                                                                                </li>
                                                                                <li class="hover">
                                                                                    <a class="dropdown-toggle" href="#">
                                                                                        <i class="menu-icon fa"></i>
                                                                                        <span class="menu-text"> Attestation </span>
                                                                                        <b class="arrow fa fa-angle-down"></b>
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                                    <ul class="submenu">
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Attestation de Travail")) echo 'disabledbutton' ?>" href="<?php echo url_for('@attestationdetravail') ?>">Attestation de tarvail </a></li>
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Attestation de Salaire Annuelle")) echo 'disabledbutton' ?>" href="<?php echo url_for('@attestationdesalaire') ?>">Attestation de salaire annuel</a></li> 
                                                                                        <li class="align_right"><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "استرجاع مصاريف")) echo 'disabledbutton' ?>" href="<?php echo url_for('@demandederemboursement') ?>"><?php echo 'استرجاع مصاريف'; ?></a></li> 
                                                                                        <li class="align_right"><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "استمارة فردية")) echo 'disabledbutton' ?>" href="<?php echo url_for('@formulaire') ?>"><?php echo 'استمارة فردية'; ?></a></li>
                                                                                        <li class="align_right"><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "بطاقة تشغيل")) echo 'disabledbutton' ?>" href="<?php echo url_for('@attestationouvrier') ?>"><?php echo 'بطاقة تشغيل'; ?></a></li> 
                                                                                        <li class="align_right"><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "أمـر بمـهـمــة")) echo 'disabledbutton' ?>" href="<?php echo url_for('@mission') ?>"><?php echo 'أمـر بمـهـمــة'; ?></a></li> 
                                                                                        <li class="align_right"><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "مطلب إطلاع على ملف إداري")) echo 'disabledbutton' ?>" href="<?php echo url_for('@demandedevoirfichieradmin') ?>"><?php echo 'مطلب إطلاع على ملف إداري'; ?></a></li>
                                                                                        <li class="align_right"><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "ترخيص للقيام بعيادة طبية")) echo 'disabledbutton' ?>" href="<?php echo url_for('autoristation') ?>"><?php echo 'ترخيص للقيام بعيادة طبية'; ?></a></li>
                                                                                    </ul>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li class="hover">
                                                                            <a class="dropdown-toggle" href="#">
                                                                                <i class="menu-icon fa fa-envelope"></i>
                                                                                <span class="menu-text"> Import </span>
                                                                                <b class="arrow fa fa-angle-down"></b>
                                                                            </a>
                                                                            <b class="arrow"></b>
                                                                            <ul class="submenu">
                                                                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Import")) echo 'disabledbutton' ?>" href="<?php echo url_for('import/paragents') ?>">Import Agents</a></li>
                                                                               <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Import")) echo 'disabledbutton' ?>" href="<?php echo url_for('import/parcontrat') ?>">Import Contrat Civil</a></li>
                                                                          <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Import")) echo 'disabledbutton' ?>" href="<?php echo url_for('import/parcontratmulitaire') ?>">Import Contrat Mulitaire</a></li>
                                                                         
                                                                            </ul>
                                                                        </li>
                                                                        <li class="hover">
                                                                            <a class="dropdown-toggle" href="#">
                                                                                <i class="menu-icon fa fa-bar-chart-o"></i>
                                                                                <span class="menu-text"> Statistiques</span>
                                                                                <b class="arrow fa fa-angle-down"></b>
                                                                            </a>
                                                                            <b class="arrow"></b>
                                                                            <ul class="submenu" >
                                                                                <li class="hover" >
                                                                                    <a class="dropdown-toggle" href="#">
                                                                                        <i class="menu-icon fa"></i>
                                                                                        <span class="menu-text"> Par S° Administrative </span>
                                                                                        <b class="arrow fa fa-angle-down"></b>
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                                    <ul class="submenu">
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Statistique S. Administrative : par Corps")) echo 'disabledbutton' ?>" href="<?php echo url_for('corps/statistiqueAgentParCorps') ?>"> Par Corps</a></li>
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Statistique S. Administrative : Sous Corp")) echo 'disabledbutton' ?>" href="<?php echo url_for('souscorps/statistiqueAgentParSouscorps') ?>"> Par Sous Corps</a></li>
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Statistique S. Administrative : Catégorie")) echo 'disabledbutton' ?>" href="<?php echo url_for('categorierh/statistiqueAgentParCategorie') ?>"> Par catégorie</a></li>
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Statistique S. Administrative : Grade")) echo 'disabledbutton' ?>" href="<?php echo url_for('grade/statistiqueAgentParGrade') ?>">Par Grade</a></li>
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Statistique S. Administrative : Echelle")) echo 'disabledbutton' ?>" href="<?php echo url_for('echelle/statistiqueAgentParEchelle') ?>">Par Echelle</a></li>
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Statistique S. Administrative : Echelon")) echo 'disabledbutton' ?>" href="<?php echo url_for('echelon/statistiqueAgentParEchelon') ?>">Par Echelon</a></li>
                                                                                    </ul>
                                                                                </li>
                                                                                <li class="hover">
                                                                                    <a class="dropdown-toggle" href="#">
                                                                                        <i class="menu-icon fa"></i>
                                                                                        <span class="menu-text"> Par Hiérarchie </span>
                                                                                        <b class="arrow fa fa-angle-down"></b>
                                                                                    </a>
                                                                                    <b class="arrow"></b>
                                                                                    <ul class="submenu">
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Statistique Hiérarchie : Direction")) echo 'disabledbutton' ?>" href="<?php echo url_for('direction/statistiqueAgentParDirection') ?>"> Par Direction</a></li>
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Statistique Hiérarchie : Sous Direction")) echo 'disabledbutton' ?>" href="<?php echo url_for('sousdirection/statistiqueAgentParSousdirection') ?>"> Par Sous Direction</a></li>
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Statistique Hiérarchie : Service")) echo 'disabledbutton' ?>" href="<?php echo url_for('servicerh/statistiqueAgentParService') ?>"> Par Service</a></li>
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Statistique Hiérarchie : Unité")) echo 'disabledbutton' ?>" href="<?php echo url_for('unite/statistiqueAgentParUnite') ?>">Par Unité</a></li>
                                                                                        <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Statistique Hiérarchie : Poste")) echo 'disabledbutton' ?>" href="<?php echo url_for('posterh/statistiqueAgentParPoste') ?>">Par Poste</a></li>
                                                                                    </ul>
                                                                                </li>
                                                                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Statistique Fonction")) echo 'disabledbutton' ?>" href="<?php echo url_for('fonction/statistiqueAgentParFonction') ?>">Par Fonction</a></li>  
                                                                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Statistique Situation Administrative")) echo 'disabledbutton' ?>" href="<?php echo url_for('typecontrat/statistiqueAgentParTypeContrat') ?>">Par Situat° administrative</a></li>                                               
                                                                                <li><a class="<?php if (!$user->getProfilModule($acces_rh->getId(), "Statistique Sexe")) echo 'disabledbutton' ?>" href="<?php echo url_for('agents/statistiqueAgentParSexe') ?>">Par Sexe</a></li>
                                                                            </ul>
                                                                        </li>

                                                                        </ul>
                                                                    <?php endif; ?>
                                                                    </div><!-- .sidebar -->
                                                                    </div>
                                                                    </div><!-- /.col -->
                                                                    </div><!-- /.row -->
                                                                    <div id="my-modalrecherche" class="modal fade" tabindex="-1" style="width: 1200px"> 
                                                                        <?php include_partial('agents/form_recherche', array()); ?>
                                                                    </div>

                                                                    <div id="my-modal1" class="modal fade" tabindex="-1" style="width: 1200px"> 
                                                                        <?php include_partial('agents/form_recherchesalariale', array()); ?>
                                                                    </div>
                                                                    <style>

                                                                        .align_right{
                                                                            text-align: right;
                                                                            margin-right: 10px;
                                                                            font-size: 16px;
                                                                        }

                                                                    </style>