<?php
$doc = new Documentachat();
$doc = $documentachat;
?>

<div class="col-lg-4" ng-init="ParametrageSociete();
        AfficheDetailFrs(<?php echo $documentachat->getIdFrs() ?>);
        InializerTransfert(<?php echo $documentachat->getIdDocparent() ?>,<?php echo $documentachat->getIdFrs() ?>,<?php echo $documentachat->getId() ?>)">
    <table>
        <tr>
            <td style="text-align: center"><p><strong>{{parametragesociete.rs}}</strong></p></td>
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
        </tr>
    </table> 
</div>
<div class="col-lg-8">
    <table>
        <tr class="disabledbutton">
            <td>
                <table>
                    <tr>
                        <td><label>Fournisseur</label></td>
                        <td>
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
                        <th>Raison sociale</th>
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
                        <td ng-if="detai.fodec != '1'"><input type="checkbox" class="disabledbutton" id="fodec"></td>

                        <td ng-if="detai.assujtva === '1'"><input type="checkbox" class="disabledbutton" checked id="asj"></td>
                        <td ng-if="detai.assujtva != '1'"><input type="checkbox" class="disabledbutton" id="asj"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div class="col-lg-12">
    <fieldset>
        <legend>Liste des articles</legend>
        <div id="my-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog" style="width: 90%">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h3 class="smaller lighter blue no-margin">Nouvel Article</h3>
                    </div>
                    <div class="modal-body">
                        <?php
                        $formarticle = new ArticleForm();
                        $article = new Article();
                        ?>
                        <?php include_partial('article/formpetit', array('article' => $article, 'form' => $formarticle)) ?>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary pull-right" data-dismiss="modal" ng-click="AjouterArticle()">
                            <i class="ace-icon fa fa-plus"></i>
                            Ajouter
                        </button>
                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                            <i class="ace-icon fa fa-times"></i>
                            fermer
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <table>
            <thead>
                <tr>
                    <th colspan="10" style="left: 80%">
                        <a href="#my-modal" role="button" class="bg-warning btn-sm  btn-warning" data-toggle="modal">
                            &nbsp; +Ajouter Article &nbsp;
                        </a> 
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
            <table style="margin-bottom: 0px;">
                <tr>
                    <td>
                        <label>Remise en valeur HT</label>
                        <input type="text" id="remisetotalvaleur" >
                    </td>
                    <td><br>OU</td>
                    <td>
                        <label>Remise en % HT</label>
                        <input type="text" id="remisetotalpourcentage">
                    </td>
                    <td></td><td></td><td></td>
                    <td>
                        <label>Remise en valeur TTC</label>
                        <input type="text" id="remisetotalvaleurttc">
                    </td>                    
                    <td><label>&emsp;</label><p class="btn btn-sm btn-warning" ng-click="AjouterTaux()">Appliquer</p></td>
                </tr>
            </table>
            </th> 
            <th colspan="6">
            <table style="margin-bottom: 0px;">
                <tbody>
                    <tr class="disabledbutton">
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
                        <td style="width: 350px">
                            <label>Liste des Bons Commnades Externes</label>
                            <select id="nbexterne">                           
                            </select>
                        </td>
                        <td><label>&emsp;</label>
                            <p class="btn btn-sm btn-warning" ng-click="AjouterLigneBce()">Ajouter</p>
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
                <th>P.Unit.<br>HT</th>
                <th style="width: 80px">Remise%</th>
                <th>T.V.A</th>              
                <th>Total H.TAX</th>
                <th>Magasin</th>
                <th>Action</th>
            </tr>             
            </thead>
            <tbody>
                <tr id="formligne">
                    <td style="width: 40px !important"><input type="text" value="" ng-model="nordre.text" id="nordreid"  class="form-control" ></td>
                    <td style="width: 120px">
                        <input  type="text" ng-value="" ng-model="code.text" id="codearticle"  autocomplete="off"   class="form-control" ng-change="RechercheArticleByCodeAndDesignation()">                   
                    </td>
                    <td>
                        <input type="text" value="" ng-model="designation.text" id="designation"  class="form-control" ng-click="ChoisirArticle()" ng-change="ChoisirArticle()">
                    </td>
                    <td style="width: 50px"><input type="text" value="" ng-model="quantite.text" id="quantite"  class="form-control"></td>
                    <td style="width: 120px">
                        <input type="text" id="puht" ng-model="puht">
                    </td>
                    <td>
                        <input type="text" id="remise" ng-model="remise">
                    </td>
                    <td style="width: 80px">
                        <select id="tva">
                            <option ng-repeat="tva in tvalistes" value="{{tva.id}}">{{tva.libelle}}</option>
                        </select>
                    </td>
                    <td></td>
                    <td style="width: 150px">
                        <select id="mag">
                            <option></option>
                            <?php foreach ($mags as $mag) { ?>
                                <option value="<?php echo $mag->getId() ?>"><?php echo $mag ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td style="width: 180px">
                        <button type="button" class="btn btn-primary" ng-click="AjouterLigne()">+ Ajouter</button>
                        <button type="button" class="btn  btn-danger" ng-click="InaliserChamps()">-</button>
                        <a href="#my-modal" ng-click="AjouterArticlenonExiste()" role="button" class="bg-warning btn-sm  btn-warning" data-toggle="modal">
                            &nbsp; +Article 
                        </a> 
                    </td>
                </tr>
                <tr ng-repeat="lignedoc in lignedocbce">
                    <td>{{lignedoc.norgdre}}</td>
                    <td>{{lignedoc.codearticle}}</td>
                    <td>{{lignedoc.designation}}</td>
                    <td>{{lignedoc.qte}}</td>
                    <td>{{lignedoc.puht}}</td>
                    <td>{{(lignedoc.tauxremise * 100).toFixed(2)}}%</td>
                    <td>{{lignedoc.tva}}</td>
                    <td>{{lignedoc.totalht}}</td>

                    <td id="mag_{{lignedoc.norgdre}}">{{lignedoc.magasin}}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-circle" ng-click="MisAJour(lignedoc)"><i class="fa fa-hospital-o"></i>
                        </button>
                        <button type="button" class="btn btn-warning btn-circle" ng-click="SupprimerLigne(lignedoc)"><i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-lg-4" style="margin-top: 5%">
            <table>
                <tr ng-repeat="base in basetva">
                    <td>BASE:{{base.titre}} %</td>
                    <td>{{base.valeur}} TND</td>
                </tr>
            </table>
        </div>
        <div class="col-lg-4" style="float: right">
            <table style="font-weight: bold">
                <tr>
                    <td>Total H.TAX</td><td> {{totalfiche.thtxa}}</td>
                </tr>
                <tr>
                    <td>Total Remise</td><td> {{totalfiche.totalremise}}</td>
                </tr>
                <tr>
                    <td>Fodec</td><td> {{totalfiche.fodec}}</td>
                </tr>
                <tr>
                    <td>Total H.TVA</td><td> {{totalfiche.tht}}</td>
                </tr>
                <tr><td>Total TVA</td><td> {{totalfiche.ttva}}</td>
                </tr>
                <tr>
                    <td>Total TTC </td><td>{{totalfiche.ttcnet}} TND</td>
                </tr>
            </table>
        </div>
    </fieldset>
    <fieldset style="margin-left: 30%">
        <legend >Action Fiche</legend>
        <div>
            <a class="btn btn-xs btn-danger" href="<?php echo url_for('documentachat/index?idtype=10'); ?>">Liste des P.V. de Réception</a>
            <input id="btnvalider" ng-click="AjouterBE(1)" type="button" value="Valider le P.V de réception... " class="btn btn-outline btn-danger" />
        </div>
    </fieldset>
</div>