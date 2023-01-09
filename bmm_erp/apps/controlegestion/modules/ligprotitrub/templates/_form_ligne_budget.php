<fieldset>
    <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
        <table class="disabledbutton">
            <tr>
                <td>
                    <label>Montant global du budget</label>
                    <input type="text" id="mnt" value="<?php echo $formdetail->getObject()->getMntglobal() ?>">
                </td>
                <td>
                    <label>Montant Transfert en TND</label>
                    <input type="text" id="mnt_externe" value="<?php echo $formdetail->getObject()->getMntexterne() ?>">
                </td>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel Global" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel / Direction & Projet"): ?>
                    <td>
                        <label>Reste du Montant</label>
                        <input type="text" id="restemnt" value="">
                    </td>
                <?php else: ?>

                <?php endif; ?>
            </tr>
        </table>
    <?php } ?>
    <div class="col-lg-7" ng-if="etatbudget === '2'" style="float: left; margin-top: 15px; margin-bottom: 15px;">
        <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel Global" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel / Direction & Projet") { ?>
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
                            <input class="disabledbutton" type="text" id="chaine_idp" value="<?php echo $mntglobal ?>">
                            <input type="hidden" id="alimentation_tranche" value="">
                        </td>
                    </tr>
                    <tr>
                        <th>Nom du Tranche</th>
                        <th>Date</th>
                        <th>Mnt.</th>
                        <th>Pourcentage %</th>
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
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php }else { ?>
                            <tr>
                                <td><?php echo $par->getLibelle() ?></td>
                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($tranche->getDatetranche())) ?></td>
                                <td style="text-align: right;"><?php echo number_format($tranche->getMntvaleur(), 3, '.', ' ') ?></td>
                                <td style="text-align: center;"><?php echo $tranche->getMntpourcentage() ?></td>
                            </tr>
                        <?php } ?>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php } ?>
    </div>

    <table id="budget_rubrique" name="tr_table" table_rubrique="">
        <thead>
            <tr>
                <th style="width: 5%; display: none;">N° Ordre</th>
                <th style="width: 8%">Code</th>
                <th style="width: 52%">RUBRIQUES</th>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                    <?php if (trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel Global" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel / Direction & Projet"): ?>
                        <th style="width: 10%">MONTANT EXTERNE</th>
                    <?php endif; ?>
                    <th style="width: 10%">CREDITS ALLOUES</th>
                <?php } ?>
                <?php if ($formdetail->getObject()->getEtatbudget() == 3 && (trim($formdetail->getObject()->getTypebudget()) == "Budget Prévisionnel Global" || trim($formdetail->getObject()->getTypebudget()) == "Budget Prévisionnel / Direction & Projet")): ?>
                    <th style="width: 10%">Action</th>
                <?php endif; ?>
                <th style="width: 10%" ng-if="etatbudget === '1'">Action</th>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                    <th ng-if="etatbudget === '2'">Mnt. Bloqué</th>
                    <th ng-if="etatbudget === '2'">Action</th>
                <?php } ?>
            </tr>
            <tr ng-if="etatbudget === '1'">
                <td style="display: none;"><?php echo $form['nordre'] ?></td>
                <td><?php echo $form['code']->render(array('ng-model' => 'code_rubrique_titre_budget', 'ng-change' => 'getCodeRubrique("#ligprotitrub_code","#rubrique")')) ?></td>
                <td><textarea id="rubrique" style="height: 32px;" ng-model="libelle_rubrique_titre_budget" ng-change="getLibelleRubrique('#rubrique', '#ligprotitrub_code')"></textarea></td>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                    <?php if (trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel Global" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel / Direction & Projet"): ?>
                        <td></td>
                    <?php endif; ?>
                    <td><?php echo $form['mnt'] ?></td>
                <?php } ?>
                <?php if (trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>
                    <td style="text-align: center;" ng-if="etatbudget === '2'">
                        Mnt. Bloqué
                    </td>
                    <td style="text-align: center;" ng-if="etatbudget === '2'">Action</td>
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
            <?php $rubriques = LigprotitrubTable::getInstance()->getFirstParentByTitre($formdetail->getObject()->getId()); ?>
            <?php foreach ($rubriques as $rubrique): ?>
                <?php include_partial('ligprotitrub/ligne_rubrique', array('rubrique' => $rubrique)); ?>
                <?php $id_current = $rubrique->getId(); ?>
            <?php endforeach; ?>
            <?php $id_current = $id_current + 1; ?>
        </tbody>
    </table>

    <div ng-if="etatbudget === '1' && budgets.length > 0" class="row" style="padding-right: 2%; margin-top: 20px; text-align: right;">
        <input type="button" value="Enregistrer Budget" onclick="ValiderSousDetail(<?php echo $formdetail->getObject()->getId() ?>, 1)">
        <?php if (!(strpos(trim($typebudget), "Direction") === false) || !(strpos(trim($typebudget), "Global") === false)): ?>
            <input type="button" value="Valider budget" onclick="ValiderSousDetail(<?php echo $formdetail->getObject()->getId() ?>, 2)">
        <?php endif; ?>
    </div>
    <div ng-if="etatbudget === '3'" class="row" style="padding-right: 2%; margin-top: 20px; text-align: right;">
        <input type="button" ng-if="budgets.length > 0" value="Valider Budget" onclick="ValiderSousDetail(<?php echo $formdetail->getObject()->getId() ?>, 2)">
    </div>
    <div ng-if="etatbudget === '2'" class="row" style="padding-right: 2%; margin-top: 20px; text-align: right;">
        <?php if (strpos(trim($typebudget), "Direction") === false && strpos(trim($typebudget), "Global") === false): ?>
            <a href="<?php echo url_for('titrebudjet/index?type=Final') ?>" type="button" class="btn btn-white btn-primary">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Retour à la liste</span>
            </a>
        <?php elseif (strpos(trim($typebudget), "Direction") !== false): ?>
            <a href="<?php echo url_for('titrebudjet/index?type=Budget Prévisionnel') ?>" class="btn btn-white btn-primary">
                <i class="ace-icon fa fa-undo bigger-110"></i> 
                Retour à la Liste
            </a>
        <?php else: ?>
            <a href="<?php echo url_for('budgetprevglobal/index?type=Budget Prévisionnel Global') ?>" class="btn btn-white btn-primary">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Retour à la Liste
            </a>
        <?php endif; ?>
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
        // console.log('OK');
        if ($("#ligprotitrub_code").val() != '' && $("#rubrique").val() != '') {
            //  console.log('OK1');
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
            console.log('else1');
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
        var id_tbody = $("#tr_" + id).closest('tbody').attr('id');
        if ($('#' + id_tbody + ' > tr').length == 1) {
            $("#" + id_tbody).closest('table').hide();
        }
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
            initTotalTable();
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
<?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel Global" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel / Direction & Projet"): ?>
            var mnt = $("#mnt").val();
            var reste_mnt = parseFloat(mnt) - parseFloat(credits);
            $("#restemnt").val(parseFloat(reste_mnt).toFixed(3));
<?php else: ?>
            $("#mnt").val(parseFloat(credits).toFixed(3));
            $("#titrebudjet_mntglobal").val(parseFloat(credits).toFixed(3));
            $("#titrebudjet_mntglobal").addClass("disabledbutton");
<?php endif; ?>
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
                var data = {
                id_titre: id_titre,
                ids:ids,
                nordre_rubrique: nordre_rubrique,
                code_rubrique: code_rubrique,
                rubrique:rubrique,
                credits: credits,
                code_rubrique_parent:code_rubrique_parent
            };

                $.ajax({
                    url: '<?php echo url_for('ligprotitrub/saveTableRubrique') ?>',
                    async: false,
                    contentType: "html",
                    data: JSON.stringify(data),
                    type: 'POST',
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
    var dialog = null;
    function setTableAnnexe(id, id_parent) {
        $.ajax({
            url: '<?php echo url_for('ligprotitrub/editTableAnnexe') ?>',
            data: 'id=' + id,
            success: function (data) {
                dialog = bootbox.confirm({
                    message: data,
                    buttons: {
                        cancel: {
                            label: "Annuler",
                            className: "btn-danger btn-sm",
                        },
                        confirm: {
                            label: "Valider",
                            className: "btn-primary btn-sm",
                        }
                    },
                    callback: function (result) {
                        if (result) {
                            saveTableAnnexe(id, id_parent);
                            return false;
                        }
                    }
                });
            }
        });
    }

    function saveTableAnnexe(id, id_parent) {
        //Delete Olds Annexes Rubriques
        $.ajax({
            url: '<?php echo url_for('annexebudget/deleteAnnexeRubrique') ?>',
            data: 'id=' + id,
            success: function (data) {
                saveAllTableAnnexe(id, id_parent);
            }
        });
    }

    function saveAllTableAnnexe(id, id_parent) {
        var montant = $("#total_type_annexe_rubrique").val();
        var count_annexe = 0;
        $('[name="annexe_rubrique"]').each(function () {
            count_annexe++;
        });
        var count_annexe_execute = 0;
        $('[name="annexe_rubrique"]').each(function () {
            var id_annexe = $(this).val();
            var total = '';
            $('[name="total_type_annexe"]').each(function () {
                if ($(this).attr("annexe_id") == id_annexe)
                    total = $(this).val();
            });
            if (total != "") {
                if (id_annexe != "1") {
                    //save tout tableau différent du tableau des salaires
                    var description = $("#annexe_description_type_" + id_annexe).val();
                    description = description.replace(/\s\s+/g, '~');
                    description = description.replace(/&nbsp;/g, '');
                    var contenu = $("#for_save_annexe_" + id_annexe).html();
                    contenu = contenu.replace(/\s\s+/g, '~');
                    contenu = contenu.replace(/&nbsp;/g, '');
                    //var encoded = encodeURIComponent(contenu);

                    $.ajax({
                        url: '<?php echo url_for('annexebudget/saveAnnexeRubrique') ?>',
                        data: 'id=' + id +
                                '&id_annexe=' + id_annexe +
                                '&description=' + description +
                                '&contenu=' + contenu +
                                '&total=' + total,
                        success: function (data) {
                            count_annexe_execute++;
                            if (count_annexe == count_annexe_execute) {
                                setCreditRubrique(id, id_parent, montant);
                                dialog.modal('hide');
                            }
                        }
                    });
                } else {
                    //Save tableau des salaires
                    //Begin : Extract data value from tbody

                    //Clear style from input
                    $('#for_save_annexe_' + id_annexe + ' input:text').not('[id="total_type_annexe_rubrique"]').attr('style', '');
                    var count_td = $("#count_td_data_table").val();
                    var value_td_table = [];

                    var value_td = '';
                    for (var i = 0; i < 9; i++) {
                        $("#tbody_table_showing tr").each(function () {
                            $(this).children("td:eq(" + i + ")").each(function () {
                                value_td = value_td + $(this).html() + ';';
                            });
                        });
                        value_td = value_td + "¤";
                    }

                    value_td_table.push(value_td);

                    var value_td = '';
                    for (var i = 9; i < 18; i++) {
                        $("#tbody_table_showing tr").each(function () {
                            $(this).children("td:eq(" + i + ")").each(function () {
                                value_td = value_td + $(this).html() + ';';
                            });
                        });
                        value_td = value_td + "¤";
                    }

                    value_td_table.push(value_td);

                    var value_td = '';
                    for (var i = 18; i < 24; i++) {
                        $("#tbody_table_showing tr").each(function () {
                            $(this).children("td:eq(" + i + ")").each(function () {
                                value_td = value_td + $(this).html() + ';';
                            });
                        });
                        value_td = value_td + "¤";
                    }

                    value_td_table.push(value_td);

                    var value_td = '';
                    for (var i = 24; i < count_td; i++) {
                        $("#tbody_table_showing tr").each(function () {
                            $(this).children("td:eq(" + i + ")").each(function () {
                                value_td = value_td + $(this).html() + ';';
                            });
                        });
                        value_td = value_td + "¤";
                    }

                    value_td_table.push(value_td);

                    var count_save_data_table = value_td_table.length;

                    $("#tbody_table_showing").html('');
                    //End : Extract data value from tbody

                    //Clear thead
                    $("#table_data_salaires > thead").html('');
                    $("#results_salaires > tbody > tr > td").each(function () {
                        var td_html = $(this).html();
                        td_html = td_html.replace(/\#/g, "§§");
                        td_html = td_html.replace(/\+/gi, "§");
                        $(this).html(td_html);
                    });
                    $("#results_salaires > tfoot > tr > td").each(function () {
                        var td_html = $(this).html();
                        td_html = td_html.replace(/\#/g, "§§");
                        td_html = td_html.replace(/\+/gi, "§");
                        $(this).html(td_html);
                    });
                    var results = $("#result_for_save_annexe_" + id_annexe).html();
                    results = results.replace(/\#/g, '§§');
                    results = results.replace(/\s\s+/g, '~');
                    results = results.replace(/&nbsp;/g, '');
                    //Clear result div
                    $("#result_for_save_annexe_" + id_annexe).html('');

                    var description = $("#annexe_description_type_" + id_annexe).val();
                    description = description.replace(/\s\s+/g, '~');
                    description = description.replace(/&nbsp;/g, '');

                    var contenu = $("#for_save_annexe_" + id_annexe).html();
                    contenu = contenu.replace(/\s\s+/g, '~');
                    contenu = contenu.replace(/&nbsp;/g, '');

                    //var encoded = encodeURIComponent(contenu);

                    $.ajax({
                        url: '<?php echo url_for('annexebudget/saveAnnexeRubrique') ?>',
                        data: 'id=' + id +
                                '&id_annexe=' + id_annexe +
                                '&description=' + description +
                                '&contenu=' + contenu +
                                '&total=' + total,
                        success: function (data) {
                            var id_annexebudget = data;
                            $.ajax({
                                url: '<?php echo url_for('annexebudget/saveResultAnnexeRubrique') ?>',
                                data: 'id=' + id_annexebudget +
                                        '&results=' + results,
                                success: function (data) {
                                    for (var m = 0; m < count_save_data_table; m++) {
                                        $.ajax({
                                            url: '<?php echo url_for('annexebudget/saveDataAnnexeRubrique') ?>',
                                            async: false,
                                            data: 'id=' + id_annexebudget +
                                                    '&m=' + m +
                                                    '&value_td=' + value_td_table[m],
//                                                    '&value_td=' + value_td,
                                            success: function (data) {
                                                if (m == 3) {
                                                    count_annexe_execute++;
                                                    if (count_annexe == count_annexe_execute) {
                                                        setCreditRubrique(id, id_parent, montant);
                                                        dialog.modal('hide');
                                                    }
                                                }
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    });
                }
            } else {
                count_annexe_execute++;
                if (count_annexe == count_annexe_execute) {
                    setCreditRubrique(id, id_parent, montant);
                    dialog.modal('hide');
                }
            }
        });
    }

    function setCreditRubrique(id, id_parent, montant) {
        $.ajax({
            url: '<?php echo url_for('annexebudget/saveMontantRubrique') ?>',
            data: 'id=' + id +
                    '&montant=' + montant,
            success: function (data) {
                var credit_alloue = '';
                if (id_parent != '') {
                    credit_alloue = "#credit_alloue_" + id_parent + "_" + id;
                } else {
                    credit_alloue = "#credit_alloue_" + id;
                }
                $(credit_alloue).val(montant);
                setTotalTable(id_parent);
            }
        });
    }

</script>

<style>

    table{margin-bottom: 0px!important;}

</style>