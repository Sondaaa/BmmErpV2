<?php use_helper('I18N', 'Date') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Suivi Solde Caisse', array(), 'messages') ?></h1>
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

                            <tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_id_banque">
                                <td>
                                    <label for="mouvementbanciare_filters_id_banque">Caisse</label></td>
                                <td>
                                    <select id="mouvementbanciare_filters_id_banque" class="chosen-select form-control">
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
                                    <a onclick="" href="<?php echo url_for('mouvementbanciare/suivisoldecaisse') ?>" class="btn btn-white btn-success">Effacer</a>
                                    <input type="submit" value="Filtrer" class="btn btn-white btn-success" onclick="goPage(1)">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <div id="sf_admin_content" >
        <?php include_partial('list_caisse', array("caisses" => $caisses)); ?>
    </div>
</div>
<script>

    function goPage(page) {
        if ($("#mouvementbanciare_filters_id_banque").val() != '0') {
            $.ajax({
                url: '<?php echo url_for('mouvementbanciare/goPageJournal') ?>',
                data: 'page=' + page +
                        '&id_banque=' + $("#mouvementbanciare_filters_id_banque").val(),
                success: function (data) {
                    $('#sf_admin_content').html(data);
                    $('#sf_admin_content').fadeIn();
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Veuillez choisir une caisse !</span>",
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
    document.title = ("BMM - Banque : Journal des mouvements");
</script>