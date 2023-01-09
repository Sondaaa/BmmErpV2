<div id="sf_admin_container" ng-init="InialiserBtn()">
    <div id="sf_admin_content">  
        <div  class="panel-body" ng-init="initialiserageretraiteAgents()" ><!--ng-show="ChargerAnciennteEchellon()" -->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true" ng-click="initialChampsDonnedebase();"  ><!---ng-show="ChargerAnciennteEchelle()"--->
                        <i class="green ace-icon fa fa-usb bigger-120"></i> Données de base </a>
                </li>
                <li><a id="profilesalariale" href="#salaire" data-toggle="tab" aria-expanded="false" ng-click="initialChampsgrille();"><!--ng-show="ChargerAnciennteGrade()"-->
                        <i class="green ace-icon fa fa-money bigger-120"></i> Grille Salariale</a>
                </li>
                <li><a id="taches" href="#tache" data-toggle="tab" aria-expanded="false" ng-click="initialChampstache();">
                        <i class="green ace-icon fa fa-money bigger-120"></i> Tâches</a>
                    <?php if (!$form->getObject()->isNew()) { ?>
                    <li><a id="primes" href="#prime1" data-toggle="tab" aria-expanded="false" ng-click="initialChamps();">
                            <i class="green ace-icon fa fa-money bigger-120"></i> Primes</a>
                    <?php } ?>
                </li>
            </ul>
            <div class="tab-content">  
                <div class="tab-pane fade active in" id="home"><!--AfficheDetailAgents -->
                    <fieldset>
                        <legend>
                            <i> Données de base</i>
                            <a style="float: right;" target="_blank" href="<?php echo url_for('contrat/ImprimerFicheDonneeBase') . '?id=' . $contrat->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                        </legend>
                        <div id="divajouagents" <?php if (!$form->getObject()->isNew()) { ?> ng-init="AfficheDetailAgents()" <?php } ?>>  

                        </div>
                        <input type="hidden" id="contrat_id" value="<?php
                        if (!$form->getObject()->isNew())
                            echo $form->getObject()->getId();
                        else
                            echo "";
                        ?>">
                        <table>
                            <tbody>
                                <tr>
                                    <td><label> Agents </label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['id_agents']->renderError() ?>
                                        <?php echo $form['id_agents'] ?>
                                    </td>
                                    <td colspan="2" class="disabledbutton">  
                                        <input type="text" ng-model="idrh.text" id="idrh" placeholder="Matricule"  class="form-control" >
                                        <input type="text" ng-model="datenaissance.text" id="datenaissance" placeholder="Date Naissance"  class="form-control" >
                                    </td>
                                    <td id="ref" colspan="3" style="display: none">
                                        <input type="text" ng-model="refagents.text" id="refagents" placeholder="Matricule"  class="form-control" ng-change="AfficheAgents()">
                                        <input type="text" ng-model="agents.text" id="agents" placeholder="NomComplet"  onfocus="this.select();" class="form-control" ng-change="AfficheAgents()">
                                    </td>
                                    <td><label>Fonction</label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['id_fonction']->renderError() ?>
                                        <?php echo $form['id_fonction'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label> Situation administrative </label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['id_typecontrat']->renderError() ?>
                                        <?php echo $form['id_typecontrat'] ?>
                                    </td><td><label>Positions administratives</label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['id_positionadmini']->renderError() ?>
                                        <?php echo $form['id_positionadmini'] ?>
                                    </td>
                                    <td><label> Lieu d'affectation </label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['id_lieu']->renderError() ?>
                                        <?php echo $form['id_lieu'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Corps</label></td>
                                    <td class="disabledbutton">
                                        <?php $magCorps = Doctrine_Core::getTable('corpsdet')->findAll(); ?>
                                        <select id="magCo">
                                            <option></option>
                                            <?php foreach ($magCorps as $magCo) { ?>
                                                <option value="<?php echo $magCo->getId() ?>"><?php echo $magCo ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <label> Grade de recrutement </label></td>
                                    <td id="gradeR" class="disabledbutton">   
                                        <?php echo $form['id_graderec']->renderError() ?>
                                        <?php echo $form['id_graderec'] ?>
                                    </td>
                                    <td><label> Date de recrutement</label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['dateemposte']->renderError() ?>
                                        <?php echo $form['dateemposte'] ?>
                                    </td> 
                                </tr>
                                <tr> 
                                    <td><label>Ancienneté Génerale</label></td>
                                    <td class="disabledbutton"><input id="ancienneteGeneral" type="text"  placeholder="Ancienneté Générale" class="disabledbutton" ></td>

                                    <td><label>Corps</label></td>
                                    <td class="disabledbutton">
                                        <?php $magCorps2 = Doctrine_Core::getTable('corpsdet')->findAll(); ?>
                                        <select id="magCo2">
                                            <option></option>
                                            <?php foreach ($magCorps2 as $magCo2) { ?>
                                                <option value="<?php echo $magCo2->getId() ?>"><?php echo $magCo2 ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><label>Grade titularisation</label></td>
                                    <td id="gradeT" class="disabledbutton">
                                        <?php echo $form['id_gradetitu']->renderError() ?>
                                        <?php echo $form['id_gradetitu'] ?>
                                    </td> 
                                </tr>
                                <tr>
                                    <td><label>Date titularisation</label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['datetitulaire']->renderError() ?>
                                        <?php echo $form['datetitulaire'] ?>
                                    </td> 
                                    <td><label>Age Retraite</label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['id_retratite']->renderError() ?>
                                        <?php echo $form['id_retratite'] ?>
                                    </td> 
                                    <td colspan="2" class="disabledbutton">
                                        <?php echo $form['dateretraite']->renderError() ?>
                                        <?php echo $form['dateretraite'] ?>
                                        <input readonly="true" type="text" ng-model="ageentre.text" id="ageentre" placeholder="Age à l'embauche " class="form-control">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>

                    <div ng-init="AfficheLignedocHistoriqueFonctions(<?php echo $contrat->getId() ?>);">
                        <fieldset>
                            <legend>
                                <i style="color: #64c633;"> Historiques </i>
                                <a style="float: right;" target="_blank" href="<?php echo url_for('contrat/ImprimerFicheHistorique') . '?id=' . $contrat->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                            </legend>
                            <legend><i>Liste des Fonctions</i></legend>
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
                        </fieldset>
                    </div>
                    <div ng-init="AfficheLignedocHistoriqueLieu(<?php echo $contrat->getId() ?>);">
                        <fieldset>
                            <legend><i>Liste des Lieux de travail</i></legend>
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
                        </fieldset>
                    </div>

                    <div ng-init="AfficheLignedocHistoriqueSituation(<?php echo $contrat->getId() ?>);" >
                        <fieldset>
                            <legend><i>Liste des Situations administratives</i></legend>
                            <table>
                                <thead>
                                    <tr>   
                                        <th>Situation administratives</th> 
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
                        </fieldset>
                    </div>

                    <div ng-init="AfficheLignedocHistoriquePositionsadministative(<?php echo $contrat->getId() ?>);" >
                        <fieldset>
                            <legend><i>Liste des Positions administratives</i></legend>
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
                        </fieldset>
                    </div>
                </div>
                <div class="tab-pane fade" id="salaire">
                    <fieldset>
                        <legend>
                            <i>Situation administrative</i>
                            <a style="float: right;" target="_blank" href="<?php echo url_for('contrat/ImprimerFicheSalariale') . '?id=' . $contrat->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                        </legend>
                        <table>
                            <tbody>
                                <tr>
                                    <td><label>Corps</label></td>
                                    <td class="disabledbutton">
                                        <?php $mags = Doctrine_Core::getTable('corpsdet')->findAll(); ?>
                                        <select id="magC">
                                            <option></option>
                                            <?php foreach ($mags as $magC) { ?>
                                                <option value="<?php echo $magC->getId() ?>"><?php echo $magC ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><label>Catégorie</label></td>
                                    <td colspan="3" class="disabledbutton">
                                        <?php $mags = Doctrine_Core::getTable('categorierh')->findAll(); ?>
                                        <select id="magCat">
                                            <option></option>
                                            <?php foreach ($mags as $magCat) { ?>
                                                <option <?php if ($resultat[0]['categorie'] == $magCat->getId()): ?>selected="true"<?php endif; ?> value="<?php echo $magCat->getId() ?>"><?php echo $magCat ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Grade</label></td>
                                    <td class="disabledbutton">
                                        <?php $mags = Doctrine_Core::getTable('grade')->findAll(); ?>
                                        <select id="magG">
                                            <option></option>
                                            <?php foreach ($mags as $magG) { ?>
                                                <option <?php if ($resultat[0]['grade'] == $magG->getId()): ?>selected="true"<?php endif; ?> value="<?php echo $magG->getId() ?>"><?php echo $magG ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><label> Date grade</label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['dategrade']->renderError() ?>
                                        <?php echo $form['dategrade'] ?>
                                    </td>
                                    <td><label>Ancienneté dans le grade</label></td>
                                    <td class="disabledbutton"><input id="ancienneteGrade" type="text"  placeholder="Ancienneté Dans le grade" class="disabledbutton"></td>
                                </tr>
                                <tr>
                                    <td><label>Echelle</label></td>
                                    <td class="disabledbutton">
                                        <?php $mags = Doctrine_Core::getTable('echelle')->findAll(); ?>
                                        <select id="magE">
                                            <option></option>
                                            <?php foreach ($mags as $magE) { ?>
                                                <option <?php if ($resultat[0]['echelle'] == $magE->getId()): ?>selected="true"<?php endif; ?> value="<?php echo $magE->getId() ?>"><?php echo $magE ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><label>Date Echelle</label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['dateechelle']->renderError() ?>
                                        <?php echo $form['dateechelle'] ?>
                                    </td>
                                    <td><label>Ancienneté dans l'echelle</label></td>
                                    <td class="disabledbutton"><input id="ancienneteEchelle" type="text"  placeholder="Ancienneté Dans l'echelle" class="disabledbutton"></td>
                                </tr>
                                <tr>
                                    <td><label>Echelon</label></td>
                                    <td class="disabledbutton">
                                        <?php $mags = Doctrine_Core::getTable('echelon')->findAll(); ?>
                                        <select id="magEchelon">
                                            <option></option>
                                            <?php foreach ($mags as $magEchelon) { ?>
                                                <option <?php if ($resultat[0]['echelon'] == $magEchelon->getId()): ?>selected="true"<?php endif; ?> value="<?php echo $magEchelon->getId() ?>"><?php echo $magEchelon ?></option>
                                            <?php } ?>
                                        </select></td>
                                    <td><label>Date Niveau (Echelon)</label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['dateechelon']->renderError() ?>
                                        <?php echo $form['dateechelon'] ?>
                                    </td>
                                    <td><label>Ancienneté dans l'echellon(/Mois)</label></td>
                                    <td class="disabledbutton"><input id="ancienneteEchellon" type="text" placeholder="Ancienneté Dans l'echellon" class="disabledbutton"></td>
                                </tr> 
                                <tr>    
                                    <td><label>Salaire de base</label></td>
                                    <td class="disabledbutton">     
                                        <?php echo $form['montant']->renderError() ?>
                                        <?php echo $form['montant'] ?>
                                    </td> 
                                    <td style="display: none">
                                        <?php echo $form['id_salairedebase']->renderError() ?>
                                        <?php echo $form['id_salairedebase'] ?>
                                    </td>
                                    <td><label>Nature des promotions </label></td>
                                    <td class="disabledbutton">     
                                        <?php echo $form['id_naturepromo']->renderError() ?>
                                        <?php echo $form['id_naturepromo'] ?>
                                    </td>
                                    <td><label>Date de promotion </label></td>
                                    <td class="disabledbutton">     
                                        <?php echo $form['datepromotions']->renderError() ?>
                                        <?php echo $form['datepromotions'] ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                    <div ng-init="AfficheLignedocHistorique(<?php echo $contrat->getId() ?>);">
                        <fieldset>
                            <legend>
                                <i style="color: #64c633;"> Historiques Promotions </i>
                                <a style="float: right;" target="_blank" href="<?php echo url_for('contrat/ImprimerFicheHistoriquePromotion') . '?id=' . $contrat->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                            </legend>
                            <legend><i> Liste des Promotions </i></legend>
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
                        </fieldset>
                    </div>
                </div>
                <div class="tab-pane fade" id="tache">
                    <fieldset > 
                        <div class="col-lg-8"> 
                            <legend>
                                <i> Liste des tâches </i>
                                <a style="float: right;" target="_blank" href="<?php echo url_for('contrat/ImprimerFicheTache') . '?id=' . $contrat->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                            </legend>
                            <table>
                                <tbody>
                                    <tr>
                                        <td><label>Poste</label></td>
                                        <td class="disabledbutton">
                                            <?php echo $form['id_posterh']->renderError() ?>
                                            <?php echo $form['id_posterh'] ?>
                                            <input type="hidden" id="idposte">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table id="magtache">
                                <thead>
                                    <tr>
                                        <th>Tâche</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="ligne in listesTaches">
                                        <td>{{ligne.libelle}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </div>
                <div class="tab-pane fade" id="prime1" ng-init="AfficheLignedocPrime(<?php echo $contrat->getId() ?>);">
                    <fieldset>  
                        <div class="col-lg-12">
                            <legend>
                                <i> Liste des Primes </i>
                                <a style="float: right;" target="_blank" href="<?php echo url_for('contrat/ImprimerFichePrime') . '?id=' . $contrat->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                            </legend>
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 5%">N°ordre</th>
                                        <th style="width: 40%">Prime</th>
                                        <th style="width: 5%">Montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="lignedocPrime in listedocsPrime">
                                        <td>{{lignedocPrime.norgdre}}</td>
                                        <td id="magprime_{{lignedocPrime.norgdre}}">{{lignedocPrime.magprime}}</td>
                                        <td>{{lignedocPrime.montantp}}</td>
                                        <td style="display:none">{{lignedocPrime.idprime}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>  
</div>