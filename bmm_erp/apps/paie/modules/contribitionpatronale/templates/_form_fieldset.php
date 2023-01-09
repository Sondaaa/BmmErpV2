<div class="col-lg-12">
    <fieldset> 
        <table>
            <tbody>
                <tr>
                    <td><label>Code  </label></td>
                    <td>
                        <?php echo $form['code']->renderError() ?>
                        <?php echo $form['code'] ?>
                    </td>
                    <td><label>Libellé </label></td>
                    <td>
                        <?php echo $form['libelle']->renderError() ?>
                        <?php echo $form['libelle'] ?>
                    </td>
<!--                    <td><label>Taux de Contribution Patronale</label></td>
                    <td>
                    <?php // echo $form['taux']->renderError() ?>
                    <?php // echo $form['taux'] ?>
                    </td>-->
                </tr>

            </tbody>
        </table>
    </fieldset>
    <div class="col-lg-12" ng-init="AfficheLigneContribiton('<?php echo $contribitionpatronale->getId(); ?>')">
        <legend>  <i>Répartition  des Taux de code Sociale  </i></legend>
        <input type="hidden" value="<?php echo $contribitionpatronale->getId() ?>" id="id_contribiton">
        <table>
            <thead>
                <tr> <th style="width: 5%">N°ordre</th>
                    <th style="width: 10%">Code</th>
                    <th style="width: 30%">Libellé</th>
                    <th style="width: 15%">Taux  de Contribution Patronale </th>
                    <th style="width: 10%">Action</th>
                </tr>             

            </thead>
            <tbody>

                <tr id="formligne">
                    <td style="width: 10px !important">
                        <input type="text" value="" ng-model="norgdre.text" id="nordre"  class="form-control disabledbutton" >
                    </td>
                    <td >
                        <input type="text" value="" id="contribition" ng-model="contribition.text" class="form-control" placeholder="Code" >
                    </td>
                    <td style="width: 30px" > 
                        <input type="text" value="" ng-model="libelle.text" id="libelle"  class="form-control" placeholder="Libellé" ></td>

                    <td >
                        <input type="text" value="" ng-model="taux.text" id="taux" placeholder="Taux" >
                    </td>

                    <td>
                        <button type="button" id="btnajoutE" class=" btn btn-info  btn-circle btn-sm"  ng-click="AjouterLigneContribition()">+</button>
                        <button type="button" class="btn btn-warning btn-circle btn-sm" ng-click="InaliserChampsContribition()">-</button>
                    </td>

                </tr>

                <tr ng-repeat="lignedocContribtion in listedocContribition">
                    <td >{{lignedocContribtion.norgdre}}</td>
                    <td>{{lignedocContribtion.contribition}}</td>
                    <td>{{lignedocContribtion.libelle}}</td>
                    <td>{{lignedocContribtion.taux}}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-circle btn-sm" ng-click="MisAJourLigneContribition(lignedocContribtion)"><i class="fa fa-hospital-o"></i></button>
                        <button type="button" class="btn btn-warning btn-circle btn-sm" ng-click="DeleteLigneContribition(lignedocContribtion)"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: 18px"  align="right">
            <tbody>
                <tr> 
                    <td>  <button type="button" id="btnvaliderContribition"  class="btn btn-info" ng-click="validerAjoutContribition()">valider</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>