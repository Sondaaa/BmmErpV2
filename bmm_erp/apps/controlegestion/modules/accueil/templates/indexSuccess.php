<?php
if (!isset($_SESSION['exercice_budget'])):
    $_SESSION['exercice_budget'] = null;
endif;
?>
<?php if ($_SESSION['exercice_budget'] == null): ?>
    <div class="row" style="margin-top: 50px;">
        <div class="col-sm-5 col-xs-push-3">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Exercice Budget Courant</h4>
                </div>

                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <form>
                            <!-- <legend>Form</legend> -->
                            <fieldset>
                                <label>Société</label>
                                <input type="text" id="dossier_courant" value="<?php echo $societe->getRs() ?>" disabled="true" class="form-control" />
                            </fieldset>

                            <fieldset>
                                <label>Exercice Budget</label>
                                <select class="chosen-select form-control" id="exercice_courant" data-placeholder="Déterminez l'exercice courant">
                                    <option value=""></option>
                                    <?php $exercices = ExerciceTable::getInstance()->findByType('budget'); ?>
                                    <?php if (isset($_SESSION['exercice_budget'])): ?>
                                        <?php foreach ($exercices as $exercice): ?>
                                            <option <?php if ($_SESSION['exercice_budget'] == trim($exercice->getLibelle())): ?>selected="true"<?php endif; ?> value="<?php echo trim($exercice->getLibelle()) ?>"><?php echo trim($exercice->getLibelle()) ?></option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <?php foreach ($exercices as $exercice): ?>
                                            <option <?php if (date('Y') == trim($exercice->getLibelle())): ?>selected="true"<?php endif; ?> value="<?php echo trim($exercice->getLibelle()) ?>"><?php echo trim($exercice->getLibelle()) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </fieldset>

                            <div class="form-actions center">
                                <button type="button" class="btn btn-sm btn-success" onclick="validerDossierCourant()">
                                    Valider
                                    <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script  type="text/javascript">

        function validerDossierCourant() {
            if ($('#exercice_courant').val() != '') {
                $('#exercice_courant').css('border', '');
                $.ajax({
                    url: '<?php echo url_for('@validerExerciceCourant') ?>',
                    data: 'exercice_id=' + $('#exercice_courant').val(),
                    success: function (data) {
                        document.location.reload();
                    }
                });
            } else {
                if ($('#exercice_courant').val() == '') {
                    $('#exercice_courant_chosen').css('border', '3px solid #e65454');
                    $('#exercice_courant_chosen').css('border-radius', '6px');
                }
            }
        }

    </script>
<?php endif; ?>

<?php if (($_SESSION['statistique'] == 0 && $_SESSION['exercice_budget'] != null) || $_SESSION['statistique'] == 1): ?>
    <div id="sf_admin_container">
        <h1 id="replacediv"> accueil  
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i> 
                Hiérarchies
            </small>
        </h1>
    </div>

    <div id="zone_hierarchie"></div>

    <script  type="text/javascript">

        $('document').ready(function () {
            showHierarchie();
        });

        function showHierarchie() {
            $.ajax({
                url: '<?php echo url_for('accueil/showHierarchie') ?>',
                data: '',
                success: function (data) {
                    $('#zone_hierarchie').html(data);
                }
            });
        }

    </script>
<?php endif; ?>