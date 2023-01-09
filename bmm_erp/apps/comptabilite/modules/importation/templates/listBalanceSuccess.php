
<div id="sf_admin_container">
    <h1 id="replacediv"> Base Comptable 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Balance - Exercice <?php echo $_SESSION['exercice_id']; ?></small>
    </h1>
</div>


<table>
    <tr>
        <td style="width: 25%">
            <label class="mws-form-label">Numéro du Compte Comptable :</label>
            <div class="mws-form-item">
                <input class="large" type="text" id="search_numero" onkeyup="searchByNumeroAndLibelle()">
            </div>
        </td>
        <td style="width: 50%">
            <label class="mws-form-label">Intitulé du Compte Comptable :</label>
            <div class="mws-form-item">
                <input class="large" type="text" id="search_libelle" onkeyup="searchByNumeroAndLibelle()">
            </div>
        </td>
        <td style="width: 15%">
            <label class="mws-form-label">Classe comptable :</label>
            <div class="mws-form-item">
                <select id="class_comptable" onchange="searchByNumeroAndLibelle()">
                    <option value="">Tous les classes</option>
                    <?php foreach ($classes as $cc): ?>
                        <option value="<?php echo $cc->getId(); ?>"><?php echo $cc->getLibelle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </td>
    </tr>
</table>

<div class="mws-panel-body no-padding" style="margin-bottom: 15px;">
    <div style="height: 360px; overflow: auto;" id="liste_compte_balance">
        <?php include_partial('importation/list_comptes_balance', array('comptes' => $comptes)); ?>
    </div>
    <hr>
</div>

<script  type="text/javascript">

    function searchByNumeroAndLibelle() {
        var libelle = '';
        var numero = '';
        var class_compte = '';
        var motiflib = $('#search_libelle').val();
        var motifnum = $('#search_numero').val();
        var motifclass = $('#class_comptable').val();
        motiflib = motiflib.toUpperCase();
        $('#myTable01 tbody tr').each(function () {
            libelle = $(this).attr('data_libelle');
            libelle = libelle.toUpperCase();
            numero = $(this).attr('data_number');
            class_compte = $(this).attr('data_class');
            var indexlib = libelle.indexOf(motiflib);
            var indexnum = numero.indexOf(motifnum);
            var indexclass = class_compte.indexOf(motifclass);
            if (indexlib >= 0 && indexnum >= 0 && indexclass >= 0) {
                $(this).css('display', '');
            }
            else {
                $(this).css('display', 'none');
            }
        });
    }

    function show(id) {
        $.ajax({
            url: '<?php echo url_for('@showCompteComptable') ?>',
            data: 'id=' + id,
            success: function (data) {
                bootbox.dialog({
                    message: data,
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
        });
    }

    function edit(id) {
        $.ajax({
            url: '<?php echo url_for('@showEditCompteComptable') ?>',
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
                            modifierCompte(id);
                        }
                    }
                });

                $('.chosen-container').attr("style", "width: 100%;");
                $('.chosen-container').trigger("chosen:updated");
            }
        });
    }

    function modifierCompte(id) {
        if ($('#libelle_edit').val() != '') {
            $.ajax({
                url: '<?php echo url_for('@updateCompteComptable') ?>',
                data: 'id=' + id +
                        '&libelle=' + $('#libelle_edit').val(),
//                        '&nature=' + $('#nature_edit').val() +
//                        '&lettrage=' + $('#lettrage_edit').val() +
//                        '&devise=' + $('#devise_edit').val(),
                success: function (data) {
                    $('#liste_compte').html(data);
                }
            });
        } else {
            return;
        }
    }

    function supprimer(id, numero) {
        var message_text = "Voulez-vous supprimer les soldes du compte comptable    ?<br> Compte comptable numéro : " + numero;
        bootbox.confirm({
            message: message_text,
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
                    validerSuppression(id);
                }
            }
        });
    }

    function validerSuppression(id) {
        $.ajax({
            url: '<?php echo url_for('@deleteSoldeCompteComptable') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#liste_compte_balance').html(data);
            }
        });
    }

</script>

<style>

    .ligne_compte {cursor: pointer;}
    #myTable01 tr td{vertical-align: middle;}

</style>

<script  type="text/javascript">
    document.title = ('BMM - G. Compta. : Plan Comptable');
</script>