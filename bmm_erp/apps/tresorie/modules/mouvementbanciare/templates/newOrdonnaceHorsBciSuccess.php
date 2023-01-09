<?php $entete = SocieteTable::getInstance()->find(1)->getRs(); ?>
<?php
$banques = CaissesbanquesTable::getInstance()->getAllCaisse();
if ($id) {
    $documentbudget = Doctrine_Core::getTable('documentbudget')->findOneById($id);
    $id_docbudget = $documentbudget->getLigprotitrub()->getId();
    $lignecaisse = LignebanquecaisseTable::getInstance()->getByIdBudgetHorsBCi($id_docbudget);
}
?>
<div class="row">
    <div class="col-xs-12">
        <div class="widget-box" >
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Informations sur la Société</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px;">
                    <h4 style="text-align: center; font-weight: bold;"><?php echo $entete; ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="typedoc" value="horbci">
<div class="row" ng-controller="CtrlMouvement" >
    <div class="col-xs-12">
        <div class="widget-box" >
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Choix Compte Bancaire Ou CCP</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px;" <?php if ($id): ?>   ng-init="InitiliserCaisse('<?php echo $id; ?>')"<?php endif; ?>>

                    <table  class="table table-striped table-bordered table-hover">
                        <tr>
                        <input type="hidden" value="<?php echo $id; ?>" id="id_doc" >
                        <td>Compte Bancaire/CCP </td>
                        <td colspan="3" <?php if ($id) { ?>class="disabledbutton"<?php } ?>> 
                            <?php // echo $form['id_banque']->renderError()  ?>
                            <?php // echo $form['id_banque'] ?>


                            <select  id="mouvementbanciare_id_banque" >
                                <option value="0"></option>
                                <?php foreach ($banques as $caisse): ?>
                                    <option <?php
                                    if ($id) {
                                        if ($lignecaisse->getFirst()->getIdCaissebanque() == $caisse->getId()):
                                            ?> selected="true"
                                                <?php
                                            endif;
                                        }
                                        ?>
                                        value="<?php echo $caisse->getId() ?>">
                                        <?php echo $caisse->getLibelle() ?></option>
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

<div class="row" id="details_mouvements" style="display: none;" ng-controller="CtrlMouvement">
    <div class="col-xs-12">
        <div class="widget-box" >
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Mouvenements</h4>

            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px; width: 100%; overflow: auto; min-height: 500px">
                    <table id="idformulaire"  
                           class="table table-bordered table-hover">
                        <tr>
                            <td>Réf.Ordonnancement<br>
                                <div id="ordonnance_select" <?php if ($id == ""): ?>  style="width: 100%;display: block;"<?php endif; ?>>
                                    <?php echo $form['id_documentbudget']->renderError() ?>
                                    <?php echo $form['id_documentbudget'] ?>
                                </div>
                                <?php //echo $form['reford']->renderError()  ?>
                                <?php //echo $form['reford']   ?>
                                <!--                                <div id="ordonnance_input" style="display: none;">
                                                                    <input type="text" ng-model="numero.text" ng-value="{{numero.text}}"
                                                                           value="{{numero.text}}"
                                                                           id="reforde">
                                                                </div>-->
                                <div id="ordonnance_input_doc" <?php if ($id): ?>  style="display: block;"<?php else: ?> style="width: 100%;display: none;"<?php endif; ?> >

                                    <input type="text" value="<?php if ($id != ""):
                                    echo trim($documentbudget->getNumero());
                                endif;
                                ?>" id="numero_doc">


                                </div>

                                <div  style="display: none;" >
                                    <input type="text" ng-model="numero.text" ng-value="{{numero.text}}" value="{{numero.text}}" id="reforde">
                                </div>
                                <div  style="display: none;" >
                                    <input type="text"  id="reforde_id">
                                </div>
                                <div id="declaration_select" style="display: none;">
                                    <select id="id_declaration">
                                        <option value="0"></option>
                                    </select>
                                </div>
                            </td>
                            <td style="width: 40%">Libellé d'opération<br>
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
                            <td>Objet de règlement<br>
                                <!--<select name="mouvementbanciare[id_object]" id="mouvementbanciare_id_object">-->
<?php echo $form['id_object']->renderError() ?>
<?php echo $form['id_object'] ?>
                                <!--                                    <option value="" selected="selected"></option>
                                                                    <option value="5">Quittance</option>
                                                                    <option value="1">Factures</option>
                                                                    <option value="4">Transfert</option>-->
                                <!--</select>-->
                            </td>
                            <td style="display: none">
                                RIB Bénéficiaire
                                <input type="text" id="ribbeni" maxlength="20" ng-model="fournisseur_rib.text" ng-value="{{fournisseur_rib.text}}" value="{{fournisseur_rib.text}}">
                            </td>
                            <td>
                                Bénéficiaire
                                <div id="beneficiaire_input">
                                    <input type="text" id="refbeni" ng-model="fournisseur_rs_hor.text" ng-value="{{fournisseur_rs_hor.text}}" >
                                </div>
                                <div id="beneficiaire_select" style="display: none;">
                                    <select id="id_banque_cible">
                                        <option id="0"></option>
                                    </select>
                                </div>                             
                            </td>
                            <td>
                                Débit
                                <input type="text" id="val_debit" ng-model="mnt.text" ng-value="{{mnt.text}}" class="align_right"   >
                            </td>
                            <td>
                                Crédit
                                <input type="text" id="val_credit" class="align_right" readonly="true">
                            </td>
                        </tr>

                    </table>
                    <div id="certificat" style="display: none"> 
                        <table   style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>Montant Tva :</td>
                                <td>
                                    <input type="text" id="val_certificat_tva" class="align_right" readonly="true">
                                </td>
                                <td>Montant Retenue :</td>
                                <td>
                                    <input type="text" id="val_certificat" class="align_right" readonly="true">
                                </td>
                            </tr>
                        </table>
                    </div>


                    <div style="font-size: 14px; height: 37px; padding: 8px 10px;" class="col-sm-3">
                        <span><i>Dernière mouvement N°:</i> </span><span id="show_last_operation"></span>
                        <input type="hidden" value="" id="last_operation" />
                        <input type="hidden" value="" id="current_operation" />
                    </div>

                    <a ng-click="SaveOperations()" class="btn btn-success" style="float: right; padding: 4px 12px; padding-top: 3px;"><i class="ace-icon fa fa-save align-center bigger-110"></i> Valider</a>
                    <a title="Ajouter avant la ligne sélectionnée." data-rel="tooltip" ng-click="ViderLigne()" class="btn btn-primary" style="float: right; padding: 4px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-right align-center bigger-110"></i> Vider Ligne</a>
                    <a title="Ajouter à la fin." data-rel="tooltip" ng-click="PushNewLigne('<?php echo $id; ?>')" class="btn btn-info" style="float: right; padding: 4px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-down align-center bigger-110"></i> Ajouter Ligne</a>
                    <table   style="list-style: none" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th style="width: 200px">date</th>
                                <th style="width: 200px">Réf.Ordonnancement</th>
                                <th style="width: 200px">Libellé d'opération</th>
                                <th style="width: 200px">Bénéficiaire</th>

                                <th style="width: 200px">Débit</th>
                                <th style="width: 200px">Crédit</th>
                                <th style="width: 20px">M.TVA</th>
                                <th style="width: 20px">Retenue</th>
                                <th style="width: 200px">solde</th>
                                <th style="width: 50px; text-align: center;">X</th>
                            </tr>
                        </thead>
                        <tbody ng-repeat="lgop in listes_operations">
                            <tr>
                                <td>{{lgop.nb}}</td>
                                <td>{{lgop.dateoperation}}</td>
                                <?php if ($id != null): ?>
                                    <td>{{lgop.numero_doc}}</td>
                                <?php else: ?>
                                    <td>{{lgop.reford}} </td>                                    
<?php endif; ?>
                                <td style="display: none">{{log.reford_id}}</td>
                                <td>{{lgop.nomoperation}}</td>
                                <td>{{lgop.refbenifi}}</td>                              
                                <td>{{lgop.debit}}</td>
                                <td>{{lgop.credit}}</td>
                                <td>{{lgop.tvaretenue}}</td>
                                <td>{{lgop.retenue}}</td>
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
    document.title = ("BMM - Caisse : Nouvelle fiche de mouvements");

</script>

<style>

    .align_right{text-align: right;}
    .btn-group{
        width: 100%;
    }
    .dropdown-toggle{
        width: 100%;
        text-align: left;
    }
    fa-caret-down{float: right;}
    .multiselect-container{
        height: 150px;
        overflow: auto;
        width: 340px;
    }

</style>