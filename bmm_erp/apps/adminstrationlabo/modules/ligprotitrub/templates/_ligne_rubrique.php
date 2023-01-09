<?php
$id = $rubrique->getId();
$code = trim($rubrique->getCode());
$libelle = trim($rubrique->getRubrique()->getLibelle());
?>
<tr id="tr_<?php echo $id; ?>" name="tr_rubrique">
    <td style=" text-align:center; display: none;">
        <input readonly="true" style="width:100%;" type="text" nordre_rubrique="<?php echo $id; ?>" name="nordre_rubrique" id="nordre_<?php echo $id; ?>" value="<?php echo $id; ?>" autocomplete="off" />
        <input type="hidden" name="hidden_id" id="hidden_<?php echo $id; ?>" value="<?php echo $id; ?>">
    </td>
    <td style=" text-align:center;">
        <input readonly="true" style="width:100%;" type="text" code_rubrique="<?php echo $id; ?>" name="code_rubrique" id="code_<?php echo $id; ?>" value="<?php echo $code; ?>" autocomplete="off" />
    </td>
    <td style="">
        <input readonly="true" style="width:100%;" type="text" rubrique="<?php echo $id; ?>" name="rubrique" id="rubrique_<?php echo $id; ?>" value="<?php echo $libelle; ?>" autocomplete="off" />
        <?php 
        if(isset($tranche))
        $sous_rubriques = LigprotitrubTable::getInstance()->getSousRubrique($rubrique->getIdRubrique(), $rubrique->getIdTitre(),$tranche->getId()); 
        else
        $sous_rubriques = LigprotitrubTable::getInstance()->getSousRubrique($rubrique->getIdRubrique(), $rubrique->getIdTitre(),null); 
        ?>
        <table id="table_<?php echo $id; ?>" table_rubrique="<?php echo $id; ?>" name="tr_table" <?php if ($sous_rubriques->count() == 0): ?>style="display: none;"<?php endif; ?>>
            <thead>
                <tr>
                    <th style="width: 5%; text-align:center; display: none;">N° Ordre</th>
                    <th style="width: 25%; text-align:center;">Code</th>
                    <th style="width: 31%;">Sous Rubrique</th>
                    <?php if (trim($rubrique->getTitrebudjet()->getTypebudget()) != 'Prototype'): ?>
                        
                        <th style="width: 15%">CREDITS ALLOUES</th>
                    <?php endif; ?>
                   
                        <?php if (trim($rubrique->getTitrebudjet()->getTypebudget()) != "Prototype"): ?>
                            <?php if ($tranche->getEtattranche()): ?>
                            <th style="width: 15%">Mnt. Bloqué</th>
                            <?php else: ?>
                       
                       <th style="text-align: center; width: 25%">Action</th>
                        <?php endif; ?>
                   
                        
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody id="tbody_rubrique_<?php echo $id; ?>">
                <?php  foreach ($sous_rubriques as $sous_rubrique): ?>
                    <?php 
                        if(isset($tranche)){
                           //die('ss');
                            include_partial('ligprotitrub/ligne_sous_rubrique', array('tranche'=>$tranche,'sous_rubrique' => $sous_rubrique, 'index' => $id));
                        }
                        else
                        include_partial('ligprotitrub/ligne_sous_rubrique', array('sous_rubrique' => $sous_rubrique, 'index' => $id));
                         ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <input type="hidden" id="compteur_sous_rubrique_<?php echo $id; ?>" value="<?php echo $sous_rubriques->count() + 1; ?>">
    </td>
    <?php if (trim($rubrique->getTitrebudjet()->getTypebudget()) != 'Prototype'): ?>
        
        <td style="width: 12%; text-align: right;">
            <input type="text" class="align_right" name="credit_alloue" parent_line="" id="credit_alloue_<?php echo $id; ?>" value="<?php echo number_format($rubrique->getMnt(), 3, '.', '') ?>" readonly="true" style="max-width: 130px; width: 100%;">
        </td>
    <?php endif; ?>
    <?php if ($rubrique->getTitrebudjet()->getEtatbudget() == 2): ?>
        <?php if (trim($rubrique->getTitrebudjet()->getTypebudget()) != "Prototype"): ?>
            <td style="width: 8%;" class="disabledbutton">
                <input type="text" id="mntencai_ligne_<?php echo $id; ?>" value="<?php echo number_format($rubrique->getMntexterne() + $rubrique->getMntencaisse(), 3, '.', '') ?>">
            </td>
        <?php endif; ?>
    <?php else: ?>
        <?php if ($rubrique->getTitrebudjet()->getEtatbudget() == 1): ?>
            <?php if (trim($rubrique->getTitrebudjet()->getTypebudget()) != "Prototype"): ?>
            <td style="width: 8%;" class="disabledbutton">
                <input type="text" id="mntencai_ligne_<?php echo $id; ?>" value="<?php echo number_format($rubrique->getMntexterne() + $rubrique->getMntencaisse(), 3, '.', '') ?>">
            </td>
            <?php endif;?>
            <td style="text-align: center; width:10%">
                <span class="btn btn-warning btn-xs" name="btn_sous_rubrique" href="#my-modal_rubrique" data-toggle="modal" onclick="setDataRubrique('<?php echo $id; ?>')" ><i class="ace-icon fa bigger-110 icon-only">+ SS. RUB.</i></span>
                <span class="btn btn-primary btn-xs" name="btn_edit_rubrique" onclick="setRubrique('<?php echo $id; ?>','<?php if($tranche) echo $tranche->getId() ?>')" ><i class="ace-icon fa fa-wrench bigger-110 icon-only"></i></span>
                <span class="btn btn-inverse btn-xs" name="btn_add_rubrique" onclick="insertRubriqueUp('<?php echo $id; ?>')" ><i class="ace-icon fa fa-arrow-up bigger-110 icon-only"></i></span>
                <span class="btn btn-xs btn-danger btn-xs" name="btn_remove_rubrique" onclick="removeRubriqueBase('<?php echo $id; ?>', '')"><i class="ace-icon fa fa-remove bigger-110 icon-only"></i></span>
            </td>
        <?php endif; ?>
    <?php endif; ?>
</tr>

<script  type="text/javascript">
    $("table").addClass("table table-bordered table-hover");
    $(document).ready(function () {
        $('#tbody_rubrique_<?php echo $id; ?>').sortable();
    });
</script>