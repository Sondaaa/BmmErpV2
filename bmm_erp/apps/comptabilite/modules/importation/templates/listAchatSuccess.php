<div id="sf_admin_container">
    <h1 id="replacediv"> Importation 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Liste des factures comptables Achats : <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Liste des Factures Comptables Achats :
            <?php
            $url = "type=achat&saisie=0";
            if ($reference != "")
                $url = $url . "&reference=" . $reference;
            if ($fournisseur != "")
                $url = $url . "&fournisseur=" . $fournisseur;
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
                        <th style="width: 10%; text-align: center;">Numéro</th>
                        <th style="width: 9%; text-align: center;">Date</th>
                        <th style="width: 10%; text-align: center;">Référence</th>
                        <th style="width: 23%;">Fournisseur</th>
                        <th style="width: 10%; text-align: center;">Total HT</th>
                        <th style="width: 10%; text-align: center;">Total TVA</th>
                        <th style="width: 8%; text-align: center;">Timbre</th>
                        <th style="width: 10%; text-align: center;">Total TTC</th>
                        <th style="width: 10%; text-align: center;">Opérations</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th><input type="text" id="ref" class="align-center" onkeyup="goPage(1);" /></th>
                        <th><input id="fournisseur" onkeyup="goPage(1);" type="text" /></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="text-align: center;">
                            <a title="Saisir tout les pièces par Maquette de Saisie" href="<?php echo url_for("importation/preparationMaquetteForAll?type=achat"); ?>" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-maxcdn"></i></a>
                        </th>
                    </tr>
                </thead>
                <tfoot>
                </tfoot>
                <tbody>
                    <?php include_partial("importation/liste_achat", array("pager" => $pager, "page" => $page, "reference" => $reference, "fournisseur" => $fournisseur)) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function validerCompte(id) {
        if ($('#compte').val() != '') {
            var compte = $('#compte').val();
            var reference = $('#ref').val();
            var fournisseur = $('#fournisseur').val();
            $.ajax({
                url: '<?php echo url_for('importation/validerCompteAchat') ?>',
                data: 'compte=' + compte +
                        '&id=' + id +
                        '&reference=' + reference +
                        '&fournisseur=' + fournisseur,
                success: function (data) {
                    $('#listFacture tbody').html(data);
                }
            });
        }
    }

    function affecterCompte(id) {
        $.ajax({
            url: '<?php echo url_for('importation/affecterCompteFournisseurAchat'); ?>',
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
        var fournisseur = $('#fournisseur').val();
        $.ajax({
            url: '<?php echo url_for('importation/goPageAchat'); ?>',
            data: 'page=' + page + '&reference=' + ref + '&fournisseur=' + fournisseur,
            success: function (data) {
                $('#listFacture tbody').html(data);
            }
        });
    }

    function showFacture(id) {
        $.ajax({
            url: '<?php echo url_for('importation/showAchat') ?>',
            data: 'id=' + id,
            success: function (data) {
                bootbox.dialog({
                    message: data,
                    buttons: {
                        "success": {
                            "label": "OK",
                            "className": "btn-sm btn-primary"
                        }
                    }
                });
            }
        });
    }

    function annulerFacture(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer cette importation de facture achat ?",
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
        var fournisseur = $('#fournisseur').val();
        $.ajax({
            url: '<?php echo url_for('importation/annulerAchat') ?>',
            data: 'id=' + id + '&reference=' + ref + '&fournisseur=' + fournisseur,
            success: function (data) {
                $('#listFacture tbody').html(data);
            }
        });
    }

    function preparationSaisir(id) {
        $.ajax({
            url: '<?php echo url_for('importation/preparationSaisirFactureAchat') ?>',
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

 function preparationSaisirBDCREG(id) {
        $.ajax({
            url: '<?php echo url_for('importation/preparationSaisirFactureAchatBDCReg') ?>',
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
        var numero_externe = $("#numero_externe").val();
        var id_compte = $("#hidden_ligne_compte_0").val() + ','
                + $("#hidden_ligne_compte_1").val() + ','
                + $("#hidden_ligne_compte_2").val();
        var debit = $("#debit_0").val() + ';' + $("#debit_1").val() + ';' + $("#debit_2").val();

        var credit = $("#credit_0").val() + ';' + $("#credit_1").val() + ';' + $("#credit_2").val();
        var id_contre = $("#hidden_ligne_contre_0").val() + ',' + $("#hidden_ligne_contre_1").val() + ',' + $("#hidden_ligne_contre_2").val();
        $.ajax({
            url: '<?php echo url_for('importation/saisirFactureAchat') ?>',
            data: 'id=' + id +
                    '&id_compte=' + id_compte +
                    '&numero_externe=' + numero_externe +
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
            url: '<?php echo url_for('importation/preparationMaquetteAchat') ?>',
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

            $('input[name="hidden_ligne_compte"]').each(function () {
                id_compte = id_compte + $(this).val() + ',';
            });
            $('input[name="ligne_debit"]').each(function () {
                debit = debit + $(this).val() + ';';
            });
            $('input[name="ligne_credit"]').each(function () {
                credit = credit + $(this).val() + ';';
            });
            $('input[name="hidden_ligne_contre"]').each(function () {
                id_contre = id_contre + $(this).val() + ',';
            });

            $.ajax({
                url: '<?php echo url_for('importation/saisirFactureAchat') ?>',
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