<?php $titre = TitrebudjetTable::getInstance()->find($id_titre); ?>
<tr id="tr_<?php echo $index . '_' . $id; ?>" name="tr_rubrique">
    <td style="width: 6%; text-align:center; display: none;">
        <input readonly="true" style="width:100%;" type="text" nordre_rubrique="<?php echo $index . '_' . $id; ?>" name="nordre_rubrique" id="nordre_<?php echo $index . '_' . $id; ?>" value="<?php echo $nordre . $id; ?>" />
        <input type="hidden" name="hidden_id" id="hidden_<?php echo $index . '_' . $id; ?>" value="">
    </td>
    <td style="width: 6%; text-align:center;">
        <input readonly="true" style="width:100%;" type="text" code_rubrique="<?php echo $index . '_' . $id; ?>" name="code_rubrique" id="code_<?php echo $index . '_' . $id; ?>" value="<?php echo $code; ?>" />
    </td>
    <td style="width: 75%;">
        <input readonly="true" style="width:100%;" type="text" rubrique="<?php echo $index . '_' . $id; ?>" name="rubrique" id="rubrique_<?php echo $index . '_' . $id; ?>" value="<?php echo $libelle; ?>" />
        <table id="table_<?php echo $index . '_' . $id; ?>" table_rubrique="<?php echo $index . '_' . $id; ?>" name="tr_table" style="display: none;">
            <thead>
                <tr>
                    <th style="width: 5%; text-align:center; display: none;">N° Ordre</th>
                    <th style="width: 5%; text-align:center;">Code</th>
                    <th style="width: 71%;">Sous Rubrique</th>
                    <?php if (trim($titre->getTypebudget()) != 'Prototype'): ?>
                        <?php if (trim($titre->getTypebudget()) != "Budget Prévisionnel Global" && trim($titre->getTypebudget()) != "Budget Prévisionnel / Direction & Projet"): ?>
                            <th style="width: 10%">MONTANT TRANSFERT</th>
                        <?php endif; ?>
                        <th style="width: 10%">CREDITS ALLOUES</th>
                    <?php endif; ?>
                    <?php if ($titre->getEtatbudget() == 2): ?>
                        <th style="width: 10%">Mnt. Bloqué</th>
                    <?php else: ?>
                        <th style="text-align: center; width: 19%">Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody id="tbody_rubrique_<?php echo $index . '_' . $id; ?>">

            </tbody>
        </table>
        <input type="hidden" id="compteur_sous_rubrique_<?php echo $index . '_' . $id; ?>" value="1">
    </td>
    <?php if (trim($titre->getTypebudget()) != 'Prototype'): ?>
        <?php if (trim($titre->getTypebudget()) != "Budget Prévisionnel Global" && trim($titre->getTypebudget()) != "Budget Prévisionnel / Direction & Projet"): ?>
            <td style="width: 8%; text-align: right;"></td>
        <?php endif; ?>
        <td style="width: 12%; text-align: right;">
            <input type="text" class="align_right" readonly="true" name="credit_alloue" parent_line="<?php echo $index; ?>" id="credit_alloue_<?php echo $index . '_' . $id; ?>" value="<?php echo number_format($montant, 3, '.', ''); ?>" style="max-width: 130px; width: 100%;">
        </td>
    <?php endif; ?>
    <?php if ($titre->getEtatbudget() == 2): ?>
        <td style="width: 8%;" class="disabledbutton">
            <input type="text" id="mntencai_ligne_<?php echo $index . '_' . $id; ?>" value="">
        </td>
    <?php else: ?>
        <td style="text-align: center; width: 13%">
            <span class="btn btn-warning btn-xs" name="btn_sous_rubrique" href="#my-modal_rubrique" data-toggle="modal" onclick="setDataRubrique('<?php echo $index . '_' . $id; ?>')" style="margin-bottom: 5px;"><i class="ace-icon fa bigger-110 icon-only">+ SS. RUB.</i></span>
            <span class="btn btn-primary btn-xs" name="btn_edit_rubrique" href="#my-modal_rubrique" data-toggle="modal" onclick="setDataSousRubrique('<?php echo $index . '_' . $id; ?>')" style="margin-bottom: 5px;"><i class="ace-icon fa fa-wrench bigger-110 icon-only"></i></span>
            <span class="btn btn-inverse btn-xs" name="btn_add_rubrique" onclick="insertSousRubriqueUp('<?php echo $index . '_' . $id; ?>', '<?php echo $nordre ?>', '<?php echo $index; ?>')" style="margin-bottom: 5px;"><i class="ace-icon fa fa-arrow-up bigger-110 icon-only"></i></span>
            <span class="btn btn-danger btn-xs" name="btn_remove_rubrique" onclick="removeRubrique('<?php echo $index . '_' . $id; ?>', '<?php echo $index; ?>')"><i class="ace-icon fa fa-remove bigger-110 icon-only"></i></span>
        </td>
    <?php endif; ?>
</tr>

<script  type="text/javascript">
    $("table").addClass("table table-bordered table-hover");
</script>