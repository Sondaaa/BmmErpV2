<div id="sf_admin_container">
    <h1 id="replacediv"> Importation 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Liste des Factures Comptables Ventes : <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Liste des Factures Comptables Ventes :
            <?php
            $url = "type=vente&saisie=0";
            if ($reference != "")
                $url = $url . "&reference=" . $reference;
            if ($client != "")
                $url = $url . "&client=" . $client;
            ?>
            <a id="imprime_liste" target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" href="<?php echo url_for("importation/imprimeListe?" . $url); ?>">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
        </div>
        <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;">
            <table id="listFacture" class="mws-datatable-fn mws-table">
                <thead>
                    <tr style="border-bottom: 1px solid #000000">
                        <th style="width: 5%; text-align: center;">Numéro</th>
                        <th style="width: 8%; text-align: center;">Date</th>
                        <th style="width: 8%; text-align: center;">Référence</th>
                       <th style="width: 8%; text-align: center;">Code Client</th>
                        <th style="width: 20%;">Client</th>
                          <th style="width: 8%; text-align: center;">T.H.TAXE</th>
                           <th style="width: 8%; text-align: center;">T.Fodec</th>
                      
                        <th style="width: 8%; text-align: center;">Total Ht</th>
                        <th style="width: 8%; text-align: center;">Total Tva</th>
                        <th style="width: 8%; text-align: center;">Timbre</th>
                        <th style="width: 8%; text-align: center;">Total Ttc</th>
                        <th style="width: 10%; text-align: center;">Opérations</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th><input type="text" id="ref" onkeyup="goPage(1);" style="width: 100%;" /></th>
                        <th><input id="codeclient" onkeyup="goPage(1);" type="text" style="width: 100%;" /></th>
                       
                        <th><input id="client" onkeyup="goPage(1);" type="text" style="width: 100%;" /></th>
                        <th></th>
                        <th></th>
                         <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="text-align: center;">
                            <a title="Saisir tout les pièces par Maquette de Saisie" href="<?php echo url_for("importation/preparationMaquetteForAll?type=vente"); ?>" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-maxcdn"></i></a>
                        </th>
                    </tr>
                </thead>
                <tfoot>
                </tfoot>
                <tbody>
                    <?php include_partial("importation/liste_vente", array("pager" => $pager, "page" => $page, "reference" => $reference, "client" => $client)) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function validerCompte(id) {
        if ($('#compte').val() != '') {
            var compte = $('#compte').val();
            var ref = $('#ref').val();
            var client = $('#client').val();
            $.ajax({
                url: '<?php echo url_for('importation/validerCompteVente') ?>',
                data: 'compte=' + compte +
                        '&id=' + id +
                        '&reference=' + ref + '&client=' + client,
                success: function (data) {
                    $('#listFacture tbody').html(data);
                }
            });
        }
    }

    function affecterCompte(id) {
        $.ajax({
            url: '<?php echo url_for('importation/affecterCompteClientVente'); ?>',
            data: 'id=' + id,
            success: function (data) {
                bootbox.confirm({
                    message: data,
                    buttons: {
                        cancel: {
                            label: "Annuler",
                            className: "btn-sm",
                        },
                        confirm: {
                            label: "Valider",
                            className: "btn-primary btn-sm",
                        }
                    },
                    callback: function (result) {
                        if (result) {
                            validerCompte(id);
                        }
                    }
                });
            }
        });

    }

    function goPage(page) {
        var ref = $('#ref').val();
        var dossier = $('#dossier').val();
        var client = $('#client').val(); 
        var codeclient = $('#codeclient').val();
        $.ajax({
            url: '<?php echo url_for('importation/goPageVente'); ?>',
            data: 'page=' + page + '&reference=' + ref + '&client=' + client+'&codeclient='+codeclient,
            success: function (data) {
                $('#listFacture tbody').html(data);
            }
        });
    }

    function showFacture(id) {
        $.ajax({
            url: '<?php echo url_for('importation/showVente') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#ligne_facture').html(data);
            }
        });
    }

    function annulerFacture(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer cette importation de facture vente ?",
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {
                if (result) {
                    goAnnulerFacture(id);
                }
            }
        });
    }

    function goAnnulerFacture(id) {
        var ref = $('#ref').val();
        var client = $('#client').val();
        $.ajax({
            url: '<?php echo url_for('importation/annulerVente') ?>',
            data: 'id=' + id + '&reference=' + ref + '&client=' + client,
            success: function (data) {
                $('#listFacture tbody').html(data);
            }
        });
    }

    function preparationSaisir(id) {
        $.ajax({
            url: '<?php echo url_for('importation/preparationSaisirFactureVente') ?>',
            data: 'id=' + id,
            success: function (data) {
                bootbox.confirm({
                    message: data,
                    buttons: {
                        cancel: {
                            label: "Annuler",
                            className: "btn-sm",
                        },
                        confirm: {
                            label: "Enregistrer",
                            className: "btn-primary btn-sm",
                        }
                    },
                    callback: function (result) {
                        if (result) {
                            saisir(id);
                        }
                    }
                });
            }
        });
    }

    function saisir(id) {
        var id_compte = $("#hidden_ligne_compte_0").val() + ',' + $("#hidden_ligne_compte_1").val() + ',' + $("#hidden_ligne_compte_2").val() + ',' + $("#hidden_ligne_compte_3").val();
        var debit = $("#debit_0").val() + ';' + $("#debit_1").val() + ';' + $("#debit_2").val() + ';' + $("#debit_3").val();
        var credit = $("#credit_0").val() + ';' + $("#credit_1").val() + ';' + $("#credit_2").val() + ';' + $("#credit_3").val();
        var id_contre = $("#hidden_ligne_contre_0").val() + ',' + $("#hidden_ligne_contre_1").val() + ',' + $("#hidden_ligne_contre_2").val() + ',' + $("#hidden_ligne_contre_3").val();
        $.ajax({
            url: '<?php echo url_for('importation/saisirFactureVente') ?>',
            data: 'id=' + id +
                    '&id_compte=' + id_compte +
                    '&debit=' + debit +
                    '&credit=' + credit +
                    '&id_contre=' + id_contre +
                    '&journal_id=' + $('#journal_piece').val() +
                    '&date=' + $('#date_piece').val(),
            success: function (data) {
                $('#listFacture tbody').html(data);
            }
        });
    }

    function preparationMaquette(id) {
        $.ajax({
            url: '<?php echo url_for('importation/preparationMaquetteVente') ?>',
            data: 'id=' + id,
            success: function (data) {
                bootbox.confirm({
                    message: data,
                    buttons: {
                        cancel: {
                            label: "Annuler",
                            className: "btn-sm",
                        },
                        confirm: {
                            label: "Enregistrer",
                            className: "btn-primary btn-sm",
                        }
                    },
                    callback: function (result) {
                        if (result) {
                            saisirMaquette(id);
                        }
                    }
                });
            }
        });
    }

    function saisirMaquette(id) {
        if ($("#maquette_id").val()) {
            var id_compte = '';
            var debit = '';
            var credit = '';
            var id_contre = '';

            $('[name="hidden_ligne_compte"]').each(function () {
                var id_compte = id_compte + $(this).val() + ',';
            });
            $('[name="ligne_debit"]').each(function () {
                var debit = debit + $(this).val() + ';';
            });
            $('[name="ligne_credit"]').each(function () {
                var credit = credit + $(this).val() + ';';
            });
            $('[name="hidden_ligne_contre"]').each(function () {
                var id_contre = id_contre + $(this).val() + ',';
            });
            $.ajax({
                url: '<?php echo url_for('importation/saisirFactureVente') ?>',
                data: 'id=' + id +
                        '&id_compte=' + id_compte +
                        '&debit=' + debit +
                        '&credit=' + credit +
                        '&id_contre=' + id_contre +
                        '&journal_id=' + $('#id_journal_piece').val() +
                        '&date=' + $('#date_piece').val() +
                        '&total_credit=' + $('#total_credit').val() +
                        '&total_debit=' + $('#total_debit').val(),
                success: function (data) {
                    $('#listFacture tbody').html(data);
                }
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir une maquette de saisir !",
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

</script>

<style type="text/css">
    .header_table th{
        font-weight: bold;
        font-size: 13px;
    }
</style>