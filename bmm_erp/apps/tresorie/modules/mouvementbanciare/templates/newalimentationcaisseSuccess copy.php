<?php $entete = SocieteTable::getInstance()->find(1)->getRs();?>
<?php
$banques = CaissesbanquesTable::getInstance()->getAllCaisse();
if ($id) {

    $mvt_bancaire = MouvementbanciareTable::getInstance()->find($id);
}
$mouvement_bancaire = MouvementbanciareTable::getInstance()->getByAlimentationcaisse();
?>
<input type="hidden" value="<?php if ($id) { echo $id ;}?>" id="id_mvt">
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
<div class="row" <?php if ($id): ?> ng-init="InitiliserCaisseAlimentation('<?php echo $id; ?>')"<?php endif;?>>
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Choix Caisse</h4>
            </div>
            <div class="widget-body" >
                <div class="widget-main" style="padding-bottom: 0px;" >
                    <?php
$caisses = CaissesbanquesTable::getInstance()->getAllCaisse();
if ($id) {
    $mvt_bancaire = MouvementbanciareTable::getInstance()->find($id);
}
//                  ?>
<?php ?>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>Caisse</td>
                            <td <?php //if ($id != null) {class="disabledbutton"?><?php //}?>>
                            <input type="hidden" value="alimentationcaisse" id="type" >
                                <input type="hidden" value="<?php echo $id; ?>" id="id_doc" >
                                <input type="hidden" value="" id="reforde_id" >
                                <select name="mouvementbanciare[id_banque]" id="mouvementbanciare_id_banque">
                                    <?php foreach ($caisses as $caisse):
?>
                                        <option value="0"></option>
                                        <option <?php
if ($id != null) {
    if ($mvt_bancaire) {
        if ($mvt_bancaire->getIdCaisse() == $caisse->getId()):
        ?> selected="true"<?php endif;}}?>
                value="<?php echo $caisse->getId() ?>">
                <?php echo $caisse->getLibelle() ?></option>
                                    <?php endforeach;?>
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
                <h4 class="widget-title smaller">Mouvements</h4>
                <div style="float: right; margin-top: 9px; margin-right: 13px;" class="disabledbutton">
                    <input   name="switch-field-1" class="ace ace-switch btn-flat" checked="false" type="checkbox" >
                    <span class="lbl" data-lbl="ENC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DEC"></span>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px; width: 100%; overflow: auto; min-height: 500px">
                    <table id="idformulaire"  class="table table-bordered table-hover">
                        <tr>
                        <td style="width: 30%">Mouvement Bancaire<br>
                                <?php if ($id): ?>
                                    <div id="muvementbancaire" >
                                    <select  name="mvt_ban" id="mvt_ban">
                                            <option></option>
                                            <?php foreach ($mouvement_bancaire as $mvt): ?>
                                                <option value="<?php echo $mvt->getId() ?>" <?php
                                                                if ($id == $mvt->getId()): echo 'selected';
                                                                endif; ?> >
                                                            <?php echo $mvt->getNumero() . ' ' . $mvt->getNomoperation() ?>
                                                </option>
                                            <?php endforeach;?>
                                        </select>
                                        <input type="hidden" id="numero_mvt">
                                    </div>

                                <?php endif;?>
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
                            <td style="width: 20%" colspan="2">
                                Référence Autre
                                    <?php echo $form['referenceautre']->renderError() ?>
                                    <?php echo $form['referenceautre'] ?>
                            </td>

                        </tr>
                        <tr>
                            <td>Objet de règlement<br>
                                <select name="mouvementbanciare[id_object]" id="mouvementbanciare_id_object">
<?php //echo $form['id_object']->renderError() ?>
<?php // echo $form['id_object'] ?>
                                                                   <option value="8" selected="selected">Alimentation Caisse</option>


                                </select>
                            </td>

                            <td>
                                Débit<br><input type="text" id="val_debit"  readonly="true"  class="align_right"   >
                            </td>
                            <td style="width: 35%" colspan="3">
                                Crédit<br>
                                <input type="text" id="val_credit"   ng-model="mnt.text"  ng-value="{{mnt.text}}" class="align_right"  style="width: 100%">
                            </td>
                            <td>
                            <a href="#my-modal" role="button" class="bg-warning btn-sm btn-warning" data-toggle="modal" ng-controller="CtrlMouvement" ng-click="initialiserpoup()">
                             Détail Monnaie
                        </a>
                            </td>
                        </tr>

                    </table>
                    <div style="font-size: 14px; height: 37px; padding: 8px 10px;" class="col-sm-3">
                        <span><i>Dernière mouvement N°:</i> </span><span id="show_last_operation"></span>
                        <input type="hidden" value="" id="last_operation" />
                        <input type="hidden" value="" id="current_operation" />
                    </div>

                    <a ng-click="SaveOperationsAlimentationcaisse()" class="btn btn-success" style="float: right; padding: 4px 12px; padding-top: 3px;"><i class="ace-icon fa fa-save align-center bigger-110"></i> Valider</a>
                    <a title="Ajouter avant la ligne sélectionnée." data-rel="tooltip" ng-click="ViderLigne()" class="btn btn-primary" style="float: right; padding: 4px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-right align-center bigger-110"></i> Vider Ligne</a>
                    <a title="Ajouter à la fin." data-rel="tooltip" ng-click="PushNewLigneAlimentationcaisse('<?php echo $id; ?>')" class="btn btn-info" style="float: right; padding: 4px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-down align-center bigger-110"></i> Ajouter Ligne</a>
                    <table   style="list-style: none" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30px">N°</th>
                                <th style="width: 200px">date</th>
                                <th style="width: 200px">Mouvement Bancaire</th>
                                <th style="width: 200px">Libellé d'opération</th>
                                <!-- <th style="width: 200px">Bénéficiaire</th> -->
                                <th style="width: 200px">Débit</th>
                                <th style="width: 200px">Crédit</th>
                                <!-- <th style="width: 20px">M.TVA</th>
                                <th style="width: 20px">Retenue</th> -->
                                <th style="width: 200px">solde</th>
                                <th style="width: 50px; text-align: center;">X</th>
                            </tr>
                        </thead>
                        <tbody ng-repeat="lgop in listes_operations">
                            <tr>
                                <td>{{lgop.nb}}</td>
                                <td>{{lgop.dateoperation}}</td>
                                <td style="display: none">{{lgop.id_mouvement}}</td>
                                <td style="display: block">{{lgop.mouvement}} </td>
                                <?php if ($id != null): ?>
                                    <td style="display: none">{{lgop.numero_doc}}</td>
                                <?php else: ?>
                                    <td style="display: none">{{lgop.reford}} </td>
                                <?php endif;?>
                                <td style="display: none">{{log.reford_id}}</td>
                                <td>{{lgop.nomoperation}}</td>
                                <!-- <td>{{lgop.refbenifi}}</td> -->
                                <td>{{lgop.debit}}</td>
                                <td>{{lgop.credit}}</td>
                                <td>{{lgop.solde| currency : "" : 3}}</td>
                                <td style="text-align: center;">
                                    <a class="btn btn-xs btn-danger btn-xs" ng-click="Supprimer(lgop.nb)"><i class="ace-icon fa fa-trash-o align-top bigger-110"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
 <div id="my-modal" class="modal fade" tabindex="-1" >
<div class="modal-dialog" style="width: 90%">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="smaller lighter blue no-margin">Détail Monnaie</h3>
                    </div>
                    <div class="modal-body">
                        <?php
                        $formapiece = new CaiseepiecemonnaieForm();
                        $caissepiecemon = new Caiseepiecemonnaie();
                        ?>
                        <?php include_partial('mouvementbanciare/formpetit', array('caissepiecemon' => $caissepiecemon, 'form' => $formapiece)) ?>
                    </div>
                    <div class="modal-footer" ng-controller="CtrlMouvement">
                        <button style="margin-left: 10px;" class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                            <i class="ace-icon fa fa-times"></i>
                            fermer
                        </button>
                        
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
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