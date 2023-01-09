<tr id="ligne_0" onclick="formatLigne(0)" index_ligne="0">
    <td name="col_number" style="text-align:center">0</td>
    <td>
        <div class="mws-form-row" style="text-align: center;">
            <select name="ligne_compte" id="ligne_compte_0" class="mws-select2 large" style="width: 96%">
                <option value="-1"></option>
                <?php foreach ($comptes as $compte): ?>
                    <option value="<?php $compte->getId() ?>"><?php echo $compte->getNumeroCompte(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </td>
    <td>
        <div style="text-align: center;">
            <input class="large" type="text" id="ligne_debit_0" name="ligne_debit" style="width: 96%" onchange="calculeTotal()">
        </div>
    </td>
    <td>
        <div style="text-align: center;">
            <input class="large" type="text" id="ligne_credit_0" name="ligne_credit" style="width: 96%" onchange="calculeTotal()">
        </div>
    </td>
    <td>
        <div class="mws-form-row" style="text-align: center;">
            <select name="ligne_contre" id="ligne_contre_0" class="mws-select2 large" style="width: 96%">
                <option value="-1"></option>
                <?php foreach ($comptes as $compte): ?>
                    <option value="<?php $compte->getId() ?>"><?php echo $compte->getNumeroCompte(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </td>
    <td style="display:none">
        <input type="text" id="ligne_nature_id_0" name="ligne_nature_id" value="">
    </td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td style="display:none">
        <input type="text" id="ligne_reference_0" name="ligne_reference" value="">
    </td>
    <td style="display:none">
        <input type="text" id="ligne_facture_id_0" name="ligne_facture_id" value="">
    </td>
</tr>

<script  type="text/javascript">

    $('#ligne_compte_0').select2({placeholder: 'Compte Comptable'});
    $('#ligne_contre_0').select2({placeholder: 'Contre Partie'});

    $("table.mws-table tbody tr:even").addClass("even");
    $("table.mws-table tbody tr:odd").addClass("odd");

    ligneNumber();

</script>