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
                Date Création: <?php echo $documentachat->getDatecreation(); ?>
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
                        <td><label>Fournisseur</label></td>
                        <td>
                            <input type="hidden" id="idtypedocumentachat" value="14">
                            <?php echo $form['id_frs']->renderError() ?>
                            <?php echo $form['id_frs'] ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table> 
</div>
<div class="col-lg-12">
    <table>
        <tr ng-repeat="detai in dtailfrs">
            <td colspan="2">
                <table>
                    <tr>
                        <th>Nom Complet du Responsable</th>
                        <th>Raison Sociale</th>
                        <th>Tél</th>
                        <th>Fax</th>
                        <th>Mail</th>
                        <th>Adresse</th>
                        <th>Fodec</th>
                        <th>Assujetti à la T.V.A</th>
                    </tr>
                    <tr>
                        <td>{{detai.nomcomplet}}</td>
                        <td>{{detai.rs}}</td>
                        <td>{{detai.tel}}</td>
                        <td>{{detai.fax}}</td>
                        <td>{{detai.mail}}</td>
                        <td>{{detai.adr}}</td>
                        <td ng-if="detai.fodec === '1'"><input type="checkbox" checked class="disabledbutton" id="fodec"></td>
                        <td ng-if="detai.fodec != '1'"><input type="checkbox" class="disabledbutton"  id="fodec"></td>

                        <td ng-if="detai.assujtva === '1'"><input type="checkbox" class="disabledbutton" checked  id="asj"></td>
                        <td ng-if="detai.assujtva != '1'"><input type="checkbox"  class="disabledbutton" id="asj"></td>
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
                    <th colspan="3">
            <table>
                <tbody>
                    <tr>
                        <td style="width: 400px">
                            <label>Liste des P.V. de Réception</label>
                            <select id="nbexterne">                           
                            </select>
                        </td>
                        <td><label>&emsp;</label>
                            <br> <p class="btn btn-sm btn-warning" ng-click="AjouterLignePvdereception()">Ajouter</p>
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
                <th>Prix TTC</th>           
                <th>Magasin</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <tr id="formligne">
                    <td style="width: 40px !important"><input type="text" value="" ng-model="nordre.text" id="nordreid"  class="form-control" ></td>
                    <td style="width: 120px">
                        <input  type="text" ng-value="" ng-model="code.text" id="codearticle"  autocomplete="off"   class="form-control" ng-change="">                   
                    </td>
                    <td>
                        <input type="hidden" id="idarticlestock">
                        <input type="text" value="" ng-model="designation.text" id="designation"  class="form-control" ng-click="" ng-change="">
                    </td>
                    <td style="width: 50px"><input type="text" value="" ng-model="quantite.text" id="quantite"  class="form-control"></td>
                    <td style="width: 120px" class="disabledbutton">
                        <input type="text" id="puht" ng-model="puht">
                    </td>
                    <td></td>
                    <td style="width: 180px">
                        <button type="button" class="btn btn-primary" ng-click="AjouterLigneAvoir()">+</button>
                        <button type="button" class="btn  btn-danger" ng-click="InaliserChamps()">-</button>
                    </td>
                </tr>
                <tr ng-repeat="lignedoc in lignedocbce">
                    <td>{{lignedoc.norgdre}}</td>
                    <td>{{lignedoc.codearticle}}</td>
                    <td>{{lignedoc.designation}}</td>
                    <td>{{lignedoc.qte}}</td>
                    <td>{{lignedoc.mntttc}}</td>
                    <td>{{lignedoc.magasin}}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-circle" ng-click="MisAJourAoir(lignedoc)"><i class="fa fa-hospital-o"></i></button>
                        <button type="button" class="btn btn-warning btn-circle" ng-click="SupprimerLigneAvoir(lignedoc)"><i class="fa fa-times"></i></button>
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
            <a class="btn btn-danger" href="<?php echo url_for('documentachat/index?idtype=14'); ?>">Listes des Avoir fournisseur</a>
            <input id="btnvalider" ng-click="AjouterBAvoir()" type="button" value="Enregistrée l'avoir fournisseur  ... " class="btn btn-outline btn-danger" />
        </div>
    </fieldset>
</div>