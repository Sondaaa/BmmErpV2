<div id="sf_admin_container"><input type="hidden" id="id_regrouppement" value="<?php echo $id_regerouppement ?>">
    <?php if ($id_regerouppement == '1'): ?>
        <div id="sf_admin_content">
            <div class="row">
                <div class="col-sm-12">
                    <span class="text-primary">( * ) : Champ obligatoire.</span>
                </div>
            </div>
            <div  class="panel-body" ng-init="initialiserageretraiteAgents()">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true" ng-click="initialChampsDonnedebase();"  ><!---ng-show="ChargerAnciennteEchelle()"--->
                            <i class="green ace-icon fa fa-database bigger-120"></i> Données de base </a>
                    </li>

                    <li><a id="profilesalariale" href="#salaire" data-toggle="tab" aria-expanded="false" ng-click="initialChampsgrille();"><!--ng-show="ChargerAnciennteGrade()"-->
                            <i class="green ace-icon fa fa-table bigger-120"></i> Grille Salariale</a>
                    </li>
                    <li><a id="taches" href="#tache" data-toggle="tab" aria-expanded="false" ng-click="initialChampstache();">
                            <i class="green ace-icon fa fa-bolt bigger-120"></i> Tâches</a>
                        <?php if (!$form->getObject()->isNew()) { ?>
                        <li><a id="primes" href="#prime1" data-toggle="tab" aria-expanded="false" ng-click="initialChamps();">
                                <i class="green ace-icon fa fa-money bigger-120"></i> Primes</a>
                        <?php } ?>
                    </li>
                </ul>
                <div class="tab-content">  
                    <div class="tab-pane fade active in" id="home"  ><!--AfficheDetailAgents -->
                        <fieldset>
                            <legend><i> Données de base</i>
                                <input type="hidden" id="id_regroupement" value="<?php echo $id_regerouppement; ?>">
                                <a style="float: right; <?php if ($form->getObject()->isNew()): ?>display: none<?php endif; ?>" target="_blank" href="<?php echo url_for('contrat/ImprimerFicheDonneeBase') . '?id=' . $contrat->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                            </legend>

                            <div id="divajouagents" <?php if (!$form->getObject()->isNew()) { ?> ng-init="AfficheDetailAgents()" <?php } ?>>  

                            </div>
                            <input type="hidden" id="contrat_id"  value="<?php if (!$form->getObject()->isNew()) echo $form->getObject()->getId(); ?> ">
                            <table>
                                <tbody>
                                    <tr> <?php $agents = AgentsTable::getInstance()->findByIdRegrouppement($id_regerouppement) ?>
                                        <td><label> Agents <span class="required">*</span></label></td>
                                        <td>
                                            <select id="contrat_id_agents">
                                                <option value=""></option>
                                                <?php foreach ($agents as $agent): ?>
                                                    <option value="<?php echo $agent->getId() ?>" 
                                                            <?php if ($contrat->getIdAgents() == $agent->getId()): ?>selected="true"<?php endif; ?> >
                                                                <?php echo $agent->getIdrh() . ' ' . $agent->getNomcomplet() ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td colspan="2">  
                                            <input type="text" ng-model="idrh.text" id="idrh" placeholder="Matricule"  class="form-control" readonly="true">
                                            <input type="text" ng-model="datenaissance.text" id="datenaissance" placeholder="Date Naissance" readonly="true" class="form-control" >
                                        </td>
                                        <td id="ref" colspan="3" style="display: none">
                                            <input type="text" ng-model="refagents.text" id="refagents" placeholder="Matricule"  class="form-control" ng-change="AfficheAgents()">
                                            <input type="text" ng-model="agents.text" id="agents" placeholder="NomComplet"  onfocus="this.select();" class="form-control" ng-change="AfficheAgents()">
                                        </td>
                                        <td><label>Grade  </label></td>
                                        <td>
                                            <?php echo $form['id_grade']->renderError() ?>
                                            <?php echo $form['id_grade'] ?>
                                        </td>
                                       
                                    </tr>
                                    <tr>
                                        <td><label> Situation administrative </label></td>
                                        <td>
                                            <?php echo $form['id_typecontrat']->renderError() ?>
                                            <?php echo $form['id_typecontrat'] ?>
                                        </td>    <td><label>Positions administratives</label></td>
                                        <td>
                                            <?php echo $form['id_positionadmini']->renderError() ?>
                                            <?php echo $form['id_positionadmini'] ?>
                                        </td>
                                        <td><label> Lieu d'affectation </label></td>
                                        <td>
                                            <?php echo $form['id_lieu']->renderError() ?>
                                            <?php echo $form['id_lieu'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Corps de recrutement</label></td>
                                        <td><?php
                                            $magCorps = Doctrine_Core::getTable('corpsdet')->findAll();
                                            ?>
                                            <select id="magCo">
                                                <option></option>
                                                <?php foreach ($magCorps as $magCo) { ?>
                                                    <option value="<?php echo $magCo->getId() ?>"><?php echo $magCo ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td >
                                            <label> Grade de recrutement </label></td>
                                        <td id="gradeR" class="disabledbutton">   
                                            <?php echo $form['id_graderec']->renderError() ?>
                                            <?php echo $form['id_graderec'] ?>
                                        </td>

                                        <td><label> Date de recrutement</label></td>
                                        <td>
                                            <?php echo $form['dateemposte']->renderError() ?>
                                            <?php echo $form['dateemposte'] ?>
                                        </td> 
                                    </tr>
                                    <tr> 
                                        <td><label>Ancienneté Génerale</label></td>
                                        <td><input id="ancienneteGeneral" type="text"  placeholder="Ancienneté Générale" class="disabledbutton" ></td>

                                        <td><label>Corps de Titularisation</label></td>
                                        <td><?php
                                            $magCorps2 = Doctrine_Core::getTable('corpsdet')->findAll();
                                            ?>

                                            <select id="magCo2">
                                                <option></option>
                                                <?php foreach ($magCorps2 as $magCo2) { ?>
                                                    <option value="<?php echo $magCo2->getId() ?>"><?php echo $magCo2 ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td><label>Grade de Titularisation</label></td>
                                        <td id="gradeT" class="disabledbutton">
                                            <?php echo $form['id_gradetitu']->renderError() ?>
                                            <?php echo $form['id_gradetitu'] ?>
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td><label>Date titularisation</label></td>
                                        <td>
                                            <?php echo $form['datetitulaire']->renderError() ?>
                                            <?php echo $form['datetitulaire'] ?>
                                        </td> 
                                        <td><label>Age Retraite</label></td>

                                        <td  class="disabledbutton">
                                            <?php echo $form['id_retratite']->renderError() ?>
                                            <?php echo $form['id_retratite'] ?>
                                        </td> 
                                        <td colspan="2"class="disabledbutton" >
                                            <!--<input type="text" ng-model="contrat_dateretraite.text" id="contrat_dateretraite"   <?php // if (!$form->getObject()->isNew()):                                                                    ?> value="<?php // echo $contrat->getDateretraite();                                                                    ?>" <?php // endif;                                                                    ?> placeholder="Date Retraite" class="form-control">--> 
                                            <?php echo $form['dateretraite']->renderError() ?>
                                            <?php echo $form['dateretraite'] ?>
                                            <input readonly="true" type="text" ng-model="ageentre.text" id="ageentre" placeholder="Age à l'embauche "  class="form-control">

                                        </td>

                                    </tr>
                                    <tr> <td><label>Fonction  </label></td>
                                        <td>
                                            <?php echo $form['id_fonction']->renderError() ?>
                                            <?php echo $form['id_fonction'] ?>
                                        </td>
                                        <td><label>Régime Horaire</label></td>
                                        <td colspan="3"><input type="hidden" id="id_regime">
                                            <?php echo $form['id_regime']->renderError() ?>
                                            <?php echo $form['id_regime'] ?>
                                        </td>
                                       
                                    </tr>
                                    <tr>
                                         <td><label>Code Sociale <span class="required">*</span></label></td>
                                        <td>
                                            <?php echo $form['id_codesociale']->renderError() ?>
                                            <?php echo $form['id_codesociale'] ?>
                                        </td>
                                        <td><label>Taux Code Sociale <span class="required">*</span></label></td>
                                        <td id="tauxsociale" class="disabledbutton" colspan="3">
                                            <?php echo $form['id_lignecodesociale']->renderError() ?>
                                            <?php echo $form['id_lignecodesociale'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Identifiant unique(CNRPS)</label></td>
                                        <td>
                                            <?php echo $form['idunique']->renderError() ?>
                                            <?php echo $form['idunique'] ?>
                                        </td>


                                        <td><label>Date d'affiliation  </label></td>
                                        <td>
                                            <?php echo $form['dateaffiliation']->renderError() ?>
                                            <?php echo $form['dateaffiliation'] ?>
                                        </td>
                                        <td><label>Spécialité  </label></td>
                                        <td>
                                            <?php echo $form['specialite']->renderError() ?>
                                            <?php echo $form['specialite'] ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td><label>Contribition patronale </label></td>
                                        <td>
                                            <?php echo $form['id_contribiton']->renderError() ?>
                                            <?php echo $form['id_contribiton'] ?>
                                        </td>


                                        <td><label>Taux ontribiton  </label></td>
                                        <td id="contribiton" class="disabledbutton">
                                            <?php echo $form['id_lignecontribition']->renderError() ?>
                                            <?php echo $form['id_lignecontribition'] ?>
                                        </td>
                                        <td><label>Total des Taux  </label></td>
                                        <td>
                                            <?php echo $form['totaltauxsociale']->renderError() ?>
                                            <?php echo $form['totaltauxsociale'] ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>        
                        <?php if (!$form->getObject()->isNew()) { ?>
                            <div ng-init="AfficheLignedocHistoriqueFonctions(<?php echo $contrat->getId() ?>);" >
                                <legend><i> Historiques </i>
                                    <a style="float: right;  <?php if ($form->getObject()->isNew()): ?>display: none<?php endif; ?>" target="_blank" href="<?php echo url_for('contrat/ImprimerFicheHistorique') . '?id=' . $contrat->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                                </legend>

                                <fieldset>
                                    <?php if (!$form->getObject()->isNew()) { ?>
                                        <legend>Liste des Fonctions</legend>
                                        <table>
                                            <thead>
                                                <tr>   
                                                    <th>Fonctions</th> 
                                                    <th>Date de changement</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="ligne in listesFonctions">
                                                    <td>{{ligne.fonction}}</td>
                                                    <td>{{ligne.datesys}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </fieldset>
                            </div>
                        <?php } ?>
                        <?php if (!$form->getObject()->isNew()) { ?>
                            <div  ng-init="AfficheLignedocHistoriqueLieu(<?php echo $contrat->getId() ?>);">
                                <fieldset>
                                    <?php if (!$form->getObject()->isNew()) { ?>
                                        <legend>Liste des Lieux de travail</legend>
                                        <table>
                                            <thead>
                                                <tr>   
                                                    <th>Lieu de travail</th> 
                                                    <th>Date de changement</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="ligne in listesLieuTravail">
                                                    <td>{{ligne.lieu}}</td>
                                                    <td>{{ligne.datesys}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </fieldset>
                            </div>
                        <?php } ?>

                        <?php if (!$form->getObject()->isNew()) { ?>
                            <div ng-init="AfficheLignedocHistoriqueSituation(<?php echo $contrat->getId() ?>);" >
                                <fieldset>
                                    <?php if (!$form->getObject()->isNew()) { ?>
                                        <legend>Liste des Situations administratives</legend>
                                        <table>
                                            <thead>
                                                <tr>   
                                                    <th>Situation administrative</th> 
                                                    <th>Date de changement</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="ligne in listesSituations">
                                                    <td>{{ligne.situations}}</td>
                                                    <td>{{ligne.datesys}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </fieldset>
                            </div>
                        <?php } ?>

                        <?php if (!$form->getObject()->isNew()) { ?>
                            <div ng-init="AfficheLignedocHistoriquePositionsadministative(<?php echo $contrat->getId() ?>);" >
                                <fieldset>
                                    <?php if (!$form->getObject()->isNew()) { ?>
                                        <legend>Liste des Positions administratives</legend>
                                        <table>
                                            <thead>
                                                <tr>   
                                                    <th>Positions administratives</th> 
                                                    <th>Date de changement</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="ligne in listesPositions">
                                                    <td>{{ligne.positions}}</td>
                                                    <td>{{ligne.datesys}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </fieldset>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade " id="salaire" >
                        <fieldset>
                            <legend><i>Situation administrative</i>
                                <a style="float: right;  <?php if ($form->getObject()->isNew()): ?>display: none<?php endif; ?>" target="_blank" href="<?php echo url_for('contrat/ImprimerFicheSalariale') . '?id=' . $contrat->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                            </legend>
                            <table>
                                <tbody>
                                    <tr>
                                        <td><label>Filiére <span class="required">*</span></label></td>
                                        <td><?php $magFiliere = Doctrine_Core::getTable('corps')->findAll(); ?>
                                            <select id="magFiliere">
                                                <option></option>
                                                <?php foreach ($magFiliere as $magF) { ?>
                                                    <option value="<?php echo $magF->getId() ?>"><?php echo $magF ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td><label>Catégorie <span class="required">*</span></label></td>
                                        <td><?php
                                            $mags = Doctrine_Core::getTable('categorierh')->findAll();
                                            ?>
                                            <!--<input type="text" <?php //  if (sizeof($resultat) >1 ):    ?>value="14"<?php // endif;    ?>>-->
                                            <select id="magCat">
                                                <option></option>
                                                <?php foreach ($mags as $magCat) { ?>
                                                    <option  <?php
                                                    if (sizeof($resultat) == 1):

                                                        if ($resultat[0]['categorie'] == $magCat->getId()) {
                                                            ?>selected="true"<?php }endif; ?> 
                                                        value="<?php echo $magCat->getId() ?>">
                                                            <?php echo $magCat->getLibelle(); ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td> <label>Corps <span class="required">*</span></label></td>
                                        <?php
                                        $mags = Doctrine_Core::getTable('corpsdet')->findAll();
                                        ?>
                                        <td>
                                            <select id="magC">
                                                <option></option>
                                                <?php foreach ($mags as $magC) { ?>
                                                    <option value="<?php echo $magC->getId() ?>"><?php echo $magC ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Grade <span class="required">*</span></label></td>
                                        <td>
                                            <?php $magg = Doctrine_Core::getTable('grade')->findAll(); ?>
                                            <select id="magG">
                                                <option></option>
                                                <?php foreach ($magg as $magG) { ?>
                                                    <option <?php if (sizeof($resultat) == 1 && $resultat[0]['grade'] == $magG->getId()): ?>selected="true"<?php endif; ?>  value="<?php echo $magG->getId() ?>"><?php echo $magG ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td><label> Date grade</label></td>
                                        <td>
                                            <?php echo $form['dategrade']->renderError() ?>
                                            <?php echo $form['dategrade'] ?>
                                        </td>
                                        <td><label>Ancienneté dans le grade</label></td>
                                        <td><input id="ancienneteGrade" type="text"  placeholder="Ancienneté Dans le grade" class="disabledbutton" ></td>
                                    </tr>
                                    <tr>
                                        <td><label>Echelle <span class="required">*</span></label></td>
                                        <td>
                                            <?php $mags = Doctrine_Core::getTable('echelle')->findAll(); ?>
                                            <select id="magE">
                                                <option></option>
                                                <?php foreach ($mags as $magE) { ?>
                                                    <option <?php if (sizeof($resultat) == 1 && $resultat[0]['echelle'] == $magE->getId()): ?>selected="true"<?php endif; ?>  value="<?php echo $magE->getId() ?>"><?php echo $magE ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td><label>Date Echelle</label></td>
                                        <td>
                                            <?php echo $form['dateechelle']->renderError() ?>
                                            <?php echo $form['dateechelle'] ?>
                                        </td>
                                        <td><label>Ancienneté dans l'echelle</label></td>
                                        <td><input id="ancienneteEchelle" type="text" placeholder="Ancienneté Dans l'echelle" class="disabledbutton"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Echelon <span class="required">*</span></label></td>
                                        <td><?php $mags = Doctrine_Core::getTable('echelon')->findAll(); ?>
                                            <select id="magEchelon">
                                                <option></option>
                                                <?php foreach ($mags as $magEchelon) { ?>
                                                    <option <?php if (sizeof($resultat) == 1 && $resultat[0]['echelon'] == $magEchelon->getId()): ?>selected="true"<?php endif; ?> value="<?php echo $magEchelon->getId() ?>"><?php echo $magEchelon ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td><label>Date Niveau (Echelon)</label></td>

                                        <td><?php echo $form['dateechelon']->renderError() ?>
                                            <?php echo $form['dateechelon'] ?></td>
                                        <td><label>Ancienneté dans l'echellon(/Mois)</label></td>
                                        <td><input id="ancienneteEchellon" type="text"  placeholder="Ancienneté Dans l'echellon" class="disabledbutton" ></td>

                                    </tr> 
                                    <tr>    
                                        <td><label>Salaire de base <span class="required">*</span></label></td>
                                        <td class="disabledbutton">     
                                            <?php echo $form['montant']->renderError() ?>
                                            <?php echo $form['montant'] ?>
                                        </td>
                                        <td style="display: none">  
                                            <?php echo $form['id_salairedebase']->renderError() ?>
                                            <?php echo $form['id_salairedebase'] ?>
                                        </td>
                                        <td colspan="2"><label>Date Validation( Modification  Salaire de base)<span class="required">*</span> </label></td>
                                        <td colspan="2">     
                                            <?php echo $form['datevalidesalaire']->renderError() ?>
                                            <?php echo $form['datevalidesalaire'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Salaire Théorique </label></td>
                                        <td>     
                                            <?php echo $form['salairetheorique']->renderError() ?>
                                            <?php echo $form['salairetheorique'] ?>
                                        </td>
                                        <td><label>Nature des promotions </label></td>
                                        <td>     
                                            <?php echo $form['id_naturepromo']->renderError() ?>
                                            <?php echo $form['id_naturepromo'] ?>
                                        </td>
                                        <td><label>Date de promotion </label></td>
                                        <td>     
                                            <?php echo $form['datepromotions']->renderError() ?>
                                            <?php echo $form['datepromotions'] ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>
                        <?php if (!$form->getObject()->isNew()) { ?>
                            <div ng-init="AfficheLignedocHistorique(<?php echo $contrat->getId() ?>);">
                                <legend><i> Historiques Promotions</i>
                                    <a style="float: right;  <?php if ($form->getObject()->isNew()): ?>display: none<?php endif; ?>" target="_blank" href="<?php echo url_for('contrat/ImprimerFicheHistoriquePromotion') . '?id=' . $contrat->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                                </legend>
                                <fieldset>
                                    <?php if (!$form->getObject()->isNew()) { ?>
                                        <legend>Liste des Promotions</legend>
                                        <table>
                                            <thead>
                                                <tr>   
                                                    <th>Nature Promotion</th> 
                                                    <th>Grade</th>
                                                    <th>Date d'effet</th>
                                                    <th>Date de changement</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="ligne in listesPromotions">
                                                    <td>{{ligne.naturepromotion}}</td>
                                                    <td>{{ligne.grade}}</td>
                                                    <td>{{ligne.dateeffet}}</td>
                                                    <td>{{ligne.datesys}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </fieldset>
                            </div>
                        <?php } ?>
                        <?php if (!$form->getObject()->isNew()) { ?>
                            <div ng-init="AfficheLignedocHistoriqueSalaire(<?php echo $contrat->getId() ?>);">
                                <legend><i> Historiques Salaire de Base</i>
                                    <a style="float: right;  <?php if ($form->getObject()->isNew()): ?>display: none<?php endif; ?>" target="_blank"
                                       href="<?php echo url_for('contrat/ImprimerFicheHistoriqueSalaire') . '?id=' . $contrat->getId() ?>"
                                       class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                                </legend>
                                <fieldset>
                                    <?php if (!$form->getObject()->isNew()) { ?>
                                        <legend>Liste des Salaires</legend>
                                        <table>
                                            <thead>
                                                <tr>   
                                                    <th>Salaire de Base</th> 
                                                    <th>Date Validation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="ligne in listesSalairedebase">
                                                    <td>{{ligne.salaire}}</td>
                                                    <td>{{ligne.date}}</td>
                                                    <td style="display: none">{{ligne.idsalaire}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </fieldset>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade" id="tache">
                        <fieldset> 
                            <div class="col-lg-8"> 
                                <legend><i> Liste des tâches </i>
                                    <a style="float: right; <?php if ($form->getObject()->isNew()): ?>display: none<?php endif; ?>" target="_blank" href="<?php echo url_for('contrat/ImprimerFicheTache') . '?id=' . $contrat->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                                </legend>
                                <input type="hidden" id="idposte">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><label>Poste </label></td>
                                            <td>
                                                <?php echo $form['id_posterh']->renderError() ?>
                                                <?php echo $form['id_posterh'] ?>
                                            </td>
                                            <td><label>Unite  <span class="required">*</span></label></td>
                                            <td>
                                                <?php echo $form['id_unite']->renderError() ?>
                                                <?php echo $form['id_unite'] ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table id="magtache">
                                    <thead>
                                        <tr>
                                            <th style="width: 90%">Tâche</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="ligne in listesTaches">
                                            <td>{{ligne.libelle}}</td>
                                            <td>
    <!--                                            <input type="button" value="Supprimer" ng-click="suprimerTache(ligne.id);"><i class="ace-icon fa fa-trash align-top bigger-110"></i></td>-->
                                                <a ng-click="suprimerTache(ligne.id);" class="btn btn-warning btn-ci" ><i class="ace-icon fa fa-trash align-top bigger-110"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table style="width: 25px"  align="right" class="divider">
                                    <tr> 
    <!--                                    <td> 
                                             <a  data-rel="tooltip" onclick="ajouterLastLigne()" class="btn btn-info" style="float: right; padding: 4px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-down align-top bigger-110"></i> Ajouter Ligne</a>
                              
                                            <a class="btn btn-info" href="<?php // echo url_for('taches/new')                                                                                 ?>">Ajouter Tâche</a>  
                                        </td>-->
                                        <td>
                                            <a href="#my-modal" role="button" class="btn btn-primary" data-toggle="modal">
                                                &nbsp; + &nbsp;
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                    </div>
                    <?php if (!$form->getObject()->isNew()) {
                        ?>
                        <div class="tab-pane fade" id="prime1" ng-init="AfficheLignedocPrime('<?php echo $contrat->getId() ?>');" ><!-- ng-click="ChargerPrimeDetaille()" -->
                            <fieldset>  
                                <div class="col-lg-12"> 
                                    <legend><i> Liste des Primes </i>
                                        <a  style="float: right;  <?php if ($form->getObject()->isNew()): ?>display: none<?php endif; ?>" target="_blank" href="<?php echo url_for('contrat/ImprimerFichePrime') . '?id=' . $contrat->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                                    </legend>
                                    <table>
                                        <thead>
                                            <tr> <th style="width: 5%">N°ordre</th>
                                                <th style="width: 40%">Prime</th>
                                                <th style="width: 10%">Montant</th>
                                                <th style="width: 15%">Date Début Ajout</th>
                                                <th style="width: 15%">Date Fin </th>
                                                <th style="width: 15%; text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="formligne">
                                                <td style="width: 5px !important">
                                                    <input type="text" value="" ng-model="norgdre.text" id="nordreprime"  class="form-control disabledbutton" ></td>
                                                <td style="width: 40px">
                                                    <select id="magprime">
                                                        <option></option>
                                                    </select>
                                                </td> 
                                                <td><input type="text" value="" ng-model="montantp.text" id="montantp" autocomplete="off"  class="form-control disabledbutton" placeholder="Montant"></td>
                                                <td><input type="date" value="" ng-model="datedebutvalide.text" id="datedebutvalide" autocomplete="off"  class="form-control " placeholder="Date debut"></td>
                                                <td><input type="date" value="" ng-model="datefinvalide.text" id="datefinvalide" autocomplete="off"  class="form-control " placeholder="Date Fin"></td>
                                                <td style="display: none;"><input type="text" id="idp"></td>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-info btn-circle" ng-click="AjouterLignePrimes()"><b>+</b></button>
                                                    <button type="button" class="btn btn-warning btn-ci" ng-click="InaliserChampsPrimes()"><b>-</b></button>
                                                </td>  
                                            </tr>
                                            <tr ng-repeat="lignedocPrime in listedocsPrime">
                                                <td>{{lignedocPrime.norgdre}}</td>
                                                <td>{{lignedocPrime.magprime}}</td>
                                                <td>{{lignedocPrime.montantp}}</td>
                                                <td>{{lignedocPrime.datedebutvalide}}</td>
                                                <td>{{lignedocPrime.datefinvalide}}</td>
                                                <td style="display: none">{{lignedocPrime.idp}}</td>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-info btn-circle" ng-click="MisAJourPrimes(lignedocPrime)">
                                                        <i class="fa fa-hospital-o"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-circle" ng-click="DeletePrimes(lignedocPrime)"><i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table style="width: 15%;" align="right">
                                        <tbody>
                                            <tr> 
                                                <td style="text-align: center;">  
                                                    <button type="button" id="btnvaliderPrime" class="btn btn-info" ng-click="validerAjoutPrime()">valider</button>
                                                </td> 
                                            </tr> 
                                        </tbody>  
                                    </table>
                                </div>
                            </fieldset>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
        </div>  
    <?php elseif ($id_regerouppement == 2): ?>
        <div id="sf_admin_content">
            <fieldset>
                <legend><i> Données de base</i>
                    <input type="hidden" id="id_regroupement" value="<?php echo $id_regerouppement; ?>">
                </legend>


        </div>
        <?php $agents = AgentsTable::getInstance()->findByIdRegrouppement($id_regerouppement) ?>
        <table>  <input type="hidden" id="contrat_id"  value="<?php if (!$form->getObject()->isNew()) echo $form->getObject()->getId(); ?> ">

            <tbody>
                <tr>
                    <td><label> Agents <span class="required">*</span></label></td>
                    <td>
                        <select id="contrat_id_agents_militaire">
                            <option value=""></option>
                            <?php foreach ($agents as $agent): ?>
                                <option value="<?php echo $agent->getId() ?>">
                                    <?php echo $agent->getIdrh() . ' ' . $agent->getNomcomplet() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td colspan="2">  
                        <input type="text" ng-model="idrh.text" id="idrh" placeholder="Matricule"  class="form-control" readonly="true">
                        <input type="text" ng-model="datenaissance.text" id="datenaissance" placeholder="Date Naissance" readonly="true" class="form-control" >
                    </td>
                    <td id="ref" colspan="3" style="display: none">
                        <input type="text" ng-model="refagents.text" id="refagents" placeholder="Matricule"  class="form-control" ng-change="AfficheAgents()">
                        <input type="text" ng-model="agents.text" id="agents" placeholder="NomComplet"  onfocus="this.select();" class="form-control" ng-change="AfficheAgents()">
                    </td>

                <tr>
                    <td><label>Poste </label></td>
                    <td>
                        <?php echo $form['id_posterh']->renderError() ?>
                        <?php echo $form['id_posterh'] ?>
                    </td>
                    <td><label>Unite <span class="required">*</span></label></td>
                    <td>
                        <?php echo $form['id_unite']->renderError() ?>
                        <?php echo $form['id_unite'] ?>
                    </td>
                </tr>

                <tr>
                    <td >
                        <label> Grade de recrutement </label></td>
                    <td >   
                        <?php echo $form['id_grade']->renderError() ?>
                        <?php echo $form['id_grade'] ?>
                    </td>

                    <td><label> Date de recrutement</label></td>
                    <td>
                        <?php echo $form['dateemposte']->renderError() ?>
                        <?php echo $form['dateemposte'] ?>
                    </td> 
                </tr>
                <tr>
                    <td><label>Spécialité  </label></td>
                    <td>
                        <?php echo $form['specialite']->renderError() ?>
                        <?php echo $form['specialite'] ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset> 
    </div>
<?php endif; ?>
</div>  
<div id="my-modal" class="modal fade" tabindex="-1">
    <?php
    include_partial('taches/form_taches', array());
    ?>
</div>