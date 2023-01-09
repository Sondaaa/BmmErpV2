<?php
$doc = new Documentachat();
$doc = $documentachat;
?>

<div class="col-lg-12" ng-init="ParametrageSociete();">
    <div class="col-lg-6">
        <table style="text-align: center">
            <tr>
                <td colspan="2">
                    <p><strong>{{parametragesociete.rs}}</strong></p>  
                </td>
            </tr>
            <tr>
                <td><?php echo $documentachat->getTypedoc(); ?></td>
                <td>
                    <input type="hidden" id="numerobe" value="<?php echo $doc->getNumerodocachat() ?>">
                    N°:<?php echo $doc->getNumerodocachat() ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" id="datebe" value="<?php echo $documentachat->getDatecreation() ?>">
                    Date création
                </td>
                <td><?php echo $documentachat->getDatecreation(); ?></td>
            </tr>
            <tr>
                <td>Référence </td>
                <td> <?php echo $form['reference'] ?></td>
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
                            <td style="width: 350px">
                                <?php $mags = Doctrine_Core::getTable('magasin')->findAll(); ?>
                                <label>Magasin départ</label>
                                <select id="mag1">
                                    <option></option>
                                    <?php foreach ($mags as $mag) { ?>
                                        <option value="<?php echo $mag->getId() ?>"><?php echo $mag ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td><br><span class="label label-lg label-pink arrowed-right">VERS</span></td>
                            <td style="width: 350px">
                                <label>Magasin réception</label>
                                <select id="mag2">
                                    <option></option>
                                    <?php foreach ($mags as $mag) { ?>
                                        <option value="<?php echo $mag->getId() ?>"><?php echo $mag ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </th>
                </tr>
                <tr>
                    <th>N°ordre</th>
                    <th>Code Article</th>
                    <th>Désignation</th>
                    <th>Quantité</th>           
                    <th>QteMax</th>      

                    <th>Magasin</th>
                    <th>Action</th>
                </tr>             
                </thead>
                <tbody>
                    <tr id="formligne">
                        <td style="width: 40px !important"><input type="text" value="" ng-model="nordre.text" id="nordreid"  class="form-control" ></td>
                        <td style="width: 120px">
                            <input type="text" ng-value="" ng-model="code.text" id="codearticle"  autocomplete="off"   class="form-control" ng-change="RechercheArticleByCodeAndDesignation()">                   
                        </td>
                        <td>
                            <input type="hidden" id="idarticlestock">
                            <input type="text" value="" ng-model="designation.text" id="designation"  class="form-control" ng-click="ChoisirArticleByMagasin()" ng-change="ChoisirArticleByMagasin()">
                        </td>
                        <td style="width: 50px"><input type="text" value="" ng-model="quantite.text" id="quantite"  class="form-control"></td>
                        <td style="width: 120px" class="disabledbutton">
                            <input type="text" id="qtemax">
                        </td>
                        <td style="width: 150px" class="disabledbutton">
                            <select id="mag">
                                <option></option>
                                <?php foreach ($mags as $mag) { ?>
                                    <option value="<?php echo $mag->getId() ?>"><?php echo $mag ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td style="width: 180px">
                            <button type="button" class="btn btn-primary" ng-click="AjouterLigneTransfert()">+ Ajouter</button>
                            <button type="button" class="btn  btn-danger" ng-click="InaliserChamps()">-</button>
                        </td>
                    </tr>
                    <tr ng-repeat="lignedoc in lignedocbce">
                        <td>{{lignedoc.norgdre}}</td>
                        <td>{{lignedoc.codearticle}}</td>
                        <td>{{lignedoc.designation}}</td>
                        <td>{{lignedoc.qte}}</td>
                        <td>{{lignedoc.qtemax}}</td>

                        <td id="mag_{{lignedoc.norgdre}}">{{lignedoc.magasin}}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-circle" ng-click="MisAJour(lignedoc)"><i class="fa fa-hospital-o"></i></button>
                            <button type="button" class="btn btn-warning btn-circle" ng-click="SupprimerLigne(lignedoc)"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
        <fieldset style="margin-left: 30%">
            <legend >Action Fiche</legend>
            <div>
                <a class="btn btn-xs btn-danger" href="<?php echo url_for('documentachat/index?idtype=13'); ?>">Listes des Transfert</a>
                <input id="btnvalider"  ng-click="AjouterBT()" type="button" value="Valider Fiche Transfert... " class="btn btn-outline btn-danger" />
            </div>
        </fieldset>
    </div>
</div>