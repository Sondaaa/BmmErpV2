<div style="font-size: 14px; margin-bottom: 10px">
    <b>Facture Vente N°:</b> <?php echo $facture->getReference() ?>
</div>

<h3 style="color: #4a63ae;">Saisir pièce comptable par maquette de saisie</h3>
<table style="width: 100%" class="table table-bordered table-hover" cellspacing="0" cellpadding="0" border="0">
    <tbody>
        <tr>
            <td colspan="5">
                Maquette de Saisie : Code - Libellé (Journal comptable : libellé)
                <select id="maquette_id" onchange="setJournal()">
                    <option value="0"></option>
                    <?php foreach ($maquettes as $maquette): ?>
                        <option id="option_<?php echo $maquette->getId(); ?>" journal_id="<?php echo $maquette->getIdJournal(); ?>" journal="<?php echo trim($maquette->getJournalcomptable()->getCode()) . ' - ' . trim($maquette->getJournalcomptable()->getLibelle()); ?>" value="<?php echo $maquette->getId(); ?>"><?php echo trim($maquette->getCode()) . ' - ' . trim($maquette->getLibelle()); ?> (Journal : <?php echo trim($maquette->getJournalcomptable()->getLibelle()); ?>)</option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="width: 46%">
                Journal Comptable
                <input id="journal_piece" type="text" value="" readonly="true" />
                <input id="id_journal_piece" type="hidden" value="" />
            </td>
            <td style="width: 15%">
                Date <br>
                <input id="date_piece" type="date" value="<?php echo $facture->getDate() ?>" />
            </td>
            <td style="width: 15%">
                Type Pièce
                <input readonly="true" type="text" value="FACTURE" />
            </td>
            <td style="width: 12%">
                N° Externe
                <input readonly="true" type="text" value="<?php echo $facture->getNumero() ?>" />
            </td>
            <td style="width: 12%">
                Référence
                <input readonly="true" type="text" value="<?php echo $facture->getReference() ?>" />
            </td>
        </tr>
    </tbody>
</table>

<table style="width: 100%" class="table table-bordered table-hover" cellspacing="0" cellpadding="0" border="0">
    <thead>
        <tr>
            <th style="width: 40%;">Compte comptable</th>
            <th style="width: 13%; text-align: center;">Débit</th>
            <th style="width: 13%; text-align: center;">Crédit</th>
            <th style="width: 34%;">Contre partie</th>
        </tr>
    </thead>
    <tbody id="tbody_maquette_saisie">
        <tr>
            <td>
                <input type="text" value="<?php echo $facture->getClient()->getPlancomptable(); ?>" name="ligne_compte" id="ligne_compte_0" onfocus="chargerCompte('#ligne_compte_0', '#hidden_ligne_compte_0', '#ligne_compte_libelle_0')" onkeyup="chargerCompte('#ligne_compte_0', '#hidden_ligne_compte_0', '#ligne_compte_libelle_0')" onkeydown="moveToNext(event, 'ligne_compte', 1)"/>
                <input type="hidden" value="<?php echo $facture->getClient()->getIdPlancomptable(); ?>" name="hidden_ligne_compte" id="hidden_ligne_compte_0" />
                <div name="ligne_compte_libelle" id="ligne_compte_libelle_0" class="mws-form-row" style="text-align: justify; margin-left: 2%;">
                    <?php echo $facture->getClient()->getPlancomptable(); ?>
                </div>
            </td>
            <td><input type="text" style="width: 100%;" value="" id="debit_0" readonly="true"/></td>
            <td><input class="align_right" style="width: 100%;" id="credit_0" type="text" value="<?php echo number_format($facture->getTotalht(), 3, '.', ' ') ?>" readonly="true"/></td>
            <td name="contre_partie" td_contre_id="0">
                <input type="text" value="" name="ligne_contre" id="ligne_contre_0" onfocus="chargerCompte('#ligne_contre_0', '#hidden_ligne_contre_0', '#ligne_contre_libelle_0')" onkeyup="chargerCompte('#ligne_contre_0', '#hidden_ligne_contre_0', '#ligne_contre_libelle_0')"/>
                <input type="hidden" value="" name="hidden_ligne_contre" id="hidden_ligne_contre_0" />
                <div name="ligne_contre_libelle" id="ligne_contre_libelle_0" class="mws-form-row" style="text-align: justify; margin-left: 2%;">

                </div>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" value="" name="ligne_compte" id="ligne_compte_1" onfocus="chargerCompte('#ligne_compte_1', '#hidden_ligne_compte_1', '#ligne_compte_libelle_1')" onkeyup="chargerCompte('#ligne_compte_1', '#hidden_ligne_compte_1', '#ligne_compte_libelle_1')"/>
                <input type="hidden" value="" name="hidden_ligne_compte" id="hidden_ligne_compte_1" />
                <div name="ligne_compte_libelle" id="ligne_compte_libelle_1" class="mws-form-row" style="text-align: justify; margin-left: 2%;">

                </div>
            </td>
            <td><input type="text" style="width: 100%;" value="" id="debit_1" readonly="true"/></td>
            <td><input class="align_right" style="width: 100%;" id="credit_1" type="text" value="<?php echo number_format($facture->getTotaltva(), 3, '.', ' ') ?>" readonly="true"/></td>
            <td name="contre_partie" td_contre_id="1">
                <input type="text" value="" name="ligne_contre" id="ligne_contre_1" onfocus="chargerCompte('#ligne_contre_1', '#hidden_ligne_contre_1', '#ligne_contre_libelle_1')" onkeyup="chargerCompte('#ligne_contre_1', '#hidden_ligne_contre_1', '#ligne_contre_libelle_1')"/>
                <input type="hidden" value="" name="hidden_ligne_contre" id="hidden_ligne_contre_1" />
                <div name="ligne_contre_libelle" id="ligne_contre_libelle_1" class="mws-form-row" style="text-align: justify; margin-left: 2%;">

                </div>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" value="" name="ligne_compte" id="ligne_compte_2" onfocus="chargerCompte('#ligne_compte_2', '#hidden_ligne_compte_2', '#ligne_compte_libelle_2')" onkeyup="chargerCompte('#ligne_compte_2', '#hidden_ligne_compte_2', '#ligne_compte_libelle_2')"/>
                <input type="hidden" value="" name="hidden_ligne_compte" id="hidden_ligne_compte_2" />
                <div name="ligne_compte_libelle" id="ligne_compte_libelle_2" class="mws-form-row" style="text-align: justify; margin-left: 2%;">

                </div>
            </td>
            <td><input type="text" style="width: 100%;" value="" id="debit_2" readonly="true"/></td>
            <td><input class="align_right" style="width: 100%;" id="credit_2" type="text" value="<?php echo number_format($facture->getTimbre(), 3, '.', ' ') ?>" readonly="true"/></td>
            <td name="contre_partie" td_contre_id="2">
                <input type="text" value="" name="ligne_contre" id="ligne_contre_2" onfocus="chargerCompte('#ligne_contre_2', '#hidden_ligne_contre_2', '#ligne_contre_libelle_2')" onkeyup="chargerCompte('#ligne_contre_2', '#hidden_ligne_contre_2', '#ligne_contre_libelle_2')"/>
                <input type="hidden" value="" name="hidden_ligne_contre" id="hidden_ligne_contre_2" />
                <div name="ligne_contre_libelle" id="ligne_contre_libelle_2" class="mws-form-row" style="text-align: justify; margin-left: 2%;">

                </div>
            </td>
        </tr>
        <tr>
            <td <?php if (!$dossier->getIdComptevente()): ?>name="contre_partie" td_contre_id="3"<?php endif; ?>>
                <input type="text" value="<?php if ($dossier->getIdComptevente()) echo $dossier->getCompteVente(); ?>" name="ligne_compte" id="ligne_compte_3" onfocus="chargerCompte('#ligne_compte_3', '#hidden_ligne_compte_3', '#ligne_compte_libelle_3')" onkeyup="chargerCompte('#ligne_compte_3', '#hidden_ligne_compte_3', '#ligne_compte_libelle_3')"/>
                <input type="hidden" value="<?php if ($dossier->getIdComptevente()) echo $dossier->getIdComptevente(); ?>" name="hidden_ligne_compte" id="hidden_ligne_compte_3" />
                <div name="ligne_compte_libelle" id="ligne_compte_libelle_3" class="mws-form-row" style="text-align: justify; margin-left: 2%;">
                    <?php if ($dossier->getIdComptevente()) echo $dossier->getCompteVente(); ?>
                </div>
            </td>
            <td><input class="align_right" style="width: 100%;" type="text" id="debit_3" value="<?php echo number_format($facture->getTotalttc(), 3, '.', ' ') ?>" readonly="true"/></td>
            <td><input type="text" style="width: 100%;" value="" id="credit_3" readonly="true"/></td>
            <td name="contre_partie" td_contre_id="3">
                <input type="text" value="" name="ligne_contre" id="ligne_contre_3" onfocus="chargerCompte('#ligne_contre_3', '#hidden_ligne_contre_3', '#ligne_contre_libelle_3')" onkeyup="chargerCompte('#ligne_contre_3', '#hidden_ligne_contre_3', '#ligne_contre_libelle_3')"/>
                <input type="hidden" value="" name="hidden_ligne_contre" id="hidden_ligne_contre_3" />
                <div name="ligne_contre_libelle" id="ligne_contre_libelle_3" class="mws-form-row" style="text-align: justify; margin-left: 2%;">

                </div>
            </td>
        </tr>
    </tbody>
</table>

<div class="row">
    <div class="col-xs-4"></div>
    <div class="col-xs-8">
        <div class="widget-box">
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <table style="margin-bottom: 0px;" class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td style="width: 33%">
                                        <div class="mws-form-row">
                                            Total Débit :
                                            <div class="mws-form-item">
                                                <input class="align_right" id="total_debit" type="text" disabled="disabled" value="<?php echo number_format($facture->getTotalttc(), 3, '.', ' ') ?>" style="width: 100%;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 33%">
                                        <div class="mws-form-row">
                                            Total Crédit :
                                            <div class="mws-form-item">
                                                <input class="align_right" id="total_credit" type="text" disabled="disabled" value="<?php echo number_format($facture->getTotalttc(), 3, '.', ' ') ?>" style="width: 100%;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 33%">
                                        <div class="mws-form-row">
                                            Total Solde :
                                            <div class="mws-form-item">
                                                <input class="align_right" id="total_solde" type="text" disabled="disabled" value="0.000" style="width: 100%;">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function setJournal() {
        if ($("#maquette_id").val() != '0') {
            var id = $("#maquette_id").val();
            var journal = $("#option_" + id).attr("journal");
            var journal_id = $("#option_" + id).attr("journal_id");
            $("#journal_piece").val(journal);
            $("#id_journal_piece").val(journal_id);
            chargerMaquetteSaisie();
        } else {
            $("#journal_piece").val('');
            $("#id_journal_piece").val('');
            $("#tbody_maquette_saisie").html('');
            $('#total_credit').val('<?php echo number_format($facture->getTotalttc(), 3, '.', ' ') ?>');
            $('#total_debit').val('<?php echo number_format($facture->getTotalttc(), 3, '.', ' ') ?>');
            $('#total_solde').val('0.000');
        }
    }

    function chargerMaquetteSaisie() {
        $.ajax({
            url: '<?php echo url_for('importation/chargerMaquetteSaisie') ?>',
            data: 'id=' + $("#maquette_id").val() +
                    '&facture_id=' + '<?php echo $facture->getId() ?>' +
                    '&type_facture=' + 'achat',
            success: function (data) {
                $("#tbody_maquette_saisie").html(data);
                calculeTotal();
            }
        });
    }

    function calculeTotal() {
        var total_credit = 0;
        $('[name="ligne_credit"]').each(function () {
            var credit = $(this).val();
            credit = eval(credit.replace(/,/g, '.'));
            credit = Math.abs(credit);
            if (isNaN(credit))
                credit = 0;
            if (credit != '' && credit != 0) {
                total_credit = parseFloat(total_credit) + parseFloat(credit);
            }
        });
        var total_debit = 0;
        $('[name="ligne_debit"]').each(function () {
            var debit = $(this).val();
            debit = eval(debit.replace(/,/g, '.'));
            debit = Math.abs(debit);
            if (isNaN(debit))
                debit = 0;
            if (debit != '' && debit != 0) {
                total_debit = parseFloat(total_debit) + parseFloat(debit);
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

</script>

<script  type="text/javascript">
    var table = '';
    function chargerCompte(id1, id2, id3) {
        if ($(id1).val() != '') {
            $.ajax({
                url: '<?php echo url_for('saisie_pieces/compteparnumeroMaxChiffre') ?>',
                data: 'numero=' + $(id1).val(),
                success: function (data) {
                    var data = JSON.parse(data);

                    $(".testul ul").css('width', $(id2).width());
                    htmlins = '';
                    table = data;
                    $(".testul").remove();
                    if (data.length > 0) {
                        htmlins = '<div class="testul">' +
                                '<ul id="ul_compte" onkeydown="selectLi(event)" style="z-index: 9;">';
                        for (i = 0; i < data.length; i++) {
                            if (i == 0)
                                htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" id3="' + id3 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
                            else
                                htmlins += '<li data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" id3="' + id3 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
                        }
                        htmlins += '</ul></div>';
                    }
                    $(id1).after(htmlins);
                }
            });
        } else {
            $(id2).val('');
            $(id3).html('');
            $(id3).text();
        }
    }

    function clickSelectElement(value2, id1, id2, id3) {
        var valeu1 = "";
        for (i = 0; i < table.length; i++) {
            if (value2 - table[i].id === 0) {
                valeu1 = table[i].name;
                break;
            }
        }
        if (id1)
            $(id1).val(valeu1);
        if (id2)
            $(id2).val(value2);
        $(".testul").remove();
        $(id3).html(valeu1);
        $(id3).text();
    }
    var highlighted;
    function selectLi(event) {
        highlighted = $(".testul ul li[class=selected_li]");
        switch (event.keyCode) {
            case 38:
                if (highlighted && highlighted.prev().length > 0) {
                    $(".selected_li").removeClass("selected_li");
                    highlighted.prev().addClass("selected_li");
                }
                break;
            case 40:
                if (highlighted && highlighted.next().length > 0) {
                    $(".selected_li").removeClass("selected_li");
                    highlighted.next().addClass("selected_li");
                }
                break;
            case 13:
                if (highlighted) {
                    var data_li = highlighted.attr('data-li');
                    var id1 = highlighted.attr('id1');
                    var id2 = highlighted.attr('id2');
                    var id3 = highlighted.attr('id3');
                    clickSelectElement(data_li, id1, id2, id3);
                }
                break;
            case 27:
                $(".testul").remove();
                break;
        }
    }

    function removeUl() {
        $(".testul").remove();
    }

</script>

<script  type="text/javascript">

    $('#maquette_id').attr('class', "chosen-select form-control");
    $('#maquette_id').attr('style', 'width: 100%;');
    $('input:text').attr('style', 'width: 100%;');

    if (!ace.vars['touch']) {
        $('.chosen-select').chosen({allow_single_deselect: true});
        //resize the chosen on window resize

        $(window)
                .off('resize.chosen')
                .on('resize.chosen', function () {
                    $('.chosen-select').each(function () {
                        var $this = $(this);
                        $this.next().css({'width': $this.parent().width()});
                    })
                }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
            if (event_name != 'sidebar_collapsed')
                return;
            $('.chosen-select').each(function () {
                var $this = $(this);
                $this.next().css({'width': $this.parent().width()});
            })
        });


        $('#chosen-multiple-style .btn').on('click', function (e) {
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if (which == 2)
                $('#form-field-select-4').addClass('tag-input-style');
            else
                $('#form-field-select-4').removeClass('tag-input-style');
        });
    }

    $('.chosen-container').attr("style", "width: 100%;");
    $('.chosen-container').trigger("chosen:updated");

</script>

<style>
    .modal-dialog {width: 80%;}
</style>