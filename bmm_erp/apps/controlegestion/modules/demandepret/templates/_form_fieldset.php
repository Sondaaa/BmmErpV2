<div class="row" >
    <div class="col-xs-12">
        <div class="widget-box">
            <!--            <div class="widget-header widget-header-flat">
                            <h4 class="widget-title smaller">Demande de Prêt </h4>
                        </div>-->
            <div class="widget-body">
                <div class="widget-main" style="min-height: 200px;" ng-init="InitialiserSociete()"><!-- -->

                    <fieldset>
                        <legend>Formulaire pour le Demandeur</legend>
                        <table>
                            <tr>
                                <td>Agents </td>
                                <td>
                                    <?php echo $form['id_agents']->renderError() ?>
                                    <?php echo $form['id_agents'] ?>
                                </td>
                                <td class="disabledbutton">
                                    <input type="hidden" id="id_contrat" ng-model="id_contrat.text">
                                    <input type="text" ng-model="idrh.text" id="idrh" placeholder="Matricule" class="form-control">
                                    <input type="text" ng-model="nom.text" id="nom" placeholder="Nom" class="form-control">
                                </td>
                                <td colspan="2" class="disabledbutton">
                                    <input type="text" ng-model="prenom.text" id="prenom" placeholder="Prénom" class="form-control">
                                    <input type="text" ng-model="adresse.text" id="adresse" placeholder="Adresse" class="form-control">
                                </td>
                                <td class="disabledbutton">
                                    <input type="text" ng-model="codepostal.text" id="codepostal" placeholder="Code Postal"   class="form-control">
                                    <input type="text" ng-model="email.text" id="email" placeholder="Email"   class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>Source Prêt </td>
                                <td>
                                    <?php echo $form['id_sourcepret']->renderError() ?>
                                    <?php echo $form['id_sourcepret'] ?>
                                </td>
                                <td>Type Prêt </td>
                                <td  id="typepret" class="disabledbutton">
                                    <input type="hidden" id="idtype_hidden" value="<?php echo $demandepret->getIdTypepret() ?>">
                                    <?php echo $form['id_typepret']->renderError() ?>
                                    <?php echo $form['id_typepret'] ?>
                                </td>
                                <td>Montant de Prêt</td>
                                <td>
                                    <?php echo $form['montantpret']->renderError() ?>
                                    <?php echo $form['montantpret'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Date demande de Prêt</td>
                                <td>
                                    <?php echo $form['datedemande']->renderError() ?>
                                    <?php echo $form['datedemande'] ?>
                                </td>
                                <td style="display: none">
                                    <?php echo $form['mois']->renderError() ?>
                                    <?php echo $form['mois'] ?>
                                </td>
                                <td style="display: none">
                                    <?php echo $form['annee']->renderError() ?>
                                    <?php echo $form['annee'] ?>
                                </td>
                                <td>Lieu demande de Prêt</td>
                                <td>
                                    <?php echo $form['lieu']->renderError() ?>
                                    <?php echo $form['lieu'] ?>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend>Formulaire pour la sociéte</legend>
                        <table>
                            <tr>
                                <td>Sociéte</td>
                                <td class="disabledbutton">
                                    <?php echo $form['societe']->renderError() ?>
                                    <?php echo $form['societe'] ?>   
                                </td>
                                <td>Numéro CNRPS</td>
                                <td class="disabledbutton">
                                    <?php echo $form['numerodecnss']->renderError() ?>
                                    <?php echo $form['numerodecnss'] ?>   
                                </td>
                            </tr>
                            <tr>
                                <td class="disabledbutton">
                                    <input type="text" ng-model="direction.text" id="direction" placeholder="Direction"  class="form-control">
                                    <input type="text" ng-model="grade.text" id="grade" placeholder="Grade"   class="form-control">
                                </td>
                                <td class="disabledbutton">
                                    <input type="text" ng-model="categorie.text" id="categorie" placeholder="Catégorie"  class="form-control">
                                    <input type="text" ng-model="dateemposte.text" id="dateemposte" placeholder="Date d'embauche"   class="form-control">
                                </td>
                                <td class="disabledbutton">
                                    <input type="text" ng-model="situation.text" id="situation" placeholder="Situation Administrative"  class="form-control">
                                    <input type="text" ng-model="datetitulaire.text" id="datetitulaire" placeholder="Date Titularisation"   class="form-control">
                                </td>
                                <td class="disabledbutton">
                                    <input type="text" ng-model="salaire.text" id="salaire" placeholder="Salaire de Base"   class="form-control">
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset>
                        <table id="prime" class="table  table-bordered table-hover"  > 
                            <thead>
                                <tr style="background: #f7e1b5">
                                    <th style="width: 10%">N°</th>
                                    <th style="width: 70%">Prime</th>
                                    <th style="width: 20%">Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="ligne in listesPrimes">
                                    <td>{{ligne.norgdre}}</td>
                                    <td>{{ligne.libelle}}</td>
                                    <td>{{ligne.montant}}
                                    </td>
                                </tr>
                                <tr style="background-color: #DCDCDC;">
                                    <td>Salaire Brut</td>
                                    <td colspan="2" class="disabledbutton">
                                        <?php echo $form['salairebrut']->renderError() ?>
                                        <?php echo $form['salairebrut'] ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                    <fieldset>
                        <table>
                            <tr>
                                <td>Date Début Retenue Prêt</td>
                                <td>
                                    <?php echo $form['datedebutretenue']->renderError() ?>
                                    <?php echo $form['datedebutretenue'] ?>
                                </td>
                                <td>Date Fin  Retenue Prêt</td>
                                <td>
                                    <?php echo $form['datefinretenue']->renderError() ?>
                                    <?php echo $form['datefinretenue'] ?>
                                </td>
                                <td>Nombre de Mois</td>
                                <td class="disabledbutton">
                                    <?php echo $form['nbrmois']->renderError() ?>
                                    <?php echo $form['nbrmois'] ?>
                                </td>
                                <td>Montant Mensuel</td>
                                <td  class="disabledbutton">
                                    <?php echo $form['montantmentielle']->renderError() ?>
                                    <?php echo $form['montantmentielle'] ?>
                                </td>
                            </tr>
                        </table>
                    </fieldset>

                    <?php if (!$form->getObject()->isNew()): ?>
                        <fieldset>
                            <table>
                                <thead>
                                    <tr style="background: #ffdcdc">
                                        <th style="width: 30%">Nature Prêt </th>
                                        <th style="width: 30%">Source Prêt </th>
                                        <th style="width: 20%">Montant Mensuel</th>
                                        <th style="width: 20%">Date Fin Retenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="ligne in ListePret">
                                        <td>{{ligne.naturepret}}</td>
                                        <td>{{ligne.sourcepret}}</td>
                                        <td>{{ligne.montantmensielle}}</td>
                                        <td>{{ligne.datefinretenue}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>
                    <?php endif; ?>

                    <fieldset>
                        <table>
                            <tr>
                                <td style="width:10%">Validé </td> 
                                <td>
                                    <?php echo $form['valide']->renderError() ?>
                                    <?php echo $form['valide'] ?>
                                </td>
                                <td>Validateur </td> 
                                <td>
                                    <?php echo $form['id_validateur']->renderError() ?>
                                    <?php echo $form['id_validateur'] ?>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    .bootstrap-duallistbox-container .info {
        font-size: 14px;
    }

</style>