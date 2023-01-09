<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>
    <?php $entete = SocieteTable::getInstance()->find(1)->getRs(); ?>
    <?php
    if ($id) {
        $document = DocumentachatTable::getInstance()->find($id);
        $numero = $document->getNumerodocumentachat(). ' - Référence: ' . $document->getReference() ;
    }
    ?>
</fieldset>
<!--<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Informations sur la Société</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px;">
                    <h4 style="text-align: center; font-weight: bold;"><?php // echo $entete                 ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>-->

<div class="row" id="details_mouvements" ng-controller="CtrlFacturatioin">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Mouvenements </h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px; width: 100%; overflow: auto; min-height: 500px">
                    <table id="idformulaire">
                        <tr>
                            <td colspan="4" style="text-align: center;">Facture</td>
                            <td colspan="3" style="text-align: center; background-color: #dff0d8;">B.C.E / B.D.C </td>
                        </tr>
                        <tr>
                            <td>Date<br>
                                <input ng-model="mouvementdate.text" ng-change="getLastOrder()" type="date" value="<?php date('d/m/Y'); ?>" id="date_mouvement">
                            </td>
                            <td>Numéro<br>
                                <input type="text" id="numero_facture">
                            </td>
                            <td colspan="2">Montant<br>
                                <input type="text" class="align_right" id="montant">
                            </td>
                            <td>Numéro

                                <a id="info_doc_achat" onclick="showHistorique()" style="float: right; cursor: pointer;"><i class="ace-icon fa fa-info-circle bigger-130"></i></a><br>
                                <?php if ($id != '') { ?>
                                    <input type="text" value="<?php
                                    if ($id != '') {
                                        echo $numero;
                                    }
                                    ?>" id="documentachat" >
                                       <?php } else { ?>
                                    <input type="text" value="<?php
                                    if ($id != '') {
                                        echo $numero;
                                    }
                                    ?>" id="documentachat" ng-model="documentachat.text" 
                                           <?php if ($id == '') { ?>  ng-change="AfficheDocAchatFournisseur('#documentachat', '#id_documentachat', '#date_documentachat', '#montant_documentachat', '#id_fournisseur', '#fournisseur_raison')" <?php } ?>>
                                       <?php } ?>
<!--                                <input type="text" value="<?php // echo $id;                            ?>" 
id="documentachat" ng-model="documentachat.text"
ng-change="AfficheDocAchatFournisseur('#documentachat', '#id_documentachat', '#date_documentachat', '#montant_documentachat', '#id_fournisseur', '#fournisseur_raison')">-->
                                <input type="hidden" id="id_documentachat" value="<?php
                                if ($id != '') {
                                    echo $id;
                                }
                                ?>">
                            </td>
                            <td>Date<br>
                                <input type="date" value="<?php
                                if ($id != '') {
                                    echo $document->getDatecreation();
                                }
                                ?>" id="date_documentachat">
                            </td>
                            <td>Montant<br>
                                <input class="align_right" type="text" value="<?php
                                if ($id != '') {
                                    echo $document->getMntttc();
                                }
                                ?>" id="montant_documentachat">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: center; background-color: #fcf8e3;">R.R.S / P.V.R</td>
                            <td colspan="3" style="text-align: center; background-color: #F7F7F7;">Fournisseur</td>
                        </tr>
                        <tr>
                            <td>R.R.S<br>
                                <input type="text" value="" id="rrs">
                            </td>
                            <td>P.V.R<br>
                                <input type="text" value="" id="pvr">
                            </td>
                            <td>Date<br>
                                <input type="date" value="" id="date_rrs_pvr">
                            </td>
                            <td>Validé<br>
                                <input type="checkbox" value="" id="valide_rrs_pvr">
                            </td>
                            <td colspan="2">Raison sociale
                                <input type="text" value="<?php
                                if ($id != '') {
                                    echo $document->getFournisseur()->getRs();
                                }
                                ?>" id="fournisseur_raison">
<!--                                <input type="text" value="" id="fournisseur_raison" 
                                       ng-model="fournisseur.text" ng-change="AfficheFournisseur('#fournisseur_raison', '#id_fournisseur')">-->
                                <input type="hidden" value="<?php
                                if ($id != '') {
                                    echo $document->getFournisseur()->getId();
                                }
                                ?>" id="id_fournisseur">
                            </td>
                            <td>
                                Situation Fiscale </br>
                                <?php
                                echo $form['etatfrs']->renderError();
                                echo $form['etatfrs']->render(array());
                                ?>

                            </td>
                        </tr>
                        <tr style="display: none;">
                            <td>Pièce jointe - Facture</td>
                            <td>
                                <?php
//                                $formfacture = new PiecejointForm();
//                                echo $formfacture['chemin']->renderError();
//                                echo $formfacture['chemin']->render(array('id' => 'piecejoint_facture'));
                                ?>
                                <input type="file" id="piecejoint_facture" />
                            </td>
                            <td>Pièce jointe - R.R.S</td>
                            <td colspan="2">
                                <?php
//                                echo $formfacture['chemin']->renderError();
//                                echo $formfacture['chemin']->render(array('id' => 'piecejoint_rrs'));
                                ?>
                                <input type="file" id="piecejoint_rrs" />
                            </td>
                            <td>Pièce jointe - P.V.R</td>
                            <td>
                                <?php
//                                echo $formfacture['chemin']->renderError();
//                                echo $formfacture['chemin']->render(array('id' => 'piecejoint_pvr'));
                                ?>
                                <input type="file" id="piecejoint_pvr" />
                            </td>
                        </tr>
                    </table>

                    <div style="font-size: 14px; height: 37px; padding: 8px 10px;" class="col-sm-3">
                        <span><i>Dernière mouvement N°:</i> </span><span id="show_last_operation">-</span>
                        <input type="hidden" value="0" id="last_operation" />
                        <input type="hidden" value="0" id="current_operation" />
                    </div>

                    <a ng-click="SaveOperations()" class="btn btn-success" style="float: right; padding: 4px 12px; padding-top: 3px;"><i class="ace-icon fa fa-save align-center bigger-110"></i> Valider</a>
                    <a title="Vider la ligne." data-rel="tooltip" ng-click="ViderLigne()" class="btn btn-primary" style="float: right; padding: 4px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-right align-center bigger-110"></i> Vider Ligne</a>
                    <a title="Ajouter à la fin." data-rel="tooltip" ng-click="PushNewLigne()" class="btn btn-info" style="float: right; padding: 4px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-down align-center bigger-110"></i> Ajouter Ligne</a>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 60px">N°</th>
                                <th style="width: 100px">date</th>
                                <th style="width: 150px">Facture N°</th>
                                <th style="width: 150px">Montant</th>
                                <th style="width: 200px; background-color: #dff0d8;">B.C.E / B.D.C </th>
                                <th style="width: 100px; background-color: #dff0d8;">Date</th>
                                <th style="width: 150px; background-color: #fcf8e3;">R.R.S + P.V.R</th>
                                <th style="width: 100px; background-color: #fcf8e3;">Date</th>
                                <th style="width: 200px">Fournisseur</th>
                                <th >Situation Fiscale</th>
                                <th style="width: 50px; text-align: center;">X</th>
                            </tr>
                        </thead>
                        <tbody ng-repeat="lgop in listes_operations">
                            <tr>
                                <td>{{lgop.nb}}</td>
                                <td style="text-align: center;">{{lgop.date_mouvement}}</td>
                                <td>{{lgop.numerofacture}}</td>
                                <td style="text-align: right;">{{lgop.montant| currency : "" : 3}}</td>
                                <td style="background-color: #dff0d8;">{{lgop.documentachat}}</td>
                                <td style="background-color: #dff0d8; text-align: center;">{{lgop.date_documentachat}}</td>
                                <td style="background-color: #fcf8e3;"><span ng-if="lgop.rrs != ''">{{lgop.rrs}}</span> + <span ng-if="lgop.pvr != ''">{{lgop.pvr}}</span> <span ng-if="lgop.valide == true" style="float: right;"><i class="ace-icon fa fa-check bigger-110" title="Validé" style="margin-right: 0px;"></i></span></td>
                                <td style="background-color: #fcf8e3; text-align: center;">{{lgop.date_rrs_pvr}}</td>
                                <td>{{lgop.fournisseur_raison}}</td>
                                <td style="display: none">{{lgop.etat_frs}}</td>
                                <td><span ng-if="lgop.etat_frs == '1'">En Régle</span>  <span ng-if="lgop.etat_frs == '0'">En Défaut</span> </td>
                                <td style="text-align: center;">
                                    <a name="supprimer_ligne" class="btn btn-danger btn-xs" ng-click="Supprimer(lgop.nb)"><i class="ace-icon fa fa-trash-o align-top bigger-110" style="margin-right: 0px;"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Liste des Mouvements</h4>
                <div class="mws-panel grid_8" id="liste_mouvement">

                </div>
            </div>
        </div>
    </div>
</div> 
<script>

    function showHistorique() {
        if ($('#id_documentachat').val() != '') {
            $.ajax({
                url: '<?php echo url_for('lignemouvementfacturation/showHistorique') ?>',
                data: 'id=' + $('#id_documentachat').val(),
                success: function (data) {
                    bootbox.dialog({
                        message: data,
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                }
            });
        }
    }
    afficher();
    function afficher() {
        $.ajax({
            url: '<?php echo url_for('lignemouvementfacturation/afficherMouvementPardate') ?>',
            data: 'date_mouvement=' + $('#date_mouvement').val(),
            success: function (data) {
                $('#liste_mouvement').html(data);

            }
        });
    }

    function openPopupSupprimerForm(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer Ce Mouvement  ?",
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {
                if (result) {
//                    deletePieceForm(id);
                    testerExistancedufacture(id);
                }
            }
        });
    }
    function testerExistancedufacture(id) {
        $.ajax({
            url: '<?php echo url_for('lignemouvementfacturation/testerExistancefacture') ?>',
            data: 'id=' + id,
            success: function (data) {
//                data = $.trim(data);
                console.log('data=' + data);
                if (data.trim() == '1') {
                    bootbox.dialog({
                        message: 'Ce Mouvement a une Facture on ne peut pas le supprimer  !',
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                }
                else if (data.trim() == '0') {
                    deletePieceForm(id);
                }
            }

        });
    }
    function deletePieceForm(id) {
        $.ajax({
            url: '<?php echo url_for('lignemouvementfacturation/delete') ?>',
            data: 'id=' + id + '&date=' + $("#date_mouvement").val(),
            success: function (data) {
                afficher();

            }
        });
    }
</script>

<script  type="text/javascript">
    document.title = ("BMM - Facturation : Nouvelle fiche de mouvements");
</script>

<style>

    .align_right{text-align: right;}

</style>