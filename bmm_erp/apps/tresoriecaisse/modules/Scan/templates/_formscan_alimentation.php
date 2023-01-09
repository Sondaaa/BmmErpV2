<div id="sf_admin_content" ng-controller="CtrlScan">
    <div class="row">
        <div  class="col-md-6">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body" style="height: 613px; text-align: center;">
                    <iframe id="imgmodel" src="<?php echo sfConfig::get('sf_appdir'); ?>uploads/PDF_file_icon.png" type="application/pdf" style="width:100%; height:570px;" frameborder="0"></iframe>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <div class="col-md-6" id="box_scan">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <fieldset style="padding: 10px;">
                        <legend>Attacher Fiche Scannée</legend>
                        <div class="col-lg-12">
                            <div class="content">
                                <input id="scan_button" type="button" value="SCAN NOUVEAUX DOCUMENT" ng-click="ScanDoc('<?php echo url_for('Scan/Lancerscan') ?>');" class="btn btn-info">
                                <input id="valid_scan_button" ng-click="ValiderAttachementBudget('<?php echo sfconfig::get('sf_appdir') ?>budget.php/titrebudjet/Validerattachement', '0')" type="button" value="VALIDER ATTACHEMENT" class="btn btn-info">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php $form = new PiecejointForm(); ?>
                    <div class="table-responsive">
                        <legend>Attacher pièce jointe</legend>
                        <table ng-controller="myCtrlbudget" style="margin-bottom: 0px;">
                            <tbody>
                                <tr>
                                    <td>Document</td>
                                    <td>
                                        <?php echo $form['chemin']->renderError() ?>
                                        <?php echo $form['chemin'] ?>
                                        <input type="hidden" id="piece_alimentation" value="" />
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr id="attachement_button">
                                    <td colspan="2">
                                        <input type="button" class="btn btn-outline btn-success" value="Ajouter Attachement" ng-click="ValiderAttachementAlimentation()" style="float: right;" />
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" id="sf_fieldset_none_choix" style="display: none;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <legend>Choix du Type</legend>
                    <select id="type_alimentation" onchange="setAffichageFormulaire()">
                        <option value=""></option>
                        <option value="0">Encaissement Budget</option>
                        <option value="2">Recette Hors Budget</option>
                        <option value="1">Transfert</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6" id="sf_fieldset_none" style="display: none;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <legend>Formulaire Alimentation</legend>
                    <fieldset>
                        <div class="col-lg-3">
                            Date <span class="required">*</span>
                            <div class="content">
                                <input type="date" name="alimentationcompte[date]" id="alimentationcompte_date">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            Banque / CCP <span class="required">*</span>
                            <div class="content">
                                <?php $caisse_banques = CaissesbanquesTable::getInstance()->getAllBanque(); ?>
                                <select name="alimentationcompte[id_compte]" id="alimentationcompte_id_compte" style="width: 100%;">
                                    <option value="" selected="selected"></option>
                                    <?php foreach ($caisse_banques as $caisse_banque): ?>
                                        <option value="<?php echo $caisse_banque->getId(); ?>"><?php echo $caisse_banque; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            Montant <span class="required">*</span>
                            <div class="content">
                                <input class="align_right" type="text" name="alimentationcompte[montant]" id="alimentationcompte_montant" style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            Source <span class="required">*</span>
                            <div class="content" id="zone_id_source">
                                <?php $sources = SourcesbudgetTable::getInstance()->findAll(); ?>
                                <select name="alimentationcompte[id_source]" id="alimentationcompte_id_source" style="width: 100%;">
                                    <option value="" selected="selected"></option>
                                    <?php foreach ($sources as $source): ?>
                                        <option value="<?php echo $source->getId(); ?>"><?php echo $source; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="content" id="zone_libelle_source">
                                <input type="text" id="alimentationcompte_source_libelle">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="col-md-6" id="sf_fieldset_none_transfert" style="display: none;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <legend>Formulaire Transfert</legend>
                    <fieldset>
                        <div class="col-lg-3">
                            Date <span class="required">*</span>
                            <div class="content">
                                <input type="date" name="alimentationcompte[date]" id="alimentationcompte_date_transfert">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            Référence Ordonnancement
                            <div class="content">
                                <input class="align_right" type="text" name="alimentationcompte[reference]" id="alimentationcompte_reference_transfert" style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            Montant <span class="required">*</span>
                            <div class="content">
                                <input class="align_right" type="text" name="alimentationcompte[montant]" id="alimentationcompte_montant_transfert" style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-lg-6" style="margin-top: 10px;">
                            Du Compte Banque / CCP <span class="required">*</span>
                            <div class="content">
                                <?php $caisse_banques = CaissesbanquesTable::getInstance()->getAllBanque(); ?>
                                <select name="alimentationcompte[id_compte]" id="alimentationcompte_id_compte_from" style="width: 100%;">
                                    <option value="" selected="selected"></option>
                                    <?php foreach ($caisse_banques as $caisse_banque): ?>
                                        <option montant="<?php echo $caisse_banque->getMntdefini(); ?>" value="<?php echo $caisse_banque->getId(); ?>"><?php echo $caisse_banque; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6" style="margin-top: 10px;">
                            Vers Compte Banque / CCP <span class="required">*</span>
                            <div class="content">
                                <?php $caisse_banques = CaissesbanquesTable::getInstance()->getAll(); ?>
                                <select name="alimentationcompte[id_compte]" id="alimentationcompte_id_compte_to" style="width: 100%;">
                                    <option value="" selected="selected"></option>
                                    <?php foreach ($caisse_banques as $caisse_banque): ?>
                                        <option value="<?php echo $caisse_banque->getId(); ?>"><?php echo $caisse_banque; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4" style="margin-top: 10px;">
                            Type d'opération <span class="required">*</span>
                            <div class="content">
                                <select name="alimentationcompte[type_operation]" id="type_operation" style="width: 100%;">

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4" style="margin-top: 10px;">
                            Instrument <span class="required">*</span>
                            <div class="content">
                                <select name="alimentationcompte[instrument]" id="instrument" style="width: 100%;">

                                </select>
                            </div>
                        </div>
                        <div id="zone_reference_instrument" class="col-lg-4" style="margin-top: 10px;">
                            Référence Instrument
                            <div class="content">
                                <input type="text" name="alimentationcompte[reference_instrument]" id="reference_instrument" style="width: 100%;">
                            </div>
                        </div>
                        <div id="zone_cheque" class="col-lg-4" style="margin-top: 10px; display: none;">
                            Chèque
                            <div class="content">
                                <input readonly="true" type="text" name="alimentationcompte[reference_cheque]" id="reference_cheque" style="width: 72%;">
                                <input type="hidden" id="cheque_id" value="" />
                                <button class="btn btn-white btn-primary" ng-click="ChargerCheque()"><i class="ace-icon fa fa-pencil-square-o" style="margin-right: 0px;"></i></button>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="col-md-6 pull-right">
            <span class="required">*</span> : Champ obligatoire.<br>
            <ul class="sf_admin_actions" style="display:inline-flex;list-style: none; margin-top:2%;">
                <li class="sf_admin_action_list" style="margin-right: 2%;">
                    <a href="<?php echo url_for('@alimentationcompte') ?>" class="btn btn-white btn-success">Retour à la liste</a>
                </li>
                <li class="sf_admin_action_save">
                    <input type="button" ng-click="saveAlimentation()" value="Enregistrer" class="btn btn-white btn-primary">
                </li>
            </ul>
        </div>
    </div>
</div>

<script>

    function setAffichageFormulaire() {
        if ($("#type_alimentation").val() == '0') {
            $("#sf_fieldset_none_transfert").hide();
            $("#sf_fieldset_none").show();
            $(".sf_admin_action_save").show();
            $("#zone_id_source").show();
            $("#zone_libelle_source").hide();
            
        } else if ($("#type_alimentation").val() == '1') {
            $("#sf_fieldset_none").hide();
            $("#sf_fieldset_none_transfert").show();
            $(".sf_admin_action_save").show();
        } else {
            $("#sf_fieldset_none_transfert").hide();
            $("#sf_fieldset_none").show();
            $(".sf_admin_action_save").show();
            $("#zone_id_source").hide();
            $("#zone_libelle_source").show();
        }
    }

</script>