<div id="sf_admin_container">
    <h1 id="replacediv"> Tiers 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Clients
        </small>
    </h1>
</div>
<div>
    <?php //if (sizeof($pager->getResults()) != 0): ?>
        <div class="col-sm-12">
            <table>
                <tr>
                    <td>
                        <b>Du</b><br>
                        <select id="client_min">
                            <option value=""></option>



                            <?php foreach ($pager->getResults() as $client): ?>
                                <option id="client_<?php echo $client->getId() ?>" value="<?php echo $client->getId() ?>">
                                    <?php if($client->getPlancomptable()!= null):?>
                                    <?php echo $client->getPlancomptable()->getNumerocompte() . ' ' . trim($client->getRs()) ?>

                                    <?php else:?>
                                    <?php echo  trim($client->getRs()) ?>

                                    <?php endif;?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        </br>
                        <b>Au</b>
                        <select id="client_max">
                            <option value=""></option>
                            <?php foreach ($pager->getResults() as $client): ?>
                                <option id="client_<?php echo $client->getId() ?>" value="<?php echo $client->getId() ?>"> 
                                    <?php if($client->getPlancomptable()!= null):?>
                                    <?php echo $client->getPlancomptable()->getNumerocompte() . ' ' . trim($client->getRs()) ?>

                                    <?php else:?>
                                    <?php echo  trim($client->getRs()) ?>

                                    <?php endif;?>
                                </option>
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
                    </td>
                </tr>
            </table>
            <div style="margin-bottom: 15px;" class="mws-panel-body no-padding">
                <div style="height: 360px; overflow: auto;" id="liste_clients">
                    <?php include_partial('tiers/list', array('pager' => $pager)); ?>
                </div>   
            </div>
        </div>
    <?php //endif; ?>
</div>


<script  type="text/javascript">

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('@listClient') ?>',
            data: 'page=' + page +
                    '&raison_sociale=' + $('#Raison_Sociale_client').val() +
                    '&code=' + $('#code_client').val() +
                    '&compte=' + $('#compte_client').val(),
            success: function (data) {
                $('#list_client > tbody').html(data);
                document.location.reload();
            }
        });
    }
    function show(id) {
        $.ajax({
            url: '<?php echo url_for('@showClient') ?>',
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
            url: '<?php echo url_for('@editClient') ?>',
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
            url: '<?php echo url_for('@updateClient') ?>',
            data: 'id=' + id +
                    '&compte_comptable=' + $('#compte').val() +
                    '&page=' + 1 +
                    '&raison_sociale=' + $('#Raison_Sociale_client').val() +
                    '&code=' + $('#code_client').val() +
                    '&compte=' + $('#compte_client').val(),
            success: function (data) {
                $('#list_client > tbody').html(data);
                document.location.reload();
            }
        });
    }
    function deleteClient(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer ce Client avec son facture de vente  ?",
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
            url: '<?php echo url_for('@deleteClient') ?>',
            data: 'id=' + id,
            success: function (data) {
//                $('#list_client > tbody').html(data);
                $('#liste_clients').html(data);
//                 document.location.reload();
            }
        });
    }
    function afficher() {
        $.ajax({
            url: '<?php echo url_for('tiers/afficherListClient') ?>',
            data: 'client_min=' + $('#client_min').val() + '&client_max=' + $('#client_max').val(),
            success: function (data) {
                $('#liste_clients').html(data);
            }
        });
    }
    function supprimer() {
        var message_text = "Voulez-vous supprimer ces Cients Avec Ses Factures de Vente? ";
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
            url: '<?php echo url_for('tiers/supprimerClients') ?>',
            data: 'client_min=' + $('#client_min').val() + '&client_max=' + $('#client_max').val(),
            success: function (data) {
                if (data != null) {
                    $('#liste_clients').html(data);
                    $('#client_min').val('');
                    $('#client_max').val('');
                    $('#client_min').trigger("chosen:updated");
                    $('.chosen-container').trigger("chosen:updated");
                    $('#client_max').trigger("chosen:updated");
                    $('.chosen-container').trigger("chosen:updated");
                }
//              document.location.reload();
            }
        });
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Tiers - Clients");
</script>