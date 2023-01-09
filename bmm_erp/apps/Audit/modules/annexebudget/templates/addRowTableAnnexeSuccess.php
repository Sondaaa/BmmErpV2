<tr id="tr_<?php echo $id; ?>">
    <td style="text-align: center; width: 7%;"><input type="text" class="align_center" name="rang" value="" readonly="true" style="width: 100%;"></td>
    <td style="width: 30%;"><input type="text" name="colonne" value="" <?php if ($direction != "left"): ?>class="align_right"<?php endif; ?> style="width: 100%;"></td>
    <td style="width: 12%;">
        <select name="type" id="type_<?php echo $id; ?>" onchange="setDisabled('<?php echo $i; ?>')">
            <option value="text">Texte</option>
            <option value="date">Date</option>
            <option value="montant">Montant</option>
            <option value="quantite">Quantité</option>
            <option value="taux">Taux</option>
        </select>
    </td>
    <td style="width: 12%;">
        <select name="nature" id="nature_<?php echo $id; ?>" onchange="setReadonly('<?php echo $id; ?>')">
            <option value="saisie">Saisie</option>
            <option value="calcule">Calcule</option>
        </select>
    </td>
    <td style="text-align: center; width: 22%;"><input type="text" id="formule_<?php echo $id; ?>" name="formule" value="" readonly="true" style="width: 100%;"></td>
    <td style="text-align: center; width: 10%; <?php if ($sommation == "false"): ?>display: none;<?php endif; ?>">
        <input name="sommation" id="sommation_<?php echo $id; ?>" type="checkbox">
    </td>
    <td style="text-align: center;">
        <input name="c_total" id="c_total_<?php echo $i; ?>" type="checkbox">
    </td>
    <td style="text-align: center; width: 7%;">
        <span class="btn btn-xs btn-danger" onclick="removeRowEdit('<?php echo $id; ?>')"><i class="ace-icon fa fa-trash bigger-110 icon-only"></i></span>
    </td>
</tr>

<script  type="text/javascript">

    $('#type_<?php echo $id; ?>').attr('class', "chosen-select form-control");
    $('#type_<?php echo $id; ?>').attr('style', 'width: 100%;');
    $('#type_<?php echo $id; ?>').chosen({allow_single_deselect: true});

    $('#nature_<?php echo $id; ?>').attr('class', "chosen-select form-control");
    $('#nature_<?php echo $id; ?>').attr('style', 'width: 100%;');
    $('#nature_<?php echo $id; ?>').chosen({allow_single_deselect: true});

    $('#nature_<?php echo $id; ?>_chosen').addClass("disabledbutton");

</script>