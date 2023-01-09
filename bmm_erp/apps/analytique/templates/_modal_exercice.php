<div id="dialog-message" class="hide">
    <form>
        <fieldset>
            <label>Dossier comptable</label>
            <?php $dossier = DossierComptableTable::getInstance()->findAll()->getFirst(); ?>
            <input type="text" id="dossier_courant_menu" value="<?php echo $dossier->getRaisonsociale() ?>" disabled="true" class="form-control" />
        </fieldset>

        <fieldset>
            <label>Exercice comptable</label>
            <select class="chosen-select form-control" id="exercice_courant_menu" data-placeholder="Déterminez l'exercice courant">
                <option value=""></option>
                <?php $exercices = ExerciceTable::getInstance()->getAll(); ?>
                <?php if (!isset($_SESSION['exercice_id'])): ?>
                    <?php foreach ($exercices as $exercice): ?>
                        <option <?php if ($_SESSION['exercice_id'] == $exercice->getId()): ?>selected="true"<?php endif; ?> value="<?php echo $exercice->getId() ?>"><?php echo $exercice->getLibelle() ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php foreach ($exercices as $exercice): ?>
                        <option value="<?php echo $exercice->getId() ?>"><?php echo $exercice->getLibelle() ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </fieldset>
    </form>
</div><!-- #dialog-message -->

<script  type="text/javascript">

    function showModal() {
        var dialog = $("#dialog-message").removeClass('hide').dialog({
            modal: true,
            title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> Changer l'\exercice comptable courant</h4></div>",
            title_html: true,
            buttons: [
                {
                    text: "Changer",
                    "class": "btn btn-primary btn-minier",
                    click: function () {
                        if ($('#exercice_courant_menu').val() != '') {
                            $('#exercice_courant_menu').css('border', '');
                            $.ajax({
                                url: '<?php echo url_for('@validerDossierCourant') ?>',
                                data: 'exercice_id=' + $('#exercice_courant_menu').val(),
                                success: function (data) {
                                    document.location.href = "<?php echo sfconfig::get('sf_appdir') . 'comptabilite.php' ?>";
                                }
                            });
                        } else {
                            if ($('#exercice_courant_menu').val() == '') {
                                $('#exercice_courant_chosen').css('border', '3px solid #e65454');
                                $('#exercice_courant_chosen').css('border-radius', '6px');
                            }
                        }
                    }
                },
                {
                    text: "Annuler",
                    "class": "btn btn-minier",
                    click: function () {
                        $(this).dialog("close");
                    }
                }
            ]
        });

        $('.chosen-container').attr("style", "width: 100%;");
        $('.chosen-container').trigger("chosen:updated");
        $('#dialog-message').attr('style', 'min-height:200px;margin-top:10px;width:450px;');
        $('#dialog-message').parent().addClass('width-400');
    }

</script>

<style>

    .width-400{width: 450px !important;}

</style>