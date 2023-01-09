<?php use_helper('I18N', 'Date') ?>
<?php include_partial('mouvementbanciare/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Passer Bordereau', array(), 'messages') ?></h1>
    <?php
    $sDatedebut = date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y")));
    $d = new DateTime(date('Y-m-d'));
    $sDateFin = $d->format('Y-m-t');
    ?>

    <div id="sf_admin_bar">
        <div class="sf_admin_filter" style="float: left;">
            <div class="widget-body" style="display: block;" ng-controller="CtrlMouvement">
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
                                    <select id="mouvementbanciare_filters_id_banque" class="chosen-select form-control">
                                        <option value="0"></option>
                                        <?php foreach ($banques as $banque): ?>
                                            <option value="<?php echo $banque->getId(); ?>"><?php echo $banque->getLibelle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_id_type">
                                <td>
                                    <label for="mouvementbanciare_filters_id_type">Type d'opération</label></td>
                                <td>
                                    <select id="mouvementbanciare_filters_id_type" class="chosen-select form-control">
                                        <option value="0"></option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_id_nature">
                                <td>
                                    <label for="mouvementbanciare_filters_id_nature">Nature compte bénéficiaire</label></td>
                                <td>
                                    <select id="mouvementbanciare_filters_id_nature" class="chosen-select form-control">
                                        <option value="0"></option>
                                        <?php foreach ($natures_compte as $nc): ?>
                                            <option value="<?php echo $nc->getId(); ?>"><?php echo $nc->getLibelle(); ?></option>
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
        <div class="col-sm-4" style="float: right; font-size: 14px; text-align: justify;">
            <span class="text-danger">Remarques :</span>
            <br><br>
            <span class="text-primary"><i class="ace-icon fa fa-hand-o-right"></i> Un mouvement bancaire / CCP se trouve dans un <u>seul</u> bordereau de virement.</span>
            <br><br>
            <span class="text-primary"><i class="ace-icon fa fa-hand-o-right"></i> On peut attribuer que 4 virements au plus pour un bordereau <u>bancaire</u>.</span>
            <br><br>
            <span class="text-primary"><i class="ace-icon fa fa-hand-o-right"></i> On peut attribuer que 13 virements au plus pour un bordereau <u>postal</u>.</span>
            <br><br>
            <span class="text-primary"><i class="ace-icon fa fa-hand-o-right"></i> Un bordereau de virement bancaire / CCP contient un seul <u>type d'opération</u>, de même pour la <u>nature des comptes</u> des bénéficiaires.</span>
            <br>
        </div>
    </div>

    <div id="sf_admin_content" style="display: none;">

    </div>
</div>

<script>

    function goPage(page) {
        if ($("#mouvementbanciare_filters_id_banque").val() != '0' && $('#mouvementbanciare_filters_id_type').val() != '0' && $('#mouvementbanciare_filters_id_type').val() && $("#mouvementbanciare_filters_id_nature").val() != '0') {
            $.ajax({
                url: '<?php echo url_for('@getBordereau') ?>',
                data: 'page=' + page +
                        '&date_debut=' + $("#mouvementbanciare_filters_dateoperation_from").val() +
                        '&date_fin=' + $("#mouvementbanciare_filters_dateoperation_to").val() +
                        '&id_banque=' + $("#mouvementbanciare_filters_id_banque").val() +
                        '&id_type=' + $('#mouvementbanciare_filters_id_type').val() +
                        '&id_nature=' + $('#mouvementbanciare_filters_id_nature').val(),
                success: function (data) {
                    $('#sf_admin_content').html(data);
                    $('#sf_admin_content').fadeIn();
                }
            });
        } else {
            var message = "<span class='bigger-110' style='margin:20px;'>Veuillez choisir : </span><ul style='margin-left:160px;'>";
            if ($("#mouvementbanciare_filters_id_banque").val() == '0')
                message = message + "<li><span class='bigger-110'>le compte bancaire.</span></li>";
            if ($('#mouvementbanciare_filters_id_type').val() == '0' || !$('#mouvementbanciare_filters_id_type').val())
                message = message + "<li><span class='bigger-110'>le type d\'opération.</span></li>";
            if ($('#mouvementbanciare_filters_id_nature').val() == '0')
                message = message + "<li><span class='bigger-110'>la nature du compte bénéficiaire.</span></li>";
            message = message + '</ul>';
            bootbox.dialog({
                message: message,
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
    document.title = ("BMM - Banque : Passer Bordereau");
</script>

<style>

    .sf_admin_filter{float: left;}

</style>