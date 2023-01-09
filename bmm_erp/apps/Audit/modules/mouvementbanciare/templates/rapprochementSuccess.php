<?php use_helper('I18N', 'Date') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Rapprochement des mouvements bancaires / Postaux', array(), 'messages') ?></h1>
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
                                    <label for="mouvementbanciare_filters_id_banque">Compte</label></td>
                                <td>
                                    <select id="mouvementbanciare_filters_id_banque" class="chosen-select form-control" style="width: 100%; display: none;">
                                        <option value="0"></option>
                                        <?php foreach ($banques as $banque): ?>
                                            <option value="<?php echo $banque->getId(); ?>"><?php echo $banque->getLibelle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <a onclick="" href="<?php echo url_for('mouvementbanciare/rapprochement') ?>" class="btn btn-white btn-success">Effacer</a>
                                    <input type="submit" value="Filtrer" class="btn btn-white btn-success" onclick="goPage(1)">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
        <div style="width: 32%; float: right;">
            <h3>Légende</h3>
            <hr style="margin-top: 10px;">
            <div class="row" style="margin: 0px 0px 10px 0px;"><div style="background-color: #FFFFFF; width: 10%; height: 20px; border: 1px solid #333D3F; float: left;"></div> <div style="float: right; width: 85%;">Mouvement non rapproché.</div></div>
            <div class="row" style="margin: 0px 0px 10px 0px;"><div style="background-color: #E7E7E7; width: 10%; height: 20px; border: 1px solid #333D3F; float: left;"></div> <div style="float: right; width: 85%;">Mouvement rapproché.</div></div>
            <div class="row" style="margin: 0px 0px 10px 0px;"><div style="background-color: #FFE1E1; width: 10%; height: 20px; border: 1px solid #333D3F; float: left;"></div> <div style="float: right; width: 85%;">Mouvement Annulé.</div></div>
        </div>
    </div>

    <div id="sf_admin_content" style="display: none;">

    </div>
</div>

<script  type="text/javascript">

    function goPage(page) {
        if ($("#mouvementbanciare_filters_id_banque").val() != '0') {
            $.ajax({
                url: '<?php echo url_for('mouvementbanciare/goPageRapprochement') ?>',
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

</script>

<script  type="text/javascript">
    document.title = ("BMM - C.Gestion : Rapprochement des mouvements bancaires / Postaux");
</script>

<style>

    .sf_admin_filter{float: left;}

</style>