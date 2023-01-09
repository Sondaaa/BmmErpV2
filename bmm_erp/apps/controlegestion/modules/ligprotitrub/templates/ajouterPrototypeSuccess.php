<?php $titre = TitrebudjetTable::getInstance()->find($id_titre); ?>
<tr id="tr_<?php echo $id; ?>" name="tr_rubrique">
    <td style="width: 5%; text-align:center; display: none;">
        <input readonly="true" style="width:100%;" type="text" nordre_rubrique="<?php echo $id; ?>" name="nordre_rubrique" id="nordre_<?php echo $id; ?>" value="<?php echo $id; ?>" />
        <input type="hidden" name="hidden_id" id="hidden_<?php echo $id; ?>" value="">
    </td>
    <td style="width: 5%; text-align:center;">
        <input readonly="true" style="width:100%;" type="text" code_rubrique="<?php echo $id; ?>" name="code_rubrique" id="code_<?php echo $id; ?>" value="<?php echo $code; ?>" />
    </td>
    <td style="width: 77%;">
        <input readonly="true" style="width:100%;" type="text" rubrique="<?php echo $id; ?>" name="rubrique" id="rubrique_<?php echo $id; ?>" value="<?php echo $libelle; ?>" />
        <table id="table_<?php echo $id; ?>" table_rubrique="<?php echo $id; ?>" name="tr_table" style="display: none;">
            <thead>
                <tr>
                    <th style="width: 5%; text-align:center; display: none;">N° Ordre</th>
                    <th style="width: 5%; text-align:center;">Code</th>
                    <th style="width: 71%;">Sous Rubrique</th>
                    <th style="text-align: center; width: 19%">Action</th>
                   
                </tr>
            </thead>
            <tbody id="tbody_rubrique_<?php echo $id; ?>">

            </tbody>
        </table>
        <input type="hidden" id="compteur_sous_rubrique_<?php echo $id; ?>" value="1">
    </td>
    
        <td style="text-align: center; width: 13%">
            <span class="btn btn-warning btn-xs" name="btn_sous_rubrique" href="#my-modal_rubrique" data-toggle="modal" onclick="setDataRubrique('<?php echo $id; ?>')" style="margin-bottom: 5px;"><i class="ace-icon fa bigger-110 icon-only">+ SS. RUB.</i></span>
            <span class="btn btn-primary btn-xs" name="btn_edit_rubrique" onclick="setRubrique('<?php echo $id; ?>')" style="margin-bottom: 5px;"><i class="ace-icon fa fa-wrench bigger-110 icon-only"></i></span>
            <span class="btn btn-inverse btn-xs" name="btn_add_rubrique" onclick="insertRubriqueUp('<?php echo $id; ?>')" style="margin-bottom: 5px;"><i class="ace-icon fa fa-arrow-up bigger-110 icon-only"></i></span>
            <span class="btn btn-danger btn-xs" name="btn_remove_rubrique" onclick="removeRubrique('<?php echo $id; ?>', '')"><i class="ace-icon fa fa-remove bigger-110 icon-only"></i></span>
        </td>
   
</tr>

<script  type="text/javascript">
    $("table").addClass("table table-bordered table-hover");
</script>