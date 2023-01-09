<div id="sf_admin_container">
    <h1>Ajouter affectation : Contrat <?php echo $contrat_ouvrier->getOuvrier(); ?></h1>
    <div id="sf_admin_content">
        <div class="sf_admin_form" ng-controller="CtrlRessourcehumaine">
            <div id="sf_admin_container">
                <div id="sf_admin_content">  
                    <div class="panel-body">
                        <div class="tab-content col-lg-12">  
                            <fieldset>
                                <div>  
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td><label> Ouvrier </label><span class="align2">(عامل الحضيرة )</span></td>
                                                <td>
                                                    <input type="text" value="<?php echo $contrat_ouvrier->getOuvrier(); ?>" class="form-control disabledbutton">
                                                </td>
                                                <td><label>Date de recrutement</label><span class="align2">(تاريخ الإنتداب )</span></td>
                                                <td>
                                                    <input type="text" value="<?php echo $contrat_ouvrier->getDaterecrutement(); ?>" class="form-control disabledbutton">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label> Date début contrat</label><span class="align2"> (بداية العقد )  </span></td>
                                                <td>   
                                                    <input type="text" value="<?php echo $contrat_ouvrier->getDatedebutcontrat(); ?>" class="form-control disabledbutton">
                                                </td>
                                                <td><label> Date fin contrat</label><span class="align2"> (نهاية العقد)</span></td>
                                                <td>
                                                    <input type="text" value="<?php echo $contrat_ouvrier->getDatefincontrat(); ?>" class="form-control disabledbutton">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                            <br>
                            <fieldset>
                                <div>
                                    <?php $form = new ContratouvrierForm(); ?>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td><label>Lieu affectation</label><span class="align2">(مكان العمل) </span></td>
                                                <td>
                                                    <?php echo $form['id_lieuaffetation']->renderError() ?>
                                                    <?php echo $form['id_lieuaffetation'] ?>
                                                </td>
                                                <td><label> Chantier</label><span class="align2">(الحضيرة)  </span></td>
                                                <td>
                                                    <?php echo $form['id_chantier']->renderError() ?>
                                                    <?php echo $form['id_chantier'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label> Date début affectation</label><span class="align2"> (بداية  الفترة )  </span></td>
                                                <td>   
                                                    <input type="date" id="date_debut" value="">
                                                </td>
                                                <td><label> Date fin affectation</label><span class="align2"> (نهاية  الفترة)</span></td>
                                                <td>
                                                    <input type="date" id="date_fin" value="<?php echo $contrat_ouvrier->getDatefincontrat(); ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td style="text-align: center;">
                                                    <button type="button" ng-click="saveAffectation(<?php echo $contrat_ouvrier->getId() ?>)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-share bigger-110"></i> Ajouter Affectation</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                            <br>
                            <div ng-init="AfficheLignedocHistoriqueContratouvrier(<?php echo $contrat_ouvrier->getId() ?>)">
                                <fieldset>
                                    <legend>Historique des Affectations</legend>
                                    <table>
                                        <thead>
                                            <tr>   
                                                <!--<th>Date de recrutement<span class="align2">(تاريخ الإنتداب )</span></th>--> 
                                                <th>Date début période <span class="align2">(بداية الفترة )</span></th>
                                                <th>date fin période <span class="align2">(نهاية الفترة)</span></th>
                                                <th>Période <span class="align2">(الفترة)</span></th>
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
                                                <td>{{ligne.nbjour}} jour(s)</td>
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
                        </div>
                    </div>
                </div>
            </div>  
            <style>
                .align2{
                    float: right;
                }
            </style>
        </div>
    </div>
</div>

<ul class="sf_admin_actions">
    <a href="<?php echo url_for('@contratouvrier') ?>" class="btn btn-white btn-success">Retour à la liste</a>
</ul>