<?php use_helper('I18N', 'Date') ?>

<div id="sf_admin_container">
    <?php
    switch ($idtype) {
        case 2:
            $titre = " B.D.C";
            break;

        case 7:
            $titre = " B.C.E";
            break;

        case 20:
            $titre = "Contrat";
            break;

        default :
            $titre = "";
            break;
    }
    ?>
    <h1><?php echo __('Journal des mouvements' . $titre, array(), 'messages') ?></h1>
    <?php
    $sDatedebut = date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y")));
    $d = new DateTime(date('Y-m-d'));
    $sDateFin = $d->format('Y-m-t');
    ?>

    <div id="sf_admin_bar">
        <div class="sf_admin_filter" style=" width: 65%;">
            <div class="widget-body" style="display: block;">
                <form>
                    <table style="margin-bottom: 0px;" class="table table-bordered table-hover" cellspacing="0">
                        <tbody>
                            <tr class="sf_admin_form_row sf_admin_date sf_admin_filter_field_dateoperation">
                                <td><label for="mouvementbanciare_filters_dateoperation">Date d'opération</label></td>
                                <td>
                                    De <input type="date" value="<?php echo $sDatedebut; ?>" id="dateoperation_from">
                                    à <input type="date" value="<?php echo $sDateFin; ?>" id="dateoperation_to">
                                </td>
                            </tr>
                            <tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_id_fournisseur">
                                <td><label for="mouvementbanciare_filters_id_fournisseur">Fournisseur</label></td>
                                <td>
                                    <select id="fournisseur_id">
                                        <option value="0"></option>
                                        <?php foreach ($fournisseurs as $fr): ?>
                                            <option value="<?php echo $fr->getId(); ?>"><?php echo $fr->getReference() . ' - ' . $fr->getRs(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_id_facture">
                                <td><label for="mouvementbanciare_filters_id_facture">Facture</label></td>
                                <td><input id="facture" type="text" value="" /></td>
                            </tr>
                            <tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_etatfrs">
                                <td><label for="mouvementbanciare_filters_etatfrs">Situation Fiscale</label></td>
                                <td><select id="etatfrs">
                                        <option value=""></option>
                                        <option value="1">En Régle</option>
                                        <option value="0">En Défaut</option>
                                    </select></td>
                            </tr>
                            <tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_valide">
                                <td><label for="mouvementbanciare_filters_valide">Etat R.R.S + P.V.R</label></td>
                                <td>
                                    <select id="valide">
                                        <option value="">Tous</option>
                                        <option value="true">Validé</option>
                                        <option value="false">Non Validé</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <a onclick="" href="<?php echo url_for('lignemouvementfacturation/journal') ?>" class="btn btn-white btn-success">Effacer</a>
                                    <input type="submit" value="Filtrer" class="btn btn-white btn-success" onclick="goPage(1)">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <div id="sf_admin_content" style="display: none;">

    </div>
</div>

<script>
    goPage(1);
    function validerMouvement(id) {
        $.ajax({
            url: '<?php echo url_for('lignemouvementfacturation/valider') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#btn_' + id).hide();
            }
        });
    }

    function goPage(page) {
        console.log('page=' + page);
        $.ajax({
            url: '<?php echo url_for('lignemouvementfacturation/goPageJournal') ?>',
            data: 'page=' + page +
                    '&idtype=' + '<?php echo $idtype; ?>' +
                    '&valide=' + $("#valide").val() +
                    '&date_debut=' + $("#dateoperation_from").val() +
                    '&date_fin=' + $("#dateoperation_to").val() +
                    '&fournisseur_id=' + $("#fournisseur_id").val() +
                    '&facture=' + $('#facture').val() + '&etatfrs=' + $('#etatfrs').val(),
            success: function (data) {
                $('#sf_admin_content').html(data);
                $('#sf_admin_content').fadeIn();
            }
        });
    }
    function openPopupSupprimerForm(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer Ce Mouvement  ?",
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
//                    deletePieceForm(id);
                    testerExistancedufacture(id);
                }
            }
        });
    }
    function testerExistancedufacture(id) {
        $.ajax({
            url: '<?php echo url_for('lignemouvementfacturation/testerExistancefacture') ?>',
            data: 'id=' + id,
            success: function (data) {
//                data = $.trim(data);
                console.log('data=' + data);
                if (data.trim() == '1') {
                    bootbox.dialog({
                        message: 'Ce Mouvement a une Facture on ne peut pas le supprimer  !',
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
                else if (data.trim() == '0') {
                    deletePieceForm(id);
                }
            }

        });
    }
    function deletePieceForm(id) {
        $.ajax({
            url: '<?php echo url_for('lignemouvementfacturation/delete') ?>',
            data: 'id=' + id,
            success: function (data) {
                afficher();

            }
        });
    }
    function edit(id) {
        $.ajax({
            url: '<?php echo url_for('lignemouvementfacturation/editEtatFournisseur') ?>',
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
                            modifierEtat(id);
                        }
                    }
                });
            }
        });
    }
    function modifierEtat(id) {
        $.ajax({
            url: '<?php echo url_for('lignemouvementfacturation/updateEtatFournisseur') ?>',
            data: 'id=' + id +
                    '&etat_frs=' + $('#etat_frs').val() +
                    '&idtype=' + '<?php echo $idtype; ?>' +
                    '&valide=' + $("#valide").val() +
                    '&date_debut=' + $("#dateoperation_from").val() +
                    '&date_fin=' + $("#dateoperation_to").val() +
                    '&fournisseur_id=' + $("#fournisseur_id").val() +
                    '&facture=' + $('#facture').val(),
            success: function (data) {
                $('#sf_admin_content').html(data);
//                goPage(1);
//                document.location.reload();
            }
        });
    }
</script>

<script  type="text/javascript">
    document.title = ("BMM - Facturation : Journal des mouvements" + "<?php echo $titre; ?>");
</script>