<?php
$doc = new Documentachat();
$doc = $documentachat;
?>

<div class="col-lg-4" ng-init="ParametrageSociete();<?php if ($doc->getIdDemandeur() && $documentachat->getIdDocparent()) { ?>
            InialiserBonSortieByBCI(<?php echo $documentachat->getIdDocparent() ?>,<?php echo $doc->getIdDemandeur() ?>, '')<?php } ?>">
    <table style="text-align: center">
        <tr>
            <td><p><strong>{{parametragesociete.rs}}</strong></p></td>
        </tr>
        <tr>
            <td><?php echo $documentachat->getTypedoc(); ?></td>
        </tr>
        <tr>
            <td>
                <input type="hidden" id="numerobe" value="<?php echo $doc->getNumerodocachat() ?>">
                N°:<?php echo $doc->getNumerodocachat() ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="hidden" id="datebe" value="<?php echo $documentachat->getDatecreation() ?>">
                Date création: <?php echo $documentachat->getDatecreation(); ?>
            </td>
        </tr>
        <tr>
            <td>Référence F.Retour: <?php echo $form['reference'] ?></td>
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
                    <th>N° Ordre</th>
                    <th>Code Article</th>
                    <th>Désignation</th>
                    <th>Quantité</th>
                    <th>PAMP</th>
                    <th>N°:B.S.</th>
                    <th>Magasin</th>
                    <th>Action</th>
                </tr>             
            </thead>
            <tbody>
                <tr id="formligne">
                    <td style="width: 40px !important"><input type="text" value="" ng-model="nordre.text" id="nordreid"  class="form-control" ></td>
                    <td style="width: 120px">
                        <input type="text" ng-value="" ng-model="code.text" id="codearticle" autocomplete="off"   class="form-control" ng-change="ChoisirArticleByDemandeur()">                   
                    </td>
                    <td>
                        <input type="hidden" id="idarticlestock">
                        <input type="text" value="" ng-model="designation.text" id="designation" class="form-control" ng-click="ChoisirArticleByDemandeur()" ng-change="ChoisirArticleByDemandeur()">
                    </td>
                    <td style="width: 50px"><input type="text" value="" ng-model="quantite.text" id="quantite"  class="form-control"></td>
                    <td style="width: 120px">

                        <input type="text" id="puht" ng-model="puht">
                    </td>
                    <td></td>
                    <td style="width: 150px">
                        <?php $mags = Doctrine_Core::getTable('magasin')->findAll(); ?>
                        <select id="mag">
                            <option></option>
                            <?php foreach ($mags as $mag) { ?>
                                <option value="<?php echo $mag->getId() ?>"><?php echo $mag ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td style="width: 180px">
                        <button type="button" class="btn btn-primary" ng-click="AjouterLigneRetour()">+ Ajouter</button>
                        <button type="button" class="btn  btn-danger" ng-click="InaliserChamps()">-</button>
                    </td>
                </tr>
                <tr ng-repeat="lignedoc in lignedocbce">
                    <td>{{lignedoc.norgdre}}</td>
                    <td>{{lignedoc.codearticle}}</td>
                    <td>{{lignedoc.designation}}</td>
                    <td>{{lignedoc.qte}}</td>
                    <td>{{lignedoc.pamp}}</td>
                    <td>{{lignedoc.numerobsi}}</td>
                    <td id="mag_{{lignedoc.norgdre}}">{{lignedoc.magasin}}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-circle" ng-click="SupprimerLigne(lignedoc)"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-lg-4" style="float: right">
            <table style="font-weight: bold">
                <tr>
                    <td>Total </td><td>{{totalfiche.ttcnet}} TND</td>
                </tr>
            </table>
        </div>

    </fieldset>
    <fieldset style="margin-left: 30%">
        <legend >Action Fiche</legend>
        <div>
            <a class="btn btn-xs btn-danger" href="<?php echo url_for('documentachat/index?idtype=12'); ?>">Liste des fiches de retour</a>
            <input id="btnvalider" ng-click="AjouterBRetout()" type="button" value="Valider le  fiche de Retour... " class="btn btn-outline btn-danger" />
        </div>
    </fieldset>
</div>