<div id="dialog-message" class="hide">
    <form>
        <fieldset>
            <label>Dossier comptable</label>
            <?php
            $user = new Utilisateur();

            $user = $sf_user->getAttribute('userB2m');
            if ($user->getProfil()->getId() != 1)
                $dossiers = DossiercomptableTable::getInstance()->getDossierByUser($user->getId());

            else {
                $dossiers = DossiercomptableTable::getInstance()->getAllActive();
            }
            ?>
            <?php // $dossiers = DossierComptableTable::getInstance()->getAll(); ?>
            <select class="chosen-select form-control" id="dossier_courant_menu" data-placeholder="Déterminez le dossier courant" <?php if (sizeof($dossiers) > 1): ?> onchange="getExerciceByDossierMenu()"  <?php endif; ?> >
                <option value=""></option>
                <?php foreach ($dossiers as $dossier): ?>
                    <option <?php if ($dossier->getId() == $_SESSION['dossier_id']): ?> selected="true"  <?php endif; ?> value="<?php echo $dossier->getId() ?>"><?php echo trim($dossier->getCode()) . ' - ' . trim($dossier->getRaisonsociale()); ?></option>
                <?php endforeach; ?>
            </select>
        </fieldset>

        <fieldset>
            <label>Exercice comptable</label>
            <select class="chosen-select form-control" id="exercice_courant_menu" data-placeholder="Déterminez l'exercice courant">
                <option value=""></option>
                <?php
                if (sizeof($dossiers) >= 1):
                    if ($_SESSION['dossier_id'] != null):

                        $exercices = ExerciceTable::getInstance()->getAllByDossier($_SESSION['dossier_id']);
                    else:

                        $exercices = ExerciceTable::getInstance()->getAllExer('comp');
                    endif;
                else:
                    $exercices = ExerciceTable::getInstance()->findAllByOrder('comp');
                endif;
                ?>
                <?php foreach ($exercices as $exercice): ?>
                    <option <?php if ($exercice->getId() == $_SESSION['exercice_id']): ?> selected="true"  <?php endif; ?> value="<?php echo $exercice->getId() ?>"><?php echo $exercice->getLibelle() ?></option>
                <?php endforeach; ?>

            </select>
<!--            <select class="chosen-select form-control" id="exercice_courant_menu" data-placeholder="Déterminez l'exercice courant">

            </select>-->
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
                    text: "Charger",
                    "class": "btn btn-primary btn-minier",
                    click: function () {
                        if ($('#exercice_courant_menu').val() != '' || $('#dossier_courant_menu').val() != '') {
                            $('#exercice_courant_menu').css('border', '');
                            $.ajax({
                                url: '<?php echo url_for('@validerDossierCourant') ?>',
                                data: 'exercice_id=' + $('#exercice_courant_menu').val() +
                                        '&dossier_id=' + $('#dossier_courant_menu').val(),
                                success: function (data) {

                                    document.location.href = "<?php echo sfconfig::get('sf_appdir') . 'comptabilite.php' ?>";
                                }
                            });
                        } else {
                            if ($('#exercice_courant_menu').val() == '') {
                                $('#exercice_courant_menu_chosen').css('border', '3px solid #e65454');
                                $('#exercice_courant_menu_chosen').css('border-radius', '6px');
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

    function getExerciceByDossierMenu() {
        if ($('#dossier_courant_menu').val() != '') {
            $.ajax({
                url: '<?php echo url_for('accueil/getExerciceByDossier'); ?>',
                data: 'dossier_id=' + $('#dossier_courant_menu').val(),
                success: function (data) {
                    $("#exercice_courant_menu").html(data);

                    $("#exercice_courant_menu").val('').trigger("liszt:updated");
                    $("#exercice_courant_menu").trigger("chosen:updated");
                }
            });
        }
    }

    function showModalCreationjournaux() {
        var dialog = $("#dialog-message").removeClass('hide').dialog({
            modal: true,
            title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> Choisir le dossier comptable </h4></div>",
            title_html: true,
            buttons: [
                {
                    text: "Changer",
                    "class": "btn btn-primary btn-minier",
                    click: function () {
                        if ($('#exercice_courant_menu').val() != '' || $('#dossier_courant_menu').val() != '') {
                            $('#exercice_courant_menu').css('border', '');
                            $.ajax({
                                url: '<?php echo url_for('@validerDossierCourant') ?>',
                                data: 'exercice_id=' + $('#exercice_courant_menu').val() +
                                        '&dossier_id=' + $('#dossier_courant_menu').val(),
                                success: function (data) {
//                                    alert(data);
                                    //document.location.reload();
                                    document.location.href = "<?php echo sfconfig::get('sf_appdir') . 'comptabilite.php' ?>";
                                }
                            });
                        } else {
                            document.location.reload(true);
                            if ($('#exercice_courant_menu').val() == '') {
                                $('#exercice_courant_menu_chosen').css('border', '3px solid #e65454');
                                $('#exercice_courant_menu_chosen').css('border-radius', '6px');
                            }
                            if ($('#dossier_courant_menu').val() == '') {
                                $('#dossier_courant_menu_chosen').css('border', '3px solid #e65454');
                                $('#dossier_courant_menu_chosen').css('border-radius', '6px');

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