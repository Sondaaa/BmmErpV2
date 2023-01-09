<?php use_helper('I18N', 'Date') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Relevé des mouvements', array(), 'messages') ?></h1>
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
                                <td>
                                    <label for="mouvementbanciare_filters_dateoperation">Date d'opération</label>    </td>
                                <td>
                                    De <input type="date" value="<?php echo $sDatedebut; ?>" id="mouvementbanciare_filters_dateoperation_from">
                                    à <input type="date" value="<?php echo $sDateFin; ?>" id="mouvementbanciare_filters_dateoperation_to">
                                </td>
                            </tr>
                            <tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_id_banque">
                                <td>
                                    <label for="mouvementbanciare_filters_id_banque">Caisse & Banque</label></td>
                                <td>
                                    <select id="mouvementbanciare_filters_id_banque" class="chosen-select form-control" style="width: 100%; display: none;">
                                        <option value="0"></option>
                                        <?php foreach ($caisses as $caisse): ?>
                                            <option value="<?php echo $caisse->getId(); ?>"><?php echo $caisse->getLibelle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <a onclick="" href="<?php echo url_for('mouvementbanciare') ?>" class="btn btn-white btn-success">Effacer</a>
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

<script  type="text/javascript">

    function goPage(page) {
        if ($("#mouvementbanciare_filters_id_banque").val() != '0') {
            $.ajax({
                url: '<?php echo url_for('mouvementbanciare/goPage') ?>',
                data: 'page=' + page +
                        '&date_debut=' + $("#mouvementbanciare_filters_dateoperation_from").val() +
                        '&date_fin=' + $("#mouvementbanciare_filters_dateoperation_to").val() +
                        '&id_banque=' + $("#mouvementbanciare_filters_id_banque").val(),
                success: function (data) {
                    $('#sf_admin_content').html(data);
                    $('#sf_admin_content').fadeIn();
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Veuillez choisir un compte bancaire !</span>",
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

    function supprimerMouvement(id, relation_existe) {
        var message = '<span style="font-size: 16px;">Voulez-vous vraiment annuler ce mouvement ?</span>';
        if (relation_existe > 0) {
            message = message + '<br><br><span style="font-size: 16px;">Ce mouvement est en relation avec un autre mouvement (Cas du transfert entre les caisses) qui va être de même annulé.</span>';
        }

        bootbox.confirm({
            message: message,
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
                    goSupprimerMouvement(id);
                }
            }
        });
    }

    function goSupprimerMouvement(id) {
        $.ajax({
            url: '<?php echo url_for('mouvementbanciare/supprimerMouvement') ?>',
            data: 'page=1' +
                    '&date_debut=' + $("#mouvementbanciare_filters_dateoperation_from").val() +
                    '&date_fin=' + $("#mouvementbanciare_filters_dateoperation_to").val() +
                    '&id_banque=' + $("#mouvementbanciare_filters_id_banque").val() +
                    '&id=' + id,
            success: function (data) {
                $('#sf_admin_content').html(data);
                $('#sf_admin_content').fadeIn();
            }
        });
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - C.Gestion : Relevé des mouvements");
</script>