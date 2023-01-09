<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>
    <?php $entete = SocieteTable::getInstance()->find(1)->getRs(); ?>
</fieldset>
<div class="row">
    <div class="col-xs-12">
        <div class="widget-box" >
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Informations sur la Société</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px;">
                    <h4 style="text-align: center; font-weight: bold;"><?php echo $entete ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Choix Caisse</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px;">
                    <?php $caisses = CaissesbanquesTable::getInstance()->getAllCaisse(); ?>
                    <table>
                        <tr>
                            <td>Caisse</td>
                            <td>
                                <select name="mouvementbanciare[id_banque]" id="mouvementbanciare_id_banque">
                                    <option value="0"></option>
                                    <?php foreach ($caisses as $caisse): ?>
                                        <option value="<?php echo $caisse->getId() ?>"><?php echo $caisse->getLibelle() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>Solde Départ</td>
                            <td>
                                <input type="text" id="sold_depart" ng-model="soldedepart.text" ng-value="{{soldedepart.text}}" ui-money-mask="3">
                            </td>
                            <td>
                                <input id="initialiser_solde" style="float: right" class="btn btn-grey" type="button" ng-click="AddNewSolde(detailBanque.id)" ng-if="soldeinial == 0" value="+ Initialiser Compte">
                            </td>
                            <td>Nouveau Solde</td>
                            <td class="disabledbutton"> 
                                <input type="text" id="nsolde" ng-model="soldefinal.text" ng-value="{{soldefinal.text}}">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="details_mouvements" style="display: none;">
    <div class="col-xs-12">
        <div class="widget-box" >
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Mouvements</h4>
                <div style="float: right; margin-top: 9px; margin-right: 13px;">
                    <input id="type_mouvement" name="switch-field-1" class="ace ace-switch btn-flat" checked="true" type="checkbox">
                    <span class="lbl" data-lbl="DEC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ENC"></span>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px; width: 100%; overflow: auto; min-height: 500px">
                    <table id="idformulaire">
                        <tr>
                            <td style="width: 30%">B. de dépenses au comptant<br>
                                <div id="ordonnance_select">
                                    <?php echo $form['id_documentachat']->renderError() ?>
                                    <?php echo $form['id_documentachat'] ?>
                                </div>
                                <div id="ordonnance_input" style="display: none;">
                                    <input type="text" ng-model="numero.text" ng-value="{{numero.text}}" value="{{numero.text}}" id="reforde">
                                </div>
                            </td>
                            <td style="width: 40%">Libellé d'opération
                                <?php echo $form['nomoperation']->renderError() ?>
                                <?php echo $form['nomoperation'] ?>
                            </td>
                            <td style="width: 15%">
                                Date d'opération<br>
                                <?php echo $form['dateoperation']->renderError() ?>
                                <?php echo $form['dateoperation'] ?>
                            </td>
                            <td style="width: 15%">
                                Référence Autre
                                <?php echo $form['referenceautre']->renderError() ?>
                                <?php echo $form['referenceautre'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Objet de règlement
                                <select name="mouvementbanciare[id_object]" id="mouvementbanciare_id_object">
                                    <option value="" selected="selected"></option>
                                    <option value="1">Factures</option>
                                    <option value="4">Transfert</option>
                                </select>
                            </td>
                            <td>
                                Bénéficiaire
                                <div id="beneficiaire_input">
                                    <input type="text" id="refbeni" ng-model="fournisseur_rs.text" ng-value="{{fournisseur_rs.text}}" value="{{fournisseur_rs.text}}">
                                </div>
                                <div id="beneficiaire_select" style="display: none;">
                                    <select id="id_banque_cible">
                                        <option id="0"></option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                Débit
                                <input type="text" id="val_debit" ng-model="mnt.text" ng-value="{{mnt.text}}" value="{{mnt.text}}" class="align_right">
                            </td>
                            <td>
                                Crédit
                                <input type="text" id="val_credit" class="align_right" readonly="true">
                            </td>
                        </tr>
                    </table>

                    <div style="font-size: 14px; height: 37px; padding: 8px 10px;" class="col-sm-3">
                        <span><i>Dernière mouvement N°:</i> </span><span id="show_last_operation"></span>
                        <input type="hidden" value="" id="last_operation" />
                        <input type="hidden" value="" id="current_operation" />
                    </div>

                    <a ng-click="SaveOperations()" class="btn btn-success" style="float: right; padding: 4px 12px; padding-top: 3px;"><i class="ace-icon fa fa-save align-center bigger-110"></i> Valider</a>
                    <a title="Ajouter avant la ligne sélectionnée." data-rel="tooltip" ng-click="ViderLigne()" class="btn btn-primary" style="float: right; padding: 4px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-right align-center bigger-110"></i> Vider Ligne</a>
                    <a title="Ajouter à la fin." data-rel="tooltip" ng-click="PushNewLigne()" class="btn btn-info" style="float: right; padding: 4px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-down align-center bigger-110"></i> Ajouter Ligne</a>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 50px">N°</th>
                                <th style="width: 100px">date</th>
                                <th style="width: 200px">B. de dépenses au comptant</th>
                                <th style="width: 200px">Libellé d'opération</th>
                                <th style="width: 200px">Bénéficiaire</th>
                                <th style="width: 150px">Débit</th>
                                <th style="width: 150px">Crédit</th>
                                <th style="width: 150px">solde</th>
                                <th style="width: 50px; text-align: center;">X</th>
                            </tr>
                        </thead>
                        <tbody ng-repeat="lgop in listes_operations">
                            <tr>
                                <td>{{lgop.nb}}</td>
                                <td>{{lgop.dateoperation}}</td>
                                <td>{{lgop.reford}}</td>
                                <td>{{lgop.nomoperation}}</td>
                                <td>{{lgop.refbenifi}}</td>
                                <td>{{lgop.debit}}</td>
                                <td>{{lgop.credit}}</td>
                                <td>{{lgop.solde| currency : "" : 3}}</td>
                                <td style="text-align: center;">
                                    <a class="btn btn-danger btn-xs" ng-click="Supprimer(lgop.nb)"><i class="ace-icon fa fa-trash-o align-top bigger-110"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">
    document.title = ("BMM - Banque : Nouvelle fiche de mouvements");
</script>

<style>

    .align_right{text-align: right;}

</style>