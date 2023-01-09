
<?php if (!$maquette) { ?>
    <tr id="ligne_0" onclick="formatLigne(0)" index_ligne="0">
        <td name="col_number" style="text-align:center">0</td>
        <?php
        $compte_libelle = '';
        $compte_id = '';
        $contre_libelle = '';
        $contre_id = '';

        if ($selected_compte != '' && $selected_compte != 'undefined'):
            $compte = PlandossiercomptableTable::getInstance()->findOneByIdPlan($selected_compte);

            if (sizeof($compte) >= 1) {
                $compte_libelle = trim($compte->getNumerocompte()) . ' - ' . trim($compte->getLibelle());
                $compte_plan_dossier = PlandossiercomptableTable::getInstance()->findCompteDossier($selected_compte);
                $compte_id = $compte_plan_dossier->getFirst()->getId();
            }
        endif;
        if ($numero_ligne > 0 && ($selected_contre != '' || $selectedcontre != '')):

            $contre = PlandossiercomptableTable::getInstance()->getCompte($selected_contre);
            if (sizeof($contre) >= 1) {
                $contre_libelle = trim($contre->getFirst()->getNumerocompte()) . ' - ' . trim($contre->getFirst()->getLibelle());
                $contre_id = $contre->getFirst()->getId();
                $compte_libelle = trim($contre->getFirst()->getNumerocompte()) . ' - ' . $contre->getFirst()->getLibelle();
                $compte_id = $contre_id;
            }
        endif;
        ?>
        <td >
            <input  type="checkbox"  name="checkk" 
            id="check_<?php echo $numero_ligne ?>"
             libelle="check_<?php echo $numero_ligne ?>" index_ligne_chek="<?php echo $numero_ligne ?>">
        </td>
        <td>
            <input type="text" value="<?php echo $compte_libelle; ?>" name="ligne_compte" id="ligne_compte_0" onfocus="chargerCompte('#ligne_compte_0', '#hidden_ligne_compte_0', '#ligne_compte_libelle_0')" onkeyup="chargerCompte('#ligne_compte_0', '#hidden_ligne_compte_0', '#ligne_compte_libelle_0')" onkeydown="moveToNext(event, 'ligne_compte', 1)"/>
            <input type="hidden" value="<?php echo $compte_id; ?>" name="hidden_ligne_compte" id="hidden_ligne_compte_0" />
            <div name="ligne_compte_libelle" id="ligne_compte_libelle_0" class="mws-form-row" style="text-align: justify; margin-left: 2%;">
    <?php echo $compte_libelle; ?>
            </div>
        </td>
        <td>
            <div class="input-group">
                <input class="form-control align_right" data-text="decimal" onfocus="removeUl()" value="<?php echo $debit ?>" type="text" id="ligne_debit_0" name="ligne_debit" onchange="calculeTotal()" onkeydown="moveToNext(event, 'ligne_debit', 1)">
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" onclick="showCalculatrice(0)" name="button_debit" id="button_debit_0" type="button">
                        <i class="ace-icon fa fa-calculator bigger-110" style="margin-right: 0px;"></i>
                    </button>
                </span>
            </div>
        </td>
        <td>
            <div class="input-group">
                <input class="form-control align_right" data-text="decimal" onfocus="removeUl()" value="<?php echo $credit ?>" type="text" id="ligne_credit_0" name="ligne_credit" onchange="calculeTotal()" onkeydown="moveToNext(event, 'ligne_credit', 1)">
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" onclick="showCalculatrice(0)" name="button_credit" id="button_credit_0" type="button">
                        <i class="ace-icon fa fa-calculator bigger-110" style="margin-right: 0px;"></i>
                    </button>
                </span>
            </div>
        </td>
        <td>
            <?php
            $contre_libelle = '';
            $contre_id = '';

            $compte_libelle = '';
            $compte_id = '';
            if ($selected_compte != '' && $selected_compte != 'undefined'):
                $compte = PlandossiercomptableTable::getInstance()->findOneByIdPlan($selected_compte);
            if(sizeof($compte)>=1){
                $compte_libelle = trim($compte->getNumerocompte()) . ' - ' . trim($compte->getLibelle());
                $compte_plan_dossier = PlandossiercomptableTable::getInstance()->findCompteDossier($selected_compte);
            $compte_id = $compte_plan_dossier->getFirst()->getId();}
            endif;
            ?>
            <input type="text" value="<?php echo $contre_libelle; ?>" name="ligne_contre" id="ligne_contre_0" onfocus="chargerCompte('#ligne_contre_0', '#hidden_ligne_contre_0', '#ligne_contre_libelle_0')" onkeyup="chargerCompte('#ligne_contre_0', '#hidden_ligne_contre_0', '#ligne_contre_libelle_0')" onkeydown="moveToNext(event, 'ligne_contre', 1)"/>
            <div name="ligne_contre_libelle" id="ligne_contre_libelle_0" class="mws-form-row" style="text-align: justify; margin-left: 2%;">
    <?php echo $contre_libelle; ?>
            </div>
            <input type="hidden" value="<?php echo $contre_id; ?>" name="hidden_ligne_contre" id="hidden_ligne_contre_0" />

        </td>
        <td><input type="text" id="ligne_libelle_0" name="ligne_libelle" value="<?php echo $libelle_ligne;?>" onkeydown="moveToNext(event, 'ligne_libelle', 1)"></td>

    <?php if ($nature_piece != ''): ?>
            <td style="display:none;">
                <input type="text" id="ligne_nature_id_0" name="ligne_nature_id" value="<?php echo $nature_piece->getId(); ?>">
            </td>
            <td style="text-align:center; display:none;"><?php echo $nature_piece->getLibelle(); ?></td>
    <?php else: ?>
            <td style="display:none;">
                <input type="text" id="ligne_nature_id_0" name="ligne_nature_id">
            </td>
            <td style="text-align:center; display:none;"></td>
            <?php endif; ?>
        <td style="text-align:center; display:none;">
    <?php echo $numero_externe; ?>
            <input style="display:none;" type="text" id="ligne_numero_externe_0" name="ligne_numero_externe" value="<?php echo $numero_externe; ?>">
        </td>
        <td style="display:none;">
    <?php echo $reference; ?>
            <input type="text" id="ligne_reference_0" name="ligne_reference" value="<?php echo $reference; ?>">
        </td>
        <td style="display:none;">
            <input type="text" id="ligne_facture_id_0" name="ligne_facture_id" value="<?php if ($facture != null): ?><?php echo $facture->getId(); ?><?php endif; ?>">
        </td>
    </tr>
<?php } ?>
<?php if ($maquette) { ?>
    <?php foreach ($maquette->getLignemaquette() as $ligne) { ?>
        <tr id="ligne_0" onclick="formatLigne(0)" index_ligne="0">
            <td name="col_number" style="text-align:center">0</td>

            <?php
            $compte_libelle = '';
            $compte_id = '';
            if ($selected_compte != ''):
                $compte = PlandossiercomptableTable::getInstance()->getCompte($selected_compte)->getFirst();
                $compte_libelle = trim($compte->getNumerocompte()) . ' - ' . trim($compte->getLibelle());
                $compte_id = $selected_compte;
            endif;
            if ($ligne->getIdComptecomptable() != ''):

                $compte = PlandossiercomptableTable::getInstance()->getCompte($ligne->getIdComptecomptable())->getFirst();
                $compte_libelle = trim($compte->getNumerocompte()) . ' - ' . trim($compte->getLibelle());
                $compte_id = $compte->getId();
            endif;

//                if ($ligne->getIdComptecomptable() != ''):
//
//                    $compte = PlandossiercomptableTable::getInstance()->findOneByIdPlan($ligne->getIdComptecomptable());
//                    $compte_libelle = trim($compte->getNumerocompte()) . ' - ' . trim($compte->getLibelle());
//                    $compte_id = $ligne->getIdComptecomptable();
//                endif
            ?>
            <td><input type="checkbox"   name="checkk" id="check_0"  index_ligne_chek="0">
            </td>
            <td>


                <!--        $compte_libelle = '';
                                $compte_id = '';
                                if ($selected_compte != ''):
                                    $compte = PlandossiercomptableTable::getInstance()->find($selected_compte);
                                    $compte_libelle = trim($compte->getNumerocompte()) . ' - ' . trim($compte->getLibelle());
                                    $compte_id = $selected_compte;
                                endif;
                                if ($ligne->getIdComptecomptable() != ''):
                                  
                                    $compte = PlandossiercomptableTable::getInstance()->findOneByIdPlan($ligne->getIdComptecomptable());
                                    $compte_libelle = trim($compte->getNumerocompte()) . ' - ' . trim($compte->getLibelle());
                                    $compte_id = $ligne->getIdComptecomptable();
                                endif;-->
                <input type="text" value="<?php echo $compte_libelle; ?>" name="ligne_compte" id="ligne_compte_0" onfocus="chargerCompte('#ligne_compte_0', '#hidden_ligne_compte_0', '#ligne_compte_libelle_0')" onkeyup="chargerCompte('#ligne_compte_0', '#hidden_ligne_compte_0', '#ligne_compte_libelle_0')" onkeydown="moveToNext(event, 'ligne_compte', 1)"/>
                <input type="hidden" value="<?php echo $compte_id; ?>" name="hidden_ligne_compte" id="hidden_ligne_compte_0" />
                <div name="ligne_compte_libelle" id="ligne_compte_libelle_0" class="mws-form-row" style="text-align: justify; margin-left: 2%;">
        <?php echo $compte_libelle; ?>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input class="form-control align_right" data-text="decimal" onfocus="removeUl()" value="<?php if (trim($ligne->getType()) == 'debit') echo $ligne->getMontant() ?>" type="text" id="ligne_debit_0" name="ligne_debit" onchange="calculeTotal()" onkeydown="moveToNext(event, 'ligne_debit', 1)">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" onclick="showCalculatrice(0)" name="button_debit" id="button_debit_0" type="button">
                            <i class="ace-icon fa fa-calculator bigger-110" style="margin-right: 0px;"></i>
                        </button>
                    </span>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input class="form-control align_right" data-text="decimal" onfocus="removeUl()" value="<?php if (trim($ligne->getType()) == 'credit') echo $ligne->getMontant() ?>" type="text" id="ligne_credit_0" name="ligne_credit" onchange="calculeTotal()" onkeydown="moveToNext(event, 'ligne_credit', 1)">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" onclick="showCalculatrice(0)" name="button_credit" id="button_credit_0" type="button">
                            <i class="ace-icon fa fa-calculator bigger-110" style="margin-right: 0px;"></i>
                        </button>
                    </span>
                </div>
            </td>
            <td>
                <?php
                $contre_libelle = '';
                $contre_id = '';
//                if ($selected_contre != ''):
//                    $contre = PlandossiercomptableTable::getInstance()->findOneByIdPlan($selected_contre);
//                    $contre_libelle = trim($contre->getNumerocompte()) . ' - ' . trim($contre->getLibelle());
//                    $contre_id = $selected_contre;
//                endif;
                ?>
                <input type="text" value="<?php echo $contre_libelle; ?>" name="ligne_contre" id="ligne_contre_0"  onkeydown="moveToNext(event, 'ligne_contre', 1)"  onfocus="chargerCompte('#ligne_contre_0', '#hidden_ligne_contre_0', '#ligne_contre_libelle_0')" onkeyup="chargerCompte('#ligne_contre_0', '#hidden_ligne_contre_0', '#ligne_contre_libelle_0')"/>
                <input type="hidden" value="<?php echo $contre_id; ?>" name="hidden_ligne_contre" id="hidden_ligne_contre_0" />
                <div name="ligne_contre_libelle" id="ligne_contre_libelle_0" class="mws-form-row" style="text-align: justify; margin-left: 2%;">
        <?php echo $contre_libelle; ?>
                </div>
            </td>
            <td><input type="text" id="ligne_libelle_0" name="ligne_libelle" value="<?php echo $libelle_ligne; ?>" onkeydown="moveToNext(event, 'ligne_libelle', 1)"></td>
        <?php if ($nature_piece != null): ?>
                <td style="display:none;">
                    <input type="text" id="ligne_nature_id_0" name="ligne_nature_id" value="<?php echo $nature_piece->getId(); ?>">
                </td>
                <td style="text-align:center; display:none;"><?php echo $nature_piece->getLibelle(); ?></td>
        <?php else: ?>
                <td style="display:none;">
                    <input type="text" id="ligne_nature_id_0" name="ligne_nature_id">
                </td>
                <td style="text-align:center; display:none;"></td>
                <?php endif; ?>
            <td style="text-align:center; display:none;">
        <?php echo $numero_externe; ?>
                <input style="display:none;" type="text" id="ligne_numero_externe_0" name="ligne_numero_externe" value="<?php echo $numero_externe; ?>">
            </td>
            <td style="display:none;">
        <?php echo $reference; ?>
                <input type="text" id="ligne_reference_0" name="ligne_reference" value="<?php echo $reference; ?>">
            </td>
            <td style="display:none;">
                <input type="text" id="ligne_facture_id_0" name="ligne_facture_id" value="<?php if ($facture != null): ?><?php echo $facture->getId(); ?><?php endif; ?>">
            </td>
        </tr>

        <?php
    }
}
?>
<script  type="text/javascript">

    function affichersolde(id) {

        if ($('#hidden_ligne_compte_' + id).val() != '') {


            $('#solde_debit').val('');
            $('#solde_credit').val('');
            var solde_credit = 0;
            var solde_debit = 0;
            var solde_debit_nouveau = 0;
            var solde_credit_nouveau = 0;
            var solde = 0;
            var id_compte = $('#hidden_ligne_compte_' + id).val();
            if (id != '' || id_compte != '') {
                $.ajax({
                    dataType: 'json',
                    url: '<?php echo url_for('saisie_pieces/affichersolde2') ?>',
                    data: 'id_compte=' + id_compte,
//                    data: JSON.stringify(data),
                    success: function (data) {
//alert(data.numerocompte);
                        //debugger;
//                        if (data.soldeouv != '0.000' && data.typesolde == 1)
//                        {
//                            solde_credit = Math.abs(data.solde);
//                            solde_debit = 0;
//                        }
//                        if (data.soldeouv != '0.000' && data.typesolde == 2)
//                        {
//                            solde_debit = Math.abs(-data.solde);
//                            solde_credit = 0;
//                        }
//                        if (data.typesolde != 2 && data.typesolde != 1)
//                        {
//                            if (data.solde < 0)
//                            {
//                                solde_credit = Math.abs(data.solde);
//                                solde_debit = 0
//                            }
//                           if (data.solde > 0){
//                                solde_debit = Math.abs(data.solde);
//                                solde_credit = 0;
//                            }
                        if (data.crediteur != 0)
//                                {alert('14');
                        {
                            solde_credit = Math.abs(data.crediteur);
                            solde_debit = 0
                        }
                        if (data.debiteur != 0) {
                            solde_debit = Math.abs(data.debiteur);
                            solde_credit = 0;
                        }
//                        }
                        //debugger;
                        if ($('#ligne_debit_' + id).val() != '')
                        {
                            solde = solde_debit + parseFloat($('#ligne_debit_' + id).val()) - Math.abs(solde_credit);
                        }
                        if ($('#ligne_credit_' + id).val() != '')
                        {
                            solde = solde_debit - solde_credit + parseFloat($('#ligne_credit_' + id).val());
                        }
                        if (solde > 0)
                            $('#solde_debit').val(solde);
                        else
                            $('#solde_credit').val(Math.abs(solde));

                        $('#solde_debit_ancien').val(parseFloat(solde_debit).toFixed(3));
                        $('#solde_credit_ancien').val(parseFloat(solde_credit).toFixed(3));
                        $('#solde_debit_ancien_hidden').val(solde_debit);
                        $('#solde_credit_ancien_hidden').val(solde_credit);
//                        $('#solde_debit').val(solde_debit_nouveau);
//                        $('#sold_credit').val(solde_credit_nouveau);
                        $('#compte_comptable').val(data.numerocompte);
                    }
                });
            }
        }
//        if ($('#ligne_debit_' + id).val() == '' )
//        {
//            console.log('ligne_debit crdit vide');
//            $('#solde_credit_nouveau').val('');
//            $('#solde_debit_nouveau').val('');
//            $('#solde_debit').val('');
//            $('#solde_cerdit').val('');
//        }
//
//        else {
//
//            console.log('mm');
//            var solde_credit_an = 0;
//            var solde_debit_an = 0;
//            var solde_credit_nv = 0;
//            var solde_debit_nv = 0;
//            var solde_credit = 0;
//            var solde_debit = 0;
//            if (parseFloat($('#solde_debit_ancien_hidden').val() == ''))
//                solde_debit_an = parseFloat($('#solde_debit_ancien').val());
//            else
//                solde_debit_an = 0;
//            if (parseFloat($('#solde_credit_ancien_hidden').val() == ''))
//                solde_credit_an = parseFloat($('#solde_credit_ancien').val());
//            else
//                solde_credit_an = 0;
//            if (parseFloat($('#ligne_debit_' + id).val() == ''))
//                solde_debit_nv = parseFloat($('#ligne_debit_' + id).val());
//            else
//                solde_debit_nv = 0;
//            if (parseFloat($('#ligne_debit_' + id).val() == ''))
//                solde_credit_nv = parseFloat($('#ligne_credit_' + id).val());
//            else
//                solde_credit_nv = 0;
//            solde_credit = solde_credit_an + solde_credit_nv;
//            solde_debit = solde_debit_an + solde_debit_nv;
//            console.log(solde_debit_an + solde_debit_nv + solde_credit + solde_debit);
//            $('#solde_debit_ancien_hidden').val((parseFloat(solde_debit)));
//            $('#solde_credit_ancien_hidden').val((parseFloat(solde_credit)));
//            $('#solde_debit_nouveau').val((parseFloat(solde_debit)).toLocaleString());
//            $('#sold_credit_nouveau').val((parseFloat(solde_credit)).toLocaleString());
//        }
////        else {console.log('ligne_debit non vide');
////            else {
////                $('#solde_debit_ancien').val('');
////                $('#solde_credit_ancien').val('');
////                $('#sold_credit_nouveau_hidden').val('');
////                $('#solde_debit_ancien_hidden').val('');
////                $('#solde_credit_nouveau').val('');
////                $('#solde_debit_nouveau').val('');
////                $('#solde_debit').val('');
////                $('#solde_cerdit').val('');
////                $('#compte_comptable').val('');
////            }
////        }
    }
    function numStr(a, b) {
        a = '' + a;
        b = b || ' ';
        var c = '',
                d = 0;
        while (a.match(/^0[0-9]/)) {
            a = a.substr(1);
        }
        for (var i = a.length - 1; i >= 0; i--) {
            c = (d != 0 && d % 3 == 0) ? a[i] + b + c : a[i] + c;
            d++;
        }
        return c;
    }
</script>

<script  type="text/javascript">

    $('#ligne_compte_0').focus();
    $('input:text').not('[id="z_journal"]').attr('style', 'width: 100%;');
    ligneNumber();

</script>