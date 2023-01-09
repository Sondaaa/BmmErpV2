<?php $rubriques = LigprotitrubTable::getInstance()->getFirstParentByTitre($formdetail->getObject()->getId()); ?>
<fieldset>
    
    <div class="col-lg-7" ng-if="etatbudget === '2'" style="float: left; margin-top: 15px; margin-bottom: 15px;">
        <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
            <table>
                <thead>
                    <tr>
                        <td colspan="5"><label>Mnt Reste débloqué</label>
                            <?php
                            $parametrages = Doctrine_Core::getTable('parametragetranche')->findAll();
                            $chaine = "";
                            $mntglobal = $formdetail->getObject()->getMntglobal();
                            foreach ($parametrages as $parametre) {
                                $tranche = Doctrine_Core::getTable('tranchebudget')
                                        ->findOneByIdTitrebudgetAndIdParametragetranche($formdetail->getObject()->getId(), $parametre->getId());
                                if ($tranche)
                                    $mntglobal-=$tranche->getMntvaleur();
                            }
                            ?>
                            <input type="text" id="chaine_idp" value="<?php echo $mntglobal ?>">
                            <input type="hidden" id="alimentation_tranche" value="">
                        </td>
                    </tr>
                    <tr>
                        <th>Nom du Tranche</th>
                        <th>Date</th>
                        <th>Mnt.</th>
                        <th>Pourcentage%</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tranche_ajout_id = '';
                    foreach ($parametrages as $par) {
                        $class = "";
                        $tranche = Doctrine_Core::getTable('tranchebudget')
                                ->findOneByIdTitrebudgetAndIdParametragetranche($formdetail->getObject()->getId(), $par->getId());
                     
                        if ($tranche)
                            $class = "disabledbutton";
                        if (!$tranche) {
                            if ($tranche_ajout_id == '')
                                $tranche_ajout_id = $par->getId();
                            ?>
                            <tr class="<?php echo $class ?>" ng-model="tr_<?php echo $par->getId() ?>">
                                <td><?php echo $par->getLibelle() ?></td>
                                <td>
                                    <input  type="date" id="date_tran_<?php echo $par->getId() ?>" value="<?php if ($tranche) echo $tranche->getDatetranche() ?>" > </td>
                                <td>
                                    <input  ng-model="mnt_tr_<?php echo $par->getId() ?>" type="text" id="mnt_tr_<?php echo $par->getId() ?>" ng-change="CalculPourcentage(<?php echo $par->getId() ?>)" value="<?php if ($tranche) echo $tranche->getMntvaleur() ?>" ng-value="<?php if ($tranche) echo $tranche->getMntvaleur() ?>"></td>
                                <td>
                                    <input  type="text" ng-model="mnt_pour_ence_<?php echo $par->getId() ?>" ng-change="CalculMntParPourcentage(<?php echo $par->getId() ?>)" id="mnt_pour_ence_<?php echo $par->getId() ?>" value="<?php if ($tranche) echo $tranche->getMntpourcentage() ?>" ng-value="<?php if ($tranche) echo $tranche->getMntpourcentage() ?>">
                                </td>
                                <td>
                                    <input type="button" value="Répartition" href="#mys-modal_tranche" data-toggle="modal" onclick="setParam('<?php echo $par->getId() ?>')">
                                </td>
                            </tr>
                        <?php }else { ?>
                            <tr>
                                <td><?php echo $par->getLibelle() ?></td>
                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($tranche->getDatetranche())) ?></td>
                                <td style="text-align: right;"><?php echo number_format($tranche->getMntvaleur(), 3, '.', ' ') ?></td>
                                <td style="text-align: center;"><?php echo $tranche->getMntpourcentage() ?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <div id="mys-modal_tranche" class="modal fade" tabindex="-1">
                <div class="modal-dialog" style="width: 1000px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="smaller lighter blue no-margin">Encaissement des Rubriques Budgétaires</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    Montant Encaissement :
                                    <input  type="text" id="montant_encaisse_rubrique">
                                </div>
                                <div class="col-lg-2">
                                    Taux Encaissement :
                                    <input  type="text" id="taux_encaisse_rubrique">
                                </div>
                                <div class="col-lg-3">
                                    Montant Reste :
                                    <input  type="text" id="montant_encaisse_rubrique_reste">
                                </div>
                                <div class="col-lg-3">
                                    Action :<br>
                                    <input type="button" value="R. Egale / Taux" class="btn btn-sm btn-success" onclick="repartitionEgalite()">
                                    <input type="button" value="Initialiser" class="btn btn-sm btn-primary" onclick="initialiserRepartition()">
                                </div>
                            </div>
                            <input type="hidden" id="idpara_tranche" value="">
                            <br>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Ordre</th>
                                        <th>Code</th>
                                        <th>Rubrique</th>
                                        <th>Montant</th>
                                        <th>Encaissement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rubriques as $rubrique): ?>
                                        <?php include_partial('ligprotitrub/ligne_rubrique_alimentation', array('rubrique' => $rubrique)); ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal" style="margin-left: 10px;">
                                <i class="ace-icon fa fa-times"></i>
                                Fermer
                            </button>
                            <button class="btn btn-sm btn-primary pull-right" data-dismiss="modal" ng-click="AlimenterRubriques('<?php echo $formdetail->getObject()->getId() ?>')">
                                <i class="ace-icon fa fa-save"></i>
                                Valider
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="col-lg-5" ng-if="etatbudget === '2'" style="float: right; margin-top: 15px; margin-bottom: 15px;">
        <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
            <?php if ($mntglobal > 0): ?>
                <table id="list_alimentation">
                    <thead>
                        <tr>
                            <th colspan="4" style="text-align: center;">Alimentation des Comptes Bancaires/CCP</th>
                        </tr>
                        <tr>
                            <th style="width: 22%;">Date</th>
                            <th style="width: 47%;">Compte Bancaires/CCP</th>
                            <th style="width: 25%;">Montant</th>
                            <th style="width: 6%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $alimentations = AlimentationcompteTable::getInstance()->getListeByTitreForValide($formdetail->getObject()->getId(), $mntglobal); ?>
                        <?php foreach ($alimentations as $alimentation): ?>
                            <tr id="tr_alimentation_<?php echo $alimentation->getId(); ?>">
                                <td style="text-align: center;">
                                    <?php echo date('d/m/Y', strtotime($alimentation->getDate())) ?>
                                    <input type="hidden" id="alimentation_date_<?php echo $alimentation->getId(); ?>" value="<?php echo $alimentation->getDate(); ?>" />
                                </td>
                                <td><?php echo $alimentation->getCaissesbanques() ?></td>
                                <td style="text-align: right;">
                                    <?php echo number_format($alimentation->getMontant(), 3, '.', ' ') ?>
                                    <input type="hidden" id="alimentation_montant_<?php echo $alimentation->getId(); ?>" value="<?php echo $alimentation->getMontant(); ?>" />
                                </td>
                                <td style="text-align: center;">
                                    <a class="btn btn-xs btn-primary" onclick="setTranche('<?php echo $alimentation->getId(); ?>', '<?php echo $tranche_ajout_id ?>')"><i class="ace-icon fa fa-plus-circle"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php } ?>
    </div>
    <table id="budget_rubrique" name="tr_table" table_rubrique="">
        <thead>
            <tr>
                <th style="width: 5%; display: none;">N° Ordre</th>
                <th style="width: 10%">Code</th>
                <th style="width: 40%">RUBRIQUES</th>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                    <th style="width: 10%">MONTANT EXTERNE</th>
                    <th style="width: 10%">CREDITS ALLOUES</th>
                <?php } ?>
                <th style="width: 10%" ng-if="etatbudget === '1'">Action</th>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                    <th ng-if="etatbudget === '2'">Mnt. Bloqué</th>
                <?php } ?>
            </tr>
            <tr ng-if="etatbudget === '1'">
                <td style="display: none;"><?php echo $form['nordre'] ?></td>
                <td><?php echo $form['code']->render(array('ng-model' => 'code_rubrique_titre_budget', 'ng-change' => 'getCodeRubrique("#ligprotitrub_code","#rubrique")')) ?></td>
                <td><textarea id="rubrique" style="height: 32px;" ng-model="libelle_rubrique_titre_budget" ng-change="getLibelleRubrique('#rubrique', '#ligprotitrub_code')"></textarea></td>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                    <td></td>
                    <td><?php echo $form['mnt'] ?></td>
                <?php } ?>
                <?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                    <td style="text-align: center;" ng-if="etatbudget === '2'">
                        Mnt. Bloqué
                    </td>
                <?php endif; ?>
                <td style="text-align: center;" ng-if="etatbudget === '1'">
                    <input type="hidden" id="index_current" value="">
                    <input type="button" value="+" onclick="AjouterRubrique()">
                    <input type="button" value="-" onclick="initialiserRubrique()">
                </td>
            </tr>
        </thead>
        <tbody id="tbody_rubrique">
            <?php $id_current = 0; ?>
            <?php foreach ($rubriques as $rubrique): ?>
                <?php include_partial('ligprotitrub/ligne_rubrique', array('rubrique' => $rubrique)); ?>
                <?php $id_current = $rubrique->getId(); ?>
            <?php endforeach; ?>
            <?php $id_current = $id_current + 1; ?>
        </tbody>
    </table>

    <div class="row" style="padding-right: 2%; margin-top: 20px; text-align: right;">
       <input type="button" value="Enregistrer Fiche Budget" onclick="ValiderSousDetail('<?php echo $formdetail->getObject()->getId() ?>', '1')">
               
       

   
            <a href="<?php echo url_for('@titrebudjet_Prototype') ?>" type="button" class="btn btn-sm btn-primary">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Retour à la liste</span>
            </a>
       
    </div>

</fieldset>
<input type="hidden" id="compteur_rubrique" value="<?php echo $id_current; ?>">
<div id="my-modal_rubrique" name="modal_rubrique" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="smaller lighter blue no-margin">Ajouter sous rubrique budgétaire :</h3>
                <input type="hidden" id="modal_rubrique_index" value="">
            </div>
            <div class="modal-body">
                <table>
                    <tr style="display: none;">
                        <td style="width: 25%; text-align: left;"><label>N°ordre Rubrique</label></td>
                        <td style="width: 75%"><input value="" type="text" id="txt_nordre_rubrique"></td>
                    </tr>
                    <tr style="display: none;">
                        <td style="text-align: left;"><label>N°ordre</label></td>
                        <td><input type="text" id="txt_nordre"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;"><label>Code</label></td>
                        <td><input type="text" id="txt_code"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;"><label>Sous Rubrique</label></td>
                        <td><textarea id="txt_sousrubrique"></textarea></td>
                    </tr>
                    <?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                        <tr>
                            <td style="text-align: left;"><label>Crédit Alloué</label></td>
                            <td><input type="text" id="txt_montant"></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal" onclick="clearModal()" style="margin-left: 10px;">
                    <i class="ace-icon fa fa-times"></i>
                    Fermer
                </button>
                <input type="hidden" id="index_sous_current" value="">
                <button class="btn btn-sm btn-primary pull-right" data-dismiss="modal" onclick="ajouterSousRubrique()">
                    <i class="ace-icon fa fa-plus"></i>
                    Ajouter
                </button>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">
    $('#compteur_rubrique').val("<?php echo $id_current; ?>");
    $(document).ready(function () {
        $('#tbody_rubrique').sortable();
    });

    function verifMontantDisponible(new_montant, old_montant) {
        var verif = true;
        var reste = parseFloat(parseFloat($("#restemnt").val()) + parseFloat(old_montant) - parseFloat(new_montant));
        if (parseFloat(reste) < 0)
            verif = false;
        return verif;
    }

    function AjouterRubrique() {
        if ($("#ligprotitrub_code").val() != '' && $("#rubrique").val() != '') {
            if ($("#ligprotitrub_nordre").val() != '') {
                var verif_montant = true;
                var id = $("#index_current").val();
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                    verif_montant = verifMontantDisponible($("#ligprotitrub_mnt").val(), $("#credit_alloue_" + id).val());
<?php endif; ?>
                if (verif_montant) {
                    $("#code_" + id).val($("#ligprotitrub_code").val());
                    $("#rubrique_" + id).val($("#rubrique").val());
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                        $("#credit_alloue_" + id).val($("#ligprotitrub_mnt").val());
<?php endif; ?>
                    $("#ligprotitrub_code").val('');
                    $("#rubrique").val('');
                    $("#ligprotitrub_nordre").val('');
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                        $("#ligprotitrub_mnt").val('');
                        setTotalTable('');
<?php endif; ?>
                    $("#index_current").val('');
                } else {
                    var reste_mnt = parseFloat(parseFloat($("#restemnt").val()) + parseFloat($("#credit_alloue_" + id).val()));
                    bootbox.dialog({
                        message: "Veuillez vérifier le montant ! il vous reste que : " + reste_mnt + " TND !",
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
            } else {
                var trouve = 0;
                $('#tbody_rubrique input[name="code_rubrique"]').each(function () {
                    if ($('#ligprotitrub_code').val() == $(this).val()) {
                        trouve = 1;
                    }
                });
                if (trouve == 0) {
                    var verif_montant = true;
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                        verif_montant = verifMontantDisponible($("#ligprotitrub_mnt").val(), '0');
<?php endif; ?>
                    if (verif_montant) {
                        var id = parseInt($('#compteur_rubrique').val());
                        var credit_allouer = '';
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                            credit_allouer = $("#ligprotitrub_mnt").val();
<?php endif; ?>
                        $.ajax({
                            url: '<?php echo url_for('ligprotitrub/ajouterRubrique') ?>',
                            data: 'id=' + id +
                                    '&id_titre=' + '<?php echo $formdetail->getObject()->getId() ?>' +
                                    '&code=' + $('#ligprotitrub_code').val() +
                                    '&credit_alloue=' + credit_allouer +
                                    '&libelle=' + $('#rubrique').val(),
                            success: function (data) {
                                $("#tbody_rubrique").append(data);
                                id++;
                                $('#compteur_rubrique').val(id);
                                $("#ligprotitrub_code").val('');
                                $("#rubrique").val('');
                                $("#ligprotitrub_nordre").val('');
                                $('#tbody_rubrique').sortable();
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                                    $("#ligprotitrub_mnt").val('');
                                    setTotalTable('');
<?php endif; ?>
                            }
                        });
                    } else {
                        bootbox.dialog({
                            message: "Veuillez vérifier le montant ! il vous reste que : " + $("#restemnt").val() + " TND !",
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
                } else {
                    bootbox.dialog({
                        message: "Rubrique n'est pas ajoutée ! Code existe déjà !",
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
            }
        } else {
            bootbox.dialog({
                message: "Veuillez saisir le code et/ou la rubrique !",
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
    }

    function initialiserRubrique() {
        $("#ligprotitrub_nordre").val('');
        $("#ligprotitrub_code").val('');
        $("#rubrique").val('');
    }

    function setRubrique(id) {
        $("#index_current").val(id);
        $("#ligprotitrub_nordre").val($("#nordre_" + id).val());
        $("#ligprotitrub_code").val($("#code_" + id).val());
        $("#rubrique").val($("#rubrique_" + id).val());
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
            $('#ligprotitrub_mnt').val($("#credit_alloue_" + id).val());
<?php endif; ?>
//        window.scrollTo(0, 0);
        $("html, body").animate({scrollTop: 0}, "slow");
    }

    function removeRubrique(id, index) {
        debugger
        var id_tbody = $("#tr_" + id).closest('tbody').attr('id');
        // if ($('#' + id_tbody + ' > tr').length == 1) {
        //     $("#" + id_tbody).closest('table').hide();
        // }
        $("#tr_" + id).remove();
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
            setTotalTable(index);
<?php endif; ?>
    }

    function removeRubriqueBase(id, index) {
        var id_rubrique = $("#hidden_" + id).val();
        $.ajax({
            url: '<?php echo url_for('ligprotitrub/removeRubrique') ?>',
            data: 'id=' + id_rubrique + '&index=' + index,
            success: function (data) {
                removeRubrique(id);
            }
        });
    }

    function insertRubriqueUp(id_tr) {
        var id = $("#compteur_rubrique").val();
        $.ajax({
            url: '<?php echo url_for('ligprotitrub/ajouterRubrique') ?>',
            data: 'id=' + id +
                    '&id_titre=' + '<?php echo $formdetail->getObject()->getId() ?>' +
                    '&credit_alloue=' + '' +
                    '&code=' + '' +
                    '&libelle=' + '',
            success: function (data) {
                $('#tr_' + id_tr).before(data);
                id++;
                $('#compteur_rubrique').val(id);
            }
        });
    }

    function setDataRubrique(index) {
        $('#my-modal_rubrique input').attr('style', 'width: 100%;');
        $('#my-modal_rubrique textarea').attr('style', 'width: 100%;');
        $("#modal_rubrique_index").val(index);
        $("#txt_nordre_rubrique").val($("#nordre_" + index).val());
    }

    function setDataSousRubrique(index) {
        $('#my-modal_rubrique input').attr('style', 'width: 100%;');
        $('#my-modal_rubrique textarea').attr('style', 'width: 100%;');
        $("#modal_rubrique_index").val(index);
        $("#txt_nordre").val($("#nordre_" + index).val());
        $("#txt_code").val($("#code_" + index).val());
        $("#txt_sousrubrique").val($("#rubrique_" + index).val());
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
            $("#txt_montant").val($("#credit_alloue_" + index).val());
<?php endif; ?>
    }

    function clearModal() {
        $("#txt_nordre_rubrique").val('');
        $("#txt_code").val('');
        $("#txt_sousrubrique").val('');
        $("#txt_nordre").val('');
        $("#modal_rubrique_index").val('');
        $("#txt_montant").val('');
    }

    function insertSousRubriqueUp(id_tr, nordre, index) {
        var id = parseInt($('#compteur_sous_rubrique_' + index).val());
        $.ajax({
            url: '<?php echo url_for('ligprotitrub/ajouterSousRubrique') ?>',
            data: 'id=' + id +
                    '&id_titre=' + '<?php echo $formdetail->getObject()->getId() ?>' +
                    '&index=' + id_tr +
                    '&nordre=' + nordre +
                    '&code=' + '' +
                    '&montant=' + '' +
                    '&libelle=' + '',
            success: function (data) {
                $('#tr_' + id_tr).before(data);
                id++;
                $('#compteur_sous_rubrique_' + index).val(id);
            }
        });
    }

    function ajouterSousRubrique() {
        if ($("#txt_code").val() != '' && $("#txt_sousrubrique").val() != '') {
            if ($("#txt_nordre").val() != '') {
                var verif_montant = true;
                var id = $("#modal_rubrique_index").val();
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                    verif_montant = verifMontantDisponible($("#txt_montant").val(), $("#credit_alloue_" + id).val());
<?php endif; ?>
                if (verif_montant) {
                    $("#code_" + id).val($("#txt_code").val());
                    $("#rubrique_" + id).val($("#txt_sousrubrique").val());
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                        $("#credit_alloue_" + id).val($("#txt_montant").val());
                        var index = $("#credit_alloue_" + id).attr("parent_line");
                        setTotalTable(index);
<?php endif; ?>

                    $("#txt_code").val('');
                    $("#txt_sousrubrique").val('');
                    $("#txt_nordre").val('');
                    $("#modal_rubrique_index").val('');
                    $("#txt_montant").val('');
                } else {
                    var reste_mnt = parseFloat(parseFloat($("#restemnt").val()) + parseFloat($("#credit_alloue_" + id).val()));
                    bootbox.dialog({
                        message: "Veuillez vérifier le montant ! il vous reste que : " + reste_mnt + " TND !",
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
            } else {
                var trouve = 0;
                $('#tbody_rubrique input[name="code_rubrique"]').each(function () {
                    if ($('#txt_code').val() == $(this).val()) {
                        trouve = 1;
                    }
                });
                if (trouve == 0) {
                    var verif_montant = true;
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                        verif_montant = verifMontantDisponible($("#txt_montant").val(), '0');
<?php endif; ?>
                    if (verif_montant) {
                        var index_compteur = $("#modal_rubrique_index").val();
                        var id = parseInt($('#compteur_sous_rubrique_' + index_compteur).val());
                        var credit_allouer = '';
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                            credit_allouer = $("#txt_montant").val();
<?php endif; ?>
                        $.ajax({
                            url: '<?php echo url_for('ligprotitrub/ajouterSousRubrique') ?>',
                            data: 'id=' + id +
                                    '&id_titre=' + '<?php echo $formdetail->getObject()->getId() ?>' +
                                    '&index=' + index_compteur +
                                    '&nordre=' + $("#txt_nordre_rubrique").val() +
                                    '&code=' + $('#txt_code').val() +
                                    '&montant=' + credit_allouer +
                                    '&libelle=' + $('#txt_sousrubrique').val(),
                            success: function (data) {
                                $("#tbody_rubrique_" + index_compteur).append(data);
                                $("#table_" + index_compteur).show();
                                id++;
                                $('#compteur_sous_rubrique_' + index_compteur).val(id);
                                $("#txt_code").val('');
                                $("#rubrique").val('');
                                $("#txt_sousrubrique").val('');
                                $("#txt_nordre").val('');
                                $("#txt_montant").val('');
                                $("#tbody_rubrique_" + index_compteur).sortable();
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                                    setTotalTable(index_compteur);
<?php endif; ?>
                            }
                        });
                    } else {
                        bootbox.dialog({
                            message: "Veuillez vérifier le montant ! il vous reste que : " + $("#restemnt").val() + " TND !",
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
                } else {
                    bootbox.dialog({
                        message: "Rubrique n'est pas ajoutée ! Code existe déjà !",
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
                local
            }
        } else {
            bootbox.dialog({
                message: "Sous Rubrique n'est pas ajouté ! Veuillez saisir le code et/ou le sous rubrique !",
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
    }

    function setTotalTable(id) {
        if (id != '') {
            var id_tbody = "tbody_rubrique_" + id;
            var credits = 0;
            $('#' + id_tbody + ' > tr > td > input[name="credit_alloue"]').each(function () {
                if ($(this).val() != '')
                    credits = parseFloat(credits) + parseFloat($(this).val());
            });
            $("#credit_alloue_" + id).val(parseFloat(credits).toFixed(3));
            var id_parent = $("#credit_alloue_" + id).attr("parent_line");
            setTotalTable(id_parent);
        } else {
            var credits = 0;
            var id_tbody = "tbody_rubrique";
            $('#' + id_tbody + ' > tr > td > input[name="credit_alloue"]').each(function () {
                if ($(this).val() != '')
                    credits = parseFloat(credits) + parseFloat($(this).val());
            });
            var mnt = $("#mnt").val();
            var reste_mnt = parseFloat(mnt) - parseFloat(credits);
            $("#restemnt").val(parseFloat(reste_mnt).toFixed(3));
        }
    }

    initTotalTable();
    function initTotalTable() {
        var credits = 0;
        var id_tbody = "tbody_rubrique";
        $('#' + id_tbody + ' > tr > td > input[name="credit_alloue"]').each(function () {
            if ($(this).val() != '')
                credits = parseFloat(credits) + parseFloat($(this).val());
        });
        var mnt = $("#mnt").val();
        var reste_mnt = parseFloat(mnt) - parseFloat(credits);
        $("#restemnt").val(parseFloat(reste_mnt));
    }

</script>

<script  type="text/javascript">

    function ValiderSousDetail(id_titre, action) {
        var i = 1;
        $('#tbody_rubrique input[name="nordre_rubrique"]').each(function () {
            $(this).val(i);
            i++;
        });
        $('[name="tr_table"]').each(function () {
            var id_table = $(this).attr('id');
            var index_rubrique = $(this).attr('table_rubrique');
            var code_rubrique_parent = '';
            if (index_rubrique != '')
                code_rubrique_parent = $("#code_" + index_rubrique).val();
            var id_tbody = $("#" + id_table + " > tbody").attr('id');
            if ($('#' + id_tbody + ' > tr').length > 0) {
                //Enregistrement de chaque niveau des rubriques budgétaires
                var ids = '';
                $('#' + id_tbody + ' > tr > td > input[name="hidden_id"]').each(function () {
                    ids = ids + $(this).val() + ';';
                });
                var nordre_rubrique = '';
                $('#' + id_tbody + ' > tr > td > input[name="nordre_rubrique"]').each(function () {
                    nordre_rubrique = nordre_rubrique + $(this).val() + ';';
                });
                var code_rubrique = '';
                $('#' + id_tbody + ' > tr > td > input[name="code_rubrique"]').each(function () {
                    code_rubrique = code_rubrique + $(this).val() + ';';
                });
                var rubrique = '';
                $('#' + id_tbody + ' > tr > td > input[name="rubrique"]').each(function () {
                    rubrique = rubrique + $(this).val() + ';;';
                });
                var credits = '';
<?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                    $('#' + id_tbody + ' > tr > td > input[name="credit_alloue"]').each(function () {
                        credits = credits + $(this).val() + ';';
                    });
<?php endif; ?>

                $.ajax({
                    url: '<?php echo url_for('ligprotitrub/saveTableRubrique') ?>',
                    async: false,
                    data: 'id_titre=' + id_titre +
                            '&ids=' + ids +
                            '&nordre_rubrique=' + nordre_rubrique +
                            '&code_rubrique=' + code_rubrique +
                            '&rubrique=' + rubrique +
                            '&credits=' + credits +
                            '&code_rubrique_parent=' + code_rubrique_parent,
                    success: function (data) {
                        //rien à faire.
                    }
                });
            }
        });
        $.ajax({
            url: '<?php echo url_for('ligprotitrub/setValideBudget') ?>',
            data: 'id_titre=' + id_titre +
                    '&etatbudget=' + action,
            success: function (data) {
                location.reload();
            }
        });
    }

</script>

<script  type="text/javascript">

    function setTranche(alimentation_id, tranche_id) {
        $('#list_alimentation tbody tr').each(function () {
            $(this).css('background', '');
        });
        $('#tr_alimentation_' + alimentation_id).css('background-color', '#E2F9EF');
        $('#date_tran_' + tranche_id).val($('#alimentation_date_' + alimentation_id).val());
        $('#mnt_tr_' + tranche_id).val($('#alimentation_montant_' + alimentation_id).val());
        var pourcent_tranche = parseFloat($('#alimentation_montant_' + alimentation_id).val()) / parseFloat($('#chaine_idp').val()) * 100;
        $('#mnt_pour_ence_' + tranche_id).val(parseFloat(pourcent_tranche).toFixed(2));
        $('#alimentation_tranche').val(alimentation_id);
        //Répartition
        $("#montant_encaisse_rubrique").val($('#alimentation_montant_' + alimentation_id).val());
        $("#montant_encaisse_rubrique_reste").val($('#alimentation_montant_' + alimentation_id).val());
        $("#taux_encaisse_rubrique").val(parseFloat(pourcent_tranche).toFixed(2));
    }

    function setParam(id_param) {
        $("#idpara_tranche").val(id_param);
        initialiserRepartition();
    }

    function initialiserRepartition() {
        $('input[nature="montant"]').each(function () {
            $(this).val('');
        });
        $("#montant_encaisse_rubrique_reste").val($('#montant_encaisse_rubrique').val());
    }

    function repartitionEgalite() {
        var pourcent_tranche = $("#taux_encaisse_rubrique").val();
        $('input[nature="montant"]').each(function () {
            var montant = $("#hidden_" + $(this).attr('id')).val();
            montant = parseFloat(montant) * parseFloat(pourcent_tranche) / 100;
            $(this).val(parseFloat(montant).toFixed(3));
        });
        calculerResteEncaissement();
    }

    function calculerSousRubriqueTotal(id_rubrique) {
        var montant = 0;
        var trouve = 0;
        $('input[rubrique_montant="' + id_rubrique + '"]').each(function () {
            trouve = 1;
            calculerSousRubriqueTotal($(this).attr('id_rubrique'));
            if ($(this).val() != '')
                montant = parseFloat(montant) + parseFloat($(this).val());
        });
        if (trouve == 1)
            $("#encaissement_mnt_" + id_rubrique).val(parseFloat(montant).toFixed(3));
    }

    function calculerRubriqueTotal() {
        $('input[ligne_rubrique="rubrique"]').each(function () {
            var id_rubrique = $(this).attr('id_rubrique');
            var montant = 0;
            var trouve = 0;
            $('input[rubrique_montant="' + id_rubrique + '"]').each(function () {
                trouve = 1;
                calculerSousRubriqueTotal($(this).attr('id_rubrique'));
                if ($(this).val() != '')
                    montant = parseFloat(montant) + parseFloat($(this).val());
            });
//            if (montant != 0)
            if (trouve == 1)
                $("#encaissement_mnt_" + id_rubrique).val(parseFloat(montant).toFixed(3));
//            else
//                $("#encaissement_mnt_" + id_rubrique).val('');
        });
        calculerResteEncaissement();
    }

    function setArrondissement() {
        $('input[nature="montant"]').each(function () {
            if ($(this).val() != '') {
                if (parseFloat($(this).val()) <= parseFloat($("#hidden_" + $(this).attr('id')).val())) {
                    $(this).val(parseFloat($(this).val()).toFixed(3));
                } else {
                    $(this).val('');
                    calculerRubriqueTotal();
                }
            }
        });
    }

    function calculerResteEncaissement() {
        var montant_rubrique = 0;
        $('input[ligne_rubrique="rubrique"]').each(function () {
            if ($(this).val() != '')
                montant_rubrique = parseFloat(montant_rubrique) + parseFloat($(this).val());
        });
        var montant = $("#montant_encaisse_rubrique").val();
        var reste = parseFloat(montant) - parseFloat(montant_rubrique);
        $("#montant_encaisse_rubrique_reste").val(parseFloat(reste).toFixed(3));
    }

</script>

<style>

    input[nature="montant"]{color: #007bb6;text-align: right;}
    input[nature="montant"]:focus{color: #007bb6;}
    table{margin-bottom: 0px!important;}

</style>