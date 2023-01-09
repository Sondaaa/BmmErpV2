<div id="sf_admin_container">
    <h1 id="replacediv"> Annexes Budgétaires
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            <?php echo $annexe->getTitre(); ?>
        </small>
    </h1>
</div>

<?php
$annexe_id = $annexe->getId();
$titre = $annexe->getTitre();
$nbr_colonne = $annexe->getNbrcolonne();
$direction = $annexe->getDirection();
$sommation = $annexe->getSommation();
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
                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="8" style="text-align: center; font-size: 16px; padding: 5px;">
                                            <span style="float: left; color: #006ea6;">
                                                <?php if ($direction == "gauche"): ?>
                                                    Gauche <i class="ace-icon fa fa-arrow-right"></i>
                                                <?php else: ?>
                                                    <i class="ace-icon fa fa-arrow-left"></i> Droite
                                                <?php endif; ?>
                                            </span>
                                            <?php echo $titre; ?>
                                            <span class="btn btn-xs btn-success pull-right" onclick="showTableEdit()"><i class="ace-icon fa fa-eye bigger-110 icon-only"></i> Afficher</span>
                                        </th>
                                    </tr>
                                    <tr style="font-size: 14px;">
                                        <th style="width: 7%; text-align: center;">Rang</th>
                                        <th style="width: 33%;">Colonne</th>
                                        <th style="width: 12%; text-align: center;">Type</th>
                                        <th style="width: 12%; text-align: center;">Nature</th>
                                        <th style="width: 20%; text-align: center;">Formule</th>
                                        <th style="width: 9%; text-align: center; <?php if ($sommation == false): ?>display: none;<?php endif; ?>">Sommation</th>
                                        <th style="width: 7%; text-align: center;">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_generate">
                                    <?php $ligne_annexes = AnnexebudgetligneTable::getInstance()->getByAnnexe($annexe->getId()); ?>
                                    <?php foreach ($ligne_annexes as $ligne_annexe): ?>
                                        <tr id="tr_<?php echo $ligne_annexe->getId(); ?>">
                                            <td><input type="text" class="align_center" name="rang" value="<?php echo $ligne_annexe->getRang(); ?>" readonly="true"></td>
                                            <td><input type="text" name="colonne" value="<?php echo $ligne_annexe->getLibelle(); ?>" <?php if ($direction != "left"): ?>class="align_right"<?php endif; ?> readonly="true"></td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="hidden" id="type_<?php echo $ligne_annexe->getId(); ?>" value="<?php echo $ligne_annexe->getType(); ?>">
                                                <?php if ($ligne_annexe->getType() == "text"): ?>Texte
                                                <?php elseif ($ligne_annexe->getType() == "date"): ?>Date
                                                <?php elseif ($ligne_annexe->getType() == "montant"): ?>Montant
                                                <?php elseif ($ligne_annexe->getType() == "quantite"): ?>Quantité
                                                <?php elseif ($ligne_annexe->getType() == "taux"): ?>Taux
                                                <?php endif; ?>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="hidden" id="nature_<?php echo $ligne_annexe->getId(); ?>" value="<?php echo $ligne_annexe->getNature(); ?>">
                                                <?php if ($ligne_annexe->getNature() == "saisie"): ?>Saisie
                                                <?php else: ?>Calcule
                                                <?php endif; ?>
                                            </td>
                                            <td style="text-align: center;"><input type="text" id="formule_<?php echo $ligne_annexe->getId(); ?>" name="formule" value="<?php echo $ligne_annexe->getFormule(); ?>" class="uppercase_input" readonly="true"></td>
                                            <td style="text-align: center; <?php if ($sommation == false): ?>display: none;<?php endif; ?>">
                                                <input name="sommation" id="sommation_<?php echo $ligne_annexe->getId(); ?>" <?php if ($ligne_annexe->getSommation() == true): ?>checked="true"<?php endif; ?> type="checkbox" class="disabledbutton">
                                            </td>
                                            <td style="text-align: center;">
                                                <input name="c_total" id="c_total_<?php echo $ligne_annexe->getId(); ?>" <?php if ($ligne_annexe->getTotal() == true): ?>checked="true"<?php endif; ?> type="checkbox" class="disabledbutton">
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" id="zone_show_table">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="annexe_id" value="<?php echo $annexe_id; ?>">

<div class="col-xs-12 col-sm-12" style="text-align: right; margin-top: 10px;">
    <a href="<?php echo url_for('@annexebudget') ?>" type="button" class="btn btn-white btn-primary">
        <i class="ace-icon fa fa-undo bigger-110"></i> 
        <span class="bigger-110 no-text-shadow">Retour à la liste</span>
    </a>
</div>

<script  type="text/javascript">

    function showTableEdit() {
        var count_nature_calcule = 0;
        var count_calcule = 0;

        var rang = '';
        $('input[name="rang"]').each(function () {
            rang = rang + $(this).val() + ',';
        });
        var colonne = '';
        $('input[name="colonne"]').each(function () {
            colonne = colonne + $(this).val() + ';;';
        });
        var type_colonne = '';
        $('select[name="type"]').each(function () {
            type_colonne = type_colonne + $(this).val() + ',';
        });
        var nature = '';
        $('select[name="nature"]').each(function () {
            nature = nature + $(this).val() + ',';
            if ($(this).val() == "calcule")
                count_nature_calcule++;
        });
        var formule = '';
        $('input[name="formule"]').each(function () {
            formule = formule + $(this).val() + ',';
            if ($(this).val() != "")
                count_calcule++;
        });
        formule = formule.replace(/\+/gi, "$");
        var sommation = '';
        $('input[name="sommation"]').each(function () {
            sommation = sommation + $(this).is(":checked") + ',';
        });
        var total = '';
        $('input[name="c_total"]').each(function () {
            total = total + $(this).is(":checked") + ',';
        });
        if (count_nature_calcule == count_calcule) {
            $.ajax({
                url: '<?php echo url_for('annexebudget/showExemple') ?>',
                data: 'rang=' + rang +
                        '&colonne=' + colonne +
                        '&type_colonne=' + type_colonne +
                        '&nature=' + nature +
                        '&formule=' + formule +
                        '&sommation=' + sommation +
                        '&total=' + total +
                        '&titre=' + "<?php echo $titre; ?>" +
                        '&direction=' + "<?php echo $direction ?>" +
                        '&sommation_table=' + "<?php echo $sommation; ?>",
                success: function (data) {
                    $("#zone_show_table").html(data);
                }
            });
        }
    }

</script>

<style>

    .uppercase_input{text-transform: uppercase;}

</style>