<div class="col-lg-12">
    <fieldset> 
        <legend><i>Données de Base </i></legend>
        <table>
            <tbody> <tr>
                    <td><label>Code Sociale </label></td>
                    <td class="disabledbutton">
                        <?php echo $form['code']->renderError() ?>
                        <?php echo $form['code'] ?>
                    </td>
                    <td><label>Libellé </label></td>
                    <td class="disabledbutton">
                        <?php echo $form['libelle']->renderError() ?>
                        <?php echo $form['libelle'] ?>
                    </td>
<!--                    <td><label>Taux de Contribution Salariale</label></td>
                    <td>
                    <?php // echo $form['taux']->renderError() ?>
                    <?php // echo $form['taux'] ?>
                    </td>-->
                </tr>
            </tbody>
        </table><br><br>
    </fieldset>

    <div class="col-lg-12" ng-init="AfficheLigneCodesociale('<?php echo $codesociale->getId(); ?>')">
        <legend><i>Répartition des Taux de code Sociale</i></legend>
        <input type="hidden" value="<?php echo $codesociale->getId() ?>" id="id_codesociale">
        <table>
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center;">N°ordre</th>
                    <th style="width: 10%; text-align: center;">Code</th>
                    <th style="width: 60%;">Libellé</th>
                    <th style="width: 15%; text-align: center;">Taux de Contribution Salariale</th>
                    <th style="width: 10%; text-align: center;">Action</th>
                </tr>             
            </thead>
            <tbody>
                <tr id="formligne">
                    <td>
                        <input type="text" value="" ng-model="norgdre.text" id="nordre" class="form-control align_center disabledbutton">
                    </td>
                    <td>
                        <input type="text" value="" id="codesociale" ng-model="codesociale.text" class="form-control align_center" placeholder="Code">
                    </td>
                    <td> 
                        <input type="text" value="" ng-model="libelle.text" id="libelle" class="form-control" placeholder="Libellé">
                    </td>
                    <td>
                        <input class="align_center" type="text" value="" ng-model="taux.text" id="taux" placeholder="Taux">
                    </td>
                    <td style="text-align: center;">
                        <button type="button" id="btnajoutE" class="btn btn-info btn-sm" ng-click="AjouterLigneCodesociale()"><i class="fa fa-plus"></i></button>
                        <button type="button" class="btn btn-warning btn-sm" ng-click="InaliserChampsCodesociale()"><i class="fa fa-minus"></i></button>
                    </td>
                </tr>
                <tr ng-repeat="lignedocCode in listedocCode">
                    <td style="text-align: center;">{{lignedocCode.norgdre}}</td>
                    <td style="text-align: center;">{{lignedocCode.codesociale}}</td>
                    <td>{{lignedocCode.libelle}}</td>
                    <td style="text-align: center;">{{lignedocCode.taux}}</td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-info btn-sm" ng-click="MisAJourLigneCode(lignedocCode)"><i class="fa fa-hospital-o"></i></button>
                        <button type="button" class="btn btn-warning btn-sm" ng-click="DeleteLigneCode(lignedocCode)"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: 10%;" align="right">
            <tbody>
                <tr> 
                    <td style="text-align: center;">
                        <button style="width: 90%;" type="button" id="btnvaliderCode" class="btn btn-xs btn-info" ng-click="validerAjoutCode()"><i class="fa fa-check"></i> Valider</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>