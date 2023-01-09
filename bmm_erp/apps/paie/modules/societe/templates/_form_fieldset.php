<div id="sf_admin_container" >
    <div id="sf_admin_content">  
        <div  class="panel-body">
            <div>
                <fieldset>
                    <div class="col-lg-12"> <legend><i> Données de base</i></legend>
                        <input type="hidden" id="id_societe" value="<?php echo $societe->getId() ?>">
                        <table style="margin-bottom: 15px;">
                            <tbody>
                                <tr>
                                    <td><label>Raison Sociale </label></td>
                                    <td class="disabledbutton" colspan="3"> 
                                        <?php echo $form['rs']->renderError() ?>
                                        <?php echo $form['rs'] ?>
                                    </td>
                                    <td><label>Matricule Fiscal</label></td>
                                    <td class="disabledbutton" colspan="3">
                                        <?php echo $form['matfiscal']->renderError() ?>
                                        <?php echo $form['matfiscal'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Identifiant Unique </label></td>
                                    <td class="disabledbutton" colspan="3">
                                        <?php echo $form['idunique']->renderError() ?>
                                        <?php echo $form['idunique'] ?>
                                    </td>
                                    <td><label>Gouvernorat </label></td>
                                    <td class="disabledbutton" colspan="3">
                                        <?php echo $form['id_gouvernera']->renderError() ?>
                                        <?php echo $form['id_gouvernera'] ?>
                                    </td>
                                </tr>
                                <tr>

                                    <td><label>Type Cotisation</label></td>
                                    <td>
                                        <?php echo $form['typecotisation']->renderError() ?>
                                        <?php echo $form['typecotisation'] ?>
                                    </td> 
                                    <td><label> Nbr Mois / Ans</label></td>
                                    <td> 
                                        <?php echo $form['nbremoisannuel']->renderError() ?>
                                        <?php echo $form['nbremoisannuel'] ?>
                                    </td>
                                    <td><label> BR</label></td>
                                    <td> 
                                        <?php echo $form['br']->renderError() ?>
                                        <?php echo $form['br'] ?>
                                    </td>
                                    <td><label> Année</label></td>
                                    <td>
                                        <select id="societe_annee" name="societe[annee]">
                                            <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                                <option <?php if ($i == date('Y')): ?>selected="true"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-12" ng-init="AfficheLigneMois('<?php echo $societe->getId(); ?>')">
                        <legend><i> Repartition les Mois > 12 </i></legend>
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 5%">N°ordre</th>
                                    <th style="width: 10%">Code du Mois</th>
                                    <th style="width: 60%">Libellé</th>
                                    <th style="width: 15%">Mois Calendrial</th>
                                    <th style="width: 10%">Action</th>
                                </tr>             
                            </thead>
                            <tbody>
                                <tr id="formligne">
                                    <td style="width: 10px !important"><input type="text" value="" ng-model="norgdre.text" id="nordre"  class="form-control disabledbutton" ></td>
                                    <td class="disabledbutton" id="code_mois" >
                                        <select id="codemois" class="chosen-select form-control">
                                            <option></option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="17">18</option>
                                        </select>
                                    </td>
                                    <td style="width: 30px"><input type="text" value="" ng-model="libelle.text" id="libelle"  class="form-control" placeholder="Libellé" ></td>
                                    <td>
                                        <select id="mois_calendrial" class="chosen-select form-control" >
                                            <option></option>
                                            <option value="1">Janvier</option>
                                            <option value="2">Février</option>
                                            <option value="3">Mars</option>
                                            <option value="4">Avril</option>
                                            <option value="5">Mai</option>
                                            <option value="6">juin</option>
                                            <option value="7">Juillet</option>
                                            <option  value="8">Août</option>
                                            <option value="9">Septembre</option>
                                            <option  value="10">Octobre</option>
                                            <option value="11">Nouvembre</option>
                                            <option value="12">Décembre</option>
                                        </select>
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" id="btnajoutE" class=" btn btn-info  btn-circle btn-sm"  ng-click="AjouterLigneMois()">+</button>
                                        <button type="button" class="btn btn-warning btn-circle btn-sm" ng-click="InaliserChampsMois()">-</button>
                                    </td>
                                </tr>
                                <?php $array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre"); ?>
                                <tr ng-repeat="lignedocMois in listedocMois">
                                    <td>{{lignedocMois.norgdre}}</td>

                                    <td>{{lignedocMois.codemois}}</td>
                                    <td>{{lignedocMois.libelle}}</td>

                                    <td>{{lignedocMois.mois_calendrial}}</td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-info btn-circle btn-sm" ng-click="MisAJourLigneMois(lignedocMois)"><i class="fa fa-hospital-o"></i></button>
                                        <button type="button" class="btn btn-warning btn-circle btn-sm" ng-click="DeleteLigneMois(lignedocMois)"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width: 10%;" align="right">
                            <tbody>
                                <tr> 
                                    <td>
                                        <button type="button" id="btnvaliderMois" class="btn btn-info" ng-click="validerAjoutMois()">valider</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>

<script>

    $("#societe_typecotisation").val('<?php echo trim($societe->getTypecotisation()); ?>');

</script>