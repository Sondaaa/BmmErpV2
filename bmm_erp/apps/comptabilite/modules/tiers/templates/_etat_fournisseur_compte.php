<?php
$total_debit = 0;
$total_credit = 0;
$total_solde = 0;
$url = '';
if ($compte != '')
    $url.= '&compte=' . trim($compte);
if ($journal != '')
    $url.= '&journal=' . trim($journal);
if ($date_debut != '')
    $url.= '&date_debut=' . $date_debut;
if ($date_fin != '')
    $url.= '&date_fin=' . $date_fin;
if ($order != '')
    $url.= '&order=' . $order;
if ($credit != '')
    $url.= '&credit=' . $credit;
if ($debit != '')
    $url.= '&debit=' . $debit;

if ($url != '')
    $url = substr($url, 1);
?>
<div class="row" ng-controller="myCtrlPaysVille">
    <div class="col-xs-12">
        <div class="table-header" style="background: #82AF6F; border-color: #82AF6F;">
            Extrait Fournisseur :
            <a target="_blank" class="btn btn-sm btn-primary" style="float: right; padding: 5px 12px;" href="<?php echo url_for("tiers/imprimeEtatExtraitFournisseur?" . $url); ?>">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer Extrait </span>
            </a>
            <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px; margin-left: 3px" href="<?php echo url_for("tiers/exporterExtraitFournisseurExcel?=" . $url); ?>">
                <i class="ace-icon fa fa-file-excel-o"></i>
                <span class="bigger-110 no-text-shadow">Exporter</span>
            </a>

        </div>
        <div>
            <div class="row">
                <div class="col-md-12">
                    <table id="listJournal" ng-grid="resultsOptions" class="table table-bordered table-hover" >
                        <thead>
                            <tr style="border-bottom: 1px solid #000000">
                                <th></th>

                                <th style="width: 9%;">Date</th>
                                <th style="width: 15%;">Journal Comptable</th>
                                <th style="width: 7%;">N° Pièce</th>
                                <th style="width: 7%;">Nature Pièce</th>
                                <th style="width: 7%;">N° Externe</th>
                                <th style="width: 20%;">Libellé</th>

                                <th style="width: 10%;">Débit</th> 
                                <th style="width: 10%;">Crédit </th>
                                <th style="width: 10%;">Solde </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($etatExtraitCompte->count() == 0): ?>
                                <tr>
                                    <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="11">Extrait de Compte Vide</td>
                                </tr>
                            <?php endif; ?>
                            <?php
                            foreach ($etatExtraitCompte as $key => $fiche):
                                if (($fiche->getMontantdebit() != 0) || ($fiche->getMontantcredit() != 0)):
                                    ?>

                                    <tr id="ligne_<?php echo $fiche->getId() ?>" onclick="AddIDPiece(<?php echo $fiche->getId() ?>, )">
                                        <td><?php echo $key + 1; ?></td>
                                        <!--<td><input  type="checkbox" mnt_credit="<?php echo $fiche->getMontantcredit() ?>" mnt_debit="<?php echo $fiche->getMontantdebit() ?>" idientifiant="<?php echo $fiche->getId() ?>" onclick="AddIDPiece(<?php echo $fiche->getId() ?>,<?php echo $fiche->getMontantdebit(); ?>, <?php echo $fiche->getMontantcredit() ?>)" id="check_<?php echo $fiche->getId() ?>" ></td>-->
                                        <td id="td_select" style="text-align: center;" ondblclick="select()">
                                            <?php echo date('d/m/Y', strtotime($fiche->getPiececomptable()->getDate())) ?></td>
                                        <td style="text-align: left;"><?php echo $fiche->getPiececomptable()->getJournalcomptable()->getCode() . '-' . $fiche->getPiececomptable()->getJournalcomptable()->getLibelle() ?></td>
                                        <td style="text-align: center;">
                                            <a style="cursor: pointer;" target="_blank" title="Modifier Pièce" href="<?php echo url_for('saisie_pieces/showEdit?id=' . $fiche->getPiececomptable()->getId()) ?>">
                                                <?php echo $fiche->getPiececomptable()->getNumero() ?>
                                            </a>
                                        </td>
                                        <td style="text-align: center;"><?php echo $fiche->getNaturepiece()->getLibelle() ?></td>
                                        <td style="text-align: center;"><?php echo $fiche->getNumeroexterne() ?></td>
                                        <td style="text-align: left;"><?php echo $fiche->getPiececomptable()->getLibelle() ?></td>

                                        <td style="text-align: right;"><?php
                                            if ($fiche->getMontantdebit() == 0)
                                                echo '';
                                            else {
                                                echo number_format($fiche->getMontantdebit(), 3, '.', ' ');
                                                $total_debit +=$fiche->getMontantdebit();
                                            }
                                            ?></td>

                                        <td style="text-align: right;"><?php
                                            if ($fiche->getMontantcredit() == 0)
                                                echo '';
                                            else {
                                                echo number_format($fiche->getMontantcredit(), 3, '.', ' ');
                                                $total_credit +=$fiche->getMontantcredit();
                                            }
                                            ?></td>
                                        <td style="text-align: right;"><?php
                                            echo number_format($fiche->getMontantdebit() - $fiche->getMontantcredit(), 3, '.', ' ');
                                            $total_solde +=$fiche->getMontantdebit() - $fiche->getMontantcredit();
                                            ?></td>
                                    </tr>
                                <?php
                                endif;
                            endforeach;
                            ?>
                            <tr style="background: repeat-x #F2F2F2;">
                                <td style="text-align: center; font-weight: bold; font-size: 18px" colspan="4" class="fixed-side" scope="col">Total</td>
                                <td colspan="3"></td>
                                <td style="text-align: right; font-weight: bold;font-size: 16px"><?php echo number_format($total_debit, 3, '.', ' ') ?></td>
                                <td style="text-align: right; font-weight: bold;font-size: 16px"><?php echo number_format($total_credit, 3, '.', ' ') ?></td>
                                <td style="text-align: right; font-weight: bold;font-size: 16px"><?php echo number_format($total_solde, 3, '.', ' ') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<div id="my-modal_saisipiece" class="modal fade" tabindex="-1">
    <?php
    include_partial('etat/saisipiece', array());
    ?>
</div>
<script  type="text/javascript">

    function ajouterLigneVide() {
        if ($('#journal_popup').val() != '-1') {
            var count_ligne = 0;
            $('#liste_ligne tbody tr').each(function () {
                count_ligne++;
            });
            var type_journal_id = $('#journal_option_' + $('#journal_popup').val()).attr('type_journal');
            $.ajax({
                url: '<?php echo url_for('@addLigneSaisieNonequilibrer') ?>',
                async: true,
                data: 'nature_id=' + $('#nature_piece').val() +
                        '&id_compte=' + $('#id_compte').val() +
                        '&solde_lignes=' + $('#solde_lignes').val() +
                        '&numero_externe=' + $('#numero_externe').val() +
                        '&reference=' + $('#reference').val() +
                        '&type_journal_id=' + type_journal_id +
                        '&journal_id=' + $('#journal_popup').val(),
                success: function (data) {
//                    if (count_ligne > 0) {
//                        $('#liste_ligne > tbody > tr').eq(index_ligne).before(data);
//                        index_ligne++;
//                    } else {
                    $('#liste_ligne tbody').append(data);
                    index_ligne = 0;
                    $('#liste_ligne tbody tr').each(function () {
                        index_ligne++;
                    });
                    index_ligne--;
//                    }
                    $('#numero_externe').attr('disabled', 'disabled');
                    $('#reference').attr('disabled', 'disabled');
                    $('#nature_piece_chosen').hide();
                    $('#z_nature_piece').show();

                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Veuillez déterminer le journal comptable !</span>",
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

    function  Solder(id)
    {
        $('#my-modal_saisipiece').addClass('in');
        $('#my-modal_saisipiece').css('display', 'block');
        $('#id_compte').val(id);

        $('#journal_popup').attr('class', "chosen-select form-control");
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
        // addFirstLigne();

    }
    function addFirstLigne() {

        var count_ligne = 0;
        $('#liste_ligne tbody tr').each(function () {
            count_ligne++;
        });
        ajouterLastLigne();
    }
    function solderPiece() {
        var count_ligne = 0;
        $('#liste_ligne tbody tr').each(function () {
            count_ligne++;
        });
        if (count_ligne > 0 && parseFloat($('#total_solde').val()) != 0) {
            if (parseFloat($('#total_solde').val()) > 0) {
                var credit = parseFloat($('#total_solde').val());
                var debit = '';
            } else {
                var credit = '';
                var debit = parseFloat($('#total_solde').val());
            }
            $.ajax({
                url: '<?php echo url_for('@addLigneSaisie') ?>',
                async: true,
                data: 'nature_id=' + $('#nature_piece').val() +
                        '&numero_externe=' + $('#numero_externe').val() +
                        '&reference=' + $('#reference').val() +
                        '&type_journal_id=' + type_journal_id +
                        '&journal_id=' + $('#journal').val() +
                        '&selected_compte=' + $('#journal_contre_id').val() +
                        '&credit=' + credit +
                        '&debit=' + debit +
                        '&selected_contre=' + $('#ligne_contre_' + count_ligne).val() +
                        '&&numerofinligne=' + count_ligne
                ,
                success: function (data) {
                    $('#liste_ligne tbody').append(data);
                    ligneNumber();
                    calculeTotal();
                }
            });
        }
    }
    function calculeTotal() {
        var total_credit = 0;
        $('[name="ligne_credit"]').each(function () {
            var credit = $(this).val();
            credit = eval(credit.replace(/,/g, '.'));
            credit = Math.abs(credit);
            if (isNaN(credit))
                credit = 0;
            var index_tr = $(this).parent('div').parent('td').parent('tr').attr('index_ligne');
            index_tr++;
            if (credit != '' && credit != 0) {
                total_credit = parseFloat(total_credit) + parseFloat(credit);
                $(this).val(parseFloat(credit).toFixed(3));
                $('#ligne_debit_' + index_tr).attr('readonly', 'readonly');
                $('#button_debit_' + index_tr).attr('disabled', 'true');
            } else {
                $('#ligne_debit_' + index_tr).removeAttr('readonly');
                $('#button_debit_' + index_tr).removeAttr('disabled');
                $(this).val('');
            }
        });
        var total_debit = 0;
        $('[name="ligne_debit"]').each(function () {
            var debit = $(this).val();
            debit = eval(debit.replace(/,/g, '.'));
            debit = Math.abs(debit);
            if (isNaN(debit))
                debit = 0;
            var index_tr = $(this).parent('div').parent('td').parent('tr').attr('index_ligne');
            index_tr++;
            if (debit != '' && debit != 0) {
                total_debit = parseFloat(total_debit) + parseFloat(debit);
                $(this).val(parseFloat(debit).toFixed(3));
                $('#ligne_credit_' + index_tr).attr('readonly', 'readonly');
                $('#button_credit_' + index_tr).attr('disabled', 'true');
            } else {
                $('#ligne_credit_' + index_tr).removeAttr('readonly');
                $('#button_credit_' + index_tr).removeAttr('disabled');
                $(this).val('');
            }
        });
        var total_solde = parseFloat(total_debit) - parseFloat(total_credit);
        $('#total_credit').val(parseFloat(total_credit).toFixed(3));
        $('#total_debit').val(parseFloat(total_debit).toFixed(3));
        $('#total_solde').val(parseFloat(total_solde).toFixed(3));
        $('#detail_total_solde').html(parseFloat(total_solde).toFixed(3));
        if (total_solde > 0)
            $('#nature_solde').html('Débiteur');
        else if (total_solde < 0)
            $('#nature_solde').html('Créditeur');
        else
            $('#nature_solde').html('Soldé');
    }

    function ajouterLastLigne() {
        if ($('#journal_popup').val() != '-1') {

            var count_ligne = 0;
            $('#liste_ligne tbody tr').each(function () {
                count_ligne++;
            });
            $.ajax({
                url: '<?php echo url_for('@addLigneSaisiePopup') ?>',
                async: true,
                data: 'journal_id=' + $('#journal_popup').val() +
                        '&id_compte=' + $('#id_compte').val() +
                        '&solde_lignes=' + $('#solde_lignes').val() +
                        '&numerofinligne=' + count_ligne +
                        '&selectedcontre=' + $('#ligne_contre_' + count_ligne).val(),
                success: function (data) {
                    $('#liste_ligne tbody').append(data);
                    var count_ligne = 0;
                    $('#liste_ligne tbody tr').each(function () {
                        count_ligne++;
                    });
                    count_ligne--;
                    formatLigne(count_ligne);
                    calculeTotal();
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Veuillez déterminer le journal comptable !</span>",
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
    function formatLigne(index) {
        $('#liste_ligne tbody tr').each(function () {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });
        $('#ligne_' + index).css('background', '#E7E7E7');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
        index_ligne = $('#ligne_' + index).attr('index_ligne');
    }
    function select() {
//        $("#td_select").keydown(function (e) {

        if (e.keyCode == 16 || e.keyCode == 17) {
            alert('11');
            $scope.resultsOptions.multiSelect = true;
            $scope.$apply();
        }
//        });
    }
    function ligneNumber() {
        var i = 0;
        $('#liste_ligne tbody tr').each(function () {
            var id = 'ligne_' + i;
            $(this).attr('id', id);
            $(this).attr('index_ligne', i);
            var format = 'formatLigne("' + i + '")';
            $(this).attr('onclick', format);
            i++;
        });
        var i = 1;
        $('[name="col_number"]').each(function () {
            $(this).text(i);
            i++;
        });
        var i = 1;
        $('[name="ligne_compte"]').each(function () {
            var id = 'ligne_compte_' + i;
            $(this).attr('id', id);
            var format = 'chargerCompte("#ligne_compte_' + i + '", "#hidden_ligne_compte_' + i + '", "#ligne_compte_libelle_' + i + '")';
            $(this).attr('onkeyup', format);
            $(this).attr('onfocus', format);
            format = 'moveToNext(event, "ligne_compte", ' + i + ')';
            $(this).attr('onkeydown', format);
            i++;
        });
        var i = 1;
        $('[name="hidden_ligne_compte"]').each(function () {
            var id = 'hidden_ligne_compte_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ligne_debit"]').each(function () {
            var id = 'ligne_debit_' + i;
            $(this).attr('id', id);
            var format = 'moveToNext(event, "ligne_debit", ' + i + ')';
            $(this).attr('onkeydown', format);
            i++;
        });
        var i = 1;
        $('[name="ligne_credit"]').each(function () {
            var id = 'ligne_credit_' + i;
            $(this).attr('id', id);
            var format = 'moveToNext(event, "ligne_credit", ' + i + ')';
            $(this).attr('onkeydown', format);
            i++;
        });
        //calculeTotal();
    }
    function addFirstLigneVide() {

        var count_ligne = 0;
        $('#liste_ligne tbody tr').each(function () {
            count_ligne++;
        });
        if (count_ligne == 0) {
            ajouterLastLigneVide();
        }

    }

    function ajouterLastLigneVide() {
        if ($('#journal_popup').val() != '-1') {
            var type_journal_id = $('#journal_option_' + $('#journal_popup').val()).attr('type_journal');
            var maquette_id = $('#id_maquette').val();
            var count_ligne = 0;
            $('#liste_ligne tbody tr').each(function () {
                count_ligne++;
            });
            $.ajax({
                url: '<?php echo url_for('@addLigneSaisieVide') ?>',
                async: true,
                data: 'nature_id=' + $('#nature_piece').val() +
                        '&numero_externe=' + $('#numero_externe').val() +
                        '&id_compte=' + $('#id_compte').val() +
                        '&solde_lignes=' + $('#total_solde').val() +
                        '&reference=' + $('#reference').val() +
                        '&type_journal_id=' + type_journal_id +
                        '&journal_id=' + $('#journal_popup').val() +
                        '&maquette_id=' + maquette_id +
                        '&numerofinligne=' + count_ligne +
                        '&selectedcontre=' + $('#ligne_contre_' + count_ligne).val(),
                success: function (data) {
                    $('#liste_ligne tbody').append(data);
                    $('#numero_externe').attr('disabled', 'disabled');
                    $('#reference').attr('disabled', 'disabled');
                    var count_ligne = 0;
                    $('#liste_ligne tbody tr').each(function () {
                        count_ligne++;
                    });
                    count_ligne--;
                    formatLigne(count_ligne);
                    $('#nature_piece_chosen').fadeOut();
                    $('#z_nature_piece').fadeIn();
                    calculeTotal();
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Veuillez déterminer le journal comptable !</span>",
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
    function supprimerLigne() {
        $('#ligne_' + index_ligne).remove();
        ligneNumber();
        calculeTotal();
        formatLigne(0);
    }
    function validerPiece(re_journal) {

        var nb_lignes = 0;
        var numero_compte = '';
        var ligne_contre = '';
        var ligne_debit = '';
        var ligne_credit = '';
        var ligne_nature_id = '';
        var ligne_numero_externe = '';
        var ligne_reference = '';
        var ligne_facture_id = '';
        var ligne_libelle = '';
        var compte_remplie = true;
        var montant_remplie = true;
        $('#liste_ligne tbody tr').each(function () {
            nb_lignes++;
            var i_ligne = $(this).attr('index_ligne');
            i_ligne++;
            numero_compte = numero_compte + $('#hidden_ligne_compte_' + i_ligne).val() + ',,';
            ligne_contre = ligne_contre + $('#hidden_ligne_contre_' + i_ligne).val() + ',,';
            ligne_debit = ligne_debit + $('#ligne_debit_' + i_ligne).val() + ',,';
            ligne_credit = ligne_credit + $('#ligne_credit_' + i_ligne).val() + ',,';
            ligne_nature_id = ligne_nature_id + $('#ligne_nature_id_' + i_ligne).val() + ',,';
            ligne_numero_externe = ligne_numero_externe + $('#ligne_numero_externe_' + i_ligne).val() + ',,';
            ligne_reference = ligne_reference + $('#ligne_reference_' + i_ligne).val() + ',,';
            ligne_facture_id = ligne_facture_id + $('#ligne_facture_id_' + i_ligne).val() + ',,';
            ligne_libelle = ligne_libelle + $('#ligne_libelle_' + i_ligne).val() + ',**,';
            if ($('#hidden_ligne_compte_' + i_ligne).val() == '' && ($('#ligne_debit_' + i_ligne).val() != '' || $('#ligne_credit_' + i_ligne).val() != ''))
                compte_remplie = false;
            if ($('#ligne_debit_' + i_ligne).val() == '' && $('#ligne_credit_' + i_ligne).val() == '' && $('#hidden_ligne_compte_' + i_ligne).val() != '')
                montant_remplie = false;
        });
        $.ajax({
            url: '<?php echo url_for('@validerPieceExtrait') ?>',
            data: 'journal=' + $('#journal_popup').val() +
                    '&date=' + $('#date').val() +
                    '&serie=' + $('#serie_id').val() +
                    '&numero=' + $('#numero').val() +
                    '&libelle_piece=' + $('#libelle_piece').val() +
                    '&piece_id=' + $('#detail_piece_id').val() +
                    '&total_debit=' + $('#total_debit').val() +
                    '&total_credit=' + $('#total_credit').val() +
                    '&numero_compte=' + numero_compte +
                    '&ligne_contre=' + ligne_contre +
                    '&ligne_debit=' + ligne_debit +
                    '&ligne_credit=' + ligne_credit +
                    '&ligne_nature_id=' + ligne_nature_id +
                    '&ligne_numero_externe=' + ligne_numero_externe +
                    '&ligne_reference=' + ligne_reference +
                    '&ligne_facture_id=' + ligne_facture_id +
                    '&ligne_libelle=' + ligne_libelle +
                    '&re_journal=' + re_journal +
                    '&arrayid=' + $('#array_lettre').val()
                    + '&lettre=' + $('#next_lettre').val(),
            success: function (data) {
                $('#form_saisie_pieces').html(data);
                bootbox.dialog({
                    message: "<span class='bigger-160' style='margin:20px;'> " + " Pièce(s) comptable(s) créée(s) avec succès !</span>",
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                            }
                });
                //lettrer2();
                fermerPopup();
                afficher();
                //mise en forme le désign du formulaire saisie de pièce
//                                    miseEnFormeDesignFormulaire();
            }
        });
    }



</script>