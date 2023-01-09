<?php if ($piece != null): ?>
    <?php
    $i = 0;
    $nature_id = '';
    $nature_libelle = '';
    $numero_externe = '';
    $reference = '';
    ?>
    <?php $lignes = LignepiececomptableTable::getInstance()->getByPieceInOrderSaisie($piece->getId()); ?>
    <?php foreach ($lignes as $ligne): ?>
        <tr id="ligne_<?php echo $i; ?>" onclick="formatLigne(<?php echo $i; ?>)" index_ligne="<?php echo $i; ?>">
            <td name="col_number" style="text-align:center"><?php echo $i + 1; ?></td>
            <td>
            <input  type="checkbox"  onclick="affichersolde('<?php echo $compte_id ?>')" name="checkk" id="check_<?php echo $compte_id ?>" libelle="check_0" index_ligne_chek="0">
        </td>
            <td>
                <?php
                $compte_libelle = '';
                $compte_id = '';
                if ($ligne->getIdComptecomptable() != ''):
                    $compte = PlandossiercomptableTable::getInstance()->find($ligne->getIdComptecomptable());
                    $compte_libelle = trim($compte->getNumerocompte()) . ' - ' . trim($compte->getLibelle());
                    $compte_id = $ligne->getIdComptecomptable();
                endif;
                ?>
                <input type="text" style="width: 100%" value="<?php echo $compte_libelle; ?>" name="ligne_compte" id="ligne_compte_<?php echo $i + 1; ?>" onfocus="chargerCompte('#ligne_compte_<?php echo $i + 1; ?>', '#hidden_ligne_compte_<?php echo $i + 1; ?>', '#ligne_compte_libelle_<?php echo $i + 1; ?>')" onkeyup="chargerCompte('#ligne_compte_<?php echo $i + 1; ?>', '#hidden_ligne_compte_<?php echo $i + 1; ?>', '#ligne_compte_libelle_<?php echo $i + 1; ?>')" onkeydown="moveToNext(event, 'ligne_compte', <?php echo $i; ?>)"/>
                <input type="hidden" value="<?php echo $compte_id; ?>" name="hidden_ligne_compte" id="hidden_ligne_compte_<?php echo $i + 1; ?>" />
                <div name="ligne_compte_libelle" id="ligne_compte_libelle_<?php echo $i + 1; ?>" class="mws-form-row" style="text-align: justify; margin-left: 2%;width: 100%">
                    <?php echo $compte_libelle; ?>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input class="form-control" data-text="decimal" value="<?php echo $ligne->getMontantdebit(); ?>" type="text" id="ligne_debit_<?php echo $i + 1; ?>" name="ligne_debit" style="text-align:right;" onchange="calculeTotal()">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" onclick="showCalculatrice(<?php echo $i + 1; ?>)" name="button_debit" id="button_debit_<?php echo $i + 1; ?>" type="button">
                            <i class="ace-icon fa fa-calculator bigger-110" style="margin-right: 0px;"></i>
                        </button>
                    </span>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input class="form-control" data-text="decimal" value="<?php echo $ligne->getMontantcredit(); ?>" type="text" id="ligne_credit_<?php echo $i + 1; ?>" name="ligne_credit" style="text-align:right;" onchange="calculeTotal()">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" onclick="showCalculatrice(<?php echo $i + 1; ?>)" name="button_credit" id="button_credit_<?php echo $i + 1; ?>" type="button">
                            <i class="ace-icon fa fa-calculator bigger-110" style="margin-right: 0px;"></i>
                        </button>
                    </span>
                </div>
            </td>
            <td>
                <?php
                $contre_libelle = '';
                $contre_id = '';
                if ($ligne->getIdContrepartie() != ''):
                    $contre = PlandossiercomptableTable::getInstance()->find($ligne->getIdContrepartie());
                    $contre_libelle = trim($contre->getNumerocompte()) . ' - ' . trim($contre->getLibelle());
                    $contre_id = $ligne->getIdContrepartie();
                endif;
                ?>
                <input type="text" value="<?php echo $contre_libelle; ?>" name="ligne_contre" id="ligne_contre_<?php echo $i + 1; ?>" onfocus="chargerCompte('#ligne_contre_<?php echo $i + 1; ?>', '#hidden_ligne_contre_<?php echo $i + 1; ?>', '#ligne_contre_libelle_<?php echo $i + 1; ?>')" onkeyup="chargerCompte('#ligne_contre_<?php echo $i + 1; ?>', '#hidden_ligne_contre_<?php echo $i + 1; ?>', '#ligne_contre_libelle_<?php echo $i + 1; ?>')" onkeydown="moveToNext(event, 'ligne_contre', <?php echo $i + 1; ?>)"/>
                <input type="hidden" value="<?php echo $contre_id; ?>" name="hidden_ligne_contre" id="hidden_ligne_contre_<?php echo $i + 1; ?>" />
                <div name="ligne_contre_libelle" id="ligne_contre_libelle_<?php echo $i + 1; ?>" class="mws-form-row" style="text-align: justify; margin-left: 2%;">
                    <?php echo $contre_libelle; ?>
                </div>
            </td>
            <td><input type="text" id="ligne_libelle_0" name="ligne_libelle" value="<?php echo $ligne->getLibelle(); ?>"></td>
            <td style="display:none">
                <input type="text" id="ligne_nature_id_<?php echo $i + 1; ?>" name="ligne_nature_id" value="<?php echo $ligne->getIdNaturepiece(); ?>">
            </td>
            <td style="display: none;">
                <?php
                if ($ligne->getIdNaturepiece() != null) {
                    echo $ligne->getNaturepiece()->getLibelle();
                    if ($nature_id == '') {
                        $nature_id = $ligne->getIdNaturepiece();
                        $nature_libelle = $ligne->getNaturepiece()->getLibelle();
                    }
                }
                ?>
            </td>
            <td style="display: none;">
                <?php echo $ligne->getNumeroexterne(); ?>
                <input style="display:none;" type="text" id="ligne_numero_externe_<?php echo $i + 1; ?>" name="ligne_numero_externe" value="<?php echo $ligne->getNumeroexterne(); ?>">
            </td>
            <?php
            $facture = null;
            if ($ligne->getIdFacturevente() != null) {
                $facture = $ligne->getFacturecomptablevente();
            }
            if ($ligne->getIdFactureachat() != null) {
                $facture = $ligne->getFacturecomptableachat();
            }
            if ($numero_externe == '')
                $numero_externe = $ligne->getNumeroexterne();
            if ($reference == '')
                $reference = $ligne->getReference();
            ?>
            <?php if ($facture != null): ?>
                <td style="display:none">
                    <?php echo $facture->getReference(); ?>
                    <input type="text" id="ligne_reference_<?php echo $i + 1; ?>" name="ligne_reference" value="<?php echo $facture->getReference(); ?>">
                </td>
                <td style="display:none">
                    <?php echo $facture->getId(); ?>
                    <input type="text" id="ligne_facture_id_<?php echo $i + 1; ?>" name="ligne_facture_id" value="<?php echo $facture->getId(); ?>">
                </td>
            <?php else: ?>
                <td style="display:none">
                    <?php echo $ligne->getReference(); ?>
                    <input type="text" id="ligne_reference_<?php echo $i + 1; ?>" name="ligne_reference" value="<?php echo $ligne->getReference(); ?>">
                </td>
                <td style="display:none">
                    <input type="text" id="ligne_facture_id_<?php echo $i + 1; ?>" name="ligne_facture_id" value="">
                </td>
            <?php endif; ?>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>

    <script  type="text/javascript">

        ligneNumber();
        detailsPiece();

        function convert(str) {
            str = str.replace("&gt;", ">");
            str = str.replace("&lt;", "<");
            str = str.replace("&quot;", '"');
            str = str.replace("&#039;", "'");
            str = str.replace("&amp;", "&");
//            alert(str);
            return str;
        }

        function detailsPiece() {
            $('#detail_piece_id').val(<?php echo $piece->getId(); ?>);
//            alert("<?php // echo $piece->getLibelle(); ?>");
            $('#libelle_piece').val(convert("<?php echo $piece->getLibelle(); ?>"));

            $('#numero_externe').val(convert('<?php echo $numero_externe; ?>'));
            $('#reference').val(convert('<?php echo $reference; ?>'));

            $('#numero_externe').attr('disabled', 'disabled');
            $('#reference').attr('disabled', 'disabled');

            $('#z_nature_piece').val(convert('<?php echo $nature_libelle; ?>'));
//            $('#nature_piece_chosen').hide();
            $('#z_nature_piece').show();

            var t_solde = $('#total_solde').val();
            if (parseFloat(t_solde) < 0) {
                t_solde = Math.abs(t_solde);
                $('#detail_total_solde').val(parseFloat(t_solde).toFixed(3));
                $('#nature_solde').val('Créditeur');
            } else if (parseFloat(t_solde) > 0) {
                $('#detail_total_solde').val(parseFloat(t_solde).toFixed(3));
                $('#nature_solde').val('Débiteur');
            } else {
                $('#detail_total_solde').val(parseFloat(t_solde).toFixed(3));
                $('#nature_solde').val('Soldé');
            }
        }

    </script>
<?php else: ?>

    <script  type="text/javascript">

        ligneNumber();
        detailsPiece();

        function detailsPiece() {
            $('#detail_piece_id').val('');
            $('#libelle_piece').val('');
            $('#detail_total_solde').val('');
            $('#nature_solde').val('');

            $('#numero_externe').val('');
            $('#reference').val('');

            $('#numero_externe').removeAttr('disabled');
            $('#reference').removeAttr('disabled');

//            $('#z_nature_piece').val('');
//            $('#z_nature_piece').hide();
//            $('#nature_piece_chosen').show();
        }

    </script>

<?php endif; ?>
<script  type="text/javascript">
    function affichersolde(id) {


//        if ($('#ligne_' + id).attr('style') && $('#check_' + id).is(':checked') == true) {
//            $('#ligne_' + id).removeAttr('style');
//            $('#check_' + id).prop("checked", false);
//        } else {
//            $('#ligne_' + id).attr('style', 'background-color:  #e5e7e9 ;');
//            $('#check_' + id).prop("checked", true);
//
//        }
////        console.log('style=' + ($('#ligne_' + id).attr('style') + 'checked=' + $('#check_' + id).is(':checked')));
//        if ($('#check_' + id).is(':checked')) {
//            $('#ligne_' + id).attr('style', 'background-color:  #e5e7e9 ;');
//        } else {
//            $('#ligne_' + id).removeAttr('style');
//        }
// $("input:checked").each(function () {
//            var id = $(this).attr("id");
////              console.log(id);
//            if ('#select_maq_' + id_selected != '#' + id)
//                $('#' + id).prop("checked", false);
//
//        });

        $('input[name=checkk]').each(function () {
            var id_selected = $(this).attr("id");
            
            if ('#check_' + id != '#' + id_selected)
                $('#' + id_selected).prop("checked", false);
            var index = 0;
            var sThisVal = (this.checked ? "1" : "0");
            if (sThisVal == '1') {
                var solde_credit = 0;
                var solde_debit = 0;

                index_ligne++;
                var id_compte = $('#hidden_ligne_compte_' + index_ligne).val();
                if (id != '' || id_compte != '') {
                    $.ajax({
//                 index_ligne--;
                        dataType: 'json',
                        url: '<?php echo url_for('saisie_pieces/affichersolde2') ?>',
                        data: 'id=' + id + '&id_compte=' + id_compte,
                        success: function (data) {
//                            index_ligne--;
//                            if (data.soldeouv != '0.000' && data.typesolde == 1)
//                            {
//                                solde_credit = Math.abs(data.solde);
//                                solde_debit = 0;
//                            }
//                            if (data.soldeouv != '0.000' && data.typesolde == 2)
//                            {
//                                solde_debit = Math.abs(-data.solde);
//                                solde_credit = 0;
//                            }
//                            if (data.typesolde != 2 && data.typesolde != 1)
//                            {
                                if (data.crediteur < 0)
                                {
                                    solde_credit = Math.abs(data.crediteur);
                                    solde_debit = 0
                                }
                               if (data.debiteur >= 0)
                                    solde_debit = Math.abs(data.debiteur);
                                    solde_credit = 0;
                                }
//                            }
                            calculeTotal();


                            $('#solde_debit_ancien').val(solde_debit));
                            $('#solde_credit_ancien').val(solde_credit);
                            $('#solde_debit_ancien_hidden').val(solde_debit);
                            $('#solde_credit_ancien_hidden').val(solde_credit);
                            $('#solde_debit_nouveau').val(solde_debit);
                            $('#sold_credit_nouveau').val(solde_credit);
                            $('#compte_comptable').val(data.numerocompte);
                        }
                    });
                }
            }
            else {
                $('#solde_debit_ancien').val('');
                $('#solde_credit_ancien').val('');

                $('#sold_credit_nouveau_hidden').val('');
                $('#solde_debit_ancien_hidden').val('');
                $('#solde_credit_nouveau').val('');
                $('#solde_debit_nouveau').val('');
                $('#solde_debit').val('');
                $('#solde_cerdit').val('');
                $('#compte_comptable').val('');

            }


        });

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