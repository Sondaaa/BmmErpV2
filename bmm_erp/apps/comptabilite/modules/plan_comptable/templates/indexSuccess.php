<div id="sf_admin_container">
    <h1 id="replacediv"> Base Comptable 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Plan Comptable - Exercice <?php echo $_SESSION['exercice']; ?></small>
    </h1>
</div>

<div class="col-sm-12">
    <a target="_blank" href="<?php echo url_for('plan_comptable/imprimer') ?>" class="btn btn-app btn-danger radius-4" style="margin-bottom: 5px; width: 23%; padding: 10px 0 8px; float: left;">
        <i class="ace-icon fa fa-file-pdf-o bigger-170" style="margin: 0px; line-height: 30px;"></i>
        Exporter vers PDF (.pdf )
    </a>
    <a target="_blank" href="<?php echo url_for('plan_comptable/exporterExcel') ?>" class="btn btn-app btn-success radius-4" style="margin-bottom: 5px; width: 23%; padding: 10px 0 8px; float: left;">
        <i class="ace-icon fa fa-file-excel-o bigger-170" style="margin: 0px; line-height: 30px;"></i>
        Exporter vers Excel (.xlsx )
    </a>

    <a href="<?php echo url_for('@ajouterCompteComptable') ?>" class="btn btn-app btn-primary radius-4" style="margin-bottom: 5px; width: 23%; padding: 10px 0 8px;">
        <i class="ace-icon fa fa-plus-square-o bigger-170" style="margin: 0px; line-height: 30px;"></i>
        Ajouter Compte Comptable
    </a>
</div>
<div>
    <div class="col-sm-12">
        <table>
            <tr>
                <td>
                    <b>Du</b><br>
                    <select id="compte_min">
                        <option value=""></option>
                        <?php foreach ($comptes as $compte): ?>
                            <option id="compte_<?php echo $compte->getId() ?>" value="<?php echo $compte->getNumerocompte() ?>"> <?php echo $compte->getNumerocompte() . ' ' . trim($compte->getLibelle()) ?> </option>
                        <?php endforeach; ?>
                    </select>
                    </br>
                    <b>Au</b>
                    <select id="compte_max">
                        <option value=""></option>
                        <?php foreach ($comptes as $compte): ?>
                            <option id="compte_<?php echo $compte->getId() ?>" value="<?php echo $compte->getNumerocompte() ?>"> <?php echo $compte->getNumerocompte() . ' ' . trim($compte->getLibelle()) ?> </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="text-align: center;">
                    <button style="cursor:pointer;margin-top: 2px;min-width: 118px " onclick="supprimerAll()" class="btn btn-sm btn-danger">
                        <i class="ace-icon fa fa-remove icon-on-right bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Supprimer</span>
                    </button>
                    <button style="cursor:pointer;margin-top: 2px;min-width: 118px " onclick="afficher()" class="btn btn-sm btn-primary"> 
                        <i class="ace-icon fa fa-eye bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Afficher</span>
                    </button>
                </td>
            </tr>
        </table>

    </div>
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
    <div style="height: 360px; overflow: auto;" id="liste_compte">
        <?php include_partial('plan_comptable/list_comptes_plan_dossier', array('comptes' => $comptes)); ?>
    </div>
    <hr>
</div>

<script  type="text/javascript">
    function afficher() {
        $.ajax({
            url: '<?php echo url_for('plan_comptable/afficherLisCompte') ?>',
            data: 'compte_min=' + $('#compte_min').val() + '&compte_max=' + $('#compte_max').val(),
            success: function (data) {
                $('#liste_compte').html(data);
            }
        });
    }
    function supprimerAll() {
        var message_text = "Voulez-vous supprimer ces Comptes Comptables? ";
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
                    validerAllSuppressionAll();
                }
            }
        });
    }

    function validerAllSuppressionAll() {

        $.ajax({
            url: '<?php echo url_for('plan_comptable/supprimerComptes') ?>',
            data: 'compte_min=' + $('#compte_min').val() + '&compte_max=' + $('#compte_max').val(),
            success: function (data) {
                if (data != null) {
                    $('#liste_compte').html(data);
//                    $('#compte_min').val('');
//                    $('#compte_max').val('');
                    $('#compte_min').trigger("chosen:updated");
                    $('.chosen-container').trigger("chosen:updated");
                    $('#compte_max').trigger("chosen:updated");
                    $('.chosen-container').trigger("chosen:updated");
                }
//              document.location.reload();
            }
        });
    }
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
                        '&libelle=' + $('#libelle_edit').val() + '&code=' + $('#code').val(),
//                        '&nature=' + $('#nature_edit').val() +
//                        '&lettrage=' + $('#lettrage_edit').val() +
//                        '&devise=' + $('#devise_edit').val(),
                success: function (data) {
                    $('#liste_compte').html(data);
                    $('#search_numero').val('');
                }
            });
        } else {
            return;
        }
    }

    function supprimer(id, numero) {
        var message_text = "Voulez-vous supprimer ce compte comptable ?<br> Compte comptable numéro : " + numero;
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
            url: '<?php echo url_for('@deleteCompteComptable') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#liste_compte').html(data);
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