
<tr id="ligne_0" onclick="formatLigne(0)" index_ligne="0">
    <td name="col_number" style="text-align:center">0</td>
    <td class="disabledbutton">
        <?php
        $compte = PlandossiercomptableTable::getInstance()->findOneById($id_compte);
        $compte_libelle = trim($compte->getNumerocompte()) . ' - ' . trim($compte->getLibelle());
        ?>
        <input type="text" value="<?php echo $compte_libelle; ?>" name="ligne_compte" id="ligne_compte_0" onfocus="chargerCompte('#ligne_compte_0', '#hidden_ligne_compte_0', '#ligne_compte_libelle_0')" onkeyup="chargerCompte('#ligne_compte_0', '#hidden_ligne_compte_0', '#ligne_compte_libelle_0')" onkeydown="moveToNext(event, 'ligne_compte', 1)"/>
        <input type="hidden" value="<?php echo $id_compte; ?>" name="hidden_ligne_compte" id="hidden_ligne_compte_0" />
        <div name="ligne_compte_libelle" id="ligne_compte_libelle_0" class="mws-form-row" style="text-align: justify; margin-left: 2%;">
            <?php echo $compte_libelle; ?>
        </div>
    </td>
    <?php if ($solde_lignes > 0): ?>
        <td>
            <div class="input-group">
                <input class="form-control align_right" data-text="decimal" onfocus="removeUl()" value="<?php echo 0 ?>" type="text" id="ligne_debit_0" name="ligne_debit" onchange="calculeTotal()" onkeydown="moveToNext(event, 'ligne_debit', 1)">
                <a href="etatExtraitCompteSuccess.php"></a>
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" onclick="showCalculatrice(0)" name="button_debit" id="button_debit_0" type="button">
                        <i class="ace-icon fa fa-calculator bigger-110" style="margin-right: 0px;"></i>
                    </button>
                </span>
            </div>
        </td>
        <td>
            <div class="input-group">
                <input class="form-control align_right" data-text="decimal" onfocus="removeUl()" value="<?php echo abs($solde_lignes) ?>" type="text" id="ligne_credit_0" name="ligne_credit" onchange="calculeTotal()" onkeydown="moveToNext(event, 'ligne_credit', 1)">
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" onclick="showCalculatrice(0)" name="button_credit" id="button_credit_0" type="button">
                        <i class="ace-icon fa fa-calculator bigger-110" style="margin-right: 0px;"></i>
                    </button>
                </span>
            </div>
        </td>
    <?php else: ?>
        <td>
            <div class="input-group">
                <input class="form-control align_right" data-text="decimal" onfocus="removeUl()" value="<?php echo abs($solde_lignes) ?>" type="text" id="ligne_debit_0" name="ligne_debit" onchange="calculeTotal()" onkeydown="moveToNext(event, 'ligne_debit', 1)">
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" onclick="showCalculatrice(0)" name="button_debit" id="button_debit_0" type="button">
                        <i class="ace-icon fa fa-calculator bigger-110" style="margin-right: 0px;"></i>
                    </button>
                </span>
            </div>
        </td>
        <td>
            <div class="input-group">
                <input class="form-control align_right" data-text="decimal" onfocus="removeUl()" value="<?php echo 0 ?>" type="text" id="ligne_credit_0" name="ligne_credit" onchange="calculeTotal()" onkeydown="moveToNext(event, 'ligne_credit', 1)">
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" onclick="showCalculatrice(0)" name="button_credit" id="button_credit_0" type="button">
                        <i class="ace-icon fa fa-calculator bigger-110" style="margin-right: 0px;"></i>
                    </button>
                </span>
            </div>
        </td>
    <?php endif; ?>  



    <td class="disabledbutton"><input type="text" id="ligne_libelle_0" name="ligne_libelle" value="Ecriture lettrage"></td>

</tr>

<script  type="text/javascript">
    if ($('#ligne_debit_0').val() > 0)
    {
        $('#total_debit').val($('#ligne_debit_0').val());
    }
    if ($('#ligne_credit_0').val() > 0)
    {
        $('#total_credit').val($('#ligne_credit_0').val());
    }

    $('#ligne_compte_0').focus();
    $('input:text').not('[id="z_journal"]').attr('style', 'width: 100%;');
    ligneNumber();
   
</script>