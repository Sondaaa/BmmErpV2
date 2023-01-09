<div id="sf_admin_container" ng-controller="CtrlRessourcehumaine">
    <div id="sf_admin_content">  
        <div class="panel-body">
            <div class="tab-content col-lg-12" ng-init="initialiserageretraite()">  
                <fieldset>
                    <div id="divoubrier" <?php if (!$form->getObject()->isNew()) { ?> ng-init="AfficheDetailOuvrier()" <?php } ?>>  
                        <legend>
                            Contrat
                            <?php if (!$form->getObject()->isNew()) { ?><a target="_blank" href="<?php echo url_for('contratouvrier/ImprimerFicheContrat') . '?id=' . $contratouvrier->getId() ?>" class="btn btn-xs btn-primary pull-right">Imprimer Contrat</a><?php } ?>
                        </legend>                       
                        <table>
                            <tbody>
                                <tr>
                                    <td><label> Ouvrier </label><span class="align2">(عامل الحضيرة )</span></td>
                                    <td>
                                        <?php echo $form['id_ouvrier']->renderError() ?>
                                        <?php echo $form['id_ouvrier'] ?>
                                    </td>
                                    <td colspan="2" class="disabledbutton">
                                        <input type="text" ng-model="datenaissance.text" id="datenaissance" placeholder="Date Naissance"  class="form-control" >
                                    </td>
                                    <td id="ref" colspan="3" style="display: none">
                                        <input type="text" ng-model="refouvrier.text" id="refouvrier" placeholder="Matricule"  class="form-control" ng-change="AfficheOuvrier()">
                                        <input type="text" ng-model="ouvrier.text" id="ouvrier" placeholder="NomComplet"   class="form-control" ng-change="AfficheOuvrier()">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Date de recrutement</label><span class="align2">(تاريخ الإنتداب )</span></td>
                                    <td>
                                        <?php echo $form['daterecrutement']->renderError() ?>
                                        <?php echo $form['daterecrutement'] ?>
                                    </td>
                                    <td><label> Date début contrat</label><span class="align2"> (بداية العقد )  </span></td>
                                    <td>   
                                        <?php echo $form['datedebutcontrat']->renderError() ?>
                                        <?php echo $form['datedebutcontrat'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label> Date fin contrat</label><span class="align2"> (نهاية العقد)</span></td>
                                    <td>
                                        <?php echo $form['datefincontrat']->renderError() ?>
                                        <?php echo $form['datefincontrat'] ?>
                                    </td> 
                                    <td style="display: none">
                                        <input type="text" ng-model="nbjour.text" id="nbjour" placeholder="nbrjour" class="form-control">
                                    </td> 
                                    <td style="display: none">
                                        <input type="text" id="mnbjour" placeholder="mnbrjour" class="form-control">
                                    </td>
                                    <td><label>Lieu affectation</label><span class="align2">(مكان العمل) </span></td>
                                    <td>
                                        <?php echo $form['id_lieuaffetation']->renderError() ?>
                                        <?php echo $form['id_lieuaffetation'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Spécialité</label><span class="align2">(الاختصاص )</span></td>
                                    <td>
                                        <?php echo $form['id_specialteouvrier']->renderError() ?>
                                        <?php echo $form['id_specialteouvrier'] ?>
                                    </td>
                                    <td><label> Chantier</label><span class="align2">(الحضيرة)  </span></td>
                                    <td>
                                        <?php echo $form['id_chantier']->renderError() ?>
                                        <?php echo $form['id_chantier'] ?>
                                    </td>   
                                </tr>
                                <tr>
                                    <td><label> Situation administrative</label><span class="align2"> (الوضع الاداري)</span></td>
                                    <td>
                                        <?php echo $form['id_situationadmini']->renderError() ?>
                                        <?php echo $form['id_situationadmini'] ?>
                                    </td>

                                    <td><label>Montant</label><span class="align2">(الأجر اليومي) </span></td>
                                    <td>
                                        <!-- <input type="text" ng-model="montant.text" id="montant" placeholder="Montant" class="form-control"> -->
                                        <?php echo $form['id_salairejouralier']->renderError() ?>
                                        <?php echo $form['id_salairejouralier'] ?>
                                    </td> 
                                </tr>
                                <tr>
                                    <td><label>Projet</label><span class="align2">(المشروع المخصص ) </span></td>
                                    <td>
                                        <?php echo $form['id_projet']->renderError() ?>
                                        <?php echo $form['id_projet'] ?>
                                    </td> 
                                    <td><label>Age Retraite</label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['id_retraite']->renderError() ?>
                                        <?php echo $form['id_retraite'] ?>
                                    </td> 
                                </tr>
                                <tr>
                                    <td colspan="2"  class="disabledbutton">
                                        <?php echo $form['dateretraite']->renderError() ?>
                                        <?php echo $form['dateretraite'] ?>
                                    </td>
                                    <td colspan="2">
                                        <input type="text" ng-model="ageentre.text" id="ageentre" placeholder="Age à l'embauche" class="form-control" readonly="true">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </fieldset>

                <?php if (!$form->getObject()->isNew()) { ?>
                    <div ng-init="AfficheLignedocHistoriqueContratouvrier(<?php echo $contratouvrier->getId() ?>);">
                        <fieldset>
                         <legend>
                            Historique des Affectations
                            <a target="_blank" href="<?php echo url_for('contratouvrier/ImprimerFicheHistorique') . '?id=' . $contratouvrier->getId() ?>" class="btn btn-xs btn-primary pull-right">Imprimer Historique</a>
                        </legend>
                            <table>
                                <thead>
                                    <tr>   
                                        <!--<th>Date de recrutement<span class="align2">(تاريخ الإنتداب )</span></th>--> 
                                        <th>Date début période <span class="align2">(بداية الفترة )</span></th>
                                        <th>date fin période <span class="align2">(نهاية الفترة)</span></th>
                                        <!--<th>Montant <span class="align2"> (الأجر اليومي)</span></th>-->

                                        <th>Lieu d'affectation <span class="align2">(مكان العمل)</span></th>
                                        <th>Chantier <span class="align2">(الحضيرة)</span> </th>

                                        <th>Spécilaité <span class="align2">(الاختصاص) </span></th>
                                        <th>Situation administrative <span class="align2">(الوضع الاداري  )</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="ligne in listesHistorique" style="text-align: center;">

                                            <!--<td>{{ligne.datere}}</td>-->
                                        <td>{{ligne.dated}}</td>
                                        <td>{{ligne.datef}}</td>
                                        <!--<td>{{ligne.montant}}</td>-->
                                        <td>{{ligne.lieu}}</td>
                                        <td>{{ligne.chantier}}</td>
                                        <td>{{ligne.specialite}}</td>
                                        <td>{{ligne.situation}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>  
<style>
    .align2{
        float: right;
        /*        margin-right: 10px;*/
    }

</style>