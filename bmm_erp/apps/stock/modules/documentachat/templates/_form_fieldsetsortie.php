<?php
$doc = new Documentachat();
$doc = $documentachat;
?>

<div class="col-lg-4" ng-init="ParametrageSociete();<?php if ($doc->getIdDemandeur() && $documentachat->getIdDocparent()) { ?>
            InialiserBonSortieByBCI(<?php echo $documentachat->getIdDocparent() ?>,<?php echo $doc->getIdDemandeur() ?>, '')<?php } ?>">
    <table style="text-align: center">
        <tr>
            <td>
                <p><strong>{{parametragesociete.rs}}</strong></p>  
            </td>
        </tr>
        <tr>
            <td><?php echo $documentachat->getTypedoc(); ?></td>
        </tr>
        <tr>
            <td>
                <input type="hidden" id="numerobe" value="<?php echo $doc->getNumerodocachat() ?>">
                N° : <?php echo $doc->getNumerodocachat() ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="hidden" id="datebe" value="<?php echo $documentachat->getDatecreation() ?>">
                Date création : <?php echo $documentachat->getDatecreation(); ?>
            </td>
        </tr>
        <tr>
            <td>Référence B.Sortie : <?php echo $form['reference'] ?></td>
        </tr>
    </table> 

</div>
<div class="col-lg-8">
    <table>
        <tr>
            <td>
                <table>
                    <tr>
                        <td><label>Demandeur</label></td>
                        <td>
                            <?php echo $form['id_demandeur']->renderError() ?>
                            <?php echo $form['id_demandeur'] ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table> 
</div>

<div class="col-lg-12">
    <fieldset>
        <legend>Liste des articles</legend>
        <table>
            <thead>
                <tr>
                    <th colspan="7">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <?php $mags = Doctrine_Core::getTable('magasin')->findAll(); ?>
                            <label>Magasin</label>
                            <select id="magtous">
                                <option></option>
                                <?php foreach ($mags as $mag) { ?>
                                    <option value="<?php echo $mag->getId() ?>"><?php echo $mag ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <label>Liste des Bons Commnades Internes</label>
                            <select id="nbexterne"></select>
                        </td>
                        <td style="vertical-align: bottom;">
                            <p class="btn btn-sm btn-warning" ng-click="AjouterLigneBcI()">Ajouter</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            </th>
            </tr>
            <tr>
                <th>N° Ordre</th>
                <th>Code Article</th>
                <th>Désignation</th>
                <th>Quantité</th>
                <th>PAMP</th>

                <th>Magasin</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <tr id="formligne">
                    <td style="width: 40px !important">
                        <input type="text" value="" ng-model="nordre.text" id="nordreid" class="form-control">
                    </td>
                    <td style="width: 120px">
                        <input type="text" ng-value="" ng-model="code.text" id="codearticle" autocomplete="off" class="form-control" ng-change="RechercheArticleByCodeAndDesignation()">                   
                    </td>
                    <td>
                        <input type="text" value="" ng-model="designation.text" id="designation" class="form-control" ng-click="ChoisirArticle()" ng-change="ChoisirArticle()">
                    </td>
                    <td style="width: 50px"><input type="text" value="" ng-model="quantite.text" id="quantite"  class="form-control"></td>
                    <td style="width: 120px">
                        <input type="text" id="puht" ng-model="puht">
                    </td>
                    <td style="width: 150px">
                        <select id="mag">
                            <option></option>
                            <?php foreach ($mags as $mag) { ?>
                                <option value="<?php echo $mag->getId() ?>"><?php echo $mag ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td style="width: 180px; text-align: center;">
                        <button type="button" class="btn btn-primary" ng-click="AjouterLigne()"><i class="fa fa-plus"></i></button>
                        <button type="button" class="btn btn-danger" ng-click="InaliserChamps()"><i class="fa fa-minus"></i></button>
                    </td>
                </tr>
                <tr ng-repeat="lignedoc in lignedocbce">
                    <td style="text-align: center;">{{lignedoc.norgdre}}</td>
                    <td>{{lignedoc.codearticle}}</td>
                    <td>{{lignedoc.designation}}</td>
                    <td style="text-align: center;">{{lignedoc.qte}}</td>
                    <td style="text-align: right;">{{lignedoc.puht}}</td>

                    <td id="mag_{{lignedoc.norgdre}}">{{lignedoc.magasin}}</td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-info btn-circle" ng-click="MisAJour(lignedoc)"><i class="fa fa-hospital-o"></i></button>
                        <button type="button" class="btn btn-warning btn-circle" ng-click="SupprimerLigne(lignedoc)"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-lg-4" style="float: right">
            <table style="font-weight: bold">
                <tr>
                    <td style="text-align: right;">Total </td><td>{{totalfiche.ttcnet}} TND</td>
                </tr>
            </table>
        </div>
    </fieldset>
    <fieldset style="margin-left: 30%">
        <legend>Action Fiche</legend>
        <div>
            <a class="btn btn-danger" href="<?php echo url_for('documentachat/index?idtype=11'); ?>">Liste des Bons de sortie</a>
            <input id="btnvalider" ng-click="AjouterBS()" type="button" value="Valider le Bon de Sortie... " class="btn btn-outline btn-danger" />
        </div>
    </fieldset>
</div>