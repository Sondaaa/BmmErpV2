<?php

$id = $sous_rubrique->getId();
$nordre = trim($sous_rubrique->getNordre());
$code = trim($sous_rubrique->getCode());
$libelle = trim($sous_rubrique->getRubrique()->getLibelle());
?>
<tr id="tr_<?php echo $index . '_' . $id; ?>" name="tr_rubrique">
    <td style=" text-align:center; display: none;">
        <input readonly="true" style="width:100%;" type="text" nordre_rubrique="<?php echo $index . '_' . $id; ?>" name="nordre_rubrique" id="nordre_<?php echo $index . '_' . $id; ?>" value="<?php echo $nordre . $id; ?>" />
        <input type="hidden" name="hidden_id" id="hidden_<?php echo $index . '_' . $id; ?>" value="<?php echo $id; ?>">
    </td>
    <td style=" text-align:center;">
        <input readonly="true" style="width:100%;" type="text" code_rubrique="<?php echo $index . '_' . $id; ?>" name="code_rubrique" id="code_<?php echo $index . '_' . $id; ?>" value="<?php echo $code; ?>" />
    </td>
    <td style="">
        <input readonly="true" style="width:100%;" type="text" rubrique="<?php echo $index . '_' . $id; ?>" name="rubrique" id="rubrique_<?php echo $index . '_' . $id; ?>" value="<?php echo $libelle; ?>" />
        <?php 
        if(isset($tranche))
        $sous_rubriques = LigprotitrubTable::getInstance()->getSousRubrique($sous_rubrique->getIdRubrique(), $sous_rubrique->getIdTitre(),$tranche->getId());
        else
        $sous_rubriques = LigprotitrubTable::getInstance()->getSousRubrique($sous_rubrique->getIdRubrique(), $sous_rubrique->getIdTitre());
        ?>
        <table id="table_<?php echo $index . '_' . $id; ?>" table_rubrique="<?php echo $index . '_' . $id; ?>" name="tr_table" <?php if ($sous_rubriques->count() == 0): ?>style="display: none;"<?php endif; ?>>
            <thead>
                <tr>
                    <th style=" text-align:center; display: none;">N° Ordre</th>
                    <th style=" text-align:center;">Code</th>
                    <th style="">Sous Rubrique</th>
                    <?php if (trim($sous_rubrique->getTitrebudjet()->getTypebudget()) != 'Prototype'): ?>
                        
                        <th style="">CREDITS ALLOUES</th>
                    <?php endif; ?>
                    <?php if ($sous_rubrique->getTitrebudjet()->getEtatbudget() == 2): ?>
                        <?php if (trim($sous_rubrique->getTitrebudjet()->getTypebudget()) != "Prototype"): ?>
                            <th style="">Mnt. Bloqué</th>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if ($sous_rubrique->getTitrebudjet()->getEtatbudget() == 1): ?>
                            <th style="text-align: center;">Action</th>
                        <?php endif; ?>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody id="tbody_rubrique_<?php echo $index . '_' . $id; ?>">
                <?php foreach ($sous_rubriques as $s_rubrique): ?>
                    <?php include_partial('ligprotitrub/ligne_sous_rubrique', array('tranche'=>$tranche,'sous_rubrique' => $s_rubrique, 'index' => $index . '_' . $id)); ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <input type="hidden" id="compteur_sous_rubrique_<?php echo $index . '_' . $id; ?>" value="<?php echo $sous_rubriques->count() + 1; ?>">
    </td>
    <?php if (trim($sous_rubrique->getTitrebudjet()->getTypebudget()) != 'Prototype'): ?>
        <!-- <td style="width: 8%; text-align: right;"></td>     -->
        <td style="width: 12%; text-align: right;">
            <input type="text" class="align_right" name="credit_alloue" parent_line="<?php echo $index; ?>" id="credit_alloue_<?php echo $index . '_' . $id; ?>" value="<?php echo number_format($sous_rubrique->getMnt(), 3, '.', '') ?>" readonly="true" style="max-width: 130px; width: 100%;">
        </td>
    <?php endif; ?>
   
        <?php if (trim($sous_rubrique->getTitrebudjet()->getTypebudget()) != "Prototype"): ?>
            <?php if ($tranche->getEtattranche()): ?>
            <td style="width: 8%;" class="">
                <input type="text" id="mntencai_ligne_<?php echo $index . '_' . $id; ?>" value="<?php echo number_format($sous_rubrique->getMntexterne() + $sous_rubrique->getMntencaisse(), 3, '.', '') ?>">
            </td>
            <?php else: ?>
        
        <td style="text-align: center; width: 13%">
            <span class="btn btn-warning btn-xs" name="btn_sous_rubrique" href="#my-modal_rubrique" data-toggle="modal" onclick="setDataRubrique('<?php echo $index . '_' . $id; ?>')" ><i class="ace-icon fa bigger-110 icon-only">+ SS. RUB.</i></span>
            <span class="btn btn-primary btn-xs" name="btn_edit_rubrique" href="#my-modal_rubrique" data-toggle="modal" onclick="setDataSousRubrique('<?php echo $index . '_' . $id; ?>')" ><i class="ace-icon fa fa-wrench bigger-110 icon-only"></i></span>
            <span class="btn btn-inverse btn-xs" name="btn_add_rubrique" onclick="insertSousRubriqueUp('<?php echo $index . '_' . $id; ?>', '<?php echo $nordre ?>', '<?php echo $index; ?>')" ><i class="ace-icon fa fa-arrow-up bigger-110 icon-only"></i></span>
            <span class="btn btn-xs btn-danger btn-xs" name="btn_remove_rubrique" onclick="removeRubriqueBase('<?php echo $index . '_' . $id; ?>', '<?php echo $index; ?>')"><i class="ace-icon fa fa-remove bigger-110 icon-only"></i></span>
        </td>
   
<?php endif; ?>
        <?php endif; ?>
   
</tr>

<script  type="text/javascript">
    $("table").addClass("table table-bordered table-hover");
    $(document).ready(function () {
        $('#tbody_rubrique_<?php echo $index . '_' . $id; ?>').sortable();
    });
</script>