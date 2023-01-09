<legend>Edition des Annexes Budgétaires :</legend>
<?php
if ($form->getObject()->isNew()) {
    $annexe_id = "";
    $titre = "";
    $nbr_colonne = "";
    $direction = "left";
    $sommation = false;
} else {
    $annexe = $form->getObject();
    $annexe_id = $annexe->getId();
    $titre = $annexe->getTitre();
    $nbr_colonne = $annexe->getNbrcolonne();
    $direction = $annexe->getDirection();
    $sommation = $annexe->getSommation();
}
?>
<div class="col-xs-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-blue ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>
                Tableau Annexe / Rubrique Budgétaire
            </h5>
            <div class="widget-toolbar">
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table style="margin-bottom: 15px !important;">
                        <thead>
                            <tr>
                                <th style="width: 45%;">Titre du Tableau</th>
                                <th style="width: 16%; text-align: center;">Nombre de Colonnes</th>
                                <th style="width: 13%; text-align: center;">Direction</th>
                                <th style="width: 16%; text-align: center;">Ligne de Sommation</th>
                                <th style="width: 10%; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input id="titre" type="text" value="<?php echo $titre; ?>"></td>
                                <td><input id="nbr_colonne" class="align_center" type="text" value="<?php echo $nbr_colonne; ?>"></td>
                                <td>
                                    <select id="direction">
                                        <option <?php if ($direction == "left"): ?>selected="true"<?php endif; ?> value="left">Gauche</option>
                                        <option <?php if ($direction == "right"): ?>selected="true"<?php endif; ?> value="right">Droite</option>
                                    </select>
                                </td>
                                <td style="text-align: center;"><input id="sommation" type="checkbox" <?php if ($sommation): ?>checked="true"<?php endif; ?>></td>
                                <td style="text-align: center;"><span class="btn btn-primary btn-xs" onclick="genererTable()"><i class="ace-icon fa fa-arrow-down bigger-110 icon-only"></i> Générer</span></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row" id="zone_edit_table">
                        <?php if (!$form->getObject()->isNew()): ?>
                            <?php include_partial('annexebudget/tableAnnexe', array('annexe' => $annexe)); ?>
                        <?php endif; ?>
                    </div>
                    <div class="row" id="zone_show_table">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="annexe_id" value="<?php echo $annexe_id; ?>">

<script  type="text/javascript">

    $(document).ready(function () {
        $("#direction").val('<?php echo $direction; ?>');
    });

    function genererTable() {
        if ($("#nbr_colonne").val() != '' && $("#titre").val() != '' && $("#sommation").val() != '') {
            $("#zone_edit_table").html('');
            $("#zone_show_table").html('');
            $.ajax({
                url: '<?php echo url_for('annexebudget/genererTableAnnexe') ?>',
                data: 'titre=' + $("#titre").val() +
                        '&nbr=' + $("#nbr_colonne").val() +
                        '&direction=' + $("#direction").val() +
                        '&sommation=' + $("#sommation").is(":checked"),
                success: function (data) {
                    $("#zone_edit_table").html(data);
                }
            });
        }
    }

</script>