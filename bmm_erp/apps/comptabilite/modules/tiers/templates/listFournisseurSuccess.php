<div id="sf_admin_container">
    <h1 id="replacediv"> Tiers 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Fournisseurs
        </small>
    </h1>
</div>
<div>
    <div class="col-sm-12">
        <table>
            <tr>
                <td>
                    <b>Du</b><br>
                    <select id="fournisseur_min">
                        <option value=""></option>
                        <?php foreach ($pager as $fournisseur): ?>
                            <option id="fournisseur_<?php echo $fournisseur->getId() ?>" value="<?php echo $fournisseur->getId() ?>"> <?php echo  trim($fournisseur->getRs()) ?> </option>
                        <?php endforeach; ?>
                    </select>
                    </br>
                    <b>Au</b>
                    <select id="fournisseur_max">
                        <option value=""></option>
                        <?php foreach ($pager as $fournisseur): ?>
                            <option id="fournisseur_<?php echo $fournisseur->getId() ?>" value="<?php echo $fournisseur->getId() ?>"> <?php echo 'Code' . trim($fournisseur->getCodefrs()) . ' - Rs  ' . trim($fournisseur->getRs()) ?> </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="text-align: center;">
                    <button style="cursor:pointer;margin-top: 2px;min-width: 118px " onclick="supprimer()" class="btn btn-sm btn-danger">
                        <i class="ace-icon fa fa-remove icon-on-right bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Supprimer</span>
                    </button>
                    <button style="cursor:pointer;margin-top: 2px;min-width: 118px " onclick="afficher()" class="btn btn-sm btn-primary"> 
                        <i class="ace-icon fa fa-eye bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Afficher</span>
                    </button>
                     <br><br>

           
              <button style="font-size: 14px !important; font-weight: bold !important;" 
                    onclick="exportFournisseur()" class=" btn btn-primary">
                <i class="ace-icon fa fa-file_excel-o"></i> Exporter Liste des Fournisseurs vers Excel (.xlsx )
            </button>
                </td>
            </tr>
        </table>

        <div style="margin-bottom: 15px;" class="mws-panel-body ">
            <div style="height: 360px; overflow: auto;" id="liste_fournisseur">
                <?php include_partial('tiers/list_frs', array('pager' => $pager)); ?>
            </div>   
        </div>
    </div>
</div>


<script  type="text/javascript">

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('@listFournisseur') ?>',
            data: 'page=' + page +
                    '&raison_sociale=' + $('#Raison_Sociale_fournisseur').val() +
                    '&code=' + $('#code_fournisseur').val() +
                    '&compte=' + $('#compte_fournisseur').val(),
            success: function (data) {
                $('#list_fournisseur tbody').html(data);
            }
        });
    }
    function show(id) {
        $.ajax({
            url: '<?php echo url_for('@showFournisseur') ?>',
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
            url: '<?php echo url_for('@editFournisseur') ?>',
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
            }
        });
    }

    function modifierCompte(id) {
        $.ajax({
            url: '<?php echo url_for('@updateFournisseur') ?>',
            data: 'id=' + id +
                    '&compte_comptable=' + $('#compte').val() +
                    '&page=' + 1 +
                    '&raison_sociale=' + $('#Raison_Sociale_fournisseur').val() +
                    '&code=' + $('#code_fournisseur').val() +
                    '&compte=' + $('#compte_fournisseur').val(),
            success: function (data) {
                $('#list_fournisseur tbody').html(data);
                  document.location.reload();
            }
        });
    }
    function deleteFournisseur(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer ce Fournisseur avec son facture de achat  ?",
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
            url: '<?php echo url_for('@deleteFournisseur') ?>',
            data: 'id=' + id,
            success: function (data) {
//                $('#list_fournisseur > tbody').html(data);
//                 $('#liste_fournisseur').html(data);
                  $('#liste_fournisseur').html(data);
//                document.location.reload();
            }
        });
    }
    function afficher() {
        $.ajax({
            url: '<?php echo url_for('tiers/afficherListFournisseur') ?>',
            data: 'fournisseur_min=' + $('#fournisseur_min').val() + '&fournisseur_max=' + $('#fournisseur_max').val(),
            success: function (data) {
                  $('#liste_fournisseur').html(data);

            }
        });
    }
    function supprimer() {
        var message_text = "Voulez-vous supprimer ces Fournisseurs Avec Ses Factures d'Achat ? ";
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
                    validerAllSuppression();
                }
            }
        });
    }

    function validerAllSuppression() {

        $.ajax({
            url: '<?php echo url_for('tiers/supprimerFournisseur') ?>',
            data: 'fournisseur_min=' + $('#fournisseur_min').val() + '&fournisseur_max=' + $('#fournisseur_max').val(),
            success: function (data) {
                if (data != null) {
                    $('#liste_fournisseur').html(data);
                    $('#fournisseur_min').val('');
                    $('#fournisseur_max').val('');
                    $('#fournisseur_min').trigger("chosen:updated");
                    $('.chosen-container').trigger("chosen:updated");
                    $('#fournisseur_max').trigger("chosen:updated");
                    $('.chosen-container').trigger("chosen:updated");
                }
//              
            }
        });
    }
</script>
<script  type="text/javascript">
      function exportFournisseur() {
        var url = '';

//        if ($('#fournisseur_filters_rs').val() != '')
//        {
//            if (url == '')
//                url = 'rs=' + $('#fournisseur_filters_rs').val();
//            else
//                url = url + '&rs=' + $('#fournisseur_filters_rs').val();
//        }
//
//        if ($('#fournisseur_filters_id_famillearticle').val() != '')
//        {
//            if (url == '')
//                url = '?id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
//            else
//                url = url + '&id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
//        }
//        if ($('#fournisseur_filters_id_activite').val() != '')
//        {
//            if (url == '')
//                url = '?id_activite=' + $('#fournisseur_filters_id_activite').val();
//            else
//                url = url + '&id_activite=' + $('#fournisseur_filters_id_activite').val();
//        }

        url = '<?php echo url_for('tiers/exporterFourniseseurExcel') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
   
</script>
<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Tiers - Fournisseurs");
</script>